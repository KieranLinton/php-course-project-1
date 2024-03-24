<?php


class PageSummaryView extends AbstractEntity
{
    public int $id;
    public string $title;
    public string $content;

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
