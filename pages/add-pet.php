<?php
require_once('../repos/PetRepo.php');
require_once('../entities/Pet.php');
if (isset($_POST['name']) && isset($_POST['type'])) {
    $pet = new Pet();

    $pet->name = htmlspecialchars(trim($_POST['name']));
    $pet->type = htmlspecialchars(trim($_POST['type']));

    $target_dir = "uploaded/";
    $ext = pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION);

    $target_file = $target_dir .$pet->name.$pet->type.".".$ext ;

    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);

    $pet->picture = $pet->name.$pet->type.".".$ext;
    $repo = new PetRepo();
    $repo->save($pet);

    header("Location: pets.php");
} else {
    require_once "../partials/header.php";
    require_once "../partials/sidebar.php";
    require_once('../validations/validationAdmin.php');

    ?>
    <div class="row">
        <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-5 col-md-offset-3">
            <div class="section">
                <h1 class="text-primary text-center">Add pet</h1>

                <form method="post" action="add-pet.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="text" name="name" placeholder="Name" required class="form-control"/>
                    </div>
                    <div class="form-group">
                        <select name="type" required class="form-control">
                            <option value="" disabled selected hidden>Select pet type</option>
                            <option value="Dog">Dog</option>
                            <option value="Cat">Cat</option>
                            <option value="Bird">Bird</option>
                            <option value="Hamster">Hamster</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="file" name="fileToUpload" id="fileToUpload" class="form-control" required>
                    </div>

                    <input type="submit" value="Save" class="btn btn-primary"/>
                </form>
            </div>
        </div>
    </div>
    <?php
}
require_once "../partials/footer.php"; ?>
