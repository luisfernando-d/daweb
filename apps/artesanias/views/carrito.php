<?php

class CarritoView  {

    public function agregar($list=[],$productos=[]){
        $str = file_get_contents(
            STATIC_DIR . "html/artesanias/pedidos_agregar.html"); 
        $html = Template($str)->render_regex('LISTADO_CARRITO', $list);
        //$html = Template($html)->render_regex('LISTADO_PRODUCTOS', $productos);
        print Template('Confirmacion de carrito')->show($html);
    } 

    public function listar($carrito = []){
        $str = file_get_contents(
            STATIC_DIR . "html/artesanias/carrito_listar.html"); 
        $html = Template($str)->render_regex('LISTADO_CARRITO', $carrito);
        print Template('Listado de carrito')->show($html);
    } 

    
}
?>