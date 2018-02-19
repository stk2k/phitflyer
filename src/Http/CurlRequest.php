<?php
namespace PhitFlyer\Http;

use PhitFlyer\PhitFlyerClient;
use PhitFlyer\Exception\BitflyerClientException;
use PhitFlyer\Exception\BitflyerApiErrorResponseException;
use PhitFlyer\Exception\BitflyerApiTimeoutException;
use PhitFlyer\Exception\JsonFormatException;
use PhitFlyer\Exception\CurlException;

abstract class CurlRequest
{
    /** @var PhitFlyerClient  */
    protected $client;
    
    /**
     * Construct
     *
     * @param PhitFlyerClient $client
     */
    public function __construct($client)
    {
        $this->client = $client;
    }
    
    /**
     * execute http request
     *
     * @param CurlHandle $handle
     * @param bool $return_value
     *
     * @return mixed
     *
     * @throws BitflyerClientException
     */
    public function execute($handle, $return_value = true)
    {
        $url = $this->getUrl();
    
        try{
            $ch = $handle->reset();
            
            // set default options
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    
            curl_setopt($ch, CURLINFO_HEADER_OUT, true);
            curl_setopt($ch, CURLOPT_VERBOSE, true);
            
            // set request header
            $headers = $this->getHttpHeaders();
            $headers_curl = array();
            foreach($headers as $key => $value){
                $headers_curl[] = "$key: $value";
            }
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers_curl);
            
            // set extra options
            $extra_options = $this->getExtraOptions();
            foreach($extra_options as $opt => $value){
                curl_setopt($ch, $opt, $value);
            }
            
            $result = curl_exec($ch);
        
            if ($result === false){
                throw new CurlException('curl_exec', $ch);
            }
        
            $info = curl_getinfo ($ch);
    
            $response = new CurlResponse($info, $result);
            
            $body = $response->getBody();
    
            $status_code = $response->getStatusCode();
            switch ($status_code)
            {
                case 200:   // Success
                    if ($return_value){
                        // decode json
                        $json = json_decode($body);
                        if ($json===null){
                            throw new JsonFormatException($body);
                        }
                        return $json;
                    }
                    break;
    
                case 524:   // Timeout
                    throw new BitflyerApiTimeoutException($url,$status_code);
                    break;
    
                default:
                    $json = json_decode($body, true);
            
                    if ($json){
                        $status = isset($json['status']) ? $json['status'] : '';
                        $message = isset($json['error_message']) ? $json['error_message'] : '';
                        $data = isset($json['data']) ? $json['data'] : '';
            
                        throw new BitflyerApiErrorResponseException($url,$status, $message, $data);
                    }
                    else{
                        throw new BitflyerApiErrorResponseException($url,-1, $body);
                    }
                    break;
            }
        }
        catch (\Exception $e){
            throw new BitflyerClientException($url, $e);
        }
        return null;
    }
    
    /**
     * get default http headers
     *
     * @return array
     */
    public function getDefaultHttpHeaders()
    {
        return array(
            'Content-Type' => 'text/plain',
            'User-Agent' => $this->client->getUserAgent(),
            'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
            'Accept-Language' => 'en-us;q=0.7,en;q=0.3',
            'Accept-Encoding' => 'gzip, deflate',
            'Accept-Charset' => 'ISO-8859-1,utf-8;q=0.7,*;q=0.7',
            'Connection' => 'keep-alive',
            'Keep-Alive' => '300',
            'Cache-Control' => 'max-age=0',
            'Pragma' => '',
        );
    }
    
    /**
     * get http headers
     *
     * @return array
     */
    public abstract function getHttpHeaders();
    
    /**
     * get url
     *
     * @return string
     */
    public abstract function getUrl();
    
    /**
     * get extra options
     *
     * @return array
     */
    public abstract function getExtraOptions();
    
}