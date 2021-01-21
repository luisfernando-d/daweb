<?php

importar('apps/artesanias/models/carrito');
importar('apps/artesanias/views/carrito');
importar('apps/artesanias/views/mensajes');
importar('core/helpers/Utilerias');

class CarritoController extends Controller  {

    public function agregar(){
        $sql = "SELECT * FROM carrito";
        $carrito = $this->model->query($sql);
        $this->view->agregar($carrito);
    }

    public function editar($id=0){
        
    }
    
    public function listar($formato=""){
        $sql = "SELECT * FROM carrito";
        $listaCarrito = $this->model->query($sql);
        
        if (strtolower($formato)=="json"){
            echo json_encode($listaCarrito);
        }else if ($formato=="xml"){
            $xml = Utilerias::toXML($listaCarrito,"carrito","carrito");
            echo $xml;
        }else {
            $this->view->listar($listaCarrito);
        }
 
    }

    public function guardar(){
       $id               = $_POST['id']?? 0;
       $producto_id      = $_POST['producto_id']??0;
       $producto         = $_POST['producto']??"";
       $cantidad         = $_POST['cantidad']??0;
       $precioventa      = $_POST['precioventa']??0;

        //--$padre       = $_POST['padre'];
        //--- validar datos
 
        //--- asociar al modelo
        $this->model->id = $id;
        $this->model->producto_id      = $producto_id;
        $this->model->producto         = $producto;
        $this->model->cantidad         = $cantidad;
        $this->model->precioventa      = $precioventa;
        $this->model->save();
        //--- 
        HTTPHelper::go("/artesanias/carrito/listar");
     }


    public function eliminar($id){
        $this->model->delete($id);
        HTTPHelper::go("/artesanias/carrito/listar");
    }
    
}

?>
