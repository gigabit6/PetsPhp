<?php

require_once('../entities/Connection.php');

class PetRepo
{
    private $connection;
    function __construct(){
        $this->connection = new Connection();
    }


    function insert(Pet $pet)
    {

        $query = "INSERT INTO pets(name, type, picture, ownerId) VALUES ('$pet->name','$pet->type','$pet->picture','$pet->ownerId')";

        $result = $this->connection->queryResult($query);

    }

    public function update(Pet $pet){

        $query = "UPDATE `pets` SET `id`='$pet->id',`name`='$pet->name',`type`='$pet->type',`ownerId`='$pet->ownerId',`picture`='$pet->picture'  WHERE id=$pet->id";

        $result = $this->connection->queryResult($query);
    }


    public function getAll()
    {
        $query = "SELECT * FROM `pets`";

        $result = $this-> connection-> queryResult($query);
        $pets = array();
        while($rows = $result->fetch(PDO::FETCH_ASSOC))
        {
            $pet = new Pet();
            $pet->id = $rows['id'];
            $pet->name  = $rows['name'];
            $pet->type  = $rows['type'];
            $pet->picture  = $rows['picture'];
            $pet->ownerId  = $rows['ownerId'];

            array_push($pets,$pet);
        }

        return $pets;
    }

    public function getAllMyPets()
    {
        $query = "SELECT * FROM `pets`  WHERE `ownerId` = '".$_SESSION['id']."'";

        $result = $this-> connection-> queryResult($query);
        $pets = array();
        while($rows = $result->fetch(PDO::FETCH_ASSOC))
        {
            $pet = new Pet();
            $pet->id = $rows['id'];
            $pet->name  = $rows['name'];
            $pet->type  = $rows['type'];
            $pet->picture  = $rows['picture'];
            $pet->ownerId  = $rows['ownerId'];

            array_push($pets,$pet);
        }

        return $pets;
    }
    public function search($type)
    {
        if($type == "all"){
            $query = "SELECT * FROM `pets`";
        }
        else{
            $query = "SELECT * FROM `pets`WHERE `type` = '".$type."'";
        }


        $result = $this-> connection-> queryResult($query);
        $pets = array();
        while($rows = $result->fetch(PDO::FETCH_ASSOC))
        {
            $pet = new Pet();
            $pet->id = $rows['id'];
            $pet->name  = $rows['name'];
            $pet->type  = $rows['type'];
            $pet->picture  = $rows['picture'];
            $pet->ownerId  = $rows['ownerId'];

            array_push($pets,$pet);
        }

        return $pets;
    }

    public function getById($id){
        $query = "SELECT * FROM `pets` WHERE id=$id";

        $result = $this-> connection->queryResult($query);

        $pet = new Pet();
        while($rows = $result->fetch(PDO::FETCH_ASSOC))
        {
            $pet->id = $rows['id'];
            $pet->name  = $rows['name'];
            $pet->type  = $rows['type'];
            $pet->picture  = $rows['picture'];
            $pet->ownerId  = $rows['ownerId'];
        }

        return $pet;
    }


    public function save(Pet $pet)
    {
        if($pet->id!=null)
            $this->update($pet);
        else
            $this->insert($pet);
    }

    public function delete($id)
    {

        $query = "DELETE FROM `pets` WHERE id=$id";

        $result = $this-> connection->queryResult($query);
    }
}