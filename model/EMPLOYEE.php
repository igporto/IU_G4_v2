<?php

require_once(__DIR__."/../core/ValidationException.php");
require_once(__DIR__."/../model/USER.php");


class Employee {

    public $codemployee;
    public $employeedni;
    public $employeename;
    public $employeesurname;
    public $birthdate;
    public $address;
    public $email;
    public $comment;
    public $hourIn;
    public $hourOut;
    public $banknum;
    public $contracttype;
    public $user;

    public function __construct($codemployee = NULL, $dni = NULL, $employeename = NULL, $employeesurname = NULL, $birthdate = NULL, $address = NULL, $email = NULL, $comment = NULL, $hourIn = NULL,
                                $hourOut = NULL, $banknum = NULL, $contracttype = NULL, User $user = NULL)
    {
        $this->codemployee = $codemployee;
        $this->employeedni = $dni;
        $this->employeename = $employeename;
        $this->employeesurname = $employeesurname;
        $this->birthdate = $birthdate;
        $this->address = $address;
        $this->email = $email;
        $this->comment = $comment;
        $this->hourIn = $hourIn;
        $this->hourOut = $hourOut;
        $this->banknum = $banknum;
        $this->contracttype = $contracttype;
        $this->user = $user;
    }

    public function getEmployeedni()
    {
        return $this->employeedni;
    }

    public function setEmployeedni($employeedni)
    {
        $this->employeedni = $employeedni;
    }

    public function getCodemployee()
    {
        return $this->codemployee;
    }

    public function setCodemployee($codemployee)
    {
        $this->codemployee = $codemployee;
    }

    public function getEmployeename()
    {
        return $this->employeename;
    }

    public function setEmployeename($employeename)
    {
        $this->employeename = $employeename;
    }

    public function getEmployeesurname()
    {
        return $this->employeesurname;
    }

    public function setEmployeesurname($employeesurname)
    {
        $this->employeesurname = $employeesurname;
    }

    public function getBirthdate()
    {
        return $this->birthdate;
    }

    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getEmail()
    {
        return $this->email;
    }


    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    public function getHourIn()
    {
        return $this->hourIn;
    }

    public function setHourIn($hourIn)
    {
        $this->hourIn = $hourIn;
    }

    public function getHourOut()
    {
        return $this->hourOut;
    }

    public function setHourOut($hourOut)
    {
        $this->hourOut = $hourOut;
    }

    public function getBanknum()
    {
        return $this->banknum;
    }

    public function setBanknum($banknum)
    {
        $this->banknum = $banknum;
    }

    public function getContracttype()
    {
        return $this->contracttype;
    }

    public function setContracttype($contracttype)
    {
        $this->contracttype = $contracttype;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser(User $user)
    {
        $this->user = $user;
    }



}
