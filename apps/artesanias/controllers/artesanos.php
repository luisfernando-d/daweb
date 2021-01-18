
<?php

importar('apps/artesanias/models/artesanos');
importar('apps/artesanias/views/artesanos');
importar('core/helpers/utilerias');

class ArtesanosController extends Controller  {

    public function agregar(){
        $sql = "SELECT * FROM artesanos";
        $data = $this->model->query($sql);

        $this->view->agregar($data);
    }
    public function editar($id=0){
        $id= intval($id);

        /**$sql= "SELECT  A.padre 
            FROM roles A WHERE A.id=$id ";

        $sql = "SELECT C.id, C.descripcion, C.padre,
          if(A.padre=C.id,'selected','') as selected
         FROM roles as C, ($sql) as A";
        $rolesListado = $this->model->query($sql);*/
        $artesanos = $this->model->getById($id);

        $this->view->editar( $artesanos);
    }
    
    public function listar($formato){
        $sql = "SELECT * FROM artesanos";
        $data = $this->model->query($sql);
        
       if (empty($formato)){
            $this->view->listar($data);
        } else if ($formato=="json"){
            print(json_encode($data));
        }
        else if ($formato=="xml"){
            $xml= Utilerias::toXml($data,"artesanos","artesano" );
            echo $xml;
        }
        
    }
    

    public function guardar(){
        $id          = $_POST['id']?? 0;
        $nombres = $_POST['nombres'];
        $primerapellido = $_POST['primerapellido'];
        $segundoapellido = $_POST['segundoapellido'];
        $domicilio = $_POST['domicilio'];
        $telefono = $_POST['telefono'];
        $correo = $_POST['correo'];

        //--$padre       = $_POST['padre'];
        //--- validar datos
 
        //--- asociar al modelo
        $this->model->id=$id;
        $this->model->nombres = $nombres;
        $this->model->primerapellido = $primerapellido;
        $this->model->segundoapellido = $segundoapellido;
        $this->model->domicilio = $domicilio;
        $this->model->telefono = $telefono;
        $this->model->correo = $correo;
        //--$this->model->padre       = $padre;
        $this->model->save();
        //--- 
        HTTPHelper::go("/artesanias/artesanos/listar");
     }

     public function eliminar($id){
        $this->model->delete($id);
        HTTPHelper::go("/artesanias/artesanos/listar");
    }

}

?>



