<?php

class Errorapp extends Controller
{

    public function index()
    {
        $data['function_js'] = "error.js";
        $this->views->getView($this, 'error404');
    }

    public function error404()
    {
        $data['function_js'] = "error.js";
        $this->views->getView($this, 'error404');
    }
}
