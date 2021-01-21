<?php

importar('apps/artesanias/models/pedidos');
importar('apps/artesanias/views/pedidos');
importar('apps/artesanias/views/mensajes');
importar('core/helpers/Utilerias');

class PedidosController extends Controller  {

    public function agregar(){
        $sql = "SELECT * FROM pedidos";
        $pedidos = $this->model->query($sql);
        $this->view->agregar($pedidos);
    }

    public function editar($id=0){
        
    }

    public function listar($formato=""){
        $sql = "SELECT * FROM pedidos";
        $listaProductos = $this->model->query($sql);
        
        if (strtolower($formato)=="json"){
            echo json_encode($listaProductos);
        }else if ($formato=="xml"){
            $xml = Utilerias::toXML($listaProductos,"pedidos","pedidos");
            echo $xml;
        }else {
            $this->view->listar($listaProductos);
        }
 
    }

    public function guardar(){
       $id               = $_POST['id']?? 0;
       $fecha      = $_POST['fecha']??0;
       $cliente_id         = $_POST['cliente_id']??0;
       $formapago = $_POST['formapago']??"";
       $domicilioentrega     = $_POST['domicilioentrega']??"";


       //--- validar datos

       if (empty($descripcion) || empty($producto)){
           Mensajes::show ("Faltan datos importantes "); 
           exit;
       }
 
       //--- asociar al modelo
        $this->model->id = $id;
        $this->model->fecha         = $fecha;
        $this->model->cliente_id      = $cliente_id;
        $this->model->formapago = $formapago;
        $this->model->domicilioentrega      = $domicilioentrega;
        $this->model->save();

       //--- guardar las imagenes en la tabla productoImagen

       Mensajes::show ( "Guardado satisfactoriamente ..."); 

    }

    public function eliminar($id){
        $this->model->delete($id);
        HTTPHelper::go("/artesanias/productos/listar");
    }
    
}

?>
