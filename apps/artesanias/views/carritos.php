<?php

class CarritosView  {


    public function listar($list=array()) {
        $str = file_get_contents(
            STATIC_DIR . "html/artesanias/carritos_listar.html"); 
        $html = Template($str)->render_regex('LISTADO_CARRITOS', $list);
        print Template('Listado de carritos')->show($html);
    }

    public function agregar($list=[], $productos=[], $clientes){
        $str = file_get_contents(
            STATIC_DIR . "html/artesanias/productos_listar.html"); 
        $html = Template($str)->render_regex('LISTADO_PRODUCTOS', $productos);
        $html = Template($html)->render_regex('LISTADO_CLIENTES', $clientes);
        $html = Template($html)->render_regex('LISTADO_CARRITOS', $list);
        print Template('Agregar carritos')->show($html);
    } 
    public function editar($carritos){
        $str = file_get_contents(
            STATIC_DIR . "html/artesanias/modal.html"); 
        $html = Template($str)->render($carritos);
        print Template('Editar carritos')->show($html);
    }


}
?>