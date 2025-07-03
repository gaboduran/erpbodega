<?php

class Home extends Controller
{

    public function __construct()
    {
        Auth::noAuth();
        parent::__construct();
        Permisos::getPermisos(6);
    }

    public function index()
    {
        $data['page_name'] = "Home";
        $data['function_js'] = "home.js";
        $bodega = Listas::getbodegasByUsuario($_SESSION['idusuario']);
       // var_dump($deposito);
         $data['idperfil'] = $_SESSION['idperfil'];
         $data['bodega'] = to_obj($bodega);
         $this->views->getView($this, 'index', $data);
    }
    
    public function sesionBodega(){
        if ($_SERVER['REQUEST_METHOD'] == "POST"){
            $data  = [];
             if (isset($_SESSION['login'])){
                unset($_SESSION['idbodega']);        
                unset($_SESSION['nombodega']);        
                $data = Auth::sesionBodega($_POST['idbodega']);
                $_SESSION['idbodega']    = $data['ID'];
                $_SESSION['nombodega']   = $data['NOMBRE'];
                $_SESSION['ciudad']      = $data['CODCIUDAD'];
                $data = ['url' => base_url.'dashboard'];
            }
           echo json_encode($data, JSON_UNESCAPED_UNICODE);



       }
       
     }
}
