<?php

require_once(__DIR__."/../core/ValidationException.php");

class Accesslog {

    private $cod;
    private $injury;
    private $alumn;
    private $employee;
    private $user;
    private $date;

    public function __construct($cod = NULL, Injury $injury = NULL, Alumn $alumn = NULL,Employee $employee = NULL, User $user = NULL, $date = NULL)
    {
        $this->cod = $cod;
        $this->injury = $injury;
        $this->alumn = $alumn;
        $this->employee = $employee;
        $this->user = $user;
        $this->date = $date;
    }

    /**
     * @return null
     */
    public function getCod()
    {
        return $this->cod;
    }

    /**
     * @param null $cod
     */
    public function setCod($cod)
    {
        $this->cod = $cod;
    }

    /**
     * @return Injury
     */
    public function getInjury()
    {
        return $this->injury;
    }

    /**
     * @param Injury $injury
     */
    public function setInjury( Injury $injury)
    {
        $this->injury = $injury;
    }

    /**
     * @return Alumn
     */
    public function getAlumn()
    {
        return $this->alumn;
    }

    /**
     * @param Alumn $alumn
     */
    public function setAlumn(Alumn $alumn)
    {
        $this->alumn = $alumn;
    }

    /**
     * @return Employee
     */
    public function getEmployee()
    {
        return $this->employee;
    }

    /**
     * @param Employee $employee
     */
    public function setEmployee(Employee $employee)
    {
        $this->employee = $employee;
    }


    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return null
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param null $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }


}
