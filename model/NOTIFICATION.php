<?php

require_once(__DIR__."/../core/ValidationException.php");

class Notification {

    private $codnotification;
    private $description;
    private $user;


    public function __construct($codnotification = NULL, $description = NULL, User $user = NULL)
    {
        $this->codnotification = $codnotification;
        $this->description = $description;
        $this->user = $user;
    }


    public function getCodnotification()
    {
        return $this->codnotification;
    }


    public function setCodnotification($codnotification)
    {
        $this->codnotification = $codnotification;
    }


    public function getDescription()
    {
        return $this->description;
    }


    public function setDescription($description)
    {
        $this->description = $description;
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
