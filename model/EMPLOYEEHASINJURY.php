<?php

require_once(__DIR__."/../core/ValidationException.php");
require_once(__DIR__."/../model/PROFILE.php");
require_once(__DIR__."/../model/PERMISSION.php");

class Employeehasinjury
{

    public $cod;
    public $employee;
    public $injury;
    public $dateRecovery;
    public $dateInjury;

    /**
     * Employer_has_injury constructor.
     * @param $cod
     * @param $employee
     * @param $injury
     * @param $dateRecovery
     * @param $dateInjury
     */
    public function __construct($cod = NULL, Employee $employee = NULL, Injury $injury = NULL, $dateInjury = NULL, $dateRecovery = NULL)
    {
        $this->cod = $cod;
        $this->employee = $employee;
        $this->injury = $injury;
        $this->dateRecovery = $dateRecovery;
        $this->dateInjury = $dateInjury;
    }

    /**
     * @return mixed
     */
    public function getCod()
    {
        return $this->cod;
    }

    /**
     * @param mixed $cod
     */
    public function setCod($cod)
    {
        $this->cod = $cod;
    }

    /**
     * @return mixed
     */
    public function getEmployee()
    {
        return $this->employee;
    }

    /**
     * @param mixed $employee
     */
    public function setEmployee(Employee $employee)
    {
        $this->employee = $employee;
    }

    /**
     * @return mixed
     */
    public function getInjury()
    {
        return $this->injury;
    }

    /**
     * @param mixed $injury
     */
    public function setInjury(Injury $injury)
    {
        $this->injury = $injury;
    }

    /**
     * @return mixed
     */
    public function getDateRecovery()
    {
        return $this->dateRecovery;
    }

    /**
     * @param mixed $dateRecovery
     */
    public function setDateRecovery($dateRecovery)
    {
        $this->dateRecovery = $dateRecovery;
    }

    /**
     * @return mixed
     */
    public function getDateInjury()
    {
        return $this->dateInjury;
    }

    /**
     * @param mixed $dateInjury
     */
    public function setDateInjury($dateInjury)
    {
        $this->dateInjury = $dateInjury;
    }


}