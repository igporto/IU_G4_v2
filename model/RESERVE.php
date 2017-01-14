<?php
require_once(__DIR__."/../core/ValidationException.php");
require_once(__DIR__."/../model/SPACE.php");
require_once(__DIR__."/../model/SERVICE.php");
require_once(__DIR__."/../model/ALUMN.php");

class Reserve {
	public $codReserve;
	public $space;
	public $service;
	public $alumn;
    public $reserveDate;
    public $start_time;
    public $end_time;
    public $spacePrice;
    public $physioPrice;
	public function __construct($codReserve=NULL, Space $space = NULL, Service $service=NULL, Alumn $alumn=NULL, $reserveDate=NULL,
                                $start_time=NULL, $end_time=NULL, $spacePrice=NULL, $physioPrice=NULL) {
		$this->codReserve = $codReserve;
		$this->space = $space;
		$this->service = $service;
		$this->alumn = $alumn;
        $this->reserveDate = $reserveDate;
        $this->start_time = $start_time;
        $this->end_time = $end_time;
        $this->spacePrice = $spacePrice;
        $this->physioPrice = $physioPrice;
	}
    /**
     * Gets the value of codReserve.
     *
     * @return mixed
     */
    public function getCodReserve()
    {
        return $this->codReserve;
    }
    /**
     * Sets the value of codReserve.service
     *
     * @param mixed $codReserve the codReserve
     *
     */
    public function setCodReserve($codReserve)
    {
        $this->codReserve = $codReserve;
    }
    /**
     * Gets the value of space.
     *
     * @return mixed
     */
    public function getSpace()
    {
        return $this->space;
    }
    /**
     * Sets the value of space.
     *
     * @param mixed $space the space
     *
     */
    public function setSpace(Space $space)
    {
        $this->space = $space;
    }
    /**
     * Gets the value of service.
     *
     * @return mixed
     */
    public function getService()
    {
        return $this->service;
    }
    /**
     * Sets the value of service.
     *
     * @param mixed $service the service
     *
     */
    public function setService( Service $service)
    {
        $this->service = $service;
    }
    /**
     * Gets the value of alumn.
     *
     * @return mixed
     */
    public function getAlumn()
    {
        return $this->alumn;
    }
    /**
     * Sets the value of alumn.
     *
     * @param mixed $alumn the alumn
     */
    public function setAlumn(Alumn $alumn)
    {
        $this->alumn = $alumn;
    }
    /**
     * Gets the value of reserveDate.
     *
     * @return mixed
     */
    public function getDate()
    {
        return $this->reserveDate;
    }
    /**
     * Sets the value of reserveDate.
     *
     * @param mixed $reserveDate the reserveDate
     * @return mixed    
     */

    public function setDate($reserveDate)
    {
        $this->reserveDate = $reserveDate;
        return $this;
    }
    /**
     * Gets the value of start_time.
     *
     * @return mixed
     */
    public function getStartTime()
    {
        return $this->start_time;
    }
    /**
     * Sets the value of start_time.
     *
     * @param mixed $start_time the start_time
     * @return mixed    
     */
    public function setStartTime($start_time)
    {
        $this->start_time = $start_time;
        return $this;
    }
    /**
     * Gets the value of end_time.
     *
     * @return mixed
     */
    public function getEndTime()
    {
        return $this->end_time;
    }
    /**
     * Sets the value of end_time.
     *
     * @param mixed $end_time the end_time
     * @return mixed    
     */
    public function setEndTime($end_time)
    {
        $this->end_time = $end_time;
        return $this;
    }
    /**
     * Gets the value of spacePrice.
     *
     * @return mixed
     */
    public function getSpacePrice()
    {
        return $this->spacePrice;
    }
    /**
     * Sets the value of spacePrice.
     *
     * @param mixed $spacePrice the spacePrice
     * @return mixed    
     */
    public function setSpacePrice($spacePrice)
    {
        $this->spacePrice = $spacePrice;
        return $this;
    }
    /**
     * Gets the value of physioPrice.
     *
     * @return mixed
     */
    public function getPhysioPrice()
    {
        return $this->physioPrice;
    }
    /**
     * Sets the value of physioPrice.
     *
     * @param mixed $physioPrice the physioPrice
     * @return mixed    
     */
    public function setPhysioPrice($physioPrice)
    {
        $this->physioPrice = $physioPrice;
        return $this;
    }
}
?>