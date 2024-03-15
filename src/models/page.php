<?php

class Page {

    public $id;
    public $title;
    public $content;

    public function getById($id){

        $dsn = 'mysql:dbname=db;host=db:3306';
        $user = 'db';
        $password = 'db';
        
        try{ 
            $dbh = new PDO($dsn, $user, $password);
        }
        catch(PDOException $e) {
            echo "Connection to database has failed < /br>";
            var_dump($e);
            die();
        }

        $query = "SELECT * FROM pages where id = :id";
        $smtp = $dbh->prepare($query);
        $smtp->execute(["id"=> $id]);

        $result = $smtp->fetch();

        $this->id = $result["id"];
        $this->title = $result["title"];
        $this->content = $result["content"];
    }
    
}