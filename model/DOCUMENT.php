<?php

require_once(__DIR__."/../core/ValidationException.php");

class Document {

    private $coddocument;
    private $signdate;
    private $name;
    private $route;
    private $alumn;
    private $employee;


    public function __construct($coddocument = NULL, $signdate = NULL, $name = NULL, $route = NULL, Alumn $alumn = NULL, Employee $employee = NULL)
    {
        $this->coddocument = $coddocument;
        $this->signdate = $signdate;
        $this->name = $name;
        $this->alumn = $alumn;
        $this->route = $route;
        $this->employee = $employee;
    }

    public function getCoddocument()
    {
        return $this->coddocument;
    }

    public function setCoddocument($coddocument)
    {
        $this->coddocument = $coddocument;
    }

    public function getSigndate()
    {
        return $this->signdate;
    }

    public function setSigndate($signdate)
    {
        $this->signdate = $signdate;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getRoute()
    {
        return $this->route;
    }

    public function setRoute($route)
    {
        $this->route = $route;
    }


    public function getAlumn()
    {
        return $this->alumn;
    }

    public function setAlumn(Alumn $alumn)
    {
        $this->alumn = $alumn;
    }

    public function getEmployee()
    {
        return $this->employee;
    }

    public function setEmployee(Employee $employee)
    {
        $this->employee = $employee;
    }

    /**
     * @return null
     */



}
