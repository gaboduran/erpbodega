<?php
    
    class miPerfil extends Controller{

        public function __construct(){
            Auth::noDepot();
            Auth::noAuth();
            parent::__construct();
        }
        
        public function cambiarPassword($id){
            $data['page_name'] 	    = 'Cambio Contraseña';
            $data['function_js']    = 'miperfil.js';
            $this->views->getView($this,'cambiarPassword', $data);
     
        }

        public function procesaCambiarPassowrd(){
            if ($_SERVER['REQUEST_METHOD'] == "POST"){
                $val = new Validator();
                $val->name('txt_pass1')->value(limpiar($_POST['txt_pass1']))->required();
                $val->name('txt_pass2')->value(limpiar($_POST['txt_pass2']))->required();
                    if($val->isSuccess()){
                        $data = miperfilModel::updatePassword();
                    }else{
                        $data = ['errorvalida' =>  true,'msg' => $val->getErrors()];
                    }
                    echo json_encode($data, JSON_UNESCAPED_UNICODE);
                 //   Auth::logout();

            }
     
        }
    }

?>