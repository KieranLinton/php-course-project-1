<?php

namespace core;

class BaseController
{
    public Template $template;
    protected ?int $entityId;

    function runAction(string $actionName)
    {
        $continue = $this->runBeforeAction();

        if (!$continue) {
            return;
        }

        $actionName .= "Action";

        if (!method_exists($this, $actionName)) {
            $this->template->view(VIEW_PATH . "status-pages/404");
            return;
        }

        $this->$actionName();
    }

    protected function runBeforeAction()
    {
        return true;
    }

    public function setEntityId(?int $entityId)
    {
        $this->entityId = $entityId;
    }
}
