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
    public function __construct(string $nickname, string $message, string $date){
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
    public static function fromArray(array $data) : Chat
    {
        return new self(
            $data['nickname'] ?? null,
            $data['message'] ?? null,
            $data['date'] ?? null
        );
    }
    
    /**
     * get nickname
     *
     * @return string
     * @noinspection PhpUnused
     */
    public function getNickname() : string
    {
        return $this->nickname;
    }
    
    /**
     * get message
     *
     * @return string
     */
    public function getMessage() : string{
        return $this->message;
    }
    
    /**
     * get date
     *
     * @return string
     */
    public function getDate() : string
    {
        return $this->date;
    }
    
}