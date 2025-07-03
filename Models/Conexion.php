<?php
date_default_timezone_set("America/Lima");
    
    class Conexion {

        public static function Conectar(){

            $driver = 'mysql'; //mysql no cambiar
			$host = 'localhost'; //localhost
			$dbname = 'erpbodega'; //bdd
			$username ='root'; //usuario
			$passwd = 'juanse.2014*'; //contra
			$server=$driver.':host='.$host.';dbname='.$dbname;
			try {
				$conexion = new PDO($server,$username,$passwd);
				//$conexion = exec("SET CHARACTER SET utf8");
				$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch (Exception $e) {
				$conexion = null;
            	echo '<span class="label label-danger label-block">ERROR AL CONECTARSE A LA BASE DE DATOS, PRESIONE F5</span>';
            	exit();
			}
			return $conexion;
        }
        
        public static function query($sql, $params = []){
            $db = new Conexion();
            $link = (object)$db->Conectar();
            $link->beginTransaction(); // por cualquier error , chekpoint
            $query = $link->prepare($sql);

            if (!$query->execute($params)) {
                $link->rollBack();
                $error = $query->errorInfo();
                throw new Exception($error[2]);
            }
            // SELECT | INSERT | UPDATE | DELETE | ALTER TABLE
            //Manejo del tipo de query
            if (strpos($sql, 'SELECT') !== false) {
                return $query->rowCount() > 0 ? $query->fetchAll(PDO::FETCH_ASSOC) : false;
            } elseif (strpos($sql, 'INSERT') !== false) {
                $id = $link->lastInsertId();
                $link->commit();
                return $id;
            } elseif (strpos($sql, 'UPDATE') !== false) {
                $link->commit();
                return true;
            }elseif (strpos($sql, 'DELETE') !== false) {
                if ($query->rowCount() > 0) {
                    $link->commit();
                    return true;
                }
                $link->rollBack();
                return false; //no se borro nada
            } else {
                //alter table / drop table
                $link->commit();
                return true;
            }
            $db = null;
        }

        public static function countRows($sql){
            $db = new Conexion();
            $link = (object)$db->Conectar();
            $link->beginTransaction(); // por cualquier error , chekpoint
            $query = $link->prepare($sql);
            $query->execute();
            $count = $query->fetchColumn();
            return $count;
        }

    
        public static function ejecutaQuery($sql){
            $db = new Conexion();
            $link = (object)$db->Conectar();
            $query = $link->prepare($sql);
            $query->execute();
            return $link->lastInsertId();;
        }

        public static function ejecutaQuery1($sql){
        $db = new Conexion();
        $link = (object)$db->Conectar();
        $query = $link->prepare($sql);
        $result = $link->execute($sql);
        return $result;
    }

}