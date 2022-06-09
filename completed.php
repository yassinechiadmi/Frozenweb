<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
require("include/head.php");
// session_start();


require_once("include/connect_db.php");
require_once("backend/interactDB.php");



if (!isset($_POST['id'])) {
    header("Location:index.php");
    die();
} elseif (!isset($_SESSION["username"])) {
    header("Location:login.php");
    die();
}


$map_id = $_POST['id'];
$user_id = get_uid();
$move = $_POST['move'];
// echo $map_id . " " . $user_id . " " . $move;
$mes = "the unregistered map";
$map_name = "";

if ($map_id != "null") {
    $mes = "the map";
    $res = mysqli_query($connexion, "SELECT move from score WHERE map_id = $map_id AND user_id = $user_id");
    
    if (!$res or mysqli_num_rows($res) == 0) {
        $res = mysqli_query($connexion, "INSERT INTO `score` (`id`, `user_id`, `map_id`, `move`) VALUES (NULL, '$user_id', '$map_id', '$move')");
    } else {
        if ($res = mysqli_fetch_assoc($res)['move'] > $move) {
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
            <h1>Congratulation !</h1>
            <?php
            echo "<h3>You completed the map in <strong>$move</strong> moves</h3>"
            ?>
            <a class="retry-button" href="glagla/"></a>
        </div>

    </div>


    <?php require("include/foot.php") ?>

</body>

</html>