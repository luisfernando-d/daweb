<?php

class ArtesanosView  {

    /*public function agregar(){
        echo "Metodo agregar de clase ClasificacionViews";
    }*/ 

    public function listar($list=array()) {
        $str = file_get_contents(
            STATIC_DIR . "html/artesanias/artesanos_listar.html"); 
        $html = Template($str)->render_regex('LISTADO_ARTESANOS', $list);
        print Template('Listado de artesanos')->show($html);
    }

    public function agregar($list=[]){
        $str = file_get_contents(
            STATIC_DIR . "html/artesanias/artesanos_agregar.html"); 
        $html = Template($str)->render_regex('LISTADO_ARTESANOS', $list);
        print Template('Agregar artesanos')->show($html);
    } 

    public function editar($artesanos){
        $str = file_get_contents(
            STATIC_DIR . "html/artesanias/artesanos_editar.html"); 
        /*$html = Template($str)->render_regex('LISTADO_ARTESANOS', $list);*/
        $html = Template($str)->render($artesanos);
        print Template('Agregar artesanos')->show($html);
    } 

}

?>