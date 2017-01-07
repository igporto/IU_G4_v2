<?php

require_once(__DIR__."/../core/ValidationException.php");
require_once(__DIR__."/../model/EMPLOYEE_model.php");
require_once(__DIR__."/../model/SPACE_model.php");

class Event {

    public $codevent;
    public $name;
    public $ini_hour;
    public $fin_hour;
    public $date;
    public $capacity;
    public $space;
    public $employee;
    public $freeplaces;

    public function __construct($codevent = NULL, $name = NULL, $ini_hour = NULL, $fin_hour = NULL, $date = NULL, $capacity = NULL, Space $space = NULL, Employee $employee = NULL, $freeplace = NULL)
    {
        $this->codevent = $codevent;
        $this->name = $name;
        $this->ini_hour = $ini_hour;
        $this->fin_hour = $fin_hour;
        $this->date = $date;
        $this->capacity = $capacity;
        $this->space = $space;
        $this->employee = $employee;
        $this->freeplaces = $freeplace;
    }

    public function getCodevent()
    {
        return $this->codevent;
    }

    public function setCodevent($codevent)
    {
        $this->codevent = $codevent;
    }

    public function getName()
    {
        return $this->name;
    }


    public function setName($name)
    {
        $this->name = $name;
    }

    public function getIniHour()
    {
        return $this->ini_hour;
    }

    public function setIniHour($ini_hour)
    {
        $this->ini_hour = $ini_hour;
    }

    public function getFinHour()
    {
        return $this->fin_hour;
    }

    public function setFinHour($fin_hour)
    {
        $this->fin_hour = $fin_hour;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function getCapacity()
    {
        return $this->capacity;
    }

    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;
    }

    public function getSpace()
    {
        return $this->space;
    }

    public function setSpace(Space $space)
    {
        $this->space = $space;
    }

    public function getEmployee()
    {
        return $this->employee;
    }

    public function setEmployee(Employee $employee)
    {
        $this->employee = $employee;
    }

    public function getFreeplaces()
    {
        return $this->freeplaces;
    }

    public function setFreeplaces($freeplaces)
    {
        $this->freeplaces = $freeplaces;
    }

}
