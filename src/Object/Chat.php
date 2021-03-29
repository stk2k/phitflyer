<?php
declare(strict_types=1);

namespace Stk2k\PhitFlyer\Object;


class Chat
{
    /** @var string  */
    private $nickname;
    
    /** @var string  */
    private $message;
    
    /** @var string  */
    private $date;
    
    /**
     * construct
     *
     * @param string $nickname
     * @param string $message
     * @param string $date
     */
    public function __construct($nickname, $message, $date){
        $this->nickname = $nickname;
        $this->message = $message;
        $this->date = $date;
    }
    
    /**
     * construct from stdObject
     *
     * @param array $data
     *
     * @return Chat
     */
    public static function fromArray(array $data){
        return new self(
            isset($data['nickname']) ? $data['nickname'] : null,
            isset($data['message']) ? $data['message'] : null,
            isset($data['date']) ? $data['date'] : null
        );
    }
    
    /**
     * get nickname
     *
     * @return string
     */
    public function getNickname(){
        return $this->nickname;
    }
    
    /**
     * get message
     *
     * @return string
     */
    public function getMessage(){
        return $this->message;
    }
    
    /**
     * get date
     *
     * @return string
     */
    public function getDate(){
        return $this->date;
    }
    
}