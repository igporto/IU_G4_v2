<?php

require_once(__DIR__."/../core/ValidationException.php");
require_once(__DIR__."/../model/PROFILE.php");
require_once(__DIR__."/../model/PERMISSION.php");

class Employer_has_injury
{

    public $codEmp;
    public $codInjury;
    public $dateRecovery;
    public $dateInjury;


    public function __construct($codEmp = NULL, $codInjury = NULL, $dateInjury = NULL, $dateRecovery = NULL)
    {
        $this->codEmp = $codEmp;
        $this->codInjury = $codInjury;
        $this->dateInjury = $dateInjury;
        $this->dateRecovery = $dateRecovery;
    }

    public function getCodEmpl()
    {
        return $this->codEmp;
    }

    public function setCodEmpl($codEmp)
    {
        $this->codEmp = $codEmp;
    }

    public function getCodInjury()
    {
        return $this->codInjury;
    }

    public function setCodInjury($codInjury)
    {
        $this->codInjury = $codInjury;
    }

    public function getDateInjury()
    {
        return $this->dateInjury;
    }

    public function setDateInjury($dateInjury)
    {
        $this->dateInjury = $dateInjury;
    }

    public function getDateRecovery()
    {
        return $this->dateRecovery;
    }

    public function setDateRecovery($dateRecovery)
    {
        $this->dateRecovery = $dateRecovery;
    }

}