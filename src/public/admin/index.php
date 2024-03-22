<?php

session_start();

define('ROOT_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
define('VIEW_PATH', ROOT_PATH . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR);
define('MODULE_PATH', ROOT_PATH . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR);

define("ENCRYPTION_SALT", "VeryVerySecureSalt4312$");

require_once ROOT_PATH . "core/utils/includeAll.php";

requireOnceAll(ROOT_PATH . 'db/*.php');
requireOnceAll(ROOT_PATH . 'core/*.php');
requireOnceAll(ROOT_PATH . 'core/*/*.php');
requireOnceAll(ROOT_PATH . 'core/*/*/*.php');

require_once MODULE_PATH . 'page/models/Page.php';
require_once MODULE_PATH . 'admin/pageList/models/PageSummaryView.php';

require_once MODULE_PATH . 'users/models/User.php';


DatabaseConnection::connect("db:3306", "db", "db", "db");

$module = $_POST['module'] ?? $_GET['module'] ?? 'dashboard';
$action =  $_POST['action'] ?? $_GET['action'] ?? 'default';

switch ($module) {
  case 'login':
    include MODULE_PATH . 'admin/login/controllers/LoginController.php';

    $dashboardController = new LoginController();
    $dashboardController->runAction($action);
    break;
  case 'dashboard':
    include MODULE_PATH . 'admin/dashboard/controllers/DashboardController.php';

    $dashboardController = new DashboardController();
    $dashboardController->template = new Template('admin/layout/default');
    $dashboardController->runAction($action);
    break;

  case $module = "pageList":
    require_once MODULE_PATH . 'admin/pageList/controllers/PageListController.php';

    $dashboardController = new PageListController();
    $dashboardController->template = new Template('admin/layout/default');
    $dashboardController->runAction($action);
    break;
}
