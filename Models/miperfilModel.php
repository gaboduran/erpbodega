<?php 
	
	class miperfilModel extends DB{

		public function __construct(){

		}

		public static function getAllUsuarios(){
			$result = [];
			try {
				$stringSQL = "SELECT usuario.ID, USUARIO, NOMBRE, APELLIDOS, EMAIL, NOMPERFIL, 
									usuario.ESTADO, TELEFONO
									FROM usuario
									INNER JOIN perfil ON perfil.ID = usuario.IDPERFIL;";
				$respuesta = parent::SQL($stringSQL);
				return $respuesta;
			} catch (Exception $e) {
				$result = ['status' => 'error', 'msg' => $e->getMessage()];
				return $result;
			}
		}

		public static function updatePassword(){
			
		$usuario 	= limpiar($_POST['txt_usuario']);
		$pass1 		= limpiar($_POST['txt_pass1']);
		$pass2 		= limpiar($_POST['txt_pass2']);
		$result = [];
			try {
				if($pass1==$pass2){
					$password = hash("sha256", $pass1);
					$stringSQL = "UPDATE usuario
									SET PASSWORD = '".$password."'
									WHERE USUARIO = '".$usuario."'";
					$respuesta = DB::query($stringSQL,[]);
					if($respuesta){
						$result = ['status' => 'update_ok', 'msg' => 'password Actualizado'];
					}
				}else{
					$result = ['status' => 'pass_no', 'msg' => 'los password no coiciden'];
				}
			}catch (PDOException $e) {
				$result = ['status' => 'error', 'msg' => $e->getMessage()];
			}
			return $result;
		}


}
?>