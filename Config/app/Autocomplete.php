<?php
	
	class Autocomplete extends DB {

        public static function getComponente($termino, $idlinea, $idingreso)
		{
			$result = [];
			try {
				$tamano = self::getTamanoByIngreso($idingreso);
				$grupo = self::getgrupoByIngreso($idingreso);
				$stringSQL = "SELECT detalletablarepara.ID, componente.ID AS IDCOMPONENTE, CODCOMPONENTE, UPPER(componente.DESCRIPCION) AS DESCRIPCION, 
								detalletablarepara.CODREPARA, reparacion.ID AS IDREPARA, UPPER(NOMBREIN) AS NOMBREIN, detalletablarepara.ESTADO, LOCALIZA, TIPOLIQUIDA, TAMANO
								FROM detalletablarepara 
								LEFT JOIN tablarepara ON tablarepara.ID  = detalletablarepara.IDTABLA
								LEFT JOIN componente ON componente.CODIGO = detalletablarepara.CODCOMPONENTE
								LEFT JOIN reparacion ON reparacion.CODREPARA = detalletablarepara.CODREPARA
								WHERE (CODCOMPONENTE LIKE '%".$termino."%')  AND componente.ESTADO = 1 AND tablarepara.IDCLIENTE = '".$idlinea."' AND JSON_CONTAINS(TAMANO, {$tamano[0]["TAMANO"]}, '$') AND JSON_CONTAINS(GRUPOTIPOCONT, '\"".$grupo[0]["GRUPO"]."\"', '$') ";
				//echo $stringSQL;
				$respuesta = parent::SQL($stringSQL);
				return $respuesta;
			} catch (PDOException $e) {
				$result = ['status' => 'error', 'msg' => $e->getMessage()];
				return $result;
			}
		}



		public static function getdanoByComponente($idcomponente, $termino)
		{
			$result = [];
			try {
				$stringSQL = "SELECT componentedano.ID, dano.ID AS IDDANO, CODDANO, UPPER(dano.NOMBRESP) AS NOMBRESP, UPPER(dano.NOMBREIN) AS NOMBREIN
								FROM teus.componentedano
								LEFT JOIN dano ON dano.ID = componentedano.IDDANO
								WHERE componentedano.IDCOMPONENTE = '".$idcomponente."' AND dano.CODDANO LIKE '%".$termino."%' AND dano.ESTADO = 1";
				$respuesta = parent::SQL($stringSQL);
				return $respuesta;
			} catch (PDOException $e) {
				$result = ['status' => 'error', 'msg' => $e->getMessage()];
				return $result;
			}
		}

		public static function getTamanoByIngreso($idingreso)
		{
			$result = [];
			try {
				$stringSQL = "SELECT TAMANO
								FROM teus.ingresocont
								WHERE ingresocont.ID = '".$idingreso."'";
				$respuesta = parent::SQL($stringSQL);
				return $respuesta;
			} catch (PDOException $e) {
				$result = ['status' => 'error', 'msg' => $e->getMessage()];
				return $result;
			}
		}

		public static function getgrupoByIngreso($idingreso)
		{
			$result = [];
			try {
				$stringSQL = "SELECT GRUPO
								FROM teus.ingresocont
								WHERE ingresocont.ID = '".$idingreso."'";
				
				$respuesta = parent::SQL($stringSQL);
				return $respuesta;
			} catch (PDOException $e) {
				$result = ['status' => 'error', 'msg' => $e->getMessage()];
				return $result;
			}
		}


	}

?>