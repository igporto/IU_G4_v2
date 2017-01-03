<?php

require_once(__DIR__."/../core/ValidationException.php");

class Discount {

    private $coddiscount;
    private $type;
    private $percent;
    private $description;

    public function __construct($coddiscount = NULL, $type = NULL, $percent = NULL, $description = NULL)
    {
        $this->coddiscount = $coddiscount;
        $this->type = $type;
        $this->percent = $percent;
        $this->description = $description;
    }


    public function getCoddiscount()
    {
        return $this->coddiscount;
    }

    public function setCoddiscount($coddiscount)
    {
        $this->coddiscount = $coddiscount;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getPercent()
    {
        return $this->percent;
    }

    public function setPercent($percent)
    {
        $this->percent = $percent;
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
