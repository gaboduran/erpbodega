<?php

	class configuraciongeneralModel extends DB {


		private $conexion;
		public function __construct(){
		
		}

		public static function guardarSeccionTaller(){
			$result = [];
			$cobrotallertercero = isset($_POST['cobrotallertercero']) ? '1' : '0';
			
			echo $_POST['txt_sec_taller'].' - '.$cobrotallertercero;
			/*try {
				$stringSQL = "INSERT INTO configeneral SECCION, VARIABLE VALUES ( 'TALLER', 'TALLERTERCERO', '".$cobrotallertercero."')";
				//$respuesta = parent::SQL($stringSQL);
				//return $respuesta;
				echo $stringSQL;
			} catch (PDOException $e) {
				$result = ['status' => 'error', 'msg' => $e->getMessage()];
				return $result;
			}*/
        }

        public static function getOneGrupoTipoCont($idgrupoticont){
			try {
				$stringSQL = "SELECT ID, CODIGO, DESCRIPCION, ESTADO FROM grupotipcont WHERE ID = {$idgrupoticont}";
				$respuesta = parent::SQL($stringSQL);
				return $respuesta;
			} catch (PDOException $e) {
				$result = ['status' => 'error', 'msg' => $e->getMessage()];
				return $result;
			}
        }

        public static function saveGrupoTipoContenedor(){
			$result = [];
			$codigo			= mb_strtoupper(limpiar($_POST['txt_codigo']));
			$descripcion 	= mb_strtolower(limpiar($_POST['txt_descripcion']));
			$estado 		= mb_strtolower(limpiar($_POST['sel_estado']));
			$usuario 		= $_SESSION['usuario'];
			try {
				$stringSQL = "INSERT INTO grupotipcont VALUES (NULL, '".$codigo."', '".$descripcion."', '".$estado."','".$usuario."',  NULL, now())";
				$respuesta = parent::query($stringSQL,[]);
				$result = ['status' => 'save_ok','msg'=>'grupo guardado'];
			} catch (PDOException $e) {
				$result = ['status' => 'error', 'msg'=>$e->getMessage()];
				if ($e->getCode() == 23000 ){
						$result = ['status' => 'grupo_existe', 'msg'=>'grupo existe'];
				}else{
						$result = ['status' => 'error', 'msg' => $e->getMessage()];
				}
			}
			return $result;
		}
		

		 public static function updateGrupoTipoContenedor(){
			$result 		= [];
			$idgrupoticont 	= mb_strtolower(limpiar($_POST['idgrupoticont']));
			$codigo			= mb_strtoupper(limpiar($_POST['txt_codigo']));
			$descripcion 	= mb_strtolower(limpiar($_POST['txt_descripcion']));
			$estado 		= mb_strtolower(limpiar($_POST['sel_estado']));
			$usuario 		= $_SESSION['usuario'];
			try {
				$stringSQL = "UPDATE grupotipcont
								SET CODIGO 			=  '".$codigo."',
									DESCRIPCION 	= 	'".$descripcion."',
									ESTADO 			=	'".$estado."',
									USUAACTUA		=	'".$usuario."'
								WHERE ID = {$idgrupoticont}";
				$respuesta = parent::query($stringSQL,[]);
				$result = ['status' => 'update_ok','msg'=>'grupo guardado'];
			} catch (PDOException $e) {
				$result = ['status' => 'error', 'msg'=>$e->getMessage()];
				if ($e->getCode() == 23000 ){
						$result = ['status' => 'grupo_existe', 'msg'=>'grupo existe'];
				}else{
						$result = ['status' => 'error', 'msg' => $e->getMessage()];
				}
			}
			return $result;
		}

		public static function deleteGrupoTipoContenedor(){
			$result 		= [];
			$motivo 		= mb_strtolower(limpiar($_POST['descmotivo']));
			$ideliminacion 	= mb_strtolower(limpiar($_POST['ideliminacion']));
			$usuario 		= $_SESSION['usuario'];
			$tabla 			= 'grupotipcont';
			try {
				$stringSQLdelete = "DELETE FROM grupotipcont WHERE ID = '".$ideliminacion."'";
				$respuestaDelete = parent::query($stringSQLdelete,[]);
				if($respuestaDelete){
					$stringSQL = "INSERT INTO moteliminacion VALUES (NULL, '".$ideliminacion."', '".$motivo."', now(), '".$usuario."','".$tabla."')";
					$respuestaLOG = parent::query($stringSQL,[]);
				}
				$result = ['status' => 'delete_ok','msg'=>'grupo eliminado'];
			}catch (PDOException $e) {
				$result = ['status' => 'error', 'msg'=>$e->getMessage()];
			}
				return $result;		
		}
	}

?>