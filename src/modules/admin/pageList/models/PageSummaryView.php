<?php

namespace modules\admin\pageList\models;

use  PDO;
use core\db\AbstractEntity;

class PageSummaryView extends AbstractEntity
{
    public string $title;
    public string $content;

    public function __construct(PDO $dbc)
    {
        parent::__construct($dbc, 'page_summaries_view');
    }

    protected function initFields()
    {
        $this->fields = [
            'title',
            'content'
        ];
    }
}
