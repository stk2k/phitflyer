<?php
namespace PhitFlyer\Object;


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
     * @param object $obj
     *
     * @return Chat
     */
    public static function fromObject($obj){
        return new self(
            property_exists($obj,'nickname') ? $obj->nickname : null,
            property_exists($obj,'message') ? $obj->message : null,
            property_exists($obj,'date') ? $obj->date : null
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