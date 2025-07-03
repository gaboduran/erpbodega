<?php

require_once('Conexion.php');


class loginModel extends Conexion
{

	public $db;

	public function __construct()
	{

		$db = Conexion::Conectar();
	}


	public static function login()
	{
		$usuario 	= strtolower(limpiar($_POST['usuario']));
		$password 	= hash("sha256", limpiar($_POST['password']));
		$dbconec = Conexion::Conectar();
		try {
			$stringSQL = "SELECT ID, USUARIO, NOMBRE, APELLIDOS, IDPERFIL, ESTADO, ESTADOCAMBIOPSW, ULTIMOCAMBIOPSW 
							FROM usuarios 
							WHERE USUARIO = '" . $usuario . "' AND password = '" . $password . "'";
			$stmt = $dbconec->prepare($stringSQL);
			if ($stmt->execute()) {
				$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
				return $data;
			}
		} catch (Exception $e) {
			$data = "Error " .  $e->getMessage();
			echo json_encode($data);
		}
	}

	public static function updateUltimoAcceso($idusuario)
	{
		try {
			$stringSQL = "UPDATE usuarios SET ULTIMOACCESO = now() WHERE ID = '" . $idusuario . "'";
			$respuesta = parent::query($stringSQL, []);
		} catch (PDOException $e) {
			return $e->getMessage();
		}
	}

	public static function validaToken($token)
	{
		try {
			$stringSQL = "SELECT ID, USUARIO, TOKEN, ESTADOCAMBIOPSW, TOKENEXPIRA, timestampdiff(SECOND, TOKENEXPIRA ,now()) AS TIEMPO FROM usuario WHERE usuario.TOKEN = '" . $token . "'";
			//echo $stringSQL;
			$result = DB::SQL($stringSQL);
		} catch (PDOException $e) {
			$result = ['status' => 'error', 'msg' => $e->getMessage()];
		}
		return $result;
	}


	public static function logConexion($idusuario)
	{
		try {
			$stringSQL = "UPDATE usuario SET ULTIMOACCESO = now() WHERE ID = '" . $idusuario . "'";
			$respuesta = parent::query($stringSQL, []);
		} catch (PDOException $e) {
			return $e->getMessage();
		}
	}

	public static function prueba(){
		echo 'seta';
	}
}
