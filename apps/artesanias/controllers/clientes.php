<?php

importar('apps/artesanias/models/clientes');
importar('apps/artesanias/views/clientes');
importar('core/helpers/utilerias');

class ClientesController extends Controller  {

    public function agregar(){
        $sql = "SELECT * FROM clientes";
        $data = $this->model->query($sql);

        $this->view->agregar($data);
    }
    public function editar($id=0){
        $id= intval($id);

        $clientes = $this->model->getById($id);

        $this->view->editar( $clientes);
    }
    
    public function listar($formato){
        $sql = "SELECT * FROM clientes";
        $data = $this->model->query($sql);
        
       if (empty($formato)){
            $this->view->listar($data);
        } else if ($formato=="json"){
            print(json_encode($data));
        }
        else if ($formato=="xml"){
            $xml= Utilerias::toXml($data,"clientes","cliente" );
            echo $xml;
        }
        
    }
    

    public function guardar(){
        $id          = $_POST['id']?? 0;
        $nombreorazonsocial = $_POST['nombreorazonsocial'];
        $domicilio = $_POST['domicilio'];
        $telefono = $_POST['telefono'];
        $correo = $_POST['correo'];
        $contacto = $_POST['contacto'];
        
 
        //--- asociar al modelo
        $this->model->id=$id;
        $this->model->nombreorazonsocial = $nombreorazonsocial;
        $this->model->domicilio = $domicilio;
        $this->model->telefono = $telefono;
        $this->model->correo = $correo;
        $this->model->contacto = $contacto;
        $this->model->save();
        //--- 
        HTTPHelper::go("/artesanias/clientes/listar");
     }

     public function eliminar($id){
        $this->model->delete($id);
        HTTPHelper::go("/artesanias/clientes/listar");
    }

}

?>