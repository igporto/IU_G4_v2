<?php

class Session
{   
   
	private $idSession;
    private $date;
    private $hourstart;
    private $hourend;
    private $space;
    private $event;
    private $activity;
    private $employee;


	
	public function __construct(
                    $idSession=NULL,
                    $date=NULL,
                    $hourstart=NULL,
                    $hourend=NULL,
                    $space=NULL,
                    $event=NULL,
                    $activity=NULL,
                    $employee=NULL)
    {
        $this->idSession = $idSession;
        $this->date = $date;
        $this->hourstart = $hourstart;
        $this->hourend = $hourend;
        $this->space = $space;
        $this->event = $event;
        $this->activity = $activity;
        $this->employee = $employee;

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
     * Gets the value of space.
     *
     * @return mixed
     */
    public function getSpace()
    {
        return $this->space;
    }

    /**
     * Gets the value of event.
     *
     * @return mixed
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * Gets the value of activity.
     *
     * @return mixed
     */
    public function getActivity()
    {
        return $this->activity;
    }

    /**
     * Gets the value of employee.
     *
     * @return mixed
     */
    public function getEmployee()
    {
        return $this->employee;
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
     * Sets the value of space.
     *
     * @param mixed $space the id space
     *
     * @return self
     */
    public function setSpace(Space $space)
    {
        $this->space = $space;

        return $this;
    }

    /**
     * Sets the value of event.
     *
     * @param mixed $event the id event
     *
     * @return self
     */
    public function setEvent(Event $event)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Sets the value of activity.
     *
     * @param mixed $activity the iactivity
     *
     * @return self
     */
    public function setActivity(Activity $activity)
    {
        $this->activity = $activity;

        return $this;
    }

    /**
     * Sets the value of employee.
     *
     * @param mixed $employee the id employee
     *
     * @return self
     */
    public function setEmployee(Employee $employee)
    {
        $this->employee = $employee;

        return $this;
    }


    /**
     * Gets the value of date.
     *
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Sets the value of date.
     *
     * @param mixed $date the date
     *
     * @return self
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Gets the value of hourstart.
     *
     * @return mixed
     */
    public function getHourstart()
    {
        return $this->hourstart;
    }

    /**
     * Sets the value of hourstart.
     *
     * @param mixed $hourstart the hourstart
     *
     * @return self
     */
    public function setHourstart($hourstart)
    {
        $this->hourstart = $hourstart;

        return $this;
    }

    /**
     * Gets the value of hourend.
     *
     * @return mixed
     */
    public function getHourend()
    {
        return $this->hourend;
    }

    /**
     * Sets the value of hourend.
     *
     * @param mixed $hourend the hourend
     *
     * @return self
     */
    public function setHourend($hourend)
    {
        $this->hourend = $hourend;

        return $this;
    }
}
?>