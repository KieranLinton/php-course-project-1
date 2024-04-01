<?php

session_start();

use core\db\DatabaseConnection;
use core\Router;
use core\Template;


define('ROOT_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
define('VIEW_PATH', ROOT_PATH . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR);
define('MODULE_PATH', ROOT_PATH . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR);



spl_autoload_register(function ($class_name) {

  $file = ROOT_PATH . str_replace('\\', '/', $class_name) . '.php';

  // if the file exists, require it
  if (file_exists($file)) {
    require $file;
  }
});

DatabaseConnection::connect("db:3306", "db", "db", "db");


$request = $_SERVER['REQUEST_URI'];
$action =  $request == '/' ? '/home' : $request;

$dbh = DatabaseConnection::getInstance();
$dbc = $dbh->getConnection();

$router = new Router($dbc);
$pageTemplate = new Template('layout/default');


if (!$router->findBy("url", $action)) {
  $pageTemplate->view("../views/status-pages/404");
  return;
}
$routerModule = $router->{"module"};

$action = !!$router->{"action"} ? $router->{"action"} : 'default';
$moduleName = ucfirst($routerModule) . 'Controller';

$modulePath = MODULE_PATH . $routerModule . "/controllers/$moduleName.php";

if (!file_exists($modulePath)) {
  $pageTemplate->view("../status-pages/404");
  return;
}

require $modulePath;

$class =  "modules\\$routerModule\\controllers\\$moduleName";

$controller = new $class();
$controller->template = $pageTemplate;
$controller->setEntityId($router->{"entity_id"});
$controller->runAction($action);
