<?php 

require 'controllers/baseController.php';

session_start();

$section = $_GET['section'] ?? $_POST['section'] ?? 'home'; 
$action =  $_GET['action'] ?? $_POST['action'] ?? 'default';

switch ($section) {
  case 'home':
    include "controllers/homePage.php";
    break;
  case "about-us":
    include "controllers/aboutUsPage.php";
    break;

  case "contact-us":
    include "controllers/contactUsPage.php";
    $contactController = new ContactController();
    $contactController->runAction($action);
    break;
}


