<?php
class funcionesLOG extends DB{
        /*
        ---     Funcion que extrae la datos del registro que se va a eliminar para pasarselos a funcion que va a eliminar y se almacenar en tabla moteliminacion
        ---     como registro (log )de eliminacion,
        */
        public static function logDelete($tabla, $columns, $id){
                $selectString = "";
                $where_condition = "";
                $stringSQL = "";
                try {
                        $selectString .= "SELECT ";
                        for ($i = 0; $i < count($columns); $i++) {
                                $selectString .= "$columns[$i]" . ", ";
                        }
                        $selectString = substr($selectString, 0, -2);
                        $stringSQL .= $selectString . ' FROM ' . $tabla;

                        $where_condition .= " WHERE ID = '" . $id . "'";
                        $stringSQL .= $where_condition;
                        $result = DB::query($stringSQL,[]);
                } catch (PDOException $e) {
                        $result = ['status' => 'error', 'msg' => $e->getMessage()];
                }
                return $result;
        }
}
