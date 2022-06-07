<?php require('include/head.php'); ?>

<head>
    <link rel="stylesheet" href="static/register.css" />
</head>

<body>

    <?php
    require("include/nav.php");
    require('include/connect_db.php');
    require('backend/interactDB.php');
    if (isset($_SESSION['username'])) {
    ?>

        <div class="text-background">
            <!-- <div class="profile-container">
                <h4>Highest scores :</h4>
                <ul role="list">
                    <li>Easy : </li>
                    <li>Medium : </li>
                    <li>Hard : </li>
                </ul>
                <img src="rs/logo.gif" alt="pfp">
            </div> -->
            <h4>Highest scores :</h4>
            <ul role="list">
                <?php
                require_once("include/connect_db.php");
                require_once("backend/interactDB.php");
                $uid = get_uid();
                $req = mysqli_query($connexion, "SELECT * FROM `user_stat` WHERE `userID` = '$uid'");
                $diff = ["", "Easy: ", "Medium: ", "Hard: "];
                while ($res = mysqli_fetch_assoc($req)) {
                    $score = $res['H_score'];
                    $idx = $res['difficulty'];
                    echo "<li>$diff[$idx] $score</li>";
                }
                ?>
            </ul>
            <br>
            <form method="post" id="edit-username-form" class="dropdown-form" action="<?php edit_username(); ?>">

                <label>Change username - current : <?php echo $_SESSION['username']; ?></label>
                <input name="username" class="dropdown-input" type="text">
            </form>
            <form method="post" id="edit-password-form" class="dropdown-form" action="<?php edit_password(); ?>">
                <label>Change Password : </label>
                <input type="password" name="password" class="dropdown-input">
            </form>
        </div>

        <div class="skins-container">
            
        </div>

    <?php
    }

    if (!$connexion) {
        echo "Error while logging in" . mysqli_connect_errno();
        die();
    }

    ?>
</body>

</html>