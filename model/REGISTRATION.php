<?php
require_once(__DIR__."/../core/ValidationException.php");
require_once(__DIR__."/../model/PAYMENT.php");
require_once(__DIR__."/../model/RESERVE.php");
class Registration {
    public $codRegistration;
    public $reserve;
    public $date;
    public $payment;

    public function __construct($codRegistration = NULL, Reserve $reserve = NULL, $date = NULL, Payment $payment = NULL)
    {
        $this->codRegistration = $codRegistration;
        $this->reserve = $reserve;
        $this->date = $date;
        $this->payment = $payment;
    }

    public function getCodRegistration()
    {
        return $this->codRegistration;
    }
    public function setCodRegistration($codRegistration)
    {
        $this->codRegistration = $codRegistration;
    }
    
    public function getReserve()
    {
        return $this->reserve;
    }
    
    public function setReserve(Reserve $reserve)
    {
        $this->reserve = $reserve;
    }
    
    public function getDate()
    {
        return $this->date;
    }
    
    public function setDate($date)
    {
        $this->date = $date;
    } 
    
    public function getPayment()
    {
        return $this->payment;
    }
    
    public function setPayment( Payment $payment)
    {
        $this->payment = $payment;
    }    
}