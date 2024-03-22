<?php

class PageListController extends AdminController
{
    public function defaultAction()
    {
        $this->template->view("admin/pageList/views/page-list");
    }
}
