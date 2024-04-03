<?php

namespace core;

use monolog\Logger;

class BaseController
{
    public Template $template;
    protected Logger $logger;
    protected ?int $entityId;

    function log($level, string|\Stringable $message, array $context = [])
    {
        $this->logger->log($level, get_class($this) . ": " . $message, $context);
    }

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
    public function setLogger(Logger $logger)
    {
        $this->logger = $logger;
    }
}
