<?php
require("include/head.php");
require("include/nav.php");

// session_start();

if (!isset($_POST['id'])) {
    header("Location:index.php");
    // die();
} elseif (!isset($_SESSION['username'])) {
    echo "pas de username<br>";
    var_dump($_SESSION);
    // header("Location:login.php");
    // die();
}

require("include/connect_db.php");
require("backend/interactDB.php");

$map_id = $_POST['id'];
$user_id = get_uid($_SESSION['username']);
$move = $_POST['move'];
// echo $map_id . " " . $user_id . " " . $move;
$mes = "the unregister map";
if ($map_id != "null") {
    $mes = "the map";
    $res = mysqli_query($connexion, "SELECT move from score WHERE map_id = $map_id AND user_id = $user_id");

    if (mysqli_num_rows($res) == 0) {
        // echo "No score found";
        $res = mysqli_query($connexion, "INSERT INTO `score` (`id`, `user_id`, `map_id`, `move`) VALUES (NULL, '$user_id', '$map_id', '$move')");
        // if ($res) {
        //     echo "Score inserted";
        // } else {
        //     echo "Score not inserted";
        //     echo mysqli_error($connexion);
        // }
    } else {
        if (mysqli_fetch_assoc($res)['move'] > $move) {
            mysqli_query($connexion, "UPDATE `score` SET `move`=$move WHERE `map_id` = $map_id AND `user_id` = $user_id");
        }
    }
}

?>

<head>
    <link rel="stylesheet" href="static/completed.css">
</head>

<body>

    <?php require("include/nav.php"); ?>

    <div class="center-div">
        <div class="panel">
            <h1>Congratulation</h1>
            <?php
            echo "<h3>You completed $mes in <strong>$move</strong> move</h3>"
            ?>
            <a class="retry-button" href="http://localhost:5500/"></a>
        </div>

    </div>


    <?php require("include/foot.php") ?>

</body>

</html>