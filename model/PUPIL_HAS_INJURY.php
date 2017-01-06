<?php

require_once(__DIR__."/../core/ValidationException.php");
require_once(__DIR__."/../model/PROFILE.php");
require_once(__DIR__."/../model/PERMISSION.php");

class Pupil_has_injury
{

    public $codPupil;
    public $codInjury;
    public $dateRecovery;
    public $dateInjury;


    public function __construct($codPupil = NULL, $codInjury = NULL, $dateInjury = NULL, $dateRecovery = NULL)
    {
        $this->codPupil = $codPupil;
        $this->codInjury = $codInjury;
        $this->dateInjury = $dateInjury;
        $this->dateRecovery = $dateRecovery;
    }

    public function getCodPupil()
    {
        return $this->codPupil;
    }

    public function setCodPupil($codPupil)
    {
        $this->codPupil = $codPupil;
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