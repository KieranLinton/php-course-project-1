<?php

session_start();

define('ROOT_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
define('VIEW_PATH', ROOT_PATH . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR);
define('MODULE_PATH', ROOT_PATH . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR);

define("ENCRYPTION_SALT", "VeryVerySecureSalt4312$");

require_once ROOT_PATH . "utils/includeAll.php";

requireOnceAll(ROOT_PATH . 'db/*.php');
requireOnceAll(ROOT_PATH . 'core/*.php');

require_once MODULE_PATH . 'page/models/Page.php';



DatabaseConnection::connect("db:3306", "db", "db", "db");

$module = $_GET['module'] ?? $_POST['module'] ?? 'dashboard';
$action = $_GET['action'] ?? $_POST['action'] ?? 'default';

if ($module == 'dashboard') {

  include MODULE_PATH . 'dashboard/admin/controllers/DashboardController.php';

  $dashboardController = new DashboardController();
  $dashboardController->runAction($action);
}
