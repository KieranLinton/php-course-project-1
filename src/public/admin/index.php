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

use Monolog\Logger;
use Monolog\Level;
use Monolog\Handler\StreamHandler;

require ROOT_PATH . '../vendor/autoload.php';

spl_autoload_register(function ($class_name) {

  $file = ROOT_PATH . str_replace('\\', '/', $class_name) . '.php';

  if (file_exists($file)) {
    require $file;
  }
});


DatabaseConnection::connect("db:3306", "db", "db", "db");

$module = $_POST['module'] ?? $_GET['module'] ?? 'dashboard';
$action =  $_POST['action'] ?? $_GET['action'] ?? 'default';

$logger = new Logger("admin_general");
$logger->pushHandler(new StreamHandler(ROOT_PATH . "../logs/general.log"));


switch ($module) {
  case 'login':
    $loginController = new LoginController();
    $loginController->setLogger($logger);
    $loginController->runAction($action);
    break;

  case 'dashboard':
    $dashboardController = new DashboardController();
    $dashboardController->template = new Template('admin/layout/default');
    $dashboardController->setLogger($logger);
    $dashboardController->runAction($action);
    break;

  case $module = "pageList":
    $pageListController = new PageListController();
    $pageListController->template = new Template('admin/layout/default');
    $pageListController->setLogger($logger);
    $pageListController->runAction($action);
    break;
}
