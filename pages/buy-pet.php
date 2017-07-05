<?php
if (isset($_POST['id'])) {
    require_once('../repos/PetRepo.php');
    require_once('../entities/Pet.php');
    require_once('../validations/validationAdmin.php');
    $repo = new PetRepo();
    $pet = $repo->getById($_POST['id']);

    $pet->ownerId = $_SESSION['id'];

    $repo->save($pet);
    header("Location: my-pets.php");
}
?>
