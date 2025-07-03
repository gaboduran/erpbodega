<?php

	require_once('Conexion.php');
	
	class errorPDO extends DB {


		private $conexion;
		public function __construct(){

		}

	public static function saveError($tabla, $proceso, $code, $message, $usuario){
		$result = [];
			try {
			$stringSQL = "INSERT INTO logpdo VALUES (NULL, '".$tabla."', '".$proceso."', '".$code."', '".$message."', '".$usuario."',  now())";
				$respuesta = parent::SQL($stringSQL);
				return $respuesta;
			} catch (PDOException $e) {
				$result = ['status' => 'error', 'msg' => $e->getMessage()];
				return $result;
			}

	}

	}

?>