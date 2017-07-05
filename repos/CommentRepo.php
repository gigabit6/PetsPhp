<?php

require_once('../entities/Connection.php');

class CommentRepo
{
    private $connection;
    function __construct(){
        $this->connection = new Connection();
    }


    function insert(Comment $comment)
    {

        $query = "INSERT INTO comments(petId,userId, comment) VALUES ('$comment->petId','$comment->userId','$comment->comment')";

        $result = $this->connection->queryResult($query);

    }

    public function update(Comment $comment){

        $query = "UPDATE `comments` SET `id`='$comment->id',`petId`='$comment->petId',`userId`='$comment->userId',`comment`='$comment->comment'  WHERE id=$comment->id";

        $result = $this->connection->queryResult($query);
    }


    public function getAll()
    {
        $query = "SELECT * FROM `comments`";

        $result = $this-> connection-> queryResult($query);
        $comments = array();
        while($rows = $result->fetch(PDO::FETCH_ASSOC))
        {
            $comment = new Comment();
            $comment->id = $rows['id'];
            $comment->petId  = $rows['petId'];
            $comment->userId  = $rows['userId'];
            $comment->comment  = $rows['comment'];

            array_push($comments,$comment);
        }

        return $comments;
    }

    public function getAllByPetId($id)
    {
        $query = "SELECT * FROM `comments`WHERE petId=$id";

        $result = $this-> connection-> queryResult($query);
        $comments = array();
        while($rows = $result->fetch(PDO::FETCH_ASSOC))
        {
            $comment = new Comment();
            $comment->id = $rows['id'];
            $comment->petId  = $rows['petId'];
            $comment->userId  = $rows['userId'];
            $comment->comment  = $rows['comment'];

            array_push($comments,$comment);
        }

        return $comments;
    }

    public function getById($id){
        $query = "SELECT * FROM `comments` WHERE id=$id";

        $result = $this-> connection->queryResult($query);

        $comment = new Comment();
        while($rows = $result->fetch(PDO::FETCH_ASSOC))
        {
            $comment->id = $rows['id'];
            $comment->petId  = $rows['petId'];
            $comment->userId  = $rows['userId'];
            $comment->comment  = $rows['comment'];
        }

        return $comment;
    }


    public function save(Comment $comment)
    {
        if($comment->id!=null)
            $this->update($comment);
        else
            $this->insert($comment);
    }

    public function delete(Comment $comment)
    {

        $query = "DELETE FROM `comments` WHERE id=$comment->id";

        $result = $this-> connection->queryResult($query);
    }
}