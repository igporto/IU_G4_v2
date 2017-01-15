<?php

require_once(__DIR__."/../core/ValidationException.php");

class Attendance {

    private $cod;
    private $alumn;
    private $session;
    private $assist;

    public function __construct($cod = NULL,Alumn $alumn = NULL, Session $session = NULL, $assist = false)
    {
        $this->cod=$cod;
        $this->alumn = $alumn;
        $this->session = $session;
        $this->assist = $assist;
    }

    public function getCod()
    {
        return $this->cod;
    }

    public function setCod($cod)
    {
        $this->cod = $cod;
    }


    public function getAlumn()
    {
        return $this->alumn;
    }

    public function setAlumn( Alumn $alumn)
    {
        $this->alumn = $alumn;
    }

    public function getSession()
    {
        return $this->session;
    }

    public function setSession( Session $session)
    {
        $this->session = $session;
    }

    public function isAssist()
    {
        return $this->assist;
    }

    public function setAssist($assist)
    {
        $this->assist = $assist;
    }

}
