<?php

require_once(__DIR__."/../core/ValidationException.php");

class Category {

    private $codcategory;
    private $categoryname;


    public function __construct($codcategory=NULL, $categoryname=NULL) {
        $this->categoryname = $categoryname;
        $this->codcategory = $codcategory;
    }
    
    public function getCategoryname()
    {
        return $this->categoryname;
    }
    
    public function setCategoryname($categoryname)
    {
        $this->categoryname = $categoryname;
    }
    
    public function getCodcategory()
    {
        return $this->codcategory;
    }
    
    public function setCodcategory($codcategory)
    {
        $this->codcategory = $codcategory;
    }
    
}
