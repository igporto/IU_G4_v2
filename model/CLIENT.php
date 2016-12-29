<?php

require_once(__DIR__."/../core/ValidationException.php");

class Client {

    private $dni;
    private $name;
    private $surname;
    private $phone;
    private $email;

    public function __construct($dni=NULL, $name=NULL, $surname=NULL, $phone=NULL, $email=NULL)
    {
        $this->dni = $dni;
        $this->name = $name;
        $this->surname = $surname;
        $this->phone = $phone;
        $this->email = $email;
    }

    /**
     * @return null
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * @param null $dni
     */
    public function setDni($dni)
    {
        $this->dni = $dni;
    }

    /**
     * @return null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param null $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return null
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @param null $surname
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    /**
     * @return null
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param null $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param null $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }



}
