 <?php 
	
	require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/erpbodega/Models/Conexion.php');

	class DB extends Conexion {

		public static function consultarSQL($query){
			$link = new Conexion();
			$link = Conexion::Conectar();
			$resultado = $link->query($query);
      		$array = [];
	 			while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
           		 	$array[] = $registro;
        		}
 			$resultado->closeCursor();
        	return $array;
		}

		public static function SQL($query){
			$resultado = self::consultarSQL($query);
			return $resultado;
		}

		
	}
	
?>