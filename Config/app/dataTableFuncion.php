<?php
class dataTableFuncion extends DB {

	public static function rowCountTable($columns, $tabla){
		$where_condition = "";
		$stringSQL = "";
		try{
			if(!empty($_REQUEST['search']['value']) ) {
                $where_condition .= " WHERE ";
	                for ($i=0; $i<count($columns); $i++) { 
	                	$where_condition .= "$columns[$i]"." LIKE ". "'%" .$_REQUEST['search']['value']."%' OR ";
	                }
               	$where_condition = substr($where_condition,0,-4);
	         }
			$stringSQL .= "SELECT COUNT(ID) AS total FROM " .$tabla;
			$stringSQL .= $where_condition;
			$result = DB::SQL($stringSQL);
			return $result;
		}catch (PDOException $e) {
			$result = ['status' => 'error', 'msg' => $e->getMessage()];
		}
		return $result;
	}

	public static function datosTabla($columns, $tabla){
		$selectString = "";
		$where_condition = "";
		$orderby_condition = "";
		$stringSQL = "";
		try{			
            $selectString .= "SELECT ";
        	for ($i=0; $i<count($columns); $i++) { 
                	$selectString .= "$columns[$i]".", ";
            }
			$selectString = substr($selectString,0,-2);
			$stringSQL = $selectString.' FROM '.$tabla;
			if(!empty($_REQUEST['search']['value']) ) {
                $where_condition .= " WHERE ";
	                for ($i=0; $i<count($columns); $i++) { 
	                	$where_condition .= "$columns[$i]"." LIKE ". "'%" .$_REQUEST['search']['value']."%' OR ";
	                }
               	$where_condition = substr($where_condition,0,-4);
	         }
	         $stringSQL .= $where_condition;
		         $stringSQL .= " ORDER BY ". $columns[$_REQUEST['order'][0]['column']] ."   ". $_REQUEST['order'][0]['dir'] ." LIMIT ". $_REQUEST['start'] ." ,". $_REQUEST['length'] ."   ";
	       // echo $stringSQL;
				  $result = DB::SQL($stringSQL);
		}catch (PDOException $e) {
				$result = ['status' => 'error', 'msg' => $e->getMessage()];
		}
	     return $result;
	}
}
?> 