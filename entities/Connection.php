<?php

class Connection
{
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $dbName = "petshopphp";

    function queryResult($query){

        try{
            $conn = new PDO($url = "mysql:dbname=$this->dbName;host=$this->host", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $conn->prepare($query);
            $stmt->execute();

            $result = $stmt;

        }catch (PDOException $e){
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        $conn=null;
        return $result;
    }
}