<?php

class ProductosView  {

    public function agregar($artesanos=[], $clasificacion=[], $productos=[]){
        $str = file_get_contents(
            STATIC_DIR . "html/artesanias/productos_agregar.html"); 
        $html = Template($str)->render_regex('LISTADO_ARTESANOS', $artesanos);
        $html = Template($html)->render_regex('LISTADO_CLASIFICACION', $clasificacion);
        $html = Template($html)->render_regex('LISTADO_PRODUCTOS', $productos);
        print Template('Agregar productos')->show($html);
    } 
    
    public function listar($list=array()) {
        $carouselhtml="";
     
        $carouselstr= file_get_contents(
            STATIC_DIR . "html/artesanias/carousel_item.html"); 
            for ($i=0; $i<sizeof($list) ; $i++) {
               
                $arrayimagenes = [];
                $imagenes=[];
                $imagenes= explode( ',', $list[$i]['imagenes']);
                for ($j=0; $j<sizeof($imagenes) ; $j++) {
                    if ($j>0){
                        $carouselhtml=$carouselhtml. " <div class=\"carousel-item  \">
                        <img class=\"d-block w-100 \" src=\"/uploads/".$imagenes[$j]."\" alt=\"First slide\">
                    </div>";
                       
                    }
                    else {
                        $carouselhtml=$carouselhtml. " <div class=\"carousel-item  active\">
                        <img class=\"d-block w-100  \" src=\"/uploads/".$imagenes[$j]."\" alt=\"First slide\">
                    </div>";}
                    
                   
                }
                $list[$i]['carousel'] = $carouselhtml;     
                $carouselhtml="";
               
            }
 
            
        $str = file_get_contents(
            STATIC_DIR . "html/artesanias/productos_listar.html"); 
        $html = Template($str)->render_regex('LISTADO_PRODUCTOS', $list);    
        print Template('Listado de productos')->show($html);
    }

    public function editar($lis=[],$productos){
        $str = file_get_contents(
            STATIC_DIR . "html/artesanias/carritos_agregar.html"); 
            $html = Template($str)->render_regex('LISTADO_CARRITOS', $list); 
        $html = Template($str)->render($productos);
        print Template('carrito')->show($html);
    }
    

}

?>
