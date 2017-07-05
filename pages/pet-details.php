<?php
require_once "../partials/header.php";
require_once "../partials/sidebar.php";
require_once('../repos/PetRepo.php');
require_once('../entities/Pet.php');
require_once('../repos/UserRepo.php');
require_once('../entities/User.php');
if (isset($_GET['id'])) {
    $pet = new Pet();
    $repo = new PetRepo();
    $pet = $repo->getById($_GET['id']);
}
?>
<div class="row">
    <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-5 col-md-offset-3">
        <div class="section">
            <h1 class="text-primary text-center">Details</h1>

            <p>Name: <span class="text-primary"><?= $pet->name ?></span></p>

            <p>Type: <span class="text-primary"><?= $pet->type ?></span></p>

            <?=file_exists("uploaded/".$pet->picture)?'<img src="'."uploaded/".$pet->picture.'" style="max-width:400px">':''?>

        </div>
        <div class="well text-center">
        <form action="add-comment.php" method="post">
            <input type="text" name="comment" placeholder="Comment" required class="form-control"/>
            <input type="hidden" name="petId" value="<?= $pet->id ?>" required/>
            <input type="hidden" name="userId" value="<?= ($_SESSION['id']) ?>" required/>
            <input type="submit" value="Add Comment" class="btn btn-primary"/>
        </form>
        </div>
        <div class="well">
        <ul>
        <?php
        require_once('../repos/CommentRepo.php');
        require_once('../entities/Comment.php');
        $repo = new CommentRepo();
        $comments = $repo->getAllByPetId($pet->id);
        foreach ($comments as $key => $value) :
        ?>

                <li><strong><?php $repo = new UserRepo();
                        echo $repo->getById($comments[$key]->userId)->username ?>: </strong><?= $comments[$key]->comment ?></li>
            <?php
        endforeach;
        ?>
        </ul>
        </div>
    </div>
</div>
<?php require_once "../partials/footer.php"; ?>
