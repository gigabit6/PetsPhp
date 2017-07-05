
<?php
require_once('../repos/CommentRepo.php');
require_once('../entities/Comment.php');
if (isset($_POST['comment']) && isset($_POST['petId']) && isset($_POST['userId'])) {
    $comment = new Comment;
    $comment->comment = htmlspecialchars(trim($_POST['comment']));
    $comment->petId = htmlspecialchars(trim($_POST['petId']));
    $comment->userId = htmlspecialchars(trim($_POST['userId']));

    $repo = new CommentRepo();
    $repo->save($comment);

    header("Location: pet-details.php?id=".$_POST['petId']);
}