<?php

require_once('../repos/UserRepo.php');
require_once('../entities/User.php');


if(isset($_POST['username']) && isset($_POST['password'])){
    session_start();
    $username = htmlspecialchars(trim($_POST['username']));
    $password = htmlspecialchars(trim($_POST['password']));

    $user = new User();
    $repo = new UserRepo();
    $user = $repo->getByUsernameAndPassword($username,$password);

    if($user->id!=0){
        $_SESSION['id'] = $user->id;
        $_SESSION['firstName'] = $user->firstName;
        $_SESSION['lastName'] = $user->lastName;
        $_SESSION['username'] = $user->username;
        $_SESSION['password'] = $user->password;
        $_SESSION['isAdmin'] = $user->isAdmin;

        header("Location: index.php");
    }
    else{
        $msg = "Invalid username or password!";
        header("Location: login.php?error=$msg");
    }

}
else {

    include "../partials/header.php";
    include "../partials/sidebar.php";
        ?>
        <div class="row">
            <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">Log in</div>
                    <div class="panel-body">
                        <form action="login.php" method="POST">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="username" type="text"
                                           autofocus="">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password"
                                           value="">
                                </div>
                                <?php
                                if (isset($_GET['error'])) {
                                    echo '<div class="error-message">' . $_GET['error'] . '</div>';
                                }
                                ?>
                                <input type="submit" value="Login" class="btn btn-primary"/>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div><!-- /.col-->
        </div><!-- /.row -->
        <?php
    include "../partials/footer.php";
  }