<?php
namespace PhitFlyer\Http;

use PhitFlyer\PhitFlyerClient;

class HttpGetRequest extends CurlRequest
{
    /** @var string  */
    private $url;
    
    /** @var array  */
    private $query_data;
    
    /** @var array  */
    private $options;
    
    /**
     * Construct
     *
     * @param PhitFlyerClient $client
     * @param string $url
     * @param array $query_data
     * @param array $options
     */
    public function __construct($client, $url, $query_data = null, $options = null)
    {
        parent::__construct($client);
        
        $this->url = $url;
        $this->query_data = $query_data ? $query_data : array();
        $this->options = $options ? $options : array();
    }
    
    /**
     * get query data
     *
     * @return array
     */
    public function getQueryData()
    {
        return $this->query_data;
    }
    
    /**
     * get http headers
     *
     * @return array
     */
    public function getHttpHeaders()
    {
        $http_deaders = parent::getDefaultHttpHeaders();
    
        $http_deaders['Content-Type'] = 'text/plain';
        
        if (isset($this->options['http_headers'])){
            $http_deaders = array_merge($http_deaders, $this->options['http_headers']);
        }
        return $http_deaders;
    }
    
    /**
     * get url
     *
     * @return string
     */
    public function getUrl()
    {
        return !empty($this->query_data) ? $this->url . '?' . http_build_query($this->query_data) : $this->url;
    }
    
    /**
     * get extra options
     *
     * @return array
     */
    public function getExtraOptions()
    {
        return array(
            CURLOPT_CUSTOMREQUEST => 'GET',
        );
    }
}