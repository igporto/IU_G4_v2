<?php

require_once(__DIR__."/../core/ValidationException.php");
require_once(__DIR__."/../model/PROFILE.php");
require_once(__DIR__."/../model/PERMISSION.php");

class Event {

    public $codEvent;
    public $name;
    public $ini_hour;
    public $fin_hour;
    public $date;
    public $capacity;
    public $codSpace;
    public $cod_prof;



    public function __construct($codEvent=NULL,$name=NULL,$ini_hour=NULL,$fin_hour=NULL,$date=NULL,$capacity=NULL,$codSpace=NULL,$cod_prof=NULL)
    {
        $this->codEvent = $codEvent;
        $this->name = $name;
        $this->ini_hour = $ini_hour;
        $this->fin_hour = $fin_hour;
        $this->date = $date;
        $this->capacity = $capacity;
        $this->codSpace = $codSpace;
        $this->cod_prof = $cod_prof;
    }

    public function getCodEvent(){
        return $this->codEvent;
    }

    public function setCodEvent($codEvent){
        $this->codEvent = $codEvent;
    }

    public function getEventname(){
        return $this->name;
    }

    public function setEventname($name){
        $this->name = $name;
    }
    public function getInitialHour(){
        return $this->ini_hour;
    }

    public function setInitialHour($ini_hour){
        $this->ini_hour = $ini_hour;
    }

    public function getFinalHour(){
        return $this->fin_hour;
    }

    public function setFinalHour($fin_hour){
        $this->fin_hour = $fin_hour;
    }

    public function getDate(){
        return $this->date;
    }

    public function setDate($date){
        $this->date = $date;
    }

    public function getCapacity(){
        return $this->capacity;
    }

    public function setCapacity($capacity){
        $this->capacity = $capacity;
    }

    public function getCodSpace(){
        return $this->codSpace;
    }

    public function setCodSpace($cod_space){
        $this->codSpace = $cod_space;
    }

    public function getCodProf(){
        return $this->cod_prof;
    }

    public function setCodProf($cod_prof){
        $this->cod_prof = $cod_prof;
    }

}
