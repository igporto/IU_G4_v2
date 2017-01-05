<?php

class Schedule
{
	
    private $name;
    private $dateStart;
	private $dateEnd;
    private $idSchedule;
	
	public function __construct( $idSchedule=NULL, $name = NULL, $dateStart = NULL, $dateEnd=NULL)
    {
        $this->name		= $name;
        $this->dateStart	= $dateStart;
        $this->dateEnd		= $dateEnd;
        $this->idSchedule   = $idSchedule;
    }
    
    /**
     * Gets the value of name.
     *
     * @return mixed
     */
    public function getSchedulename()
    {
        return $this->name;
    }
    
    /**
     * Sets the value of name.
     *
     * @param mixed $name the name
     *
     * @return self
     */
    public function setSchedulename($name)
    {
        $this->name = $name;
        
        return $this;
    }
    
    /**
     * Gets the value of dateStart.
     *
     * @return mixed
     */
    public function getDateStart()
    {
        return $this->dateStart;
    }
    
    /**
     * Sets the value of dateStart.
     *
     * @param mixed $dateStart the dateStart
     *
     * @return self
     */
    public function setDateStart($dateStart)
    {
        $this->dateStart = $dateStart;
        
        return $this;
    }	
	
	/**
     * Gets the value of dateEnd.
     *
     * @return mixed
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }
    
    /**
     * Sets the value of dateEnd.
     *
     * @param mixed $dateEnd the dateEnd
     *
     * @return self
     */
    public function setDateEnd($dateEnd)
    {
        $this->dateEnd = $dateEnd;
        
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
    public function setIdSchedule($idSchedule)
    {
        $this->idSchedule = $idSchedule;

        return $this;
    }
}
?>