<?php

class Carritos extends DAO {

    public function __construct() {
        $this->keyfield = "id";
        $this->id = 0;
        //$this->producto_id = 0;
        $this->producto= "";
        $this->cantidad = 0;
        $this->precioventa = 0.0; 
        $this->subtotal = 0.0;

    } 
}
?>


