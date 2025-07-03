<?php

const base_url = 'http://localhost/erpbodega/';

define('SITE_LANG', 'es');


/*--------------------------------------------------------------------------------------*/
/*						CONSTANTES PARA CONEXION DE LA BASE DE DATOS					*/
/*																						*/
/*--------------------------------------------------------------------------------------*/

const DB_DRIVER 	= 	'mysql';
const DB_HOST 		= 	'localhost';
const DB_NAME 		= 	'erpbodega';
const DB_USER 		= 	'root';
const DB_PASS 		= 	'juanse.2014*';
const DB_CHARSET	= 	'utf8';

/*--------------------------------------------------------------------------------------*/
/*								 	MODULOS 			 								*/
/*																						*/
/*--------------------------------------------------------------------------------------*/

const USUARIOS 			= 	1;
const PERFILES 			= 	2;
const DASHOBOARD	    = 	3;




/*--------------------------------------------------------------------------------------*/
/*								 DIRECTORIOS DE LA APP	 								*/
/*																						*/
/*--------------------------------------------------------------------------------------*/
define('SITE_CHARSET', 'utf-8');
define('SITE_NAME', 'LOGISTICA INTEGRAL');
define('SITE_VERSION', '1.0.0');
define('SITE_LOGO', 'gsflogo.svg');
define('SITE_FAVICON', 'android-icon-48x48.png');
define('SITE_DESC', 'GSF FRAMEWORK');
define('SITE_LOGO_MAIN', 'main.logo.png');


/*--------------------------------------------------------------------------------------*/
/*								 DIRECTORIOS DE LA APP	 								*/
/*																						*/
/*--------------------------------------------------------------------------------------*/

define('TEMPLATE_DEFAULT', 'gentelella');
define('DASHBOARD', 'dashboard');
define('DS', '/');
define('SPA', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__DIR__));
define('CONTROLLER', ROOT . SPA . 'Controllers');
define('VIEW', ROOT . SPA . 'Views');


/*--------------------------------------------------------------------------------------*/
/*								ARCHIVOS PUBLICOS 		 								*/
/*																						*/
/*--------------------------------------------------------------------------------------*/

define('ASSETS', base_url . 'assets');
define('APP', 'app');
define('TEMPLATE', 'templates/gentelella/');
define('CSS', 'css');
define('PLUGINS', 'plugins');
define('JS', 'js');
define('IMG', base_url . 'assets/img');



/*--------------------------------------------------------------------------------------*/
/*								ARCHIVOS PUBLICOS 		 								*/
/*																						*/
/*--------------------------------------------------------------------------------------*/

define('CONTROLLER_DEFAULT', 'Login');
define('METHOD_DEFAULT', 'index');
define('CONTROLLER_ERROR', 'Error404');