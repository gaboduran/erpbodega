<?php

	function base_url(){
		return base_url;
	}

	function media(){
		return base_url. '/Assets';
	}

	function headerAdmin($data = ""){
		$view_header = "Views/Template/".TEMPLATE_DEFAULT."/header.php";
		require_once($view_header);
	} 

	function headerBody($data = ""){
		$view_header = "Views/Template/".TEMPLATE_DEFAULT."/headerBody.php";
		require_once($view_header);
	} 

	function navAdmin($data = ""){
		$view_nav = "Views/Template/".TEMPLATE_DEFAULT."/menu.php";
		require_once($view_nav);
	} 

	function navAdminNoLogin($data = ""){
		$view_nav = "Views/Template/".TEMPLATE_DEFAULT."/menuNoLogin.php";
		require_once($view_nav);
	} 

	function topNav($data = ""){
		$view_topNav = "Views/Template/".TEMPLATE_DEFAULT."/topnav.php";
		require_once($view_topNav);
	} 

	function topnavNoLogin($data = ""){
		$view_topNav = "Views/Template/".TEMPLATE_DEFAULT."/topnavNoLogin.php";
		require_once($view_topNav);
	} 

	function footerAdmin($data = ""){
		$view_footer = "Views/Template/".TEMPLATE_DEFAULT."/footer.php";
		require_once($view_footer);
	} 

	

	function functionsJS($data = ""){
		$view_functionsJS = "Views/Template/".TEMPLATE_DEFAULT."/functionJs.php";
		require_once($view_functionsJS);
	}

	
	function helperNumericos($data = ""){
		$view_functionsJS = "Views/Template/".TEMPLATE_DEFAULT."/helperNumericos.php";
		require_once($view_functionsJS);
	}

	function Loader($data = ""){
		$view_Loader = "Views/Loader/loader.php";
		require_once($view_Loader);
	} 
	function datatables($data = ""){
		$view_footer = "Views/Template/".TEMPLATE_DEFAULT."/plugins/datatables.php";
		require_once($view_footer);
	} 

	

	function datefunctions($data = ""){
		$view_footer = "Views/Template/".TEMPLATE_DEFAULT."/footer.php";
		require_once($view_footer);
	} 

	function selectfunctions($data = ""){
		$view_footer = "Views/Template/".TEMPLATE_DEFAULT."/plugins/select2.php";
		require_once($view_footer);
	}

	function calendarfunctions($data = ""){
		$view_footer = "Views/Template/".TEMPLATE_DEFAULT."/footer.php";
		require_once($view_footer);
	}

	function variousfunctions($data = ""){
		$view_footer = "Views/Template/".TEMPLATE_DEFAULT."/footer.php";
		require_once($view_footer);
	}

	function debug($data){
    	$format = print_r('<pre>');
    	$format .= print_r($data);
    	$format .= print_r('</pre>');
    	return $format;
	}

	function limpiar($datos){
   		$datos = trim($datos);
    	$datos = htmlspecialchars($datos, ENT_QUOTES, 'UTF-8');
    	return $datos;
	}


	function moneyNumber($datos){
   		$datos = str_replace(',','',$datos);
    	return $datos;
	}


	function formatoMoneda($datos){
		$number = number_format($datos, 2);
		$output = '$ '. $number;
    	return $output;
	}

	function formatoNumero($datos){
		$number = number_format($datos, 2);
		return $number;
	}

	function to_obj($array){
    	return json_decode(json_encode($array));
	}


	function convert_date($fecha){
		$anofac = substr($fecha, 6, 4);
		$mesfac = substr($fecha, 3, 2);
		$diafac = substr($fecha, 0, 2);
		$fechaconcat = $anofac.'-'.$mesfac.'-'.$diafac;
		return $fechaconcat;
	}

	function to_date($fecha){
		$date = date_create($fecha);
		return date_format($date, 'Y-m-d');
	}

	function to_date_ddmmyyyy($fecha){
		$date = date_create($fecha);
		return date_format($date, 'd/m/Y');
	}

	function stringJson($dato){
		$json = trim($dato, ',');
		$result = '['.$json.']';
		return $result;

	}

	function fechaYYYYMMDD($parametrofecha){
		// Crear un objeto DateTime desde la cadena de fecha original
			$fecha = DateTime::createFromFormat('d/m/Y', $parametrofecha);
		// Convertir al formato yyyy-mm-dd
			$resultfecha = $fecha->format('Y-m-d');
		return $resultfecha;
	}

?>