<?php

	class depositosModel extends DB {
		private $conexion;
		public function __construct(){
		}

		public static function getAllDepositos(){
			$result = [];
			try {
				$stringSQL = "SELECT deposito.ID, deposito.NOMBRE AS NOMDEPOSITO, INGINVENTARIO, ciudad.NOMBRE 	AS NOMCIUDAD, deposito.USUACREA, deposito.ESTADO
								FROM deposito
								INNER JOIN ciudad ON ciudad.CODIGO = deposito.CODCIUDAD";
				$respuesta = parent::SQL($stringSQL);
				return $respuesta;
			} catch (PDOException $e) {
				$result = ['status' => 'error', 'msg' => $e->getMessage()];
				return $result;
			}
        }

		public static function datosTabla($tabla){
			$selectString = "";
			$where_condition = "";
			$stringSQL = "";
			$columns = array(
				0 => 'deposito.ID',
				1 => 'deposito.NOMBRE',
				2 => 'ciudad.NOMBRE', 
				3 => 'INGINVENTARIO',
				4 => 'deposito.ESTADO');
			try{			
				$selectString .= "SELECT deposito.ID, deposito.NOMBRE AS NOMDEPOSITO, INGINVENTARIO, ciudad.NOMBRE 	AS NOMCIUDAD, deposito.USUACREA, deposito.ESTADO ";
				$stringSQL = $selectString.' FROM '.$tabla .' INNER JOIN ciudad ON ciudad.CODIGO = deposito.CODCIUDAD';
				if(!empty($_REQUEST['search']['value']) ) {
					$where_condition .= " WHERE ";
						for ($i=0; $i<count($columns); $i++) { 
							$where_condition .= "$columns[$i]"." LIKE ". "'%" .$_REQUEST['search']['value']."%' OR ";
						}
					   $where_condition = substr($where_condition,0,-4);
				 }
				 $stringSQL .= $where_condition;
				 $stringSQL .= " ORDER BY ". $columns[$_REQUEST['order'][0]['column']] ."   ". $_REQUEST['order'][0]['dir'] ." LIMIT ". $_REQUEST['start'] ." ,". $_REQUEST['length'] ."   ";
				 $result = DB::SQL($stringSQL);
			}catch (PDOException $e) {
					$result = ['status' => 'error', 'msg' => $e->getMessage()];
			}
			 return $result;
		}

		
		public static function rowCountTable($tabla){
			$stringSQL = "";
			$where_condition = "";
			$columns = array(
				0 => 'deposito.ID',
				1 => 'deposito.NOMBRE',
				2 => 'ciudad.NOMBRE', 
				3 => 'INGINVENTARIO',
				4 => 'deposito.ESTADO');
				try {
					if (!empty($_REQUEST['search']['value'])) {
						$where_condition .= " WHERE ";
						for ($i = 0; $i < count($columns); $i++) {
							$where_condition .= "$columns[$i]" . " LIKE " . "'%" . $_REQUEST['search']['value'] . "%' OR ";
						}
						$where_condition = substr($where_condition, 0, -4);
					}
					$stringSQL .= "SELECT COUNT(deposito.ID) AS total FROM " . $tabla. ' INNER JOIN ciudad ON ciudad.CODIGO = deposito.CODCIUDAD';
					$stringSQL .= $where_condition;
					$stringSQL .= " ORDER BY ". $columns[$_REQUEST['order'][0]['column']] ."   ". $_REQUEST['order'][0]['dir'] ." LIMIT ". $_REQUEST['start'] ." ,". $_REQUEST['length'] ."   ";
					$result = DB::SQL($stringSQL);
				} catch (PDOException $e) {
					$result = ['status' => 'error', 'msg' => $e->getMessage()];
				}
			return $result;
		}


        public static function getOneDeposito($iddeposito){
		$result = [];
			try {
				$stringSQL = "SELECT deposito.ID, deposito.NOMBRE AS NOMDEPOSITO, INGINVENTARIO, ciudad.NOMBRE 	AS NOMCIUDAD, deposito.CODCIUDAD, deposito.USUACREA, deposito.ESTADO, 
								estado.DESCESTADO
								FROM deposito
								INNER JOIN ciudad ON ciudad.CODIGO = deposito.CODCIUDAD
								INNER JOIN estado ON estado.ID = deposito.ESTADO
								WHERE deposito.ID = '".$iddeposito."'";
				$result = parent::SQL($stringSQL);
			} catch (PDOException $e) {
				$result = ['status' => 'error', 'msg' => $e->getMessage()];
			}
			return $result;
        }

        public static function saveDeposito(){
			$result = [];
			$nomdeposito	= mb_strtolower(limpiar($_POST['txt_nombre']));
			$ciudad			= mb_strtolower(limpiar($_POST['sel_ciudad']));
			$estado 		= mb_strtolower(limpiar($_POST['sel_estado']));
			$inventario 	= isset($_POST['inginventario']) ? '1' : '0';
			$usuario 		= $_SESSION['usuario'];
			try {
				$stringSQL = "INSERT INTO deposito VALUES (NULL, '".$nomdeposito."', '".$estado."','".$inventario."', '".$ciudad."','".$usuario."', NULL, now())";
				$iddeposito = parent::query($stringSQL,[]);
			if ($iddeposito>0){		
				if ((!empty($_POST['listLineas_to'])) ){
					$lineas 	= $_POST['listLineas_to'];
						for ($i=0; $i < count($lineas) ; $i++) { 
							$stringSQLlineas = "INSERT INTO depositocliente VALUES ( '".$iddeposito."', '".$lineas[$i]."')";
							$respuestaSelect = parent::query($stringSQLlineas,[]);
						}
				}
			}

			$result = ['status' => 'save_ok','msg'=>'deposito guardado'];
			} catch (PDOException $e) {
				$result = ['status' => 'error', 'msg'=>$e->getMessage()];
				if ($e->getCode() == 23000 ){
						$result = ['status' => 'deposito_existe', 'msg'=>'deposito existe'];
				}else{
						$result = ['status' => 'error', 'msg' => $e->getMessage()];
				}
			}
			return $result;
		}
		

		 public static function updateDeposito (){
			$result = [];
			$iddeposito		= mb_strtolower(limpiar($_POST['iddeposito']));
			$nomdeposito	= mb_strtolower(limpiar($_POST['txt_nombre']));
			$ciudad			= mb_strtolower(limpiar($_POST['sel_ciudad']));
			$estado 		= mb_strtolower(limpiar($_POST['sel_estado']));
			$inventario 	= isset($_POST['inginventario']) ? '1' : '0';
			$usuaupdate		= $_SESSION['usuario'];
			try {
				$stringSQL = "UPDATE deposito
								SET NOMBRE	 		= 	'".$nomdeposito."',
									ESTADO 			=	'".$estado."',
									INGINVENTARIO	= 	'".$inventario."',
									CODCIUDAD 		= 	'".$ciudad."',
									USUAACTUA 		=	'".$usuaupdate."'
								WHERE ID = '".$iddeposito."'";
				$respuesta = parent::query($stringSQL,[]);
				if ((!empty($_POST['listLineas_to'])) ){
					$lineas 	= $_POST['listLineas_to'];
					// Borra el contendio de la tabla depositocliente
					$stringSQLDelete = "DELETE FROM depositocliente WHERE IDDEPOSITO = '".$iddeposito."'";
					$resultSQL = parent::query($stringSQLDelete,[]);
						for ($i=0; $i < count($lineas) ; $i++) { 
								$stringSQLlineas = "INSERT INTO depositocliente VALUES ( '".$iddeposito."', '".$lineas[$i]."')";
								$respuestaSelect = parent::query($stringSQLlineas,[]);
							}
				}else{
					$stringSQLDelete = "DELETE FROM depositocliente WHERE IDDEPOSITO = '".$iddeposito."'";
					$resultSQL = parent::query($stringSQLDelete,[]);
				}
				$result = ['status' => 'update_ok','msg'=>'deposito guardado'];
			}catch (PDOException $e) {
				$result = ['status' => 'error', 'msg'=>$e->getMessage()];
				if ($e->getCode() == 23000 ){
						$result = ['status' => 'deposito_existe', 'msg'=>'deposito existe'];
				}else{
						$result = ['status' => 'error', 'msg' => $e->getMessage()];
				}
			}
			return $result;
		}

		public static function deleteDeposito(){
			$result 		= [];
			$motivo 		= mb_strtolower(limpiar($_POST['descmotivo']));
			$ideliminacion 	= mb_strtolower(limpiar($_POST['ideliminacion']));
			$usuario 		= $_SESSION['usuario'];
			$tabla 			= 'deposito';
			try {
				$stringSQLdelete = "DELETE FROM deposito WHERE ID = '".$ideliminacion."'";
				$respuestaDelete = parent::query($stringSQLdelete,[]);
				if($respuestaDelete){
					$stringSQL = "INSERT INTO moteliminacion VALUES (NULL, '".$ideliminacion."', '".$motivo."', now(), '".$usuario."','".$tabla."')";
					$respuestaLOG = parent::query($stringSQL,[]);
				}
				$result = ['status' => 'delete_ok','msg'=>'deposito eliminado'];
			}catch (PDOException $e) {
				$result = ['status' => 'error', 'msg'=>$e->getMessage()];
			}
				return $result;		
		}

		public static function getClientesDisponible($iddeposito){
			$result = [];
				try {
					$stringSQL = "SELECT * FROM cliente WHERE (ESTADO = 1 AND LINEANAV = 1) AND ID NOT IN 
    							(SELECT IDCLIENTE FROM depositocliente WHERE IDDEPOSITO = '".$iddeposito."');";
					$respuesta = parent::SQL($stringSQL);
					return $respuesta;
				} catch (PDOException $e) {
					$result = ['status' => 'error', 'msg' => $e->getMessage()];
					return $result;
				}
		}

		public static function getClientesDeposito($iddeposito){
			$result = [];
				try {
					$stringSQL = "SELECT cliente.ID, NOMCLIENTE 
									FROM cliente
									INNER JOIN depositocliente ON depositocliente.IDCLIENTE = cliente.ID
									WHERE depositocliente.IDDEPOSITO = '".$iddeposito."' AND cliente.ESTADO = 1 AND LINEANAV = 1";
					$respuesta = parent::SQL($stringSQL);
					return $respuesta;
				} catch (PDOException $e) {
					$result = ['status' => 'error', 'msg' => $e->getMessage()];
					return $result;
				}
		}


	}

?>