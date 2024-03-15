<?php

class BaseController {
    function runAction($actionName) {

        $continue = $this->runBeforeAction();   

        if(!$continue){
            return;
        }

        $actionName .= "Action";

        if(method_exists($this, $actionName)){
            $this->$actionName();
        }
        else {
            include "views/status-pages/404.html";
        }
    }

    function runBeforeAction() {
        return true;
    }
}