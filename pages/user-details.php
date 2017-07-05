<?php
require_once "../partials/header.php";
require_once "../partials/sidebar.php";
require_once('../repos/UserRepo.php');
require_once('../entities/User.php');
if (isset($_GET['id'])) {
    $user = new User();
    $repo = new UserRepo();
    $user = $repo->getById($_GET['id']);
}
?>
<div class="row">
    <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-5 col-md-offset-3">
        <div class="section">
            <h1 class="text-primary text-center">Details</h1>

            <p>Username: <span class="text-primary"><?= $user->username ?></span></p>

            <p>First Name: <span class="text-primary"><?= $user->firstName ?></span></p>

            <p>Last Name: <span class="text-primary"><?= $user->lastName ?></span></p>

            <p>Is Admin: <?php if ($user->isAdmin == 0) {
                    echo '<span class="text-primary">No</span>';
                } else {
                    echo '<span class="text-primary">Yes</span>';
                } ?></p>

        </div>
    </div>
</div>
<?php require_once "../partials/footer.php"; ?>
