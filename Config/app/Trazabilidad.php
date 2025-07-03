<?php
	
	class Trazabilidad extends DB {

		
		public static function updateTrazabilidad ($ncontenedor,$destino,$eirin){
			try {
                



			} catch (PDOException $e) {
				$result = ['status' => 'error', 'msg' => $e->getMessage()];
				return $result;
			}

		}

        public static function getOrigen ($ncontenedor,$eirin){
			try {
				$depot = DB::SQL("SELECT ID, IDORIGEN, FECHAMOV 
                                            FROM trazabilidad 
                                            WHERE EIRIN  = '".$eirin."' LIMIT 1 ");
				return $depot;
			} catch (PDOException $e) {
				$result = ['status' => 'error', 'msg' => $e->getMessage()];
				return $result;
			}

		}
				
	}

?>