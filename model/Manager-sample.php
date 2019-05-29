<?php


class Manager
{
    protected function dbConnect()
    {
        $db = new PDO('mysql:host=localhost;dbname=baseName;charset=utf8', id, password);
        return $db;
    }
}


?>