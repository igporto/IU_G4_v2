<?php

require_once(__DIR__."/../core/ValidationException.php");
require_once(__DIR__."/../model/PROFILE.php");
require_once(__DIR__."/../model/PERMISSION.php");

class Pupilhasinjury
{

    public $cod;
    public $pupil;
    public $injury;
    public $dateRecovery;
    public $date;


    public function __construct($cod = NULL, Alumn $pupil = NULL, Injury $injury = NULL, $date = NULL, $dateRecovery = NULL)
    {
        $this->cod = $cod;
        $this->pupil = $pupil;
        $this->injury = $injury;
        $this->date = $date;
        $this->dateRecovery = $dateRecovery;
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
     * @return Pupil
     */
    public function getPupil()
    {
        return $this->pupil;
    }

    public function setPupil(Alumn $pupil)
    {
        $this->pupil = $pupil;
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
    public function setInjury($injury)
    {
        $this->injury = $injury;
    }

    /**
     * @return null
     */
    public function getDateRecovery()
    {
        return $this->dateRecovery;
    }

    /**
     * @param null $dateRecovery
     */
    public function setDateRecovery($dateRecovery)
    {
        $this->dateRecovery = $dateRecovery;
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