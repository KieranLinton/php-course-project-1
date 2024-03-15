<?php

class AboutUsController extends BaseController {
    public function defaultAction() {

        $variables = [
            "title"=> "About Page",
            "content"=> "This is a test website that does not do anything in particular, just exists."
        ];

        $template = new Template();
        $template->view("about-us", $variables);
    }
}
