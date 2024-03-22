<?php

session_start();

define('ROOT_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
define('VIEW_PATH', ROOT_PATH . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR);
define('MODULE_PATH', ROOT_PATH . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR);

require_once ROOT_PATH . "core/utils/includeAll.php";

requireOnceAll(ROOT_PATH . 'db/*.php');
requireOnceAll(ROOT_PATH . 'core/*.php');

require_once MODULE_PATH . 'page/models/Page.php';

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

$action = !!$router->{"action"} ? $router->{"action"} : 'default';
$moduleName = ucfirst($router->{"module"}) . 'Controller';

$modulePath = MODULE_PATH . $router->{'module'} . "/controllers/$moduleName.php";

if (!file_exists($modulePath)) {
  $pageTemplate->view("../status-pages/404");
  return;
}

include $modulePath;

$controller = new $moduleName();
$controller->template = $pageTemplate;
$controller->setEntityId($router->{"entity_id"});
$controller->runAction($action);
