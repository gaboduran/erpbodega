<?php
	
	class Permisos extends DB {

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

		public static function getEspeciales($id){
			if (!empty($_SESSION['userData'])){
				$idPerfil = $_SESSION['userData']['IDPERFIL'];
				$arrayPermisosEspeciales = self::getPermisosEspeciales($idPerfil);
				$especiales = "";
				$permisosEsp = "";
				if(count($arrayPermisosEspeciales)>0) {
					$especiales = $arrayPermisosEspeciales;
					$permisosEsp = isset($arrayPermisosEspeciales[$id]) ? $arrayPermisosEspeciales[$id] : "";
				}
				$_SESSION['especiales'] = $especiales;
				$_SESSION['permisosEsp'] = $permisosEsp;
			}
			return $arrayPermisosEspeciales;
		}


		public static function getPermisosMoludos($idperfil){
			$idPerfil = $_SESSION['userData']['IDPERFIL'];
			$sql = DB::SQL("SELECT p.* ,m.*, m.ID as IDMODULO FROM permisos p INNER JOIN modulos m ON p.IDMODULO = m.ID WHERE p.IDPERFIL= $idperfil");
			$arrayPermisos = [];
			for ($i=0; $i <count($sql) ; $i++) { 
				$arrayPermisos[$sql[$i]['IDMODULO']] = $sql[$i];
			}
			return $arrayPermisos;
		}

		public static function getPermisosEspeciales($idperfil){
			$idPerfil = $_SESSION['userData']['IDPERFIL'];
			$sql = DB::SQL("SELECT ID, IDPERFIL, DESCRIPCION, ACCESO FROM permisoespecial WHERE IDPERFIL= $idperfil");
			$arrayPermisosEspeciales = [];
			for ($i=0; $i <count($sql) ; $i++) { 
				$arrayPermisosEspeciales[$sql[$i]['ID']] = $sql[$i];
			}
			return $arrayPermisosEspeciales;
		}

		public static function accesoModulo($idperfil,$idmodulo){
			$sqlResultado = DB::SQL("SELECT C,R,U,D, PAGINA
									FROM permisos INNER JOIN modulos ON permisos.IDMODULO = modulos.ID
 									WHERE IDPERFIL = $idperfil AND IDMODULO = $idmodulo");
			$data =  $sqlResultado[0];
			return $data['R'];
		}

		public static function accesoCambioPass($idperfil,$idmodulo){
			$sqlResultado = DB::SQL("SELECT C,R,U,D, PAGINA
									FROM permisos INNER JOIN modulos ON permisos.IDMODULO = modulos.ID
 									WHERE IDPERFIL = $idperfil AND IDMODULO = $idmodulo");
			$data =  $sqlResultado[0];
			return $sqlResultado[0];
		}

		public static function nav(){
			$sql = DB::SQL("SELECT ID as IDMODULO, NOMBRE, ICONO FROM modulo WHERE ESTADO = 1");
			foreach ($sql as $item) {
				if(!empty($_SESSION['permisos'][$item['IDMODULO']]['R'])){
					echo "<li><a href='".base_url."".$item['NOMBRE']."'><i class='fa fa-users'></i>".ucwords($item['NOMBRE'])."</a></li>";
				}
			}
		}
		public static function create(){
			if(!empty($_SESSION['permisosMod']['C'])){
				return true;
			}
		}
		public static function read(){
			if(!empty($_SESSION['permisosMod']['R'])){
				return true;
			}
		}
		public static function update(){
			if(!empty($_SESSION['permisosMod']['U'])){
				return true;
			}
		}
		public static function delete(){
			if(!empty($_SESSION['permisosMod']['D'])){
				return true;
			}
		}
		public static function gestionatablareperacion(){
			if(!empty($_SESSION['permisosEsp']['ACCESO'])){
				return true;
			}
		}

		public static function getpermisoGenerales(){
			if(!empty($_SESSION['permisosEsp']['ACCESO'])){
				return true;
			}
		}

		public static function getpermisoEspecial(){
			if(!empty($_SESSION['permisosEsp']['ACCESO'])){
				return true;
			}
		}

		public static function resetPassword(){
			if(!empty($_SESSION['permisosEsp']['ACCESO'])){
				return true;
			}
		}
		public static function mostrar_menu(){
			$menus = '';
			
			$menus .= self::generar_menus();

			echo $menus;	
		}

		public static function generar_menus($parent_id = null){
			$menu = "";
			if (is_null($parent_id)){
				$strinSQL = "SELECT modulos.ID, modulos.NOMBRE as NOMBRE, modulos.PADREID, modulos.PAGINA, 
							modulos.ICONO
							FROM modulos INNER JOIN permisos ON permisos.IDMODULO = modulos.ID
							WHERE permisos.IDPERFIL = '".$_SESSION['idperfil']."' AND modulos.PADREID IS NULL AND modulos.ESTADO = 1 ORDER BY ORDEN ASC";
			}else{
				$strinSQL = "SELECT modulos.ID, modulos.NOMBRE as NOMBRE, modulos.PADREID, modulos.PAGINA, 	
							modulos.ICONO
							FROM modulos INNER JOIN permisos ON permisos.IDMODULO = modulos.ID
							WHERE permisos.IDPERFIL = '".$_SESSION['idperfil']."' AND modulos.PADREID ='".$parent_id."' AND  modulos.ESTADO = 1 ORDER BY ORDEN ASC";
			}
			$sql = DB::SQL($strinSQL);
			for ($i=0; $i < count($sql) ; $i++) { 
				if ($sql[$i]['PAGINA']){
					if (!empty($_SESSION['permisos'][$sql[$i]['ID']]['R'])){
						$menu .= '<li><a href="'.base_url.''.$sql[$i]['PAGINA'].'"><i class="'.$sql[$i]['ICONO'].'"></i>'.ucwords($sql[$i]['NOMBRE']).'</a>';
					}
				}else{
					if (!empty($_SESSION['permisos'][$sql[$i]['ID']]['R'])){	
						$menu .= '<li><a href="#"><i class="'.$sql[$i]['ICONO'].' "></i>'.ucwords($sql[$i]['NOMBRE']).'<span class="fa fa-chevron-down"></span></a>';
					}
				}
				if (!empty($_SESSION['permisos'][$sql[$i]['ID']]['R'])){	
				
					$menu .= '<ul class="nav child_menu">'.self::generar_menus($sql[$i]['ID']).'</ul>';
					$menu .= '</li>';
				}
			}
				return $menu;
		}
	}

?>