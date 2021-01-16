
<?php

importar('apps/artesanias/models/roles');
importar('apps/artesanias/views/roles');

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
    
    public function listar(){
       
        $sql = "SELECT * FROM roles" ; 
        
            /*IFNULL(P.descripcion, 'Ninguno') as padre 
                FROM roles C LEFT JOIN roles P 
                ON C.padre=P.id";*/

        $data = $this->model->query($sql);
        $this->view->listar($data);
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



