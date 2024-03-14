<?php

class ContactController extends BaseController {

    function runBeforeAction() {
        if($_SESSION["has_submitted_contact_form"]){
            include "views/contact/already-submitted.html";
            return false;
        } 
        return true;
    }

    function defaultAction() {
        include "views/contact/contact-us.html";
    }


    function submitContactFormAction(){
        $_SESSION["has_submitted_contact_form"] = true;
        include "views/contact/contact-us-thank-you.html";
    }
}

