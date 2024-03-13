<?php 

$section = $_GET['section'] ?? 'home'; 


switch ($section) {
  case 'home':
    include "controller/homePage.php";
    break;
  case "about-us":
    include "controller/aboutUsPage.php";
    break;

  case "contact-us":
    include "controller/contactUsPage.php";
    break;
}


