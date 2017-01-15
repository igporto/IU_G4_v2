<?php
require_once(__DIR__."/../core/ValidationException.php");
require_once(__DIR__."/../model/PAYMENT.php");
require_once(__DIR__."/../model/RESERVE.php");
class Registration {
    private $codRegistration;
    private $activity;
    private $event;
    private $alumn;
    private $date;
    private $payment;
    private $periodicidad;

    public function __construct($codRegistration = NULL, Activity $activity = NULL, Alumn $alumn = NULL, Event $event = NULL, $date = NULL, Payment $payment = NULL, $periodicidad = NULL)
    {
        $this->codRegistration = $codRegistration;
        $this->activity = $activity;
        $this->alumn =$alumn;
        $this->event = $event;
        $this->date = $date;
        $this->payment = $payment;
        $this->periodicidad = $periodicidad;
    }

    /**
     * @return null
     */
    public function getCodRegistration()
    {
        return $this->codRegistration;
    }

    /**
     * @param null $codRegistration
     */
    public function setCodRegistration($codRegistration)
    {
        $this->codRegistration = $codRegistration;
    }

    /**
     * @return Activity
     */
    public function getActivity()
    {
        return $this->activity;
    }

    /**
     * @param Activity $activity
     */
    public function setActivity(Activity $activity)
    {
        $this->activity = $activity;
    }

    /**
     * @return Event
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * @param Event $event
     */
    public function setEvent(Event $event)
    {
        $this->event = $event;
    }

    /**
     * @return Alumn
     */
    public function getAlumn()
    {
        return $this->alumn;
    }

    /**
     * @param Alumn $alumn
     */
    public function setAlumn(Alumn $alumn)
    {
        $this->alumn = $alumn;
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

    /**
     * @return Payment
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * @param Payment $payment
     */
    public function setPayment(Payment $payment)
    {
        $this->payment = $payment;
    }

    /**
     * @return null
     */
    public function getPeriodicidad()
    {
        return $this->periodicidad;
    }

    /**
     * @param null $periodicidad
     */
    public function setPeriodicidad($periodicidad)
    {
        $this->periodicidad = $periodicidad;
    }



}