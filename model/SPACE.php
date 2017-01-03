<?php

require_once(__DIR__."/../core/ValidationException.php");

class Space {

    public $capacity;
    public $spacename;
    public $codspace;
    public $description;
    
    public function __construct($codspace = NULL, $spacename = NULL, $capacity = NULL, $description = NULL)
    {
        $this->capacity = $capacity;
        $this->codspace = $codspace;
        $this->spacename = $spacename;
        $this->description = $description;
    }

    public function getCapacity()
    {
        return $this->capacity;
    }

    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;
    }
    
    public function getSpacename()
    {
        return $this->spacename;
    }

    public function setSpacename($spacename)
    {
        $this->spacename = $spacename;
    }

    public function getCodspace()
    {
        return $this->codspace;
    }


    public function setCodspace($codspace)
    {
        $this->codspace = $codspace;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

}
