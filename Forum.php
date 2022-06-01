<!DOCTYPE html>
<html lang="en">

<?php require("include/head.php"); 
if(isset($_SESSION["username"]))
    header('location:index.php');
?>

<body>
    <link rel="stylesheet" href="static/forum.css">
    <?php 
        require("include/nav.php"); 
        if (isset($_SESSION["username"]))
        {
    ?>

    <div id="case">
        <form method="post" action="" class="logform">

            <h1> Upload a map </h1>
            <!-- <input type="file" name="map" value="Upload a map"> -->
            <?php
                $data = isset($_GET['map-data']) ? $_GET['map-data'] : "";
                echo "<input type='text' name='map' placeholder='Map data' value='$data'>";
            ?>
            <input type="text" name="map_name" placeholder="Map name">
            <input type="submit" name="upload" value="Upload map">

        </form>
    </div>

    <?php }?>

    <div class="map-container">
        <h2 style="color: white; text-align: center; text-shadow: 2px 2px 4px rgb(0 0 0);">Community maps</h2>
        <?php
        require("include/connect_db.php");
        require("backend/interactDB.php");
        $req = mysqli_query($connexion, "SELECT `userID`, `map_name` from `user_map`");
        if($req == true){
            while ($res = mysqli_fetch_assoc($req)) {
                $user = get_username($res['userID']);
                $map_name = $res['map_name'];
                echo
                "<div class='text-background' style='width: 90%;'>
                        <label>Username: $user</label>
                        <label for='map_name'>Map name: $map_name</label>
                </div>";
            }
        }
        ?>
    </div>

    <?php require("include/foot.php") ?>
</body>

</html>

<?php

if (isset($_POST["upload"])) {
    // require("backend/interactDB.php");
    $map = $_POST["map"];
    $map_name = $_POST["map_name"];
    $ret = upload_map($map, $map_name);
    $uid = get_uid();
    if (!$ret) echo "$ret, $uid";
    header("Location:Forum.php");
}
?>