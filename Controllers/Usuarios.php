<?php

class Usuarios extends Controller
{

	public function __construct()
	{
		Auth::noDepot();
		Auth::noAuth();
		parent::__construct();
		Permisos::getPermisos(1);
		Permisos::getEspeciales(7);
	}

	public function index()
	{
		if (!empty(permisos::accesoModulo($_SESSION['userData']['IDPERFIL'], USUARIOS))) {
			$data['page_name'] 	= 'Usuarios';
			$data['function_js'] = 'usuarios.js';
			$this->views->getView($this, 'index', $data);
		} else {
			header('location:' . base_url() . "Error401");
		}
	}
	public function nuevo()
	{
		if (!empty(permisos::create())) {
			$perfil =  Listas::getAllPerfiles();
			$depot = Listas::getDepositos();
			$bodegas = Listas::getBodegas();
			$tipousuario = Listas::tipoUsuario();
			$data['perfil'] 	= to_obj($perfil);
			$data['bodegas'] 		= to_obj($bodegas);
			$data['depot'] 		= to_obj($depot);
			$data['tipousuario'] 	= to_obj($tipousuario);
			$data['page_name'] 	= "Nuevo Usuario";
			$data['function_js'] = "usuarios.js";
			$this->views->getView($this, 'nuevo', $data);
		} else {
			header('location:' . base_url() . "Error401");
		}
	}


	public function editar($id)
	{
		if (!empty(permisos::update())) {
			$usuarioData			= usuariosModel::getOneUsuario($id);
			$perfilesData			= usuariosModel::perfilesNOuser($usuarioData[0]['IDPERFIL']);
			$estadoData				= Listas::getNoestado($usuarioData[0]['ESTADO']);
			$getBodegas				= Listas::getBodegasUsuario($usuarioData[0]['ID']);
			$getBodegasFree			= Listas::getBodegasDisponible($usuarioData[0]['ID']);
			$getDepot				= Listas::getDepotUsuario($usuarioData[0]['ID']);
			$getDepotFree			= Listas::getDepotDisponible($usuarioData[0]['ID']);
			$tipousuario			= Listas::NOtipoUsuario($usuarioData[0]['CODTIPOUSER']);
			$data['page_name'] 		= 'Editar Usuario Sistema';
			$data['function_js'] 	= "usuarios.js";
			$data['usuario'] 		= to_obj($usuarioData);
			$data['perfiles'] 		= to_obj($perfilesData);
			$data['bodegasuser'] 	= to_obj($getBodegas);
			$data['BodegasFree'] 	= to_obj($getBodegasFree);
			$data['deposito'] 		= to_obj($getDepot);
			$data['depotfree'] 		= to_obj($getDepotFree);
			$data['estado'] 		= to_obj($estadoData);
			$data['tipousuario'] 	= to_obj($tipousuario);
			$this->views->getView($this, 'editar', $data);
		} else {
			header('location:' . base_url() . "error401");
		}
	}

	public function getAllUser()
	{
		$data = [];
		$btnEdit = "";
		$btnEspeciales = "";
		$btnResetpass = "";
		$btnDelete = "";
		$resultado = usuariosModel::getAllUsuarios();
		for ($i = 0; $i < count($resultado); $i++) {
			$sub_array = array();
			if ($resultado[$i]['ESTADO'] == 1) {
				$estado = '<span class="badge bg-success">Activo</span>';
			} else {
				$estado = '<span class="badge bg-danger">Inactivo</span>';
			}
			if (permisos::update()) {
				$btnEdit = '<a href="' . base_url . 'usuarios/editar/' . $resultado[$i]['ID'] . '"<button class="dropdown-item" type="button"><i class="fa fa-edit"></i> Editar</button></a>';
			}
			if (permisos::delete()) {
				$btnDelete = '';
			}

			if (permisos::resetPassword()) {
				$btnResetpass = '<button class="dropdown-item" type="button" onClick="verResetPassword(' . $resultado[$i]['ID'] . ');"><i class="fa-regular fa fa-key"></i> Password</button>';
			}

			if (permisos::update() || permisos::delete() || permisos::resetPassword() ) {
				$sub_array['options'] = '<div class="dropdown">
											  <button class="btn btn-light btn-sm dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-list-ul"></i>

											   </button>
											  <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
											   ' . $btnEdit . '
											     ' . $btnDelete . '
												 ' . $btnResetpass . '
												
											  </div>
											</div>';
			} else {
				$sub_array['options'] = '';
			}
			$sub_array["id"]        = ucwords($resultado[$i]['ID']);
			$sub_array["usuario"]   = ucwords($resultado[$i]['USUARIO']);
			$sub_array["nombres"]   = ucwords($resultado[$i]['NOMBRE']) . ' ' . ucwords($resultado[$i]['APELLIDOS']);
			$sub_array["email"]     = ucwords($resultado[$i]['EMAIL']);
			$sub_array["nomperfil"] = ucwords($resultado[$i]['NOMPERFIL']);
			$sub_array["estado"]    = $estado;
			$data[] = $sub_array;
		}
		echo json_encode($data, JSON_UNESCAPED_UNICODE);
	}

	public function procesar()
	{
		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			$val = new Validator();
			if ($_POST["operation"] == "Add") {
				$val->name('txt_ide')->value(limpiar($_POST['txt_ide']))->required();
				$val->name('txt_nombre')->value(limpiar($_POST['txt_nombre']))->required();
				$val->name('txt_apellido')->value(limpiar($_POST['txt_apellido']))->required();
				$val->name('txt_email')->value(limpiar($_POST['txt_email']))->pattern('email')->required();
				$val->name('txt_telefono')->value(limpiar($_POST['txt_telefono']))->pattern('int')->required();
				$val->name('sel_estado')->value(limpiar($_POST['sel_estado']))->required();
				$val->name('sel_perfil')->value(limpiar($_POST['sel_perfil']))->required();
				$val->name('sel_tipousuario')->value(limpiar($_POST['sel_tipousuario']))->required();
				$val->name('txt_usuario')->value(limpiar($_POST['txt_usuario']))->min(6)->max(15)->required();
				if ($val->isSuccess()) {
					$data = usuariosModel::crearUsuario();
				}
			}
			if ($_POST["operation"] == "Edit") {
				$val->name('txt_ide')->value(limpiar($_POST['txt_ide']))->required();
				$val->name('txt_nombre')->value(limpiar($_POST['txt_nombre']))->required();
				$val->name('txt_apellido')->value(limpiar($_POST['txt_apellido']))->required();
				$val->name('txt_email')->value(limpiar($_POST['txt_email']))->pattern('email')->required();
				$val->name('txt_telefono')->value(limpiar($_POST['txt_telefono']))->pattern('int')->required();
				$val->name('sel_estado')->value(limpiar($_POST['sel_estado']))->required();
				$val->name('sel_perfil')->value(limpiar($_POST['sel_perfil']))->required();
				$val->name('sel_tipousuario')->value(limpiar($_POST['sel_tipousuario']))->required();
				$idusuario =  limpiar($_POST['idusuario']);
				if ($val->isSuccess()) {
					$data = usuariosModel::actualizarUsuario($idusuario);
				}
			}
		} else {
			$data = ['errorvalida' =>  true, 'msg' => $val->getErrors()];
		}

		echo json_encode($data, JSON_UNESCAPED_UNICODE);
	}


	public function verUsuario()
	{
		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			$idusuario = $_POST['idusuario'];
			$data = usuariosModel::getOneUsuario($idusuario);
			foreach ($data as $row) {
				$data['ID']     	= $row['ID'];
				$data['USUARIO']    = strtolower($row['USUARIO']);
				$data['NOMBRE']    	= ucwords($row['NOMBRE']);
				$data['APELLIDOS']  = ucwords($row['APELLIDOS']);
				$data['MENSAJE']  	= ucwords($row['NOMBRE']) . ' ' . ucwords($row['APELLIDOS']);
			}
		}
		echo json_encode($data, JSON_UNESCAPED_UNICODE);
	}

	public function procesarCambio()
	{
		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			$idusuario = limpiar($_POST['txt_idusuario']);
			$val = new Validator();
			$val->name('txt_pass1')->value(limpiar($_POST['txt_pass1']))->min(6)->max(10)->equal(limpiar($_POST['txt_pass2']))->required();
			if ($val->isSuccess()) {
				$data = usuariosModel::cambioManualPass($idusuario);
				if ($data['status'] == "update_ok") {
					$data = ['status' => 'update_ok', 'msg' => 'Usuario Eliminado'];
				} else if ($data['status'] == "error") {
					$data = ['status' => 'error_delete', 'msg' => 'Error durante la eilimacion'];
				}
			} else {
				$data = ['errorvalida' =>  true, 'msg' => $val->getErrors()];
			}
		}
		echo json_encode($data, JSON_UNESCAPED_UNICODE);
	}



	public function eliminarUsuario()
	{
		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			$val = new Validator();
			$val->name('descmotivo')->value(limpiar($_POST['descmotivo']))->required();
			if ($val->isSuccess()) {
				$data = usuariosModel::deleteUsuario();
				if ($data['status'] == "delete_ok") {
					$data = ['status' => 'delete_ok', 'msg' => 'Usuario Eliminado'];
				} else if ($data['status'] == "error") {
					$data = ['status' => 'error_delete', 'msg' => 'Error durante la eilimacion'];
				}
			} else {
				$data = ['errorvalida' =>  true, 'msg' => $val->getErrors()];
			}
		}
		echo json_encode($data, JSON_UNESCAPED_UNICODE);
	}
}
