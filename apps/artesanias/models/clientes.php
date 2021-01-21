<?php
class Clientes extends DAO {

    public function __construct() {
        $this->keyfield = "id";
        $this->id = 0;
        $this->nombreorazonsocial = "";
        $this->domicilio = "";
        $this->correo = "";
        $this->telefono = "";
        $this->contacto = "";

    } 
}
?>
