<?php
if (isset($_POST['id'])) {
    require_once('../repos/PetRepo.php');
    require_once('../entities/Pet.php');
    require_once('../validations/validationAdmin.php');
    $repo = new PetRepo();
    $pet = new Pet();

    $pet->id = htmlspecialchars(trim($_POST['id']));
    $pet->name = htmlspecialchars(trim($_POST['name']));
    $pet->type = htmlspecialchars(trim($_POST['type']));

    $oldPetPicture = $repo->getById($_POST['id'])->picture;
    if (basename($_FILES["fileToUpload"]["name"]) != "" && basename($_FILES["fileToUpload"]["name"]) != null) {
        $pet->picture = htmlspecialchars(trim(basename($_FILES["fileToUpload"]["name"])));

        $target_file = "uploaded/" . basename($_FILES["fileToUpload"]["name"]);

        $uploadOk = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
    }
    else{
        $pet->picture = $oldPetPicture;
    }
    $repo->save($pet);
    header("Location: pets.php");
}
?>

<?php
require_once "../partials/header.php";
require_once "../partials/sidebar.php";
require_once('../repos/PetRepo.php');
require_once('../entities/Pet.php');
require_once('../validations/validationAdmin.php');
if (isset($_GET['id'])) {
    $pet = new Pet();
    $repo = new PetRepo();
    $pet = $repo->getById($_GET['id']);
}
?>
    <div class="row">
        <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-5 col-md-offset-3">
            <div class="section">
                <h1 class="text-primary text-center">Edit pet</h1>

                <form method="post" action="edit-pet.php" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $pet->id ?>" required/>

                    <div class="form-group">
                        <input type="text" name="name" value="<?= $pet->name ?>" placeholder="Name" required
                               class="form-control"/>
                    </div>
                    <div class="form-group">
                        <input type="text" name="type" value="<?= $pet->type ?>" placeholder="Type" required
                               class="form-control"/>
                    </div>
                    <div class="form-group">
                        <input type="file" name="fileToUpload" id="fileToUpload" class="form-control">
                    </div>

                    <input type="submit" value="Save" class="btn btn-primary"/>
                </form>
            </div>
        </div>
    </div>
<?php require_once "../partials/footer.php"; ?>