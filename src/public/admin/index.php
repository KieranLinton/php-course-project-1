<?php

session_start();

define('ROOT_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
define('VIEW_PATH', ROOT_PATH . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR);
define('MODULE_PATH', ROOT_PATH . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR);

define("ENCRYPTION_SALT", "VeryVerySecureSalt4312$");

use core\db\DatabaseConnection;
use modules\admin\login\controllers\LoginController;
use modules\admin\dashboard\controllers\DashboardController;
use modules\admin\pageList\controllers\PageListController;
use core\Template;

spl_autoload_register(function ($class_name) {

  $file = ROOT_PATH . str_replace('\\', '/', $class_name) . '.php';

  // if the file exists, require it
  if (file_exists($file)) {
    require $file;
  }
});

DatabaseConnection::connect("db:3306", "db", "db", "db");

$module = $_POST['module'] ?? $_GET['module'] ?? 'dashboard';
$action =  $_POST['action'] ?? $_GET['action'] ?? 'default';

switch ($module) {
  case 'login':
    $dashboardController = new LoginController();
    $dashboardController->runAction($action);
    break;

  case 'dashboard':
    $dashboardController = new DashboardController();
    $dashboardController->template = new Template('admin/layout/default');
    $dashboardController->runAction($action);
    break;

  case $module = "pageList":
    $dashboardController = new PageListController();
    $dashboardController->template = new Template('admin/layout/default');
    $dashboardController->runAction($action);
    break;
}
