<?php
require_once "../partials/header.php";
require_once "../partials/sidebar.php";
require_once('../repos/PetRepo.php');
require_once('../entities/Pet.php');

$repo = new PetRepo();
$pets = $repo->getAllMyPets();

?>
    <div class="row">
        <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-7 col-md-offset-2">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    foreach ($pets as $key => $value) :
                        ?>

                        <div class="panel panel-default" style="width: 330px; display: inline-block">

                            <div class="panel-heading text-center"><a
                                    href="pet-details.php?id=<?= $pets[$key]->id ?>"><span><?= $pets[$key]->name ?></span></a>
                            </div>
                            <?= file_exists("uploaded/" . $pets[$key]->picture) ? '<img src="' . "uploaded/" . $pets[$key]->picture . '" style="max-width:300px; display:block;margin:auto">' : '' ?>
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