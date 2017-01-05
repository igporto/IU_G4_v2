<?php

require_once(__DIR__."/../core/ValidationException.php");

class Alumn {

    private $codalumn;
    private $dni;
    private $alumnname;
    private $alumnsurname;
    private $birthdate;
    private $job;
    private $address;
    private $email;
    private $comment;
    private $pendingclasses;

    public function __construct($codalumn = NULL, $dni = NULL, $alumnname = NULL, $alumnsurname = NULL, $birthdate = NULL, $job = NULL, $address = NULL,
                                    $email = NULL, $comment = "", $pendingclasses = 0)
    {
        $this->codalumn = $codalumn;
        $this->dni = $dni;
        $this->alumnname = $alumnname;
        $this->alumnsurname = $alumnsurname;
        $this->birthdate = $birthdate;
        $this->job = $job;
        $this->address = $address;
        $this->email = $email;
        $this->comment = $comment;
        $this->pendingclasses = $pendingclasses;
    }


    public function getCodalumn()
    {
        return $this->codalumn;
    }

    public function setCodalumn($codalumn)
    {
        $this->codalumn = $codalumn;
    }

    public function getDni()
    {
        return $this->dni;
    }

    public function setDni($dni)
    {
        $this->dni = $dni;
    }

    public function getAlumnname()
    {
        return $this->alumnname;
    }

    public function setAlumnname($alumnname)
    {
        $this->alumnname = $alumnname;
    }

    public function getAlumnsurname()
    {
        return $this->alumnsurname;
    }

    public function setAlumnsurname($alumnsurname)
    {
        $this->alumnsurname = $alumnsurname;
    }

    public function getBirthdate()
    {
        return $this->birthdate;
    }

    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;
    }

    public function getJob()
    {
        return $this->job;
    }

    public function setJob($job)
    {
        $this->job = $job;
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

    public function getPendingclasses()
    {
        return $this->pendingclasses;
    }

    public function setPendingclasses($pendingclasses)
    {
        $this->pendingclasses = $pendingclasses;
    }



}
