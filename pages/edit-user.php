<?php
if (isset($_POST['id'])) {
    require_once('../repos/UserRepo.php');
    require_once('../entities/User.php');
    require_once('../validations/validationAdmin.php');
    $repo = new UserRepo();
    $user = new User();

    $user->id = htmlspecialchars(trim($_POST['id']));
    $user->firstName = htmlspecialchars(trim($_POST['firstName']));
    $user->lastName = htmlspecialchars(trim($_POST['lastName']));
    $user->username = htmlspecialchars(trim($_POST['username']));
    $user->password = htmlspecialchars(trim($_POST['password']));
    $user->isAdmin = htmlspecialchars(trim($_POST['isAdmin']));

    $repo->save($user);
    header("Location: users.php");
}
?>

<?php
require_once "../partials/header.php";
require_once "../partials/sidebar.php";
require_once('../repos/UserRepo.php');
require_once('../entities/User.php');
require_once('../validations/validationAdmin.php');
if (isset($_GET['id'])) {
    $user = new User();
    $repo = new UserRepo();
    $user = $repo->getById($_GET['id']);
}
?>
    <div class="row">
        <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-5 col-md-offset-3">
            <div class="section">
                <h1 class="text-primary text-center">Edit user</h1>

                <form method="post" action="edit-user.php">
                    <input type="hidden" name="id" value="<?= $user->id ?>" required />
                    <div class="form-group">
                        <input type="text" name="username" value="<?= $user->username ?>"  placeholder="Username" required class="form-control"/>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password"  value="<?= $user->password ?>"  placeholder="Password" required class="form-control"/>
                    </div>
                    <div class="form-group">
                        <input type="text" name="firstName" value="<?= $user->firstName ?>"  placeholder="First Name" required class="form-control"/>
                    </div>
                    <div class="form-group">
                        <input type="text" name="lastName" value="<?= $user->lastName ?>"  placeholder="Last Name" required class="form-control"/>
                    </div>

                    <div class="form-group">
                        <select name="isAdmin" required class="form-control">
                            <option value="0" <?php if($user->isAdmin==0) {echo 'selected';} ?> > User </option>
                            <option value="1" <?php if($user->isAdmin==1) {echo 'selected';} ?> > Admin </option>
                        </select>
                    </div>
                    <input type="submit" value="Save" class="btn btn-primary"/>
                </form>
            </div>
        </div>
    </div>
<?php require_once "../partials/footer.php"; ?>