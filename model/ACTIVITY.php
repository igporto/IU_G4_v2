<?php

require_once(__DIR__."/../core/ValidationException.php");
require_once(__DIR__."/../model/CATEGORY.php");


class Activity {

    public $codactivity;
    public $activityname;
    public $capacity;
    public $category;
    public $space;
    public $discount;
    public $employee;
    public $color;

    public function __construct($codactivity = NULL, $activityname = NULL, $capacity = NULL, Category $category = NULL, SPACE $space= NULL, Discount $discount = NULL, Employee $employee = NULL, $color = NULL)
    {
        $this->codactivity = $codactivity;
        $this->activityname = $activityname;
        $this->capacity = $capacity;
        $this->category = $category;
        $this->space = $space;
        $this->discount = $discount;
        $this->employee = $employee;
        $this->color = $color;
    }


    public function getColor()
    {
        return $this->color;
    }

    public function setColor($color)
    {
        $this->color = $color;
    }
    public function getCodactivity()
    {
        return $this->codactivity;
    }

    public function setCodactivity($codactivity)
    {
        $this->codactivity = $codactivity;
    }
    
    public function getActivityname()
    {
        return $this->activityname;
    }
    
    public function setActivityname($activityname)
    {
        $this->activityname = $activityname;
    }
    
    public function getCapacity()
    {
        return $this->capacity;
    }
    
    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;
    } 
    
    public function getCategory()
    {
        return $this->category;
    }
    
    public function setCategory( Category $category)
    {
        $this->category = $category;
    }
    
    public function getSpace()
    {
        return $this->space;
    }
    
    public function setSpace( Space $space)
    {
        $this->space = $space;
    }
    
    public function getDiscount()
    {
        return $this->discount;
    }
    
    public function  setDiscount(Discount $discount)
    {
        $this->discount = $discount;
    }
    
    public function getEmployee()
    {
        return $this->employee;
    }
    
    public function setEmployee(Employee $employee)
    {
        $this->employee = $employee;
    }

    
}
