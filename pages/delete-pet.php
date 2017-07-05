<?php

require_once('../repos/PetRepo.php');
require_once('../entities/Pet.php');

$repo = new PetRepo();
unlink ("uploaded/".$repo->getById($_GET['id'])->picture );
$repo->delete($_GET['id']);

header("Location: pets.php");
