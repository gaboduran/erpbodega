<?php
	
	class Auth{

		public static function sessionUser($iduser){
			// $query = "SELECT * FROM usuarios u INNER JOIN perfiles p ON p.ID = u.IDPERFIL WHERE u.ID = $iduser";
			// echo $query;
			$sqlResultado = DB::SQL("SELECT * FROM usuarios u INNER JOIN perfiles p ON p.ID = u.IDPERFIL WHERE u.ID = $iduser");
			$_SESSION['userData'] = $sqlResultado[0];
			return $sqlResultado[0];
		}

		public static function sessionCambioPassword($iduser){
			$sqlResultado = DB::SQL("SELECT * FROM usuarios u INNER JOIN perfiles p ON p.ID = u.IDPERFIL WHERE u.ID = $iduser");
			$_SESSION['userCambioPass'] = $sqlResultado[0];
			return $sqlResultado[0];
		}

		public static function noAuth(){
			if (!isset($_SESSION['login'])){
				header('location:' .base_url()."login" );
			}
		}
		
		public static function noDepot(){
			if (!isset($_SESSION['idbodega'])){
				header('location:' .base_url()."home" );
			}
		}

		public static function sesionBodega($idbodega){
			if (isset($_SESSION['login'])){
				$sqlDeposito =  DB::SQL("SELECT bodegas.ID, bodegas.NOMBRE, CODCIUDAD 
												FROM bodegas 
												WHERE ID = $idbodega");
				return $sqlDeposito[0];
			}	
		}

		public static function logout(){
			session_start();
			session_destroy();
			$_SESSION = [];
			header('location:' .base_url()."login" );
		}

		public static function cierraSesion(){
			session_destroy();
			session_start();
			session_destroy();
			$_SESSION = [];
			$data = ['status' => 'logoutok', 'msg' => 'Se cerro la sesion'];
			return $data;
		}

	
	}

?>