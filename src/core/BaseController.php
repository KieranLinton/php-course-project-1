<?php

class BaseController
{
    protected $entityId;

    function runAction(string $actionName)
    {

        $continue = $this->runBeforeAction();


        if (!$continue) {
            return;
        }

        $actionName .= "Action";

        if (!method_exists($this, $actionName)) {
            $template = new Template();
            $template->view(VIEW_PATH . "status-pages/404");
            return;
        }

        $this->$actionName();
    }

    function runBeforeAction()
    {
        return true;
    }

    public function setEntityId(int $entityId)
    {
        $this->entityId = $entityId;
    }
}
