<?php 

require 'controllers/BaseController.php';
require 'views/Template.php';
require 'models/Page.php';
require 'db/DatabaseConnection.php';

session_start();

DatabaseConnection::connect("db:3306", "db", "db", "db");


$section = $_GET['section'] ?? $_POST['section'] ?? 'home'; 
$action =  $_GET['action'] ?? $_POST['action'] ?? 'default';

switch ($section) {
  case 'home':
    include "controllers/homePage.php";
    $homeController = new HomeController();
    $homeController->runAction($action);
    break;

  case "about-us":
    include "controllers/aboutUsPage.php";
    $aboutUsController = new AboutUsController();
    $aboutUsController->runAction($action);
    break;

  case "contact-us":
    include "controllers/contactUsPage.php";
    $contactController = new ContactController();
    $contactController->runAction($action);
    break;
}


