<?php
	
	class Upload extends DB {

		
		public static function validaLinea($ncontenedor, $idlinea){
			try {
				$stringSQL = "SELECT 
								ID, NCONT, TIPO, IDLINEA, INVENTARIO, PREASIGNACION 
							FROM 
								inventario 
							WHERE 
								NCONT = '".$ncontenedor."'";
				$result = DB::SQL($stringSQL);
			} catch (PDOException $e) {
				$result = ['status' => 'error', 'msg' => $e->getMessage()];
			}
			return $result;

		}

		public static function validaTipoContendor($tipocont, $idlinea){
			try {
				$stringSQL = "SELECT 
								ID, CODIGO, ISOCODE, IDLINEA 
							FROM 
								tipocont 
							WHERE 
								IDLINEA = '".$idlinea."' AND ID = {$tipocont}";
				$result = DB::SQL($stringSQL);
			} catch (PDOException $e) {
				$result = ['status' => 'error', 'msg' => $e->getMessage()];
			}
			return $result;
		}

		public static function validaPreasignacion($ncontenedor){
			$result =[];
			try {
				$stringSQL = "SELECT 
									IDPRESASIGNACION, CONTENEDOR, IDRESERVA, EIRSALIDA, preasignacionesdet.ESTADO
							FROM 
									teus.preasignacionesdet
							INNER JOIN 
									preasignaciones ON preasignaciones.ID = preasignacionesdet.IDPRESASIGNACION 
							WHERE 
									preasignacionesdet.CONTENEDOR = '".$ncontenedor."'  AND EIRSALIDA IS NULL LIMIT 1;".PHP_EOL;
			//echo $stringSQL;
				$result = DB::SQL($stringSQL);
			} catch (PDOException $e) {
				$result = ['status' => 'error', 'msg' => $e->getMessage()];
			}
			return $result;
		}
		
				
	}

?>