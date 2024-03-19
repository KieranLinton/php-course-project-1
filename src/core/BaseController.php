<?php

class BaseController
{
    protected $entityId;

    function runAction($actionName)
    {

        $continue = $this->runBeforeAction();

        if (!$continue) {
            return;
        }

        $actionName .= "Action";

        if (!method_exists($this, $actionName)) {
            $template = new Template();
            $template->view("status-pages/404");
            return;
        }

        $this->$actionName();
    }

    function runBeforeAction()
    {
        return true;
    }

    public function setEntityId($entityId)
    {
        $this->entityId = $entityId;
    }
}
