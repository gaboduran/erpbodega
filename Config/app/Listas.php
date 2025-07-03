<?php
	
	class Listas extends DB {



		public static function getbodegasByUsuario($idusuario)
		{
			$result = [];
			try {
				$stringSQL = "SELECT bodegas.ID, bodegas.NOMBRE, ciudades.NOMBRE AS NOMCIUDAD
								FROM usuariosbodegas
								INNER JOIN bodegas ON bodegas.ID = usuariosbodegas.IDBODEGA
								INNER JOIN ciudades ON ciudades.CODIGO = bodegas.CODCIUDAD
								WHERE IDUSUA = {$idusuario} AND bodegas.ESTADO = '1'";
				$respuesta = parent::SQL($stringSQL);
				return $respuesta;
			} catch (PDOException $e) {
				$result = ['status' => 'error', 'msg' => $e->getMessage()];
				return $result;
			}
		}

		public static function getOneUsuario($id){
			$result = [];
				try {
					$stringSQL = "SELECT usuario.ID AS ID, USUARIO, TIPODOC, NROIDE, NOMBRE, APELLIDOS, EMAIL, TELEFONO, IDPERFIL, usuario.ESTADO, NOMPERFIL, estado.DESCESTADO,
									TIPOUSUARIO AS CODTIPOUSER, tipousuario.DESCRIPCION AS DESCTIPOUSER
									FROM usuario 
									INNER JOIN perfil ON perfil.ID = usuario.IDPERFIL
									INNER JOIN estado ON estado.ID = usuario.ESTADO
									INNER JOIN tipousuario ON tipousuario.CODIGO = usuario.TIPOUSUARIO
									WHERE usuario.ID = '".$id."'";
					$respuesta = parent::SQL($stringSQL);
					return $respuesta;
				} catch (PDOException $e) {
					$result = ['status' => 'error', 'msg' => $e->getMessage()];
					return $result;
				}
			}


		public static function validaEmail($email){
			$result = [];
				try {
					$stringSQL = "SELECT COUNT(email) AS CUENTA FROM usuarios WHERE email = '".$email."'";
					$result =  parent::query($stringSQL,[]);
				} catch (PDOException $e) {
					$result = ['status' => 'error', 'msg' => $e->getMessage()];
				}
				return $result;
		}
		
		public static function validaUsuario($usuario){
			$result = [];
				try {
					$stringSQL = "SELECT COUNT(usuario) AS CUENTA FROM usuarios WHERE usuario = '".$usuario."'";
					$result =  parent::query($stringSQL,[]);
				} catch (PDOException $e) {
					$result = ['status' => 'error', 'msg' => $e->getMessage()];
				}
				return $result;
		}


		public static function listaGeneral($campoid, $campodescripcion, $tabla){
			$result = [];
				try {
					$stringSQL = "SELECT $campoid, $campodescripcion from $tabla 
									WHERE ESTADO  = 1";
					$respuesta = parent::SQL($stringSQL);
					return $respuesta;
				} catch (PDOException $e) {
					$result = ['status' => 'error', 'msg' => $e->getMessage()];
					return $result;
				}

		}


		public static function periodoFacturaByContrato($idcontrato){
			$result = [];
				try {
					$stringSQL = "SELECT periodofactura.ID, NOMPERIODO 
									FROM periodofactura 
									LEFT JOIN contrato ON contrato.PERFACTURA = periodofactura.ID
									WHERE contrato.ID  = {$idcontrato} AND periodofactura.ESTADO = 1 LIMIT 1";
					$respuesta = parent::SQL($stringSQL);
					return $respuesta;
				} catch (PDOException $e) {
					$result = ['status' => 'error', 'msg' => $e->getMessage()];
					return $result;
				}
		}


		public static function monedaByContrato($idcontrato){
			$result = [];
				try {
					$stringSQL = "SELECT moneda.ID, CODIGO, DESCRIPCION FROM moneda 
									LEFT JOIN contrato ON contrato.MONEDA = moneda.CODIGO
									WHERE contrato.ID  = {$idcontrato} AND moneda.ESTADO = 1 LIMIT 1";
					$respuesta = parent::SQL($stringSQL);
					return $respuesta;
				} catch (PDOException $e) {
					$result = ['status' => 'error', 'msg' => $e->getMessage()];
					return $result;
				}
		}

		public static function getClientes (){
			$result = [];
			try {
				$result = DB::SQL("SELECT ID, NOMCLIENTE FROM cliente WHERE ESTADO = '1' ORDER BY ID ASC");
			} catch (PDOException $e) {
				$result = ['status' => 'error', 'msg' => $e->getMessage()];
			}
			return $result;
		}

		public static function getTerceros (){
			$result = [];
			try {
				$result = DB::SQL("SELECT ID, NOMCLIENTE FROM cliente WHERE ESTADO = '1' AND CONSIGNATARIO = '1' ORDER BY ID ASC");
			} catch (PDOException $e) {
				$result = ['status' => 'error', 'msg' => $e->getMessage()];
			}
			return $result;
		}


	
		public static function NOtipoDoc($codigo){
			$result = [];
			try {
				$cliente = DB::SQL("SELECT ID, CODIGO, DESCRIPCION FROM tipodoc WHERE ESTADO = '1' AND CODIGO <> '".$codigo."' ORDER BY ID ASC");
				return $cliente;
			} catch (PDOException $e) {
				$result = ['status' => 'error', 'msg' => $e->getMessage()];
				return $result;
			}
		}
		
		
		public static function tipoUsuario(){
			$result = [];
			try {
				$cliente = DB::SQL("SELECT ID, CODIGO, DESCRIPCION FROM tipousuario WHERE ESTADO = '1' ORDER BY ID ASC");
				return $cliente;
			} catch (PDOException $e) {
				$result = ['status' => 'error', 'msg' => $e->getMessage()];
				return $result;
			}
		}

		public static function NOtipoUsuario($codigo){
			$result = [];
			try {
				$cliente = DB::SQL("SELECT ID, CODIGO, DESCRIPCION FROM tipousuario WHERE ESTADO = '1' AND CODIGO <> '".$codigo."' ORDER BY ID ASC");
				return $cliente;
			} catch (PDOException $e) {
				$result = ['status' => 'error', 'msg' => $e->getMessage()];
				return $result;
			}
		}

		
		

		public static function estadoByContrato($idcontrato){
			$result = [];
				try {
					$stringSQL = "SELECT estado.ID, DESCESTADO FROM estado 
									LEFT JOIN contrato ON contrato.ESTADO = estado.ID
									WHERE contrato.ID  = {$idcontrato} LIMIT 1";
					$respuesta = parent::SQL($stringSQL);
					return $respuesta;
				} catch (PDOException $e) {
					$result = ['status' => 'error', 'msg' => $e->getMessage()];
					return $result;
				}
		}


		public static function getDepositos (){
			try {
				$depot = DB::SQL("SELECT ID, NOMBRE FROM deposito WHERE ESTADO = '1' ORDER BY NOMBRE ASC");
				return $depot;
			} catch (PDOException $e) {
				$result = ['status' => 'error', 'msg' => $e->getMessage()];
				return $result;
			}

		}

		public static function getBodegas (){
			try {
				$cliente = DB::SQL("SELECT ID, NOMBRE FROM bodegas WHERE ESTADO = '1' ORDER BY NOMBRE ASC");
				return $cliente;
			} catch (PDOException $e) {
				$result = ['status' => 'error', 'msg' => $e->getMessage()];
				return $result;
			}
		}
		
		public static function getLineasTablasrepara(){
			$result = [];
			try {
				$cliente = DB::SQL("SELECT tablarepara.ID, IDCLIENTE, NOMCLIENTE FROM tablarepara 
									LEFT JOIN cliente ON cliente.IDECLIENTE = tablarepara.IDCLIENTE
									WHERE cliente.ESTADO = 1");
				return $cliente;
			} catch (PDOException $e) {
				$result = ['status' => 'error', 'msg' => $e->getMessage()];
				return $result;
			}
		}


		public static function getLineasNOTablasrepara(){
			$result = [];
			try {
				$cliente = DB::SQL("SELECT ID, IDECLIENTE, NOMCLIENTE
									FROM cliente
									WHERE IDECLIENTE NOT IN (SELECT IDCLIENTE FROM tablarepara) AND cliente.ESTADO = 1");
				return $cliente;
			} catch (PDOException $e) {
				$result = ['status' => 'error', 'msg' => $e->getMessage()];
				return $result;
			}
		}


		public static function getAllPerfiles (){
			$result = [];
			try {
				$stringSQL = "SELECT ID, NOMPERFIL, ESTADO FROM Perfiles WHERE ESTADO = 1;";
				$respuesta = parent::SQL($stringSQL);
				return $respuesta;
			} catch (PDOException $e) {
				$result = ['status' => 'error', 'msg' => $e->getMessage()];
				return $result;
			}
		}

		public static function getBodegasUsuario($idusuario){
			$result = [];
				try {
					$stringSQL = "SELECT bodegas.ID, NOMBRE 
								FROM bodegas
								INNER JOIN usuariosbodegas ON usuariosbodegas.IDBODEGA = bodegas.ID
								WHERE usuariosbodegas.IDUSUA = '".$idusuario."' AND bodegas.ESTADO = 1";
					$respuesta = parent::SQL($stringSQL);
					return $respuesta;
				} catch (PDOException $e) {
					$result = ['status' => 'error', 'msg' => $e->getMessage()];
					return $result;
				}
		}

		public static function getBodegasDisponible($idusuario){
			$result = [];
				try {
					$stringSQL = "SELECT ID, NOMBRE FROM bodegas WHERE (ESTADO = 1) AND ID NOT IN 
								(SELECT IDBODEGA FROM usuariosbodegas WHERE IDUSUA = '".$idusuario."');";
					$respuesta = parent::SQL($stringSQL);
					return $respuesta;
				} catch (PDOException $e) {
					$result = ['status' => 'error', 'msg' => $e->getMessage()];
					return $result;
				}
		}


		public static function getDanosComponente($componente){
			$result = [];
				try {
					$stringSQL = "SELECT dano.ID, dano.CODDANO, dano.NOMBRESP, dano.NOMBREIN
					FROM dano
					INNER JOIN componentedano ON componentedano.CODDANO = dano.CODDANO
					WHERE componentedano.CODCOMPONENTE = '".$componente."' AND dano.ESTADO = 1 ORDER BY dano.CODDANO;";
					$respuesta = parent::SQL($stringSQL);
					return $respuesta;
				} catch (PDOException $e) {
					$result = ['status' => 'error', 'msg' => $e->getMessage()];
					return $result;
				}
		}

		public static function getDanosDisponibles($componente){
			$result = [];
				try {
					$stringSQL = "SELECT dano.ID, dano.CODDANO, dano.NOMBRESP, dano.NOMBREIN
					FROM dano WHERE ESTADO = 1  AND dano.CODDANO NOT IN 
					(SELECT CODDANO FROM componentedano WHERE componentedano.CODCOMPONENTE = '".$componente."') ORDER BY dano.CODDANO;";
					$respuesta = parent::SQL($stringSQL);
					return $respuesta;
				} catch (PDOException $e) {
					$result = ['status' => 'error', 'msg' => $e->getMessage()];
					return $result;
				}
		}

		public static function getReparaAsig($coddano){
			$result = [];
				try {
					$stringSQL = "SELECT reparacion.ID, reparacion.CODREPARA, reparacion.NOMBRESP, reparacion.NOMBREIN
					FROM reparacion
					INNER JOIN danoreparacion ON danoreparacion.CODREPARA = reparacion.CODREPARA
					WHERE danoreparacion.CODDANO = '".$coddano."' AND reparacion.ESTADO = 1 ORDER BY reparacion.CODREPARA;";
					$respuesta = parent::SQL($stringSQL);
					return $respuesta;
				} catch (PDOException $e) {
					$result = ['status' => 'error', 'msg' => $e->getMessage()];
					return $result;
				}
		}

		public static function getReparaDisponible($coddano){
			$result = [];
				try {
					$stringSQL = "SELECT reparacion.ID, reparacion.CODREPARA, reparacion.NOMBRESP, reparacion.NOMBREIN
					FROM reparacion WHERE ESTADO = 1  AND reparacion.CODREPARA NOT IN 
					(SELECT CODREPARA FROM danoreparacion WHERE danoreparacion.CODDANO = '".$coddano."') ORDER BY reparacion.CODREPARA;";
					$respuesta = parent::SQL($stringSQL);
					return $respuesta;
				} catch (PDOException $e) {
					$result = ['status' => 'error', 'msg' => $e->getMessage()];
					return $result;
				}
		}

		public static function getDepotUsuario($idusuario){
			$result = [];
				try {
					$stringSQL = "SELECT deposito.ID, NOMBRE 
									FROM deposito
									INNER JOIN usuariodepot ON usuariodepot.IDBODEGA = deposito.ID
									WHERE usuariodepot.IDUSUA = '".$idusuario."'";
					$respuesta = parent::SQL($stringSQL);
					return $respuesta;
				} catch (PDOException $e) {
					$result = ['status' => 'error', 'msg' => $e->getMessage()];
					return $result;
				}
		}

		public static function getDepotDisponible($idusuario){
			$result = [];
				try {
					$stringSQL = "SELECT * FROM deposito WHERE ESTADO = 1 AND  ID NOT IN 
    								(SELECT IDBODEGA FROM usuariodepot WHERE IDUSUA = '".$idusuario."');";
					$respuesta = parent::SQL($stringSQL);
					return $respuesta;
				} catch (PDOException $e) {
					$result = ['status' => 'error', 'msg' => $e->getMessage()];
					return $result;
				}
		}

		public static function getCiudades(){
			$result = [];
				try {
					$stringSQL = "SELECT ID, CODIGO, NOMBRE, ESTADO FROM ciudad WHERE ESTADO = 1";
					$respuesta = parent::SQL($stringSQL);
					return $respuesta;
				} catch (PDOException $e) {
					$result = ['status' => 'error', 'msg' => $e->getMessage()];
					return $result;
				}
		}


		public static function getAllIsocode(){
			$result = [];
				try {
					$stringSQL = "SELECT  ID, CODIGO, DESCRIPCION, ESTADO FROM isocode WHERE ESTADO = 1";
					$respuesta = parent::SQL($stringSQL);
					return $respuesta;
				} catch (PDOException $e) {
					$result = ['status' => 'error', 'msg' => $e->getMessage()];
					return $result;
				}
		}


		Public static function getNoestado($idestado){
			$result = [];
				try {
					$stringSQL = "SELECT ID, DESCESTADO FROM estado WHERE ID <> '".$idestado."'";
					//echo $stringSQL;
					$result = parent::SQL($stringSQL);
				} catch (PDOException $e) {
					$result = ['status' => 'error', 'msg' => $e->getMessage()];
				}
				return $result;
		}

		Public static function getNociudad($codigo){
			$result = [];
				try {
					$stringSQL = "SELECT ID, CODIGO, NOMBRE FROM ciudad WHERE CODIGO <> '".$codigo."'";
					$result = parent::SQL($stringSQL);
				} catch (PDOException $e) {
					$result = ['status' => 'error', 'msg' => $e->getMessage()];
				}
				return $result;
		}

		Public static function grupotipocontenedor(){
			$result = [];
				try {
					$stringSQL = "SELECT ID, CODIGO, DESCRIPCION FROM grupotipcont WHERE ESTADO = 1";
					$respuesta = parent::SQL($stringSQL);
					return $respuesta;
				} catch (PDOException $e) {
					$result = ['status' => 'error', 'msg' => $e->getMessage()];
					return $result;
				}
		}


		Public static function getTipoContenedor(){
			$result = [];
				try {
					$stringSQL = "SELECT ID, CODIGO, NOMTIPO FROM tipocont WHERE ESTADO = 1";
					$respuesta = parent::SQL($stringSQL);
					return $respuesta;
				} catch (PDOException $e) {
					$result = ['status' => 'error', 'msg' => $e->getMessage()];
					return $result;
				}
		}

		Public static function getTamano(){
			$result = [];
				try {
					$stringSQL = "SELECT ID, TAMANO, DESCRIPCION FROM tamano WHERE ESTADO = 1";
					$respuesta = parent::SQL($stringSQL);
					return $respuesta;
				} catch (PDOException $e) {
					$result = ['status' => 'error', 'msg' => $e->getMessage()];
					return $result;
				}
		}
		
		Public static function getAllComponente(){
			$result = [];
				try {
					$stringSQL = "SELECT ID, CODIGO, DESCRIPCION, ESTADO, CONCAT(DESCRIPCION,' ','(',CODIGO,')') AS CONJUNTO FROM componente WHERE ESTADO = 1 ORDER BY 3";
					$respuesta = parent::SQL($stringSQL);
					return $respuesta;
				} catch (PDOException $e) {
					$result = ['status' => 'error', 'msg' => $e->getMessage()];
					return $result;
				}
		}


		Public static function getAllReparacion(){
			$result = [];
				try {
					$stringSQL = "SELECT ID, CODREPARA, NOMBREIN, ESTADO, CONCAT(NOMBREIN,' ','(',CODREPARA,')') AS CONJUNTO 
									FROM reparacion WHERE ESTADO = 1 ORDER BY 3";
					$respuesta = parent::SQL($stringSQL);
					return $respuesta;
				} catch (PDOException $e) {
					$result = ['status' => 'error', 'msg' => $e->getMessage()];
					return $result;
				}
		}


		Public static function getAllMaterial(){
			$result = [];
				try {
					$stringSQL = "SELECT ID, CODIGO, NOMMATERIAL, CONCAT(NOMMATERIAL,' ','(',CODIGO,')') AS CONJUNTO 
									FROM teus.material
									WHERE ESTADO = 1
									ORDER BY CODIGO";
					$respuesta = parent::SQL($stringSQL);
					return $respuesta;
				} catch (PDOException $e) {
					$result = ['status' => 'error', 'msg' => $e->getMessage()];
					return $result;
				}
		}

		Public static function getAllGrupoTipoCont(){
			$result = [];
				try {
					$stringSQL = "SELECT ID, CODIGO, DESCRIPCION 
									FROM teus.grupotipcont
									WHERE ESTADO = 1
									ORDER BY CODIGO";
					$respuesta = parent::SQL($stringSQL);
					return $respuesta;
				} catch (PDOException $e) {
					$result = ['status' => 'error', 'msg' => $e->getMessage()];
					return $result;
				}
		}


		Public static function getAllPrimerCaracter(){
			$result = [];
				try {
					$stringSQL = "SELECT ID, LETRA, NOMBREIN FROM posicion WHERE CARACTER = 1 ORDER BY LETRA";
					$respuesta = parent::SQL($stringSQL);
					return $respuesta;
				} catch (PDOException $e) {
					$result = ['status' => 'error', 'msg' => $e->getMessage()];
					return $result;
				}
		}

		Public static function getAllSegundoCaracter(){
			$result = [];
				try {
					$stringSQL = "SELECT ID, LETRA, NOMBREIN FROM posicion WHERE CARACTER = 2 ORDER BY LETRA";
					$respuesta = parent::SQL($stringSQL);
					return $respuesta;
				} catch (PDOException $e) {
					$result = ['status' => 'error', 'msg' => $e->getMessage()];
					return $result;
				}
		}

		Public static function getAllPeriodoFactura(){
			$result = [];
				try {
					$stringSQL = "SELECT ID, NOMPERIODO FROM periodofactura WHERE ESTADO = 1 ORDER BY DIASPEROIDO ASC";
					$respuesta = parent::SQL($stringSQL);
					return $respuesta;
				} catch (PDOException $e) {
					$result = ['status' => 'error', 'msg' => $e->getMessage()];
					return $result;
				}
		}

		
		Public static function getNoAllPeriodoFactura($idperiodo){
			$result = [];
				try {
					$stringSQL = "SELECT ID, NOMPERIODO FROM periodofactura WHERE ID <> {$idperiodo} ORDER BY DIASPEROIDO ASC";
					$respuesta = parent::SQL($stringSQL);
					return $respuesta;
				} catch (PDOException $e) {
					$result = ['status' => 'error', 'msg' => $e->getMessage()];
					return $result;
				}
		}

		Public static function getAllMoneda(){
			$result = [];
				try {
					$stringSQL = "SELECT ID, CODIGO, DESCRIPCION FROM moneda WHERE ESTADO = 1 ORDER BY CODIGO ASC";
					$respuesta = parent::SQL($stringSQL);
					return $respuesta;
				} catch (PDOException $e) {
					$result = ['status' => 'error', 'msg' => $e->getMessage()];
					return $result;
				}
		}


		Public static function getAllEstado(){
			$result = [];
				try {
					$stringSQL = "SELECT ID, DESCESTADO FROM estado ORDER BY ID DESC";
					$respuesta = parent::SQL($stringSQL);
					return $respuesta;
				} catch (PDOException $e) {
					$result = ['status' => 'error', 'msg' => $e->getMessage()];
					return $result;
				}
		}

		Public static function getNoAllMoneda($codmoneda){
			$result = [];
				try {
					$stringSQL = "SELECT ID, CODIGO, DESCRIPCION FROM moneda WHERE ESTADO = 1 AND CODIGO <> '{$codmoneda}' ORDER BY CODIGO ASC";
					$respuesta = parent::SQL($stringSQL);
					return $respuesta;
				} catch (PDOException $e) {
					$result = ['status' => 'error', 'msg' => $e->getMessage()];
					return $result;
				}
		}

		Public static function getAllMovimiento(){
			$result = [];
				try {
					$stringSQL = "SELECT ID, CODIGO, DESCRIPCION FROM movimiento WHERE ESTADO = 1 ORDER BY CODIGO ASC";
					$respuesta = parent::SQL($stringSQL);
					return $respuesta;
				} catch (PDOException $e) {
					$result = ['status' => 'error', 'msg' => $e->getMessage()];
					return $result;
				}
		}

		Public static function getAllMovimientoIO(){
			$result = [];
				try {
					$stringSQL = "SELECT ID, CODIGO, DESCRIPCION FROM movimiento WHERE ESTADO = 1 AND CODTIPOMOV IN ('IN','OUT')ORDER BY CODIGO ASC";
					$respuesta = parent::SQL($stringSQL);
					return $respuesta;
				} catch (PDOException $e) {
					$result = ['status' => 'error', 'msg' => $e->getMessage()];
					return $result;
				}
		}


		Public static function getAllMovimientomManipuleo(){
			$result = [];
				try {
					$stringSQL = "SELECT ID, CODIGO, DESCRIPCION FROM movimiento WHERE ESTADO = 1 AND CODTIPOMOV NOT IN ('IN','OUT')ORDER BY CODIGO ASC";
					$respuesta = parent::SQL($stringSQL);
					return $respuesta;
				} catch (PDOException $e) {
					$result = ['status' => 'error', 'msg' => $e->getMessage()];
					return $result;
				}
		}

		Public static function getAllTipoliquida(){
			$result = [];
				try {
					$stringSQL = "SELECT ID, CODIGO, DESCRIPCION FROM tipoliquidacion WHERE ESTADO = 1 ORDER BY CODIGO ASC";
					$respuesta = parent::SQL($stringSQL);
					return $respuesta;
				} catch (PDOException $e) {
					$result = ['status' => 'error', 'msg' => $e->getMessage()];
					return $result;
				}
		}
		Public static function getAllTipoReparacion(){
			$result = [];
				try {
					$stringSQL = "SELECT ID, CODIGO, DESCRIPCION FROM tiporepara WHERE ESTADO = 1 ORDER BY CODIGO ASC";
					$respuesta = parent::SQL($stringSQL);
					return $respuesta;
				} catch (PDOException $e) {
					$result = ['status' => 'error', 'msg' => $e->getMessage()];
					return $result;
				}
		}

		Public static function getLineasSinTR(){
			$result = [];
				try {
					$stringSQL = "SELECT ID, IDECLIENTE, NOMCLIENTE FROM cliente WHERE ESTADO = 1 AND LINEANAV = 1 AND ID NOT IN (SELECT IDCLIENTE from tablarepara)";
					$respuesta = parent::SQL($stringSQL);
					return $respuesta;
				} catch (PDOException $e) {
					$result = ['status' => 'error', 'msg' => $e->getMessage()];
					return $result;
				}
		}

		Public static function getLineasConTR(){
			$result = [];
				try {
					$stringSQL = "SELECT cliente.ID, cliente.IDECLIENTE, cliente.NOMCLIENTE FROM tablarepara INNER JOIN cliente ON cliente.ID = tablarepara.IDCLIENTE
									WHERE cliente.ESTADO = 1 AND LINEANAV = 1";
					$respuesta = parent::SQL($stringSQL);
					return $respuesta;
				} catch (PDOException $e) {
					$result = ['status' => 'error', 'msg' => $e->getMessage()];
					return $result;
				}
		}

		Public static function getMovimientoIngreso(){
			$result = [];
				try {
					$stringSQL = "SELECT movimiento.ID, movimiento.DESCRIPCION FROM movimiento WHERE movimiento.CODTIPOMOV = 1 AND ESTADO = 1";
					$respuesta = DB::SQL($stringSQL);
					return $respuesta;
				} catch (PDOException $e) {
					$result = ['status' => 'error', 'msg' => $e->getMessage()];
					return $result;
				}
		}

		Public static function getMovimientoSalida(){
			$result = [];
				try {
					$stringSQL = "SELECT movimiento.ID, movimiento.DESCRIPCION FROM movimiento WHERE movimiento.CODTIPOMOV = 2 AND ESTADO = 1";
					$respuesta = parent::SQL($stringSQL);
					return $respuesta;
				} catch (PDOException $e) {
					$result = ['status' => 'error', 'msg' => $e->getMessage()];
					return $result;
				}
		}

		public static function getMovInCliente($idcliente){
			$result = [];
				try {
					$stringSQL = "SELECT movimiento.ID, movimiento.DESCRIPCION 
								FROM movicliente
								INNER JOIN movimiento ON movimiento.ID = movicliente.IDMOVIMIENTO
								INNER JOIN tipomovimiento ON tipomovimiento.ID = movimiento.CODTIPOMOV
								WHERE movicliente.IDCLIENTE = '".$idcliente."' AND movimiento.ESTADO = 1 AND CODTIPOMOV = 1";
					$respuesta = parent::SQL($stringSQL);
					return $respuesta;
				} catch (PDOException $e) {
					$result = ['status' => 'error', 'msg' => $e->getMessage()];
					return $result;
				}
		}

		public static function getMovInClienteFree($idcliente){
			$result = [];
				try {
					$stringSQL = "SELECT * FROM movimiento WHERE (ESTADO = 1 AND CODTIPOMOV = 1) AND ID NOT IN 
									(SELECT IDMOVIMIENTO FROM movicliente WHERE IDCLIENTE = '".$idcliente."');";
					$respuesta = parent::SQL($stringSQL);
					return $respuesta;
				} catch (PDOException $e) {
					$result = ['status' => 'error', 'msg' => $e->getMessage()];
					return $result;
				}
		}


		public static function getMovOutCliente($idcliente){
			$result = [];
				try {
					$stringSQL = "SELECT movimiento.ID, movimiento.DESCRIPCION 
								FROM movicliente
								INNER JOIN movimiento ON movimiento.ID = movicliente.IDMOVIMIENTO
								INNER JOIN tipomovimiento ON tipomovimiento.ID = movimiento.CODTIPOMOV
								WHERE movicliente.IDCLIENTE = '".$idcliente."' AND movimiento.ESTADO = 1 AND CODTIPOMOV = 2";
					$respuesta = parent::SQL($stringSQL);
					return $respuesta;
				} catch (PDOException $e) {
					$result = ['status' => 'error', 'msg' => $e->getMessage()];
					return $result;
				}
		}

		public static function getMovOutClienteFree($idcliente){
			$result = [];
				try {
					$stringSQL = "SELECT * FROM movimiento WHERE (ESTADO = 1 AND CODTIPOMOV = 2) AND ID NOT IN 
									(SELECT IDMOVIMIENTO FROM movicliente WHERE IDCLIENTE = '".$idcliente."');";
					$respuesta = parent::SQL($stringSQL);
					return $respuesta;
				} catch (PDOException $e) {
					$result = ['status' => 'error', 'msg' => $e->getMessage()];
					return $result;
				}
		}
		public static function getAllBancos(){
			$result = [];
				try {
					$stringSQL = "SELECT ID, NOMBANCO, ESTADO FROM banco WHERE ESTADO = 1";
					$respuesta = parent::SQL($stringSQL);
					return $respuesta;
				} catch (PDOException $e) {
					$result = ['status' => 'error', 'msg' => $e->getMessage()];
					return $result;
				}
		}

		public static function getResponFiscal(){
			$result = [];
				try {
					$stringSQL = "SELECT ID, NOMBRE, ESTADO FROM tablageneral WHERE ESTADO = 1 AND CAMPOUSA = 'RF'";
					$respuesta = parent::SQL($stringSQL);
					return $respuesta;
				} catch (PDOException $e) {
					$result = ['status' => 'error', 'msg' => $e->getMessage()];
					return $result;
				}
		}

		public static function getRegimenFiscal(){
			$result = [];
				try {
					$stringSQL = "SELECT ID, NOMBRE, ESTADO FROM tablageneral WHERE ESTADO = 1 AND CAMPOUSA = 'GF'";
					$respuesta = parent::SQL($stringSQL);
					return $respuesta;
				} catch (PDOException $e) {
					$result = ['status' => 'error', 'msg' => $e->getMessage()];
					return $result;
				}
		}


		public static function getTransportes($termino){
			$result = [];
			try {
				$stringSQL = "SELECT ID, NROIDE, NOMBRE AS NOMBRE FROM emptransporte WHERE (NOMBRE LIKE '%".$termino."%' OR NROIDE LIKE '%".$termino."%' )  AND ESTADO = 1";
				$result = parent::SQL($stringSQL);
			} catch (PDOException $e) {
				$result = ['status' => 'error', 'msg' => $e->getMessage()];
			}
			return $result;
		}

		public static function getTipoContenedorByLinea($idlinea){
			$result = [];
			try {
				$stringSQL = "SELECT tipocont.ID, CODIGO
						FROM teus.tipocontcliente
						INNER JOIN tipocont ON tipocont.ID = tipocontcliente.IDTIPOCONT
						WHERE IDLINEA = {$idlinea} AND tipocont.ESTADO = 1";
				$result = parent::SQL($stringSQL);
			} catch (PDOException $e) {
				$result = ['status' => 'error', 'msg' => $e->getMessage()];
			}
			return $result;
		}

		public static function getTransporteSelect(){
			$result = [];
			try {
				$stringSQL = "SELECT ID, NROIDE, NOMBRE AS NOMBRE FROM emptransporte WHERE ESTADO = 1";
				$result = parent::SQL($stringSQL);
			} catch (PDOException $e) {
				$result = ['status' => 'error', 'msg' => $e->getMessage()];
			}
			return $result;
		}


		public static function getGrupoContenedor(){
			$result = [];
			try {
				$stringSQL = "SELECT ID, CODIGO, DESCRIPCION AS NOMBRE FROM grupotipcont WHERE ESTADO = 1";
				$result = parent::SQL($stringSQL);
			} catch (PDOException $e) {
				$result = ['status' => 'error', 'msg' => $e->getMessage()];
			}
			return $result;
		}

		public static function getAllTipoMovimientoIn(){
			$result = [];
			try {
				$stringSQL = "SELECT DISTINCT(DESCRIPCION), ID FROM teus.movimiento WHERE ESTADO = 1 AND CODTIPOMOV = 1 ORDER BY 1;";
				$result = parent::SQL($stringSQL);
			} catch (PDOException $e) {
				$result = ['status' => 'error', 'msg' => $e->getMessage()];
			}
			return $result;
		}

		public static function getAllTipoContenedor(){
			$result = [];
			try {
				$stringSQL = "SELECT DISTINCT(CODIGO), ID FROM teus.tipocont WHERE ESTADO = 1 ORDER BY 1;";
				$result = parent::SQL($stringSQL);
			} catch (PDOException $e) {
				$result = ['status' => 'error', 'msg' => $e->getMessage()];
			}
			return $result;
		}


		public static function getNOLinea($idlinea){
			$result = [];
			try {
				$stringSQL = "SELECT ID, TIPODOC, IDECLIENTE, NOMCLIENTE AS NOMLINEA 
								FROM cliente 
								WHERE ESTADO = '1' AND ID <> {$idlinea}  AND LINEANAV = '1' ORDER BY ID ASC";
				$result = parent::SQL($stringSQL);
			} catch (PDOException $e) {
				$result = ['status' => 'error', 'msg' => $e->getMessage()];
			}
			return $result;
		}

		public static function getNOTipocont($idlinea, $idtipo){
			$result = [];
			try {
				$stringSQL = "SELECT IDTIPOCONT, CODIGO
								FROM tipocontcliente 
								INNER JOIN tipocont ON tipocont.ID = tipocontcliente.IDTIPOCONT where IDTIPOCONT <> {$idtipo} AND IDLINEA = {$idlinea}";
					//die($stringSQL);
					$result = parent::SQL($stringSQL);
			} catch (PDOException $e) {
				$result = ['status' => 'error', 'msg' => $e->getMessage()];
			}
			return $result;
		}

		public static function getNOTipoingreso($idlinea, $idtipo){
			$result = [];
			try {
				$stringSQL = "SELECT movimiento.ID, DESCRIPCION
								FROM teus.movimiento
								LEFT JOIN movicliente ON movicliente.IDMOVIMIENTO = movimiento.ID 
								WHERE movicliente.IDCLIENTE = {$idlinea} AND movimiento.CODTIPOMOV = 1 AND movimiento.ESTADO = 1 AND movimiento.ID <> {$idtipo};";
				$result = parent::SQL($stringSQL);
			} catch (PDOException $e) {
				$result = ['status' => 'error', 'msg' => $e->getMessage()];
			}
			return $result;
		}

		public static function getLineaByIngreso($idingreso){
			$result = [];
			try {
				$stringSQL = "SELECT ID, IDLINEA
								FROM ingresocont
								WHERE ID = '".$idingreso."'";
			$result = parent::SQL($stringSQL);
			} catch (PDOException $e) {
				$result = ['status' => 'error', 'msg' => $e->getMessage()];
			}
			return $result;
		}

		public static function getComponente($termino, $idlinea)
		{
			$result = [];
			try {
				$stringSQL = "SELECT detalletablarepara.ID, CODCOMPONENTE, componente.DESCRIPCION, CODREPARA
								FROM detalletablarepara 
								LEFT JOIN tablarepara ON tablarepara.ID  = detalletablarepara.IDTABLA
								LEFT JOIN componente ON componente.CODIGO = detalletablarepara.CODCOMPONENTE
								WHERE (CODCOMPONENTE LIKE '%".$termino."%')  AND componente.ESTADO = 1 AND tablarepara.IDCLIENTE = '".$idlinea."'";
				 //$respuesta = parent::SQL($stringSQL);
				 //return $respuesta;

                 echo $stringSQL;
			} catch (PDOException $e) {
				$result = ['status' => 'error', 'msg' => $e->getMessage()];
				return $result;
			}
		}

		public static function getCargo(){
			$result = [];
			try {
				$stringSQL = "SELECT ID, CODIGO, DESCRIPCION
								FROM cargo
								WHERE ESTADO = 1";
			$result = parent::SQL($stringSQL);
			} catch (PDOException $e) {
				$result = ['status' => 'error', 'msg' => $e->getMessage()];
			}
			return $result;
		}

		
		public static function getestadobyLinea($idingreso){
			$result = [];
			try {
				$idlinea = self::getLineaByIngreso($idingreso);
				$stringSQL = "SELECT clasificacion.ID, CODIGO, clasificacion.DESCRIPCION
								FROM teus.clasificacion
								INNER JOIN clasificacliente ON clasificacliente.IDCLASIFICA = clasificacion.ID
								WHERE clasificacliente.IDLINEA = {$idlinea[0]['IDLINEA']} AND clasificacion.ESTADO = 1";
			$result = parent::SQL($stringSQL);
			} catch (PDOException $e) {
				$result = ['status' => 'error', 'msg' => $e->getMessage()];
			}
			return $result;
		}
		
		public static function getestadoTabla($idingreso){
			$result = [];
			try {
				$idlinea = self::getLineaByIngreso($idingreso);
				$stringSQL = "SELECT COUNT(ID) AS CONTEO
							FROM teus.tablarepara
							WHERE IDCLIENTE = {$idlinea[0]['IDLINEA']} AND tablarepara.ESTADO = 1";
			//die($stringSQL);
			$result = parent::SQL($stringSQL);
			} catch (PDOException $e) {
				$result = ['status' => 'error', 'msg' => $e->getMessage()];
			}
			return $result;
		}


		public static function getcategoriabyLinea($idingreso){
			$result = [];
			try {
				$idlinea = self::getLineaByIngreso($idingreso);
				$stringSQL = "SELECT categoria.ID, CODIGO, categoria.NOMCATEGORIA
								FROM teus.categoria
								INNER JOIN categoriacliente ON categoriacliente.IDCATEGORIA = categoria.ID
								WHERE categoriacliente.IDLINEA = {$idlinea[0]['IDLINEA']} AND categoria.ESTADO = 1";
			//die($stringSQL);
			$result = parent::SQL($stringSQL);
			} catch (PDOException $e) {
				$result = ['status' => 'error', 'msg' => $e->getMessage()];
			}
			return $result;
		}

		public static function getZonas(){
			$result = [];
			try {
				$stringSQL = "SELECT ID, NOMBRE
								FROM teus.zona
								WHERE ESTADO = 1";
			//die($stringSQL);
			$result = parent::SQL($stringSQL);
			} catch (PDOException $e) {
				$result = ['status' => 'error', 'msg' => $e->getMessage()];
			}
			return $result;
		}

	}

?>