<?php
require_once(__DIR__."/../core/ValidationException.php");
require_once(__DIR__."/../model/RESERVE.php");

class Physio {
    public $codPhysio;
    public $reserve;
    public $date;
    public $startTime;
    public $endTime;

    public function __construct($codPhysio = NULL, Reserve $reserve = NULL, $date = NULL, $startTime = NULL, $endTime = NULL)
    {
        $this->codPhysio = $codPhysio;
        $this->reserve = $reserve;
        $this->date = $date;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
    }

    public function getCodPhysio()
    {
        return $this->codPhysio;
    }
    public function setCodPhysio($codPhysio)
    {
        $this->codPhysio = $codPhysio;
    }
    
    public function getReserve()
    {
        return $this->reserve;
    }
    
    public function setReserve(Reserve $reserve)
    {
        $this->reserve = $reserve;
    }
    
    public function getDate()
    {
        return $this->date;
    }
    
    public function setDate($date)
    {
        $this->date = $date;
    } 
    
    public function getStartTime()
    {
        return $this->startTime;
    }
    
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;
    }  
    public function getEndTime()
    {
        return $this->endTime;
    }
    
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;
    }
}