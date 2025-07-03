<?php
    
    class configuraciongeneral extends Controller{

        public function __construct(){
           Auth::noAuth();
            parent::__construct();
            Permisos::getPermisos(GRUPOTIPOCONT);
        }

        public function index (){
            if (!empty(permisos::accesoModulo($_SESSION['userData']['IDPERFIL'],PERFILES))) {
                $data['page_name'] = "Configuracion General";
                $data['function_js'] = "configuraciongeneral.js";
                $this->views->getView($this, 'index', $data);
            }else{
               header('location:' .base_url()."error401" );
            }   
        }

       public function seccionTaller(){
            $data = [];
            if ($_SERVER['REQUEST_METHOD'] == "POST"){
               // $data['info'] = 'holaaaaaaaaaaa';
                $data = configuraciongeneralModel::guardarSeccionTaller();
                 
            }
            echo json_encode($data, JSON_UNESCAPED_UNICODE);

        }



  
    }

?>