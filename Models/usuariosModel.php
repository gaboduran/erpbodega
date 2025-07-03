<?php 
	
	class usuariosModel extends DB{

		public function __construct(){

		}

		public static function getAllUsuarios(){
			$result = [];
			try {
				$stringSQL = "SELECT usuarios.ID, USUARIO, NOMBRE, APELLIDOS, EMAIL, NOMPERFIL, usuarios.ESTADO, TELEFONO
									FROM usuarios
									INNER JOIN perfiles p ON p.ID = IDPERFIL;";
				$respuesta = parent::SQL($stringSQL);
				return $respuesta;
			} catch (Exception $e) {
				$result = ['status' => 'error', 'msg' => $e->getMessage()];
				return $result;
			}
		}

		public static function getOneUsuario($id){
		$result = [];
			try {
				$stringSQL = "SELECT usuarios.ID AS ID, USUARIO, NROIDE, NOMBRE, APELLIDOS, EMAIL, TELEFONO, IDPERFIL, usuarios.ESTADO, NOMPERFIL, estado.DESCESTADO,
								TIPOUSUARIO AS CODTIPOUSER, tipousuario.DESCRIPCION AS DESCTIPOUSER
								FROM usuarios 
								INNER JOIN perfiles ON perfiles.ID = usuarios.IDPERFIL
								INNER JOIN estado ON estado.ID = usuarios.ESTADO
								INNER JOIN tipousuario ON tipousuario.CODIGO = usuarios.TIPOUSUARIO
								WHERE usuarios.ID = '".$id."'";
				$respuesta = parent::SQL($stringSQL);
				return $respuesta;
			} catch (PDOException $e) {
				$result = ['status' => 'error', 'msg' => $e->getMessage()];
				return $result;
			}
		}

		public static function listaPerfiles($estado){
			$result = [];
			try {
				$stringSQL = "SELECT ID, NOMPERFIL, ESTADO FROM perfil WHERE ESTADO = '".$estado."'";
				$respuesta = parent::query($stringSQL,[]);
				return $respuesta;
			} catch (PDOException $e) {
					$result = ['status' => 'error', 'msg' => $e->getMessage()];
				return $result;
			}
		}

		public static function crearUsuario(){
			$result 		= [];
			$usuariocrea 	= $_SESSION['idusuario'];
			$nroide 		= mb_strtolower(limpiar($_POST['txt_ide']));
			$nombres 		= mb_strtolower(limpiar($_POST['txt_nombre']));
			$apellidos 		= mb_strtolower(limpiar($_POST['txt_apellido']));
			$email			= mb_strtolower(limpiar($_POST['txt_email']));
			$telefono 		= mb_strtolower(limpiar($_POST['txt_telefono']));
			$perfil 		= mb_strtolower(limpiar($_POST['sel_perfil']));
			$tipousuario 	= mb_strtoupper(limpiar($_POST['sel_tipousuario']));
			$estado 		= mb_strtolower(limpiar($_POST['sel_estado']));
			$usuario 		= mb_strtolower(limpiar($_POST['txt_usuario']));
			$password 		= hash("sha256", limpiar($_POST['txt_ide']));
			try {
				$resultemail = Listas::validaEmail($email);
				$resultusuario = Listas::validaUsuario($usuario);
				if ($resultemail[0]['CUENTA'] >=1){
					$result = ['status' => 'email_existe','msg'=>'el email esta en uso'];
				}else if ($resultusuario[0]['CUENTA'] >=1){
					$result = ['status' => 'usuario_existe','msg'=>'el usuario esta en uso'];

				}else{
					$stringSQL = "INSERT INTO usuarios (USUARIO, PASSWORD, NROIDE, NOMBRE, APELLIDOS, EMAIL, TELEFONO, ESTADO, IDPERFIL, TIPOUSUARIO, USUACREA )
									VALUES ('".$usuario."', '".$password."', '".$nroide."','".$nombres."','".$apellidos."','".$email."','".$telefono."','".$estado."', '".$perfil."', '".$tipousuario."' , '".$usuariocrea."')";
					$idusuario = parent::query($stringSQL,[]);
					if ($idusuario>0){		
						if ((!empty($_POST['listLineas_to'])) ){
							$lineas 	= $_POST['listLineas_to'];
								for ($i=0; $i < count(value: $lineas) ; $i++) { 
										$stringSQLlineas = "INSERT INTO usuariosbodegas (IDUSUA,IDBODEGA ) VALUES ( '".$idusuario."', '".$lineas[$i]."')";
										$respuestaSelect = parent::query($stringSQLlineas,[]);
									}
						}
					}
				$result = ['status' => 'save_ok','msg'=>'usuario_guarado'];
				}
			}catch (PDOException $e) {
				 if ($e->getCode() == 23000 ){
					$result = ['status' => 'usuario_existe', 'msg'=>'usuario existe'];
				}else{
					$result = ['status' => 'error', 'msg' => $e->getMessage()];
				}
			}
			return $result;
		
		}
		public static function actualizarUsuario($idusuario){
			$result 		= [];
			$nroide 		= mb_strtolower(limpiar($_POST['txt_ide']));
			$nombres 		= mb_strtolower(limpiar($_POST['txt_nombre']));
			$apellidos 		= mb_strtolower(limpiar($_POST['txt_apellido']));
			$email			= mb_strtolower(limpiar($_POST['txt_email']));
			$telefono 		= mb_strtolower(limpiar($_POST['txt_telefono']));
			$perfil 		= mb_strtolower(limpiar($_POST['sel_perfil']));
			$tipousuario 	= mb_strtolower(limpiar($_POST['sel_tipousuario']));
			$estado 		= mb_strtolower(limpiar($_POST['sel_estado']));
			try {
				$stringSQL = "UPDATE usuarios 
								SET NROIDE		= 	'".$nroide."',	
									NOMBRE		= 	'".$nombres."',
									APELLIDOS	= 	'".$apellidos."',
									EMAIL 		= 	'".$email."',
									TELEFONO 	=  	'".$telefono."',
									ESTADO 		=  	'".$estado."',
									TIPOUSUARIO =  	'".$tipousuario."',
									IDPERFIL	= 	'".$perfil."'
								WHERE usuarios.ID = '".$idusuario."'";
				$respuesta = parent::query($stringSQL,[]);
				if ((!empty($_POST['listLineas_to'])) ){
					$lineas 	= $_POST['listLineas_to'];
					// Borra el contendio de la tabla usuariocliente
					$stringSQLDelete = "DELETE FROM usuariosbodegas WHERE IDUSUA = '".$idusuario."'";
					$resultSQL = parent::query($stringSQLDelete,[]);
						for ($i=0; $i < count($lineas) ; $i++) { 
							$stringSQLlineas = "INSERT INTO usuariosbodegas (IDUSUA,IDBODEGA ) VALUES ( '".$idusuario."', '".$lineas[$i]."')";
							$respuestaSelect = parent::query($stringSQLlineas,[]);
						}
				}else{
					$stringSQLDelete = "DELETE FROM usuariosbodegas WHERE IDUSUA = '".$idusuario."'";
					$resultSQL = parent::query($stringSQLDelete,[]);
				}
				$result = ['status' => 'update_ok','msg'=>'usuario_actualizado'];
			} catch (PDOException $e) {
						$result = ['status' => 'error', 'msg' => $e->getMessage()];
			}
			return $result;
	}

		public static function deleteUsuario(){
			$result 		= [];
			$motivo 		= mb_strtolower(limpiar($_POST['descmotivo']));
			$ideliminacion 	= mb_strtolower(limpiar($_POST['ideliminacion']));
			$usuario 		= $_SESSION['usuario'];
			$tabla 			= 'usuario';
				try {
					$stringSQLdelete = "DELETE FROM usuario WHERE ID = '".$ideliminacion."'";
					$respuestaDelete = parent::query($stringSQLdelete,[]);
					if($respuestaDelete){
						$stringSQL = "INSERT INTO moteliminacion VALUES (NULL, '".$ideliminacion."', '".$motivo."', now(), '".$usuario."','".$tabla."')";
						$respuestaLOG = parent::query($stringSQL,[]);
					}
				$result = ['status' => 'delete_ok','msg'=>'perfil eliminado'];
				} catch (PDOException $e) {
					$result = ['status' => 'error', 'msg'=>$e->getMessage()];
				}
					return $result;
		}

		public static function perfilesNOuser($idPerfil){
			$result = [];
				try {
					$stringSQL = "SELECT ID AS IDPERFIL, NOMPERFIL, ESTADO FROM perfiles WHERE ESTADO = '1' AND ID <> '".$idPerfil."'";
						$respuesta = parent::query($stringSQL,[]);
					return $respuesta;
				} catch (PDOException $e) {
						$result = ['status' => 'error', 'msg' => $e->getMessage()];
					return $result;
			}
		}

		public static function perfilesNoTipoDoc($id){
			$result = [];
				try {
					$stringSQL = "SELECT ID, CODIGO, DESCRIPCION FROM tipodoc WHERE ESTADO = '1' AND CODIGO <> '".$id."' ORDER BY ID ASC";
					$respuesta = parent::query($stringSQL,[]);
					return $respuesta;
				} catch (PDOException $e) {
						$result = ['status' => 'error', 'msg' => $e->getMessage()];
					return $result;
			}
		}

		public static function estadoNOuser($idEsatado){
			$result = [];
				try {
					$stringSQL = "SELECT ID, NOMPERFIL, ESTADO FROM perfil WHERE ESTADO = '1' AND ID <> '".$idPerfil."'";
					$respuesta = parent::query($stringSQL,[]);
					return $respuesta;
				} catch (PDOException $e) {
						$result = ['status' => 'error', 'msg' => $e->getMessage()];
					return $result;
			}
		}
		public static function cambioManualPass($idusuario){
			$result = [];
			$password 		= hash("sha256", limpiar($_POST['txt_pass1']));
				try {
					$stringSQL = "UPDATE usuario
									SET PASSWORD = '".$password."',
										ESTADOCAMBIOPSW = '0'
									WHERE ID = $idusuario";
					$result = parent::query($stringSQL,[]);
					if($result){
						$result = ['status' => 'update_ok','msg'=>'usuario_actualizado'];
					}
				}catch (PDOException $e) {
						$result = ['status' => 'error', 'msg' => $e->getMessage()];
					}
				return $result;
		}
		

}
