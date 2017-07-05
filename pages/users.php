<?php

require_once "../partials/header.php";
require_once "../partials/sidebar.php";
require_once('../repos/UserRepo.php');
require_once('../entities/User.php');
require_once('../validations/validationAdmin.php');
?>
<div class="row">
    <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-5 col-md-offset-3">
 <?php if ($_SESSION['isAdmin'] == 1) {
     echo '<div class="text-center"><a href="add-user.php" class="btn btn-primary btn-lg btn-block">Add new</a></div>';
 }?>
        <table class="table table-stripped"
            <tr>
                <th>First Name: </th>
                <th>Last Name: </th>
                <th>Is Admin: </th>
                <th>Actions: </th>
            </tr>
        <?php
        $repo = new UserRepo();
        $users = $repo->getAll();
        foreach($users as $key=>$value) :
        ?>

        <tr>
            <td><a href="user-details.php?id=<?= $users[$key]->id ?>" ><?= $users[$key]->firstName ?></a></td>
            <td><a href="user-details.php?id=<?= $users[$key]->id ?>" ><?= $users[$key]->lastName ?></a></td>
            <td><?php echo $users[$key]->isAdmin == 0 ?  'No' :  'Yes' ?></td>
            <?php if($_SESSION['isAdmin']==1) : ?>

                <td>
                    <a href="edit-user.php?id=<?= $users[$key]->id ?>" ><img src="../img/edit-user.png" width="30px"></a>
                    <a href="delete-user.php?id=<?= $users[$key]->id ?>" > <img src="../img/delete-user.png" width="35px"></a>
                </td>
                <?php
            endif;
            endforeach;
            ?>
         </tr>
        </table>
    </div>
</div>
<?php require_once "../partials/footer.php"; ?>