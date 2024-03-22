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

require_once MODULE_PATH . 'users/models/User.php';

DatabaseConnection::connect("db:3306", "db", "db", "db");

$dbh = DatabaseConnection::getInstance();
$dbc = $dbh->getConnection();

$authObj = new Auth($dbc);

$authObj = $authObj->setUserPassword("admin", "admin");

var_dump($authObj);

echo "SUCCESS";
