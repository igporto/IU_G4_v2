<?php

require_once(__DIR__."/../core/ValidationException.php");

class Injury {


    public $treatment;
    public $codinjury;
    public $description;
    public $time;
    public $name;

    public function __construct($codinjury = NULL,$name=NULL, $description = NULL, $treatment = NULL, $time = NULL)
    {
        $this->codinjury = $codinjury;
        $this->name = $name;
        $this->description= $description;
        $this->treatment = $treatment;
        $this->time = $time;
    }

    public function getCodInjury()
    {
        return $this->codinjury;
    }

    public function setCodInjury($codinjury)
    {
        $this->codinjury = $codinjury;
    }

    public function getNameInjury()
    {
        return $this->name;
    }

    public function setNameInjury($name)
    {
        $this->name = $name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getTreatment()
    {
        return $this->treatment;
    }

    public function setTreatment($treatment)
    {
        $this->treatment = $treatment;
    }

    public function getTime()
    {
        return $this->time;
    }

    public function setTime($time)
    {
        $this->time = $time;
    }


}
