<?php

class Perfiles extends Controller
{

    public function __construct()
    {
        Auth::noDepot();
        Auth::noAuth();
        parent::__construct();
        Permisos::getPermisos(PERFILES);
        Permisos::getEspeciales(7);
    }

    public function index()
    {
        if (!empty(permisos::accesoModulo($_SESSION['userData']['IDPERFIL'], PERFILES))) {
            $data['page_name'] = "Perfiles";
            $data['function_js'] = "perfiles.js";
            $this->views->getView($this, 'index', $data);
        } else {
            header('location:' . base_url() . "error401");
        }
    }

    public function editar($id)
    {
        if (!empty(permisos::update())) {
            $modulos = perfilesModel::getAllModulosPerfil($id);
            $Perfil = perfilesModel::getOnePerfil($id);
            $data['page_name'] = $Perfil[0]['NOMPERFIL'];
            $data['function_js'] = "perfiles.js";
            $data['modulos'] = to_obj($modulos);
            $data['idperfil'] = $Perfil[0]['ID'];
            $this->views->getView($this, 'editarPerfil', $data);
        } else {
            header('location:' . base_url() . "error401");
        }
    }



    public function getAllModulosPerfil($id)
    {
        $data = [];
        $resultado = perfilesModel::getAllModulosPerfil($id);

        for ($i = 0; $i < count($resultado); $i++) {
            $sub_array = array();

            $sub_array["ID"] = $resultado[$i]['ID'];
            $sub_array["NOMBRE"] = ucwords($resultado[$i]['NOMBRE']);

            $sub_array["C"] = '
        <div class="form-group">
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input permiso" data-modulo="' . $resultado[$i]['ID'] . '" name="ver[]" id="ver' . $resultado[$i]['ID'] . '" ' . ($resultado[$i]['C'] ? 'checked' : '') . ' data-action="C" />
                <label for="ver' . $resultado[$i]['ID'] . '" class="custom-control-label"></label>
            </div>
        </div>';

            $sub_array["R"] = '
        <div class="form-group">
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input permiso" data-modulo="' . $resultado[$i]['ID'] . '" name="crear[]" id="crear' . $resultado[$i]['ID'] . '" ' . ($resultado[$i]['R'] ? 'checked' : '') . ' data-action="R" />
                <label for="crear' . $resultado[$i]['ID'] . '" class="custom-control-label"></label>
            </div>
        </div>';

            $sub_array["U"] = '
        <div class="form-group">
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input permiso" data-modulo="' . $resultado[$i]['ID'] . '" name="editar[]" id="editar' . $resultado[$i]['ID'] . '" ' . ($resultado[$i]['U'] ? 'checked' : '') . ' data-action="U" />
                <label for="editar' . $resultado[$i]['ID'] . '" class="custom-control-label"></label>
            </div>
        </div>';

            $sub_array["D"] = '
        <div class="form-group">
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input permiso" data-modulo="' . $resultado[$i]['ID'] . '" name="eliminar[]" id="eliminar' . $resultado[$i]['ID'] . '" ' . ($resultado[$i]['D'] ? 'checked' : '') . ' data-action="D" />
                <label for="eliminar' . $resultado[$i]['ID'] . '" class="custom-control-label"></label>
            </div>
        </div>';

            $data[] = $sub_array;
        }

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }


    public function getOnePerfil()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $id = $_POST['id'];
            $data = perfilesModel::getOnePerfil($id);
            foreach ($data as $row) {
                $data['ID']          = $row['ID'];
                $data['NOMPERFIL']   = ucwords($row['NOMPERFIL']);
                $data['ESTADO']      = $row['ESTADO'];
            }
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        }
    }


    public function getAllPerfiles()
    {
        $data = [];
        $btnEdit = "";
        $btnGeneral = "";
        $btnEspeciales = "";
        $btnDelete = "";
        $resultado = perfilesModel::getAllPerfiles();
        for ($i = 0; $i < count($resultado); $i++) {
            $sub_array = array();
            $dataPerfil = json_encode($resultado[$i]);
            if ($resultado[$i]['ESTADO'] == 1) {
                $estado = '<span class="badge bg-success">Activo</span>';
            } else {
                $estado = '<span class="badge bg-danger">Inactivo</span>';
            }

            if (permisos::update()) {
                $btnEdit = '<button class="dropdown-item" type="button" onClick="editNomPerfil(' . $resultado[$i]['ID'] . ');"><i class="fa fa-edit"></i> Editar</button>';
            }
            if (permisos::getpermisoGenerales()) {
                $btnGeneral = '<a href="' . base_url . 'perfiles/editar/' . $resultado[$i]['ID'] . '"<button class="dropdown-item" type="button"><i class="fa fa-check-circle-o"></i> Permisos</button></a>';
            }
            if (permisos::getpermisoEspecial()) {
                $btnEspeciales = '<a href="' . base_url . 'perfiles/editar/' . $resultado[$i]['ID'] . '"<button class="dropdown-item" type="button"><i class="fa fa-check-circle-o"></i> Permisos Especiales</button></a>';
            }

            if (permisos::delete()) {
                $btnDelete = '<button class="dropdown-item" type="button" onClick="deletePerfil(\'' . htmlspecialchars($dataPerfil, ENT_QUOTES, 'UTF-8') . '\');"><i class="fa fa-trash"></i> Eliminar</button>';
            }

            if (permisos::update() || permisos::delete() || permisos::getpermisoEspecial() || permisos::getpermisoGenerales()) {
                $sub_array['options'] = '<div class="dropdown">
                                              <button class="btn btn-light btn-sm dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-list-ul"></i>
                                               </button>
                                              <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                               ' . $btnEdit . ' ' . $btnGeneral . ' ' . $btnEspeciales . ' ' . $btnDelete . '</div></div>';
            } else {
                $sub_array['options'] = '';
            }
            $sub_array["id"]        = ucwords($resultado[$i]['ID']);
            $sub_array["nomperfil"] = ucwords($resultado[$i]['NOMPERFIL']);
            $sub_array["estado"]    = $estado;
            $data[] = $sub_array;
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public function procesar()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $val = new Validator();
            $val->name('txt_nomperfil')->value(limpiar($_POST['txt_nomperfil']))->required();
            $val->name('sel_estado')->value(limpiar($_POST['sel_estado']))->required();
            if ($val->isSuccess()) {
                if ($_POST["operation"] == "Add") {
                    $data = perfilesModel::savePerfil();
                }
                if ($_POST["operation"] == "Edit") {
                    $id = limpiar($_POST['idperfil']);
                    $data = perfilesModel::updatePerfil($id);
                }
            } else {
                $data = ['errorvalida' =>  true, 'msg' => $val->getErrors()];
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public function actualizaPermiso()
    {
        $data = [];
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $idperfil =  $_POST['txt_idperfil'];
            perfilesModel::deleteModulos($idperfil);
            if (isset($_POST['ver'])) {
                $ver = $_POST['ver'];
                foreach ($ver as $row) {
                    perfilesModel::registrarPrimerVer($idperfil, $row);
                    perfilesModel::registrarVer($idperfil, $row);
                }
            }
            if (isset($_POST['crear'])) {
                $crear = $_POST['crear'];
                foreach ($crear as $row) {
                    perfilesModel::registrarCrear($idperfil, $row);
                }
            }
            if (isset($_POST['editar'])) {
                $editar = $_POST['editar'];
                foreach ($editar as $row) {
                    perfilesModel::registrarUpdate($idperfil, $row);
                }
            }
            if (isset($_POST['eliminar'])) {
                $eliminar = $_POST['eliminar'];
                foreach ($eliminar as $row) {
                    perfilesModel::registrarEliminar($idperfil, $row);
                }
            }
            $data = ['status' => true, 'msg' => 'Perfil Actalizado'];
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        }
    }

    public function verPerfil()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $idperfil = limpiar($_POST['idperfil']);
            $val = new Validator();
            //   $val->name('txt_nomperfil')->value(limpiar($_POST['txt_nomperfil']))->required();
            if ($val->isSuccess()) {
                $data = perfilesModel::getOnePerfil($idperfil);
                foreach ($data as $row) {
                    $data['ID']         = $row['ID'];
                    $data['NOMBRE']     = ucwords($row['NOMPERFIL']);
                    $data['ESTADO']     = $row['ESTADO'];
                }
            } else {
                $data = ['errorvalida' =>  true, 'msg' => $val->getErrors()];
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }


    public function eliminarPerfil()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $idperfil = limpiar($_POST['ideliminacion']);
            $val = new Validator();
            $val->name('descmotivo')->value(limpiar($_POST['descmotivo']))->required();
            if ($val->isSuccess()) {
                $data = perfilesModel::deletePerfil($idperfil);
                if ($data['status'] == "delete_ok") {
                    $data = ['status' => 'delete_ok', 'msg' => 'Perfil Eliminado'];
                } else if ($data['status'] == "error") {
                    $data = ['status' => 'error_delete', 'msg' => $data['msg']];
                }
            } else {
                $data = ['errorvalida' =>  true, 'msg' => $val->getErrors()];
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }


    
        public function actualizarPermiso()
    {
        $json = json_decode(file_get_contents('php://input'), true);

        $idPerfil = $json['idPerfil'];
        $idModulo = $json['idModulo'];
        $action = $json['action'];
        $state = $json['state'];

        //die($idPerfil. $idModulo. $action. $state);
        $result = perfilesModel::updatePermission($idPerfil, $idModulo, $action, $state);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error actualizando permiso.']);
        }
    }
}
