<?php


class PageSummary extends AbstractEntity
{
    public function __construct(PDO $dbc)
    {
        parent::__construct($dbc, 'page-summaries');
    }

    protected function initFields()
    {
        $this->fields = [
            'id',
            'title',
            'content'
        ];
    }
}
