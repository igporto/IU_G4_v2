<?php

class Session
{   
   
	private $name;
	private $idSession;
    private $idSchedule;
    private $idFisio;
    private $idSpace;
    private $idEvent;
    private $idActivity;
    private $idEmployee;


	
	public function __construct(
                    $name=NULL,
                    $idSession=NULL,
                    $idSchedule=NULL,
                    $idFisio=NULL,
                    $idSpace=NULL,
                    $idEvent=NULL,
                    $idActivity=NULL,
                    $idEmployee=NULL)
    {
        $this->name = $name;
        $this->idSession = $idSession;
        $this->idSchedule = $idSchedule;
        $this->idFisio = $idFisio;
        $this->idSpace = $idSpace;
        $this->idEvent = $idEvent;
        $this->idActivity = $idActivity;
        $this->idEmployee = $idEmployee;

    }
	

    /**
     * Gets the value of idSession.
     *
     * @return mixed
     */
    public function getIdSession()
    {
        return $this->idSession;
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
     * Gets the value of idFisio.
     *
     * @return mixed
     */
    public function getIdFisio()
    {
        return $this->idFisio;
    }

    /**
     * Gets the value of idSpace.
     *
     * @return mixed
     */
    public function getIdSpace()
    {
        return $this->idSpace;
    }

    /**
     * Gets the value of idEvent.
     *
     * @return mixed
     */
    public function getIdEvent()
    {
        return $this->idEvent;
    }

    /**
     * Gets the value of idActivity.
     *
     * @return mixed
     */
    public function getIdActivity()
    {
        return $this->idActivity;
    }

    /**
     * Gets the value of idEmployee.
     *
     * @return mixed
     */
    public function getIdEmployee()
    {
        return $this->idEmployee;
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

    /**
     * Sets the value of idSession.
     *
     * @param mixed $idSession the id session
     *
     * @return self
     */
    public function setIdSession($idSession)
    {
        $this->idSession = $idSession;

        return $this;
    }

    /**
     * Sets the value of idFisio.
     *
     * @param mixed $idFisio the id fisio
     *
     * @return self
     */
    public function setIdFisio($idFisio)
    {
        $this->idFisio = $idFisio;

        return $this;
    }

    /**
     * Sets the value of idSpace.
     *
     * @param mixed $idSpace the id space
     *
     * @return self
     */
    public function setIdSpace($idSpace)
    {
        $this->idSpace = $idSpace;

        return $this;
    }

    /**
     * Sets the value of idEvent.
     *
     * @param mixed $idEvent the id event
     *
     * @return self
     */
    public function setIdEvent($idEvent)
    {
        $this->idEvent = $idEvent;

        return $this;
    }

    /**
     * Sets the value of idActivity.
     *
     * @param mixed $idActivity the id activity
     *
     * @return self
     */
    public function setIdActivity($idActivity)
    {
        $this->idActivity = $idActivity;

        return $this;
    }

    /**
     * Sets the value of idEmployee.
     *
     * @param mixed $idEmployee the id employee
     *
     * @return self
     */
    public function setIdEmployee($idEmployee)
    {
        $this->idEmployee = $idEmployee;

        return $this;
    }

    /**
     * Gets the value of name.
     *
     * @return mixed
     */
    public function getName()
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
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}
?>