<?php

class Hour
{
	
	private $idhour;
    private $day;
    private $hourStart;
	private $hourEnd;
    private $idSchedule;
	
	public function __construct($idhour = NULL, $day = NULL, $hourStart = NULL, $hourEnd=NULL, $idSchedule=NULL)
    {
        $this->idhour	= $idhour;
        $this->day		= $day;
        $this->hourStart	= $hourStart;
        $this->hourEnd		= $hourEnd;
        $this->idSchedule   = $idSchedule;
    }
	
	/**
     * Gets the value of idhour.
     *
     * @return mixed
     */
    public function getIdHour()
    {
        return $this->idhour;
    }
    
    /**
     * Sets the value of idhour.
     *
     * @param mixed $idhour the id Posibles
     *
     * @return self
     */
    private function setIdHour($idhour)
    {
        $this->idhour = $idhour;
        
        return $this;
    }
    
    /**
     * Gets the value of day.
     *
     * @return mixed
     */
    public function getDay()
    {
        return $this->day;
    }
    
    /**
     * Sets the value of day.
     *
     * @param mixed $day the day
     *
     * @return self
     */
    public function setDay($day)
    {
        $this->day = $day;
        
        return $this;
    }
    
    /**
     * Gets the value of hourStart.
     *
     * @return mixed
     */
    public function getHourStart()
    {
        return $this->hourStart;
    }
    
    /**
     * Sets the value of hourStart.
     *
     * @param mixed $hourStart the hourStart
     *
     * @return self
     */
    public function setHourStart($hourStart)
    {
        $this->hourStart = $hourStart;
        
        return $this;
    }	
	
	/**
     * Gets the value of hourEnd.
     *
     * @return mixed
     */
    public function getHourEnd()
    {
        return $this->hourEnd;
    }
    
    /**
     * Sets the value of hourEnd.
     *
     * @param mixed $hourEnd the hourEnd
     *
     * @return self
     */
    public function setHourEnd($hourEnd)
    {
        $this->hourEnd = $hourEnd;
        
        return $this;
    }	

    /**
     * Gets the value of idSchedule.
     *
     * @return mixed
     */
    public function getIdSchedule()
    {
        return $this->idSchedule;
    }

    /**
     * Sets the value of idSchedule.
     *
     * @param mixed $idSchedule the id schedule
     *
     * @return self
     */
    private function setIdSchedule($idSchedule)
    {
        $this->idSchedule = $idSchedule;

        return $this;
    }
}
?>