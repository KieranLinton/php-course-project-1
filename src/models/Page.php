<?php

class Page {

    public $id;
    public $title;
    public $content;

    private $dbc;

    public function __construct($dbc) {
        $this->dbc = $dbc;
    }

    public function getById($id){

        $query = "SELECT * FROM pages where id = :id";
        $smtp = $this->dbc->prepare($query);
        $smtp->execute(["id"=> $id]);

        $result = $smtp->fetch();

        $this->id = $result["id"];
        $this->title = $result["title"];
        $this->content = $result["content"];
    }
    
}