<?php

class HomeController extends BaseController {
    public function defaultAction() {

        $pageObj = new Page();
        $pageObj->getById(1);
        $variables["pageObj"] = $pageObj;

        $template = new Template();
        $template->view("home-page", $variables);
    }

}