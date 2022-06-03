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
        <form method="post" action="" enctype="multipart/form-data" class="logform">

            <h1> Upload a map </h1>
            <label>Map file: 
                <input style="margin-left: 20px;" type="file" name="map" value="Upload a map">
            </label>
            <!-- <?php
                $data = isset($_GET['map-data']) ? $_GET['map-data'] : "";
                echo "<input type='text' name='map' placeholder='Map data' value='$data'>";
            ?> -->
            <input type="text" name="map_name" placeholder="Map name">
            <input type="submit" name="upload" value="Upload map">

        </form>
    </div>

    <div class="map-container">
        <h2 style="color: white; text-align: center; text-shadow: 2px 2px 4px rgb(0 0 0);">Your maps</h2>
        <?php
        require("include/connect_db.php");
        require("backend/interactDB.php");
        $uid = get_uid();
        $req = mysqli_query($connexion, "SELECT * from `user_map` WHERE `userID` = $uid");
        if($req == true){
            while ($res = mysqli_fetch_assoc($req)) {
                $user = get_username($res['userID']);
                $map_name = $res['map_name'];
                $map_id = $res["map_id"];
                $map = $res["map"];
                echo
                "<div class='text-background' style='width: 90%;'>
                        <label>Username: $user</label>
                        <label for='map_name'>Map name: $map_name</label>
                        <span>
                            <a id='del' href='del_map.php?map_id=$map_id'>Delete</a>
                            <a id='edit' href='https://bafbi.github.io/2d-tilemap-editor/?map-data=$map'>Edit</a>
                        </span>
                </div>";            
            }
        }
        ?>
    </div>
    <?php }?>
    <?php require("include/foot.php") ?>
</body>

</html>

<?php

if (isset($_POST["upload"])) {
    $_file = $_FILES["map"]["tmp_name"]; // On choppe le nom du fichier
    $map = file_get_contents($_file); // On lit le texte
    if ($map == "") header("Location:upload.php");
    unlink($_file); // On supprime le fichier temp
    $map_name = $_POST["map_name"];
    $ret = upload_map($map, $map_name);
    $uid = get_uid();
    if (!$ret) echo "$ret, $uid";
    header("Location:upload.php");
}
?>