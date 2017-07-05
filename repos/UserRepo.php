<?php

require_once('../entities/Connection.php');
class UserRepo
{
    private $connection;
    function __construct(){
        $this->connection = new Connection();
    }


    function insert(User $user)
    {

        $query = "INSERT INTO users(username, password, firstName,lastName,isAdmin) VALUES ('$user->username','$user->password','$user->firstName','$user->lastName','$user->isAdmin')";

        $result = $this->connection->queryResult($query);

    }

    public function update(User $user){

        $query = "UPDATE `users` SET `id`='$user->id',`firstName`='$user->firstName',`lastName`='$user->lastName',`username`='$user->username',`password`='$user->password',`isAdmin`='$user->isAdmin'  WHERE id=$user->id";

        $result = $this->connection->queryResult($query);
    }


    public function getAll()
    {
        $query = "SELECT * FROM `users`";

        $result = $this-> connection-> queryResult($query);
        $users = array();
        while($rows = $result->fetch(PDO::FETCH_ASSOC))
        {
            $user = new User();
            $user->id = $rows['id'];
            $user->firstName  = $rows['firstName'];
            $user->lastName  = $rows['lastName'];
            $user->username  = $rows['username'];
            $user->password  = $rows['password'];
            $user->isAdmin  = $rows['isAdmin'];

            array_push($users,$user);
        }

        return $users;
    }

    public function getByUsernameAndPassword($username, $password){
        $query = "SELECT * FROM `users` WHERE `username`='$username' && `password`='$password'";


        $result = $this-> connection ->queryResult($query);

        $user = new User();
        while($rows = $result->fetch(PDO::FETCH_ASSOC))
        {

            $user->id = $rows['id'];
            $user->firstName  = $rows['firstName'];
            $user->lastName  = $rows['lastName'];
            $user->username  = $rows['username'];
            $user->password  = $rows['password'];
            $user->isAdmin = $rows['isAdmin'];
        }

        return $user;
    }

    public function getById($id){
        $query = "SELECT * FROM `users` WHERE id=$id";

        $result = $this-> connection->queryResult($query);

        $user = new User();
        while($rows = $result->fetch(PDO::FETCH_ASSOC))
        {
            $user->id = $rows['id'];
            $user->firstName  = $rows['firstName'];
            $user->lastName  = $rows['lastName'];
            $user->username  = $rows['username'];
            $user->password  = $rows['password'];
            $user->isAdmin = $rows['isAdmin'];
        }

        return $user;
    }

    public function getNameById($id){
        $query = "SELECT * FROM `users` WHERE id=$id";

        $result = $this-> connection->queryResult($query);

        $user = new User();
        while($rows = $result->fetch(PDO::FETCH_ASSOC))
        {

            $user->id = $rows['id'];
            $user->firstName  = $rows['firstName'];
            $user->lastName  = $rows['lastName'];
            $user->username  = $rows['username'];
            $user->password  = $rows['password'];
            $user->isAdmin = $rows['isAdmin'];
        }

        return $user->firstName . " " . $user->lastName;
    }

    public function save(User $user)
    {
        if($user->id!=null)
            $this->update($user);
        else
            $this->insert($user);
    }

    public function delete($id)
    {
        $query = "DELETE FROM `users` WHERE id=$id";

        $result = $this-> connection->queryResult($query);
    }
}