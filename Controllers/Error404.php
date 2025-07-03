<?php
	
	class Error404 extends Controller {

			public function index(){
				$data['function_js'] = "error.js";
				$this->views->getView($this, 'index');
			}
		}
?>