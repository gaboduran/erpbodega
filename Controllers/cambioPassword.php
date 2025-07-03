<?php

 
class cambioPassword extends Controller
{

	public function __construct()
	{
		Auth::noAuth();
		parent::__construct();
	}


	public function index()
	{
		if (!empty(permisos::accesoCambioPass($_SESSION['userCambioPass']['IDPERFIL'], CAMBIOPASSWORD))) {
			$data['function_js'] = 'CambiarPassword.js';
			$data['page_name'] 	= 'Cambiar Password';
			$this->views->getView($this, 'index', $data);
		} else {
			header('location:' . base_url() . "Error401");
		}
	}

	public function actualizaPassword(){
		$data = [];
		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			$pass1 = limpiar($_POST['txt_pass1']);
			$pass2 = limpiar($_POST['txt_pass2']);
			if ($pass1 != $pass2) {
				$data = ['status' => 'errorpass', 'msg' => 'Password Distintos'];
			} else {
				$data = cambioPasswordModel::cambiarPassword();
			}
			echo json_encode($data, JSON_UNESCAPED_UNICODE);
		}
	}

	public function cambiaPasswordByMEmail(){
		$data = [];
		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			$idusuario = limpiar($_POST['idusuario']);
			$dataToken = cambioPasswordModel::generaTokenPassword();
			if ($dataToken['status'] == "update_ok") {
				$token = cambioPasswordModel::buscarToken($idusuario);
				$link = base_url.'login/resetpassword?token='.$token[0]['TOKEN'];
			}
			$dataUser = Listas::getOneUsuario($idusuario);
			$email = $dataUser[0]['EMAIL'];
			$dataEmail = genaraEmail::enviarEmail($email, $link);
			//echo $link;

		}
		echo json_encode($data, JSON_UNESCAPED_UNICODE);
	}

	public function resetpassword(){
		$data['page_name'] 		= '';
		$data['function_js']	= 'reset.js';
		$this->views->getView($this,'resetpassword', $data);
	}

	public function cierraSesion(){
		$data = [];
		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			$data = Auth::cierraSesion();
		}
		echo json_encode($data, JSON_UNESCAPED_UNICODE);
	}
}
