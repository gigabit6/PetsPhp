<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <ul class="nav menu">
        <li class="active"><a href="../pages/index.php">
                <svg class="glyph stroked dashboard-dial">
                    <use xlink:href="#stroked-dashboard-dial"></use>
                </svg>
                Dashboard</a></li>
        <?php
        if (isset($_SESSION['id'])) {
            if ($_SESSION['isAdmin'] == 1) {
                echo '

        <li class="parent ">
            <a href="../pages/users.php">
                <span data-toggle="collapse" href="#sub-item-1"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> All Users
            </a>
            <ul class="children collapse" id="sub-item-1">
                <li>
                    <a class="" href="../pages/add-user.php">
                        <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Add User
                    </a>
                </li>
            </ul>
        </li>';
            }
        }
        ?>
        <?php
        if (isset($_SESSION['id'])) {
            if ($_SESSION['isAdmin'] == 1) {
                echo '

        <li class="parent ">
            <a href="../pages/pets.php">
                <span data-toggle="collapse" href="#sub-item-2"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> All Pets
            </a>
            <ul class="children collapse" id="sub-item-2">
                <li>
                    <a class="" href="../pages/add-pet.php">
                        <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Add Pet
                    </a>
                </li>
            </ul>
        </li>';
            } else {
                echo '<li><a href="../pages/pets.php"><svg class="glyph stroked line-graph"><use xlink:href="#stroked-line-graph"></use></svg> All Pets</a></li>';
            }
        }
        ?>
        <?php
        if (isset($_SESSION['id'])) {
            echo '
        <li><a href="../pages/my-pets.php">
                <svg class="glyph stroked clipboard with paper">
                    <use xlink:href="#stroked-clipboard-with-paper"></use>
                </svg>
               My Pets</a></li>';
        }
        ?>
        <?php
        if (!isset($_SESSION['id'])) {
            echo '
        <li role="presentation" class="divider"></li>
        <li><a href="../pages/login.php">
                <svg class="glyph stroked male-user">
                    <use xlink:href="#stroked-male-user"></use>
                </svg>
                Login Page</a></li>';
        }
        ?>
    </ul>
</div><!--/.sidebar-->

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main" style="margin-top: 50px">