<?php

importar('apps/artesanias/models/carritos');
importar('apps/artesanias/views/carritos');
importar('core/helpers/utilerias');

class CarritosController extends Controller  {

    public function agregar(){
        $sql = "SELECT * FROM clientes";
        $clientes = $this->model->query($sql);
        $sql = "SELECT * FROM carritos";
        $data = $this->model->query($sql);

        $this->view->agregar($clientes,$data);
    }



    public function editar($id=0){
        $id= intval($id);

        $carritos = $this->model->getById($id);

        $this->view->editar( $carritos);
    }
    
    public function listar($formato){
        $sql = "SELECT * FROM carritos";
        $data = $this->model->query($sql);
        
       if (empty($formato)){
            $this->view->listar($data);
        } else if ($formato=="json"){
            print(json_encode($data));
        }
        else if ($formato=="xml"){
            $xml= Utilerias::toXml($data,"carritos","carrito" );
            echo $xml;
        }
        
    }
    

    public function guardar(){
        $id          = $_POST['id']?? 0;
        $producto = $_POST['producto'];
        $cantidad = $_POST['cantidad']?? 0;
        $precioventa = $_POST['precioventa']?? 0.0;
        $subtotal1 = $_POST['subtotal']?? 0.0;
        
 
        //--- asociar al modelo
        $this->model->id=$id;
        $this->model->producto = $producto;
        $this->model->cantidad = $cantidad;
        $this->model->precioventa = $precioventa;
        $this->model->subtotal = $subtotal1;
        $this->model->save();

        //--- 
        $subtotal1=$cantidad * $precioventa;
        
        HTTPHelper::go("/artesanias/carritos/listar");
        
     }

     public function eliminar($id){
        $this->model->delete($id);
        HTTPHelper::go("/artesanias/carritos/listar");
    }

}

?>
