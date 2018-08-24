<?php

require_once '../app/config/config.php';

function myAutoloader($classname){
	require_once '../app/lib/'.$classname.'.php';
}

spl_autoload_register('myAutoloader');

# URL Format: controller/method/params
class Core{
	protected $currentController = 'Pages';
	protected $currentMethod = 'index';
	protected $params = array();

	public function __construct(){
		$url = $this->getURL();

		/*
		* Controller
		*/
		if (file_exists('../app/controller/'.ucfirst($url[0]).'.php')) {
			$this->currentController = ucfirst($url[0]);
			unset($url[0]);
		}

		require_once '../app/controller/'.$this->currentController.'.php';

		$this->currentController = new $this->currentController;

		/*
		* Method
		*/
		if (isset($url[1])) {
			if (method_exists($this->currentController, $url[1])) {
				$this->currentMethod = $url[1];
				unset($url[1]);
			}
		}

		/*
		* Params
		*/
		$this->params = $url ? array_values($url) : [];
		call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
	}

	public function getURL(){
		if (isset($_GET['url'])) {
			$url = rtrim($_GET['url'], '/');
			$url = filter_var($url, FILTER_SANITIZE_URL);
			$url = explode('/', $url);
			return $url;
		}
	}
}

$init = new Core;