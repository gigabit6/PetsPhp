<?php
require_once('../repos/UserRepo.php');
require_once('../entities/User.php');
require_once('../validations/validationAdmin.php');
if (isset($_POST['username']) && isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['password']) && isset($_POST['isAdmin'])) {
    $user = new User();

    $user->username = htmlspecialchars(trim($_POST['username']));
    $user->firstName = htmlspecialchars(trim($_POST['firstName']));
    $user->lastName = htmlspecialchars(trim($_POST['lastName']));
    $user->password = htmlspecialchars(trim($_POST['password']));
    $user->isAdmin = htmlspecialchars(trim($_POST['isAdmin']));

    $repo = new UserRepo();
    $repo->save($user);

    header("Location: users.php");
} else {
    require_once "../partials/header.php";
    require_once "../partials/sidebar.php";
    require_once('../validations/validationAdmin.php');

        ?>
    <div class="row">
        <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-5 col-md-offset-3">
            <div class="section">
                <h1 class="text-primary text-center">Add user</h1>

                <form method="post" action="add-user.php">
                    <div class="form-group">
                        <input type="text" name="username" placeholder="Username" required class="form-control"/>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" placeholder="Password" required class="form-control"/>
                    </div>
                    <div class="form-group">
                        <input type="text" name="firstName" placeholder="First Name" required class="form-control"/>
                    </div>
                    <div class="form-group">
                        <input type="text" name="lastName" placeholder="Last Name" required class="form-control"/>
                    </div>

                    <div class="form-group">
                        <select name="isAdmin" required class="form-control">
                            <option value="0"> User</option>
                            <option value="1"> Admin</option>
                        </select>
                    </div>
                    <input type="submit" value="Save" class="btn btn-primary"/>
                </form>
            </div>
        </div>
    </div>
<?php
}
require_once "../partials/footer.php"; ?>
