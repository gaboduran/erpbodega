<?php
	
	class PermisosEspeciales extends DB {

		public static function getPermisos($idmodulo){
			if (!empty($_SESSION['userData'])){
				$idPerfil = $_SESSION['userData']['IDPERFIL'];
				$arrayPermisos = self::getPermisosMoludos($idPerfil);
				$permisos = "";
				$permisosMod = "";
				if(count($arrayPermisos)>0) {
					$permisos = $arrayPermisos;
					$permisosMod = isset($arrayPermisos[$idmodulo]) ? $arrayPermisos[$idmodulo] : "";
				}
				$_SESSION['permisos'] = $permisos;
				$_SESSION['permisosMod'] = $permisosMod;
			}
			return $arrayPermisos;
		}

		public static function getPermisosMoludos($idperfil){
			$sql = DB::SQL("SELECT permisoespecial.ID, IDPERFIL, IDMODULO, NOMBRE, DESCRIPCION, ACCESO FROM permisoespecial
							INNER JOIN modulo ON modulo.ID = permisoespecial.IDMODULO
							WHERE permisoespecial.IDPERFIL = $idperfil AND permisoespecial.ID = 7");
			$arrayPermisos = [];
			for ($i=0; $i <count($sql) ; $i++) { 
				$arrayPermisos[$sql[$i]['ID']] = $sql[$i];
			}
			return $arrayPermisos;
		}

		public static function especial (){
			if(!empty($_SESSION['permisosMod']['R'])){
				return true;
			}
		}

	}

?>