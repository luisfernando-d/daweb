
<?php

importar('apps/artesanias/models/roles');
importar('apps/artesanias/views/roles');
importar('core/helpers/utilerias');

class RolesController extends Controller  {

    public function agregar(){
        $sql = "SELECT * FROM roles";
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
        $roles = $this->model->getById($id);

        $this->view->editar( $roles);
    }
    
    public function listar($formato){
        $sql = "SELECT * FROM roles";
        $data = $this->model->query($sql);
        
       if (empty($formato)){
            $this->view->listar($data);
        } else if ($formato=="json"){
            print(json_encode($data));
        }
        else if ($formato=="xml"){
            $xml= Utilerias::toXml($data,"roles","rol" );
            echo $xml;
        }
        
    }
    

    public function guardar(){
        $id          = $_POST['id']?? 0;
        $descripcion = $_POST['descripcion'];
        //--$padre       = $_POST['padre'];
        //--- validar datos
 
        //--- asociar al modelo
        $this->model->id=$id;
        $this->model->descripcion = $descripcion;
        //--$this->model->padre       = $padre;
        $this->model->save();
        //--- 
        HTTPHelper::go("/artesanias/roles/listar");
     }

     public function eliminar($id){
        $this->model->delete($id);
        HTTPHelper::go("/artesanias/roles/listar");
    }

}

?>



