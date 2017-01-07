<?php

require_once(__DIR__."/../core/ValidationException.php");
require_once(__DIR__."/../model/PROFILE.php");
require_once(__DIR__."/../model/PERMISSION.php");

class Pupil_attends_event {

    public $codEvent;
    public $codStudent;



    public function __construct($codEvent=NULL,$codStudent=NULL)
    {
        $this->codEvent = $codEvent;
        $this->codStudent = $codStudent;
    }

    public function getCodEvent(){
        return $this->codEvent;
    }

    public function setCodEvent($codEvent){
        $this->codEvent = $codEvent;
    }

    public function getCodStudent(){
        return $this->codStudent;
    }

    public function setCodStudent($codStudent){
        $this->codStudent = $codStudent;
    }

}
