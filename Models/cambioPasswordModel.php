<?php 

require_once('Conexion.php');

	class cambioPasswordModel extends Conexion {
	
	public $db;

		public function __construct(){

			$db = Conexion::Conectar();
		}

		public static function cambiarPassword(){
			$password	= hash("sha256", limpiar($_POST['txt_pass1']));
			try {
				$stringSQL = "UPDATE usuario 
								SET usuario.PASSWORD = '".$password."',
								ESTADOCAMBIOPSW = '1',
								ULTIMOCAMBIOPSW = now()
								WHERE usuario.ID = '".$_SESSION['idusuario']."'";
                $resultado = parent::query($stringSQL,[]);
				if ($resultado) {
					$result = ['status' => 'update_ok', 'msg' => 'Password Actualizdo'];
				} 
			}catch (PDOException $e) {
				$result = ['status' => 'error', 'msg' => $e->getMessage()];
			}
			return $result;
		}

		public static function generaTokenPassword(){
			try {
				$token = Functions::generaToken(60);
				$tokenexpira = date("Y-m-d H:i:s", time() + 60 * 60);
				$idusuario = limpiar($_POST['idusuario']);
				$stringSQL = "UPDATE usuario 
									SET TOKEN = '".$token."',
										TOKENEXPIRA = '".$tokenexpira."',
										ESTADOCAMBIOPSW = 1
									WHERE usuario.ID = '".$idusuario."'";
                $resultado = parent::query($stringSQL,[]);
				if ($resultado) {
					$result = ['status' => 'update_ok', 'msg' => 'Password Actualizdo'];
				} 
			}catch (PDOException $e) {
				$result = ['status' => 'error', 'msg' => $e->getMessage()];
			}
			return $result;
		}

		public static function buscarToken($idusuario){
			try {
				$stringSQL = "SELECT ID, USUARIO, TOKEN, ESTADOCAMBIOPSW, TOKENEXPIRA FROM usuario WHERE usuario.ID = '".$idusuario."'";
                $result = DB::SQL($stringSQL);
			}catch (PDOException $e) {
				$result = ['status' => 'error', 'msg' => $e->getMessage()];
			}
			return $result;
		}

	}
?>