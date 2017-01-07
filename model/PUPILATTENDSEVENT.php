<?php

require_once(__DIR__."/../core/ValidationException.php");

class PupilAttendsEvent {

    public $event;
    public $alumn;


    public function __construct(Event $event = NULL, Alumn $alumn = NULL)
    {
        $this->event = $event;
        $this->alumn = $alumn;
    }


    public function getEvent()
    {
        return $this->event;
    }

    public function setEvent( Event $event)
    {
        $this->event = $event;
    }

    public function getAlumn()
    {
        return $this->alumn;
    }

    public function setAlumn( Alumn$alumn)
    {
        $this->alumn = $alumn;
    }


}
