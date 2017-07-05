<?php
require_once "../partials/header.php";
require_once "../partials/sidebar.php";
require_once('../repos/PetRepo.php');
require_once('../repos/UserRepo.php');
require_once('../entities/User.php');
require_once('../entities/Pet.php');
if (isset($_POST['type'])) {
    $repo = new PetRepo();
    $pets = $repo->search($_POST['type']);

} else {
    $repo = new PetRepo();
    $pets = $repo->getAll();

}

?>
    <div class="row">
        <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-7 col-md-offset-2">

            <?php if ($_SESSION['isAdmin'] == 1) {
                echo '<div class="text-center"><a href="add-pet.php" class="btn btn-primary btn-lg btn-block">Add new</a></div>';
            } ?>
            <div class="row">
                <div class="col-md-12">
                    <form action="pets.php" method="POST">
                        <select name="type" onchange="this.form.submit()" class="form-control">
                            <option value="" disabled selected hidden>Sort Pets</option>
                            <option value="all">All</option>
                            <option value="Dog">Dogs</option>
                            <option value="Cat">Cats</option>
                            <option value="Bird">Bird</option>
                            <option value="Hamster">Hamsters</option>
                        </select>
                        <input type="hidden" value="POST" name="_method">
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?php
                    foreach ($pets as $key => $value) :
                        ?>

                        <div class="panel panel-default text-center" style="width: 330px; display: inline-block">

                            <div class="panel-heading text-center"><a
                                    href="pet-details.php?id=<?= $pets[$key]->id ?>"><span><?= $pets[$key]->name ?></span></a>
                            </div>
                            <?= file_exists("uploaded/" . $pets[$key]->picture)
                                ? '<img src="' . "uploaded/" . $pets[$key]->picture . '" style="max-width:300px; display:block;margin:auto">'
                                : '' ?>
                            <?php if (($pets[$key]->ownerId == null) || $pets[$key]->ownerId == 0) : ?>

                                <form action="buy-pet.php" method="post">
                                    <input type="hidden" name="id" value="<?= $pets[$key]->id ?>" required/>
                                    <input type="submit" value="Buy Pet" class="btn btn-block btn-warning"/>
                                </form>
                            <?php endif; ?>
                            <?php if (($pets[$key]->ownerId != null) && $pets[$key]->ownerId != 0) : ?>
                                <h5>Owner: <?php $repo = new UserRepo();
                                    echo $repo->getById($pets[$key]->ownerId)->username; ?></h5>
                            <?php endif; ?>
                            <div class="panel-body text-center">
                                <h3><?= $pets[$key]->type ?></h3>
                                </br>
                                <?php if ($_SESSION['isAdmin'] == 1) : ?>
                                    <a class="btn btn-primary" href="edit-pet.php?id=<?= $pets[$key]->id ?>">Edit
                                        Pet</a>
                                    <a class="btn btn-danger" href="delete-pet.php?id=<?= $pets[$key]->id ?>">Delete
                                        Pet</a>
                                <?php endif; ?>

                            </div>
                        </div>
                        <?php
                    endforeach;
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php require_once "../partials/footer.php"; ?>