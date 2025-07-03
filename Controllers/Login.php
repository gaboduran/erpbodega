<?php

class Login extends Controller
{


	public function index()
	{

		$data['page_name'] 		= 'Login';
		$data['function_js']	= 'Login.js';
		$this->views->getView($this, 'index', $data);
	}

	public function resetpassword()
	{
		$data['function_js']	= 'reset.js';
		$token = $_GET['token'];
		$data = loginModel::validaToken($token);
		$this->views->getView($this, 'resetpassword', $data);

	}

	public function validaToken()
	{
		$token = $_POST['token'];
		$dataToken = loginModel::validaToken($token);
		if(!empty($dataToken)) {
			if(($dataToken[0]['TIEMPO']) < 3600){
				$data = ['status' => '1', 'error' => "Token vigente"];
			}else{
				$data = ["status"=> "2", 'error' => "token vencido"];
			}
		}else{
			$data = ["status"=> "3", 'error' => "Token no existe"];
		}
		echo json_encode($data, JSON_UNESCAPED_UNICODE);
	}
		public function LoginIN()
	{
		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			$val = new Validator();
			$val->name('usuario')->value(limpiar($_POST['usuario']))->required();
			$val->name('password')->value(limpiar($_POST['password']))->required();
			$data = loginModel::login();
			if ($val->isSuccess()) {
				if (!empty($data)) {
					if ($data[0]['ESTADO'] == 1) {
						$_SESSION['idusuario'] 	= $data[0]['ID'];
						$_SESSION['usuario'] 	= $data[0]['USUARIO'];
						$_SESSION['nombres'] 	= $data[0]['NOMBRE'];
						$_SESSION['idperfil'] 	= $data[0]['IDPERFIL'];
						$_SESSION['estado'] 	= $data[0]['ESTADO'];
						if ($data[0]['ESTADOCAMBIOPSW'] == 1) {
							// $_SESSION['login'] 		= false;
							// Auth::sessionCambioPassword($_SESSION['idusuario']);
							// $data = ['status' => 'ok1', 'error' => "Cambio Manaual Password"];
						}else{
							Auth::sessionUser($_SESSION['idusuario']);
						 	$_SESSION['login'] 		= true;
						 	$data = ['status' => 'ok', 'error' => "Usuario Activo"];
						 	loginModel::updateUltimoAcceso($_SESSION['idusuario']);
						 }
					} else {
						$data = ['status' => 'inactivo', 'msg' => "El usuario se encuenta Inactivo. Contacte al Administrador"];
					}
				} else {
					$data = ['status' => 'no_existe', 'msg' => "Credenciales Incorrectas."];
				}
			} else {
				$data = ['error' => $val->getErrors()];
			}
		}
		echo json_encode($data, JSON_UNESCAPED_UNICODE);
	}
}
