<?php

require_once 'fcontroller.php';
class view extends controller{
    public function productlist(){
        
        $products = $this->fetchproducts();

        return $products;

    }
}