<?php
require_once('Application.php');
spl_autoload_register(function($className) {
	$modelFile = "Model/".$className.".php";	
	if (is_readable($modelFile)) {
        require $modelFile;
    }
	$controllerFile = "Controller/".$className.".php";	
	if (is_readable($controllerFile)) {
        require $controllerFile;
    }
});
$request = explode('/', (!empty($_GET['request']) ? $_GET['request'] : 'Home/index'));
$controller = ucfirst(strtolower($request[0]));
$action = strtolower($request[1]);
$args = array_slice($request,2);
$app = Application::GetInstance()
    ->setController($controller)
	->setAction($action)
	->setArgs($args)
	->dispatch();