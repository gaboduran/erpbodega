<?php
	
	class Dashboard extends Controller{

	public function __construct(){
		
		Auth::noDepot();
		Auth::noAuth();
		parent::__construct();
		Permisos::getPermisos(3);
	}

		public function index (){
			if (!empty(permisos::accesoModulo($_SESSION['userData']['IDPERFIL'],3))) {
				$data['page_name'] = "Dashboard";
				$data['function_js'] = "dashboard.js";
				$this->views->getView($this, 'index', $data);
			}else{
               header('location:' .base_url()."error401" );
            }
		}
	}

?>