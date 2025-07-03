<?php

	class perfilesModel extends DB {


		public $IDPERFIL;
		public $NOMBREROL;
		public $ESTADO;

		private $conexion;

		public function __construct(){
		$dbconec = Conexion::Conectar();
		}

		public static function getAllPerfiles(){
			$result = [];
			try {
				$stringSQL = "SELECT ID, NOMPERFIL, ESTADO FROM perfiles";
				$respuesta = parent::SQL($stringSQL);
				return $respuesta;
			} catch (PDOException $e) {
				$result = ['status' => 'error', 'msg' => $e->getMessage()];
				return $result;
			}
        }

		public static function getAllModulosPerfil($id){
			$result = [];
			try {
				$stringSQL = "SELECT  modulos.ID, NOMBRE, COALESCE(permisos.C,0) C, COALESCE(permisos.R,0) R, COALESCE(permisos.U,0) U, COALESCE(permisos.D,0) D
					FROM modulos
					LEFT JOIN permisos ON modulos.ID = permisos.IDMODULO AND permisos.IDPERFIL = '".$id."'
					WHERE PAGINA IS NOT NULL 
					ORDER BY modulos.ID;";
				$respuesta = parent::SQL($stringSQL);
				return $respuesta;
			} catch (PDOException $e) {
				$result = ['status' => 'error', 'msg' => $e->getMessage()];
				return $result;
			}
        }

        public static function getOnePerfil($id){
			$result = [];
			try {
				$stringSQL = "SELECT ID, NOMPERFIL, ESTADO FROM Perfiles WHERE ID = '".$id."'";
				$respuesta = parent::SQL($stringSQL);
				return $respuesta;
			} catch (PDOException $e) {
				$result = ['status' => 'error', 'msg' => $e->getMessage()];
				return $result;
			}
        }

        public static function savePerfil(){
			$result = [];
			$nomperfil 	= mb_strtolower(limpiar($_POST['txt_nomperfil']));
			$estado 	= mb_strtolower(limpiar($_POST['sel_estado']));
			$usuario 	= $_SESSION['usuario'];
			try {
				$stringSQL = "INSERT INTO perfil VALUES (NULL, '".$nomperfil."', '".$estado."', '".$usuario."', NULL, now())";
				$respuesta = parent::query($stringSQL,[]);
				if ($respuesta>=1){
					$result = ['status' => 'save_ok','msg'=>'perfil guardado'];
				}
			}catch (PDOException $e) {
				$result = ['status' => 'error', 'msg'=>$e->getMessage()];
				if ($e->getCode() == 23000 ){
						$result = ['status' => 'perfil_existe', 'msg'=>'perfil existe'];
				}else{
						$result = ['status' => 'error', 'msg' => $e->getMessage()];
				}
			}
			return $result;
		}

		public static function updatePerfil($id){
			$result = [];
			$nomperfil 	= mb_strtolower(limpiar($_POST['txt_nomperfil']));
			$estado 	= mb_strtolower(limpiar($_POST['sel_estado']));
			$usuario 	= $_SESSION['usuario'];
			try {
				$stringSQL = "UPDATE perfil
								SET NOMPERFIL = '".$nomperfil."', 
									ESTADO = '".$estado."',
									USUAACTUA = '".$usuario."'
								WHERE ID = '".$id."'";
				$respuesta = parent::query($stringSQL,[]);
				if ($respuesta>=1){
					$result = ['status' => 'update_ok','msg'=>'perfil actualizado'];
				}
			}catch (PDOException $e) {
				$result = ['status' => 'error', 'msg'=>$e->getMessage()];
				if ($e->getCode() == 23000 ){
						$result = ['status' => 'perfil_existe', 'msg'=>'perfil existe'];
				}else{
						$result = ['status' => 'error', 'msg' => $e->getMessage()];
				}
			}
			return $result;
		}


		public static function deletePerfil($idperfil){
			$result 		= [];
			$motivo 		= mb_strtolower(limpiar($_POST['descmotivo']));
			$ideliminacion 	= mb_strtolower(limpiar($_POST['ideliminacion']));
			$usuario 		= $_SESSION['usuario'];
			$tabla 			= 'perfil';
			try {
				$data = self::getOnePerfil($idperfil);
				$stringSQLdelete = "DELETE FROM perfil WHERE ID = '".$idperfil."'";
				$respuestaDelete = parent::query($stringSQLdelete,[]);
				$nomperfil =  $data[0]['NOMPERFIL'];
				if($respuestaDelete){
					$stringSQL = "INSERT INTO moteliminacion (ID, IDELIMINACION, MOTIVO, FECHA, USUARIO, TABLA, ATRIBUTO1) VALUES (NULL, '".$ideliminacion."', '".$motivo."', now(), '".$usuario."','".$tabla."', '".$data[0]['NOMPERFIL']."')";
					$respuestaLOG = parent::query($stringSQL,[]);
				}
				$result = ['status' => 'delete_ok','msg'=>'perfil eliminado'];
			}catch (PDOException $e) {
				$result = ['status' => 'error', 'msg'=>$e->getMessage()];
			}
				return $result;	
		}

		public static function verModulosPerfil($id){
			$result = [];
			try {
				$stringSQL = "SELECT modulo.ID, modulo.NOMBRE, permiso.C, permiso.R, permiso.U, permiso.D
								FROM permiso
								LEFT JOIN modulo ON modulo.ID = permiso.IDMODULO
								WHERE IDPERFIL = '".$id."' AND PAGINA IS NOT NULL";
				$respuesta = parent::SQL($stringSQL);
				return $respuesta;
			} catch (PDOException $e) {
				$result = ['status' => 'error', 'msg' => $e->getMessage()];
				return $result;
			}
		}

		 public static function deleteModulos($idperfil){
			$result = [];
				try {
					$stringSQL = "DELETE FROM permiso WHERE IDPERFIL = '".$idperfil."'";
					$respuesta = parent::SQL($stringSQL);
					return $respuesta;
				}catch (PDOException $e) {
					$result = ['status' => 'error', 'msg' => $e->getMessage()];
					return $result;
				}
		}

		public static function registrarCrear($idPerfil, $idmodulo){
			$result = [];
			$dbconec = Conexion::Conectar();
				try {
					$stringSQL = "CALL SP_PERMISO_CREATE('".$idPerfil."', '".$idmodulo."')";
					$stmt = $dbconec->prepare($stringSQL);
					$stmt->execute();
				}catch (PDOException $e) {
					$result = ['status' => 'error', 'msg' => $e->getMessage()];
					return $result;
				}
			$dbconec = null;			
		}

		public static function registrarPrimerVer($idPerfil, $idmodulo){
			$result = [];
				try {
					$stringSQL = "INSERT INTO permiso VALUES (NULL, '".$idPerfil."','".$idmodulo."', 0, 1, 0, 0, NOW())";
					$result = parent::query($stringSQL,[]);
				}catch (PDOException $e) {
					$result = ['status' => 'error', 'msg' => $e->getMessage()];
				}
				return $result;
		}

		public static function registrarVer($idPerfil, $idmodulo){
			$padres = "";
			$insertSQL = "";
			$dbconec = Conexion::Conectar();
			if (is_null($idmodulo)){
				$stringSQL = "SELECT modulo.ID, modulo.PADREID
							FROM modulo 
							WHERE modulo.ID = '".$idmodulo."' AND modulo.PADREID IS NULL";
			}else{
				$stringSQL = "SELECT modulo.ID, modulo.PADREID
							FROM modulo 
							WHERE modulo.ID = '".$idmodulo."' AND modulo.PADREID IS NOT NULL";
			}
			$sql = DB::SQL($stringSQL);
				for ($i=0; $i < count($sql) ; $i++) { 
					$padres = $sql[$i]['PADREID'];
						if (!empty($sql[$i]['PADREID'])){
						$insertSQL = "INSERT INTO permiso (ID, IDPERFIL, IDMODULO, C, R, U, D, 
								FECCREA)
								SELECT NULL, '".$idPerfil."','".$sql[$i]['PADREID']."', 0, 1, 0, 0, NOW()
								FROM permiso
								WHERE NOT EXISTS (SELECT * FROM permiso WHERE IDPERFIL = '".$idPerfil."' AND IDMODULO = '".$sql[$i]['PADREID']."') LIMIT 1;";	
								$stmt = $dbconec->prepare($insertSQL);
								$stmt->execute();
							$padres = self::registrarVer($idPerfil, $sql[$i]['PADREID']);
						}
				}
			$dbconec = null;
		}

		public static function registrarUpdate($idPerfil, $idmodulo){
			$dbconec = Conexion::Conectar();
			$result = [];
				try {
					$stringSQL = "CALL SP_PERMISO_UPDATE('".$idPerfil."', '".$idmodulo."')";
					$stmt = $dbconec->prepare($stringSQL);
					$stmt->execute();
				}catch (PDOException $e) {
					$result = ['status' => 'error', 'msg' => $e->getMessage()];
					return $result;
				}
			$dbconec = null;
		}

		public static function registrarEliminar($idPerfil, $idmodulo){
			$dbconec = Conexion::Conectar();
			$result = [];
				try {
					$stringSQL = "CALL SP_PERMISO_DELETE('".$idPerfil."', '".$idmodulo."')";
					$stmt = $dbconec->prepare($stringSQL);
					$stmt->execute();
				}catch (PDOException $e) {
					$result = ['status' => 'error', 'msg' => $e->getMessage()];
					return $result;
				}
			$dbconec = null;
		}

			public static function updatePermission($idPerfil, $idModulo, $action, $state){
			$stringSQL = "CALL SP_UPDATE_PERMISOS(?, ?, ?, ?)";
			return parent::query($stringSQL, [$idPerfil, $idModulo, $action, $state]);
		}

	}
?>