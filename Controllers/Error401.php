<?php
	
	class Error401 extends Controller {

			public function index(){
				$data['function_js'] = "error.js";
				$this->views->getView($this, 'index');
			}

			public function error404(){
				$data['function_js'] = "error.js";
				$this->views->getView($this, 'index');
			}

		}
?>