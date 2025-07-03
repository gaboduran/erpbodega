<?php
class Functions extends DB {

	public static function segundos_tiempo($segundos) {
		$minutos = $segundos / 60;
		$horas = floor($minutos / 60);
		$minutos2 = $minutos % 60;
		$segundos_2 = $segundos % 60 % 60 % 60;
		if ($minutos2 < 10) 
			$minutos2 = '0'.$minutos2;

		if ($segundos_2 < 10) 
			$segundos_2 = '0'.$segundos_2;

		if ($segundos < 60) { /* segundos */
			$resultado = round($segundos).' Segundos';
		}
		elseif($segundos > 60 && $segundos < 3600) { /* minutos */
			$resultado = $minutos2
			.':'
			.$segundos_2
			.' Minutos';
		} else { /* horas */
			$resultado = $horas . ':' . $minutos2 . ':' . $segundos_2 . ' Horas';
		}
		return $resultado;
	}

	 public static function dame_fecha($fechainicial){
	 	if (!$fechainicial == ""){
	 		$anoinicial = substr($fechainicial, 6, 4);
			$mesinicial = substr($fechainicial, 3, 2);
			$diainicial = substr($fechainicial, 0, 2);
			$fechaconcat = $anoinicial.'-'.$mesinicial.'-'.$diainicial;
			$fecharesult = date('Y-m-d',strtotime($fechaconcat));
	 	}else{
	 		$fecharesult = "";
	 	}
	 	return $fecharesult;
	 }

	public static function generaToken($longitud){
	    if ($longitud < 4) {
	        $longitud = 4;
	    }
	  return bin2hex(random_bytes(($longitud - ($longitud % 2)) / 2));
	}

	public static function ocultaEmail($email){
	    $parts = explode('@', $email);
	    return substr($parts[0], 0, min(1, strlen($parts[0])-1)) . str_repeat('*', max(1, strlen($parts[0]) - 1)) . '@' . $parts[1];
	}

	public static function validaEmail($tabla, $email){
		$result = [];
		try{
			$stringSQL = "SELECT COUNT(EMAIL) AS CONTEO FROM $tabla WHERE EMAIL = '".$email."'";
			$respuesta = DB::SQL($stringSQL);
			$result =  $respuesta[0]['CONTEO'];
		}catch (PDOException $e) {
			$result = ['status' => 'errorPDO', 'msg' => $e->getMessage()];
		}
		return $result;
	}

	public static function generaOTP($n){
	  $generador = "1357902468";
	  $result = "";
	  for ($i = 1; $i <= $n; $i++) {
	    $result .= substr($generador, rand() % strlen($generador), 1);
	  }
	  return $result;
	}

	public static function formatoFecha($fecha){
		$date = date_create($fecha);
		$resultFecha =  date_format($date, 'Y-m-d H:i:s');
		return $resultFecha;
	}

	 public static function formatoFechaYmd($fecha){
		 $date = date_create($fecha);
		 $resultFecha = date_format($date, 'Y-m-d');
		 return$resultFecha;
	}

	public static function formatoHoraHHMMSS($fecha){
		 $date = date_create($fecha);
		 $resultFecha = date_format($date, 'h:i:s');
		 return$resultFecha;
	}



	public static function conversorSegundosHoras($tiempo_en_segundos) {
	    $horas = floor($tiempo_en_segundos / 3600);
	    $minutos = floor(($tiempo_en_segundos - ($horas * 3600)) / 60);
	    $segundos = $tiempo_en_segundos - ($horas * 3600) - ($minutos * 60);
    	return $horas . ':' . $minutos . ":" . $segundos;
	}

	public static function generaClave($n){
	  $generador = "1357902468";
	  $result = "";
		  for ($i = 1; $i <= $n; $i++) {
		    $result .= substr($generador, rand() % strlen($generador), 1);
		  }
	  return $result;
	}

	public static function diferenciaMinutos_fecha($fecha){
		$fecha1 = new DateTime($fecha); 
		$fecha2 = new DateTime('now'); 
		$diferencia = $fecha1->diff($fecha2); 
		$total_minutos = ($diferencia->format('%d') * 24 * 60) + ($diferencia->format('%h') * 60) + $diferencia->format('%i'); 
		return $total_minutos;
	}

	public static function restarFechasEnDias($fechaini, $fechafin) {
		// Crear objetos DateTime a partir de las fechas proporcionadas
		$fecha_inicio = new DateTime($fechaini);
		$fecha_fin = new DateTime($fechafin);
	
		// Calcular la diferencia entre las dos fechas
		$diferencia = $fecha_inicio->diff($fecha_fin);
	
		// Retornar la diferencia en días
		return $diferencia->days;
	}

	public static function validavarGLOBAL($parametro){
		$result = [];
		try{
			$stringSQL = "SELECT CODIGO, REQUERIDO FROM varglobal WHERE CODIGO =  '".$parametro."'";
			$respuesta = DB::SQL($stringSQL);
			$result =  $respuesta[0]['REQUERIDO'];
		}catch (PDOException $e) {
			$result = ['status' => 'errorPDO', 'msg' => $e->getMessage()];
		}
		return $result;
	} 

	//Funciones usadas en Modulo Agenda
	public static function menosminutos($horaPost, $fechaPost) {
		// Convertir la hora y fecha en un objeto DateTime
		$fechaHora = new DateTime($fechaPost . ' ' . $horaPost);
		// Restar un minuto
		$fechaHora->modify('-1 minute');

		// Verificar si cambió de día
		$fechaPostNueva = $fechaHora->format('Y-m-d');
		if ($fechaPostNueva !== $fechaPost) {
			// Si cambió de día, ajustar la fecha restando un día
			$fechaHora->modify('-1 day');
		}
	
		// Obtener la hora actualizada en formato "HH:mm:ss"
		$hora_actualizada = $fechaHora->format('H:i:s');
	
		$date =  $fechaPostNueva. " ".$hora_actualizada;
	
		return $date;
	}

	public static function IgualaHora($time){

		$Horadate = new DateTime($time);
		// Obtener la hora y los minutos
		$hour = $Horadate->format('H');
		$minute = $Horadate->format('i');
		// Si los minutos son mayores o iguales a 30, redondear a la siguiente hora entera
		if ($minute >= 30) {
			$hour = ceil($hour);
		}
		// Crear una nueva fecha con la hora redondeada
		$newDate = new DateTime("$hour:59");
		// Obtener la nueva hora
		$newTime = $newDate->format('H:i');

		return $newTime;

	}
	//Fin Funciones para modulo agenda

	public static function IDCaja($ID){
		$result = [];
		try {
			$stringSQL = "SELECT ID FROM caja WHERE USUARIOCAJA = $ID AND IDDEPOT = ".$_SESSION['iddepot']."";
			//echo $stringSQL;
			$respuesta = DB::SQL($stringSQL);
			return $respuesta;
		} catch (PDOException $e) {
			$result = ['status' => 'error', 'msg' => $e->getMessage()];
			return $result;
		}
	}

	public static function IDusuario($usuario){
		$result = [];
		try {
			$stringSQL = "SELECT ID FROM USUARIO WHERE USUARIO = '$usuario'";
			$respuesta = DB::SQL($stringSQL);
			return $respuesta;
		} catch (PDOException $e) {
			$result = ['status' => 'error', 'msg' => $e->getMessage()];
			return $result;
		}
	}

	public static function eliminaComa($numero){
		$numero = str_replace(",","",$numero);
		return $numero;
	}

}
?> 