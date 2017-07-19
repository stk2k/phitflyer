<?php
namespace PhitFlyer\Exception;

use Grasshopper\Event\ErrorEvent;

class GrasshopperErrorException extends \Exception
{
    private $error_event;
    
    /**
     * construct
     *
     * @param ErrorEvent $error_event
     */
    public function __construct($error_event){
        parent::__construct($error_event->getError()->getMessage());
        $this->error_event = $error_event;
    }
    
    /**
     * get error event
     *
     * @return ErrorEvent
     */
    public function getErrorEvent(){
        return $this->error_event;
    }
}