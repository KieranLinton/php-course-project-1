<?php

class ContactController extends BaseController {

    function runBeforeAction() {
        if($_SESSION["has_submitted_contact_form"] ?? false){
            $template = new Template();
            $template->view("contact/already-submitted");
            return false;
        } 
        return true;
    }

    function defaultAction() {
        $template = new Template();
        $template->view("contact/contact-us");
    }


    function submitContactFormAction(){
        $_SESSION["has_submitted_contact_form"] = true;
        $template = new Template();
        $template->view("contact/contact-us-thank-you");
    }
}

