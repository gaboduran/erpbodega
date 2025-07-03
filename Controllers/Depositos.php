<?php
    
    class Depositos extends Controller{

        public function __construct(){
            Auth::noDepot();
            Auth::noAuth();
            parent::__construct();
            Permisos::getPermisos(DANOS);
        }

        public function index (){
            if (!empty(permisos::accesoModulo($_SESSION['userData']['IDPERFIL'],PERFILES))) {
                $data['page_name'] = "Depositos";
                $data['function_js'] = "deposito.js";
                $this->views->getView($this, 'index', $data);
            }else{
               header('location:' .base_url()."error401" );
            }   
        }

        public function nuevo (){
           if (!empty(permisos::create())){
                $ciudad = Listas::getCiudades();
                $linea = Listas::getLineas();
                $data['operation']  = "Add";
                $data['linea']      = to_obj($linea);
                $data['ciudad']      = to_obj($ciudad);
                $data['page_name']  = "Nuevo Deposito";
                $data['function_js'] = "deposito.js";
                $this->views->getView($this,'nuevo', $data);
            }else{
               header('location:' .base_url()."Error401" );
            }
    
        }

        public function getAllDepositos(){
            $data = [];
            $btnView = "";
            $btnEdit = "";
            $btnDelete = "";
            $columns = array(
                0 => 'ID',
                1 => 'NOMBRE',
                2 => 'INGINVENTARIO',
                3 => 'NOMBRE', 
                4 => 'ESTADO');
                $resultado = depositosModel::datosTabla('deposito');
                $recordTotal = depositosModel::rowCountTable('deposito');
                $totalRecords=0;
                foreach ($recordTotal as $key => $value) {
                    $totalRecords = $value['total'];
                }

            for ($i=0; $i < count($resultado) ; $i++) {
                $sub_array = array();
                    if ($resultado[$i]['ESTADO'] == 1 ){
                        $estado = '<span class="badge bg-success">Activo</span>';
                    }else{
                        $estado = '<span class="badge bg-danger">Inactivo</span>';
                    }
                    if ($resultado[$i]['INGINVENTARIO'] == 1 ){
                        $inventario = 'Si';
                    }else{
                        $inventario = 'No';
                    }
                    if(permisos::read()){ 
                        $btnView = '<button class="dropdown-item" type="button" onClick="verCliente('.$resultado[$i]['ID'].');"><i class="fa-solid fa-eye"></i> Detalle</button>';
                    }
                    if(permisos::update()){ 
                        $btnEdit = '<a href="' . base_url . 'depositos/editar/' . $resultado[$i]['ID'] . '"<button class="dropdown-item" type="button"><i class="fa fa-edit"></i> Editar</button></a>';
                    }
                    if(permisos::delete()){ 
                         $btnDelete = '<button class="dropdown-item" type="button" onClick="deleteCliente('.$resultado[$i]['ID'].');"><i class="fa-regular fa-trash-can"></i> Eliminar</button>';
                    }
                    if (permisos::update() || permisos::delete() || permisos::resetPassword() || permisos::getpermisoEspecial() ) {
                        $sub_array['options'] = '<div class="dropdown">
                                                      <button class="btn btn-light btn-sm dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-list-ul"></i>
        
                                                       </button>
                                                      <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                       ' . $btnEdit . '
                                                         ' . $btnDelete . '
                                                      </div>
                                                    </div>';
                    } else {
                        $sub_array['options'] = '';
                    }
                    $sub_array["id"]                = ucwords($resultado[$i]['ID']);
                    $sub_array["nombre"]            = ucwords($resultado[$i]['NOMDEPOSITO']);
                    $sub_array["nomciudad"]         = ucwords($resultado[$i]['NOMCIUDAD']);
                    $sub_array["inventario"]            = $inventario;
                    $sub_array["estado"]            = $estado;
                $data[] = $sub_array;
            }
               $json_data = array(
                    "draw"            => intval( $_REQUEST['draw'] ),
                    "recordsTotal"    => intval($totalRecords),
                    "recordsFiltered" => intval($totalRecords),
                    "data"            => $data
                );
            echo json_encode($json_data, JSON_UNESCAPED_UNICODE);
        }


        public function editar($iddeposito){
            $depositoData           = depositosModel::getOneDeposito($iddeposito);
            $estadoData             = Listas::getNoestado($depositoData[0]['ESTADO']);
            $ciudadData             = Listas::getNociudad($depositoData[0]['CODCIUDAD']);
            $cliente                = Listas::getLineas();
            $getClientes            = depositosModel::getClientesDeposito($depositoData[0]['ID']);
            $getClientesFree        = depositosModel::getClientesDisponible($depositoData[0]['ID']);
            $data['iddeposito']     = $iddeposito;
            $data['ciudad']         = to_obj($ciudadData);
            $data['deposito']       = to_obj($depositoData);
            $data['cliente']        = to_obj($cliente);
            $data['estado']         = to_obj($estadoData);
            $data['clientedepot']   = to_obj($getClientes);
            $data['clientesfree']   = to_obj($getClientesFree);
            $data['operation']      = "Edit";
            $data['page_name']      = "Editar Deposito";
            $data['function_js']    = "deposito.js";
            $this->views->getView($this, 'editar', $data);
          }


        public function procesar(){
            if ($_SERVER['REQUEST_METHOD'] == "POST"){
                $val = new Validator();
                $val->name('txt_nombre')->value(limpiar($_POST['txt_nombre']))->required();
                $val->name('sel_ciudad')->value(limpiar($_POST['sel_ciudad']))->required();
                $val->name('sel_estado')->value(limpiar($_POST['sel_estado']))->required();
               // $val->name('inginventario')->value(limpiar($_POST['inginventario']))->required();
                    if($val->isSuccess()){
                        if($_POST["operation"] == "Add"){
                             $data = depositosModel::saveDeposito();
                           if ($data['status'] == "save_ok"){
                                $data = ['status' => true, 'msg' => 'Deposito Creado'];
                            }else if($data['status'] == "deposito_existe") {
                                $data = ['status' => 'deposito_existe', 'msg' => 'Atención: nombre deposito existe'];
                            }else if ($data['status'] == "error"){
                                $data = ['status' => 'errorPDO', 'msg' => $data['msg']];
                            }                          
                        }
                        if($_POST["operation"] == "Edit"){
                            $data = depositosModel::updateDeposito();
                            if ($data['status'] == "update_ok"){
                                $data = ['status' => 'update_ok', 'msg' => 'Cliente Actualizado'];
                            }else if($data['status'] == "deposito_existe") {
                                $data = ['status' => 'deposito_existe', 'msg' => 'Atención: Numero Ide de Cliente existente'];
                            }else if ($data['status'] == "error"){
                                $data = ['status' => 'errorPDO', 'msg' => $data['msg']];
                            }
                        }
                    }else{
                        $data = ['errorvalida' =>  true,'msg' => $val->getErrors()];
                    }
               echo json_encode($data, JSON_UNESCAPED_UNICODE);
            }
        }

        public function eliminarDeposito(){
              if ($_SERVER['REQUEST_METHOD'] == "POST"){
                  $val = new Validator();
                  $val->name('descmotivo')->value(limpiar($_POST['descmotivo']))->required();
                   if($val->isSuccess()){
                        $data = depositosModel::deleteDeposito();
                            if ($data['status'] == "delete_ok"){
                                 $data = ['status' => 'delete_ok', 'msg' => 'Deposito Eliminado'];
                            }else if($data['status'] == "error"){
                                 $data = ['status' => 'error_delete', 'msg' => 'Error durante la eilimacion'];
                            }
                   }else{
                        $data = ['errorvalida' =>  true,'msg' => $val->getErrors()];
                    }
                }
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        }


    
    }

?>