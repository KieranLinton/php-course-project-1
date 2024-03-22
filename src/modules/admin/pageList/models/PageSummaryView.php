<?php


class PageSummaryView extends AbstractEntity
{
    public function __construct(PDO $dbc)
    {
        parent::__construct($dbc, 'page_summaries_view');
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
