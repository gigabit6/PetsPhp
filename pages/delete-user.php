<?php

require_once('../repos/UserRepo.php');
require_once('../entities/User.php');
require_once('../validations/validationAdmin.php');

$repo = new UserRepo();
$repo->delete($_GET['id']);

header("Location: users.php");
