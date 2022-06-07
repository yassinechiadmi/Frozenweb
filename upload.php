<!DOCTYPE html>
<html lang="en">

<?php require("include/head.php");

$emptyFile = false;

require("include/connect_db.php");
require("backend/interactDB.php");

session_start();

if (isset($_POST["upload"])) {
    if (isset($_POST["map_json"])) {
        $map = $_POST["map_json"];
        if (isset($_POST["map_id"])) {
            $map_id = $_POST["map_id"];
            $map_name = $_POST["map_name"];
            $ret = update_map($map, $map_name, $map_id);
            header("Location:upload.php");
            die();
        }
    } else {
        $_file = $_FILES["map_file"]["tmp_name"]; // On choppe le nom du fichier
        try {
            $map = file_get_contents($_file); // On lit le texte

        } catch (\Throwable $th) {
            $emptyFile = true;  // On indique que le fichier est vide
            goto here;
        }
        unlink($_file); // On supprime le fichier temp
    }

    $map_name = $_POST["map_name"];
    $ret = upload_map($map, $map_name);

    $uid = get_uid();
    if (!$ret) echo "$ret, $uid";
    header("Location:upload.php");
}

here:

?>

<body>
    <link rel="stylesheet" href="static/forum.css">
    <?php
    require("include/nav.php");
    if (isset($_SESSION["username"])) {
    ?>

        <div id="case">
            <form method="post" action="" enctype="multipart/form-data" class="logform">


                <?php
                $preName = "";
                if (isset($_GET['map-data'])) {
                    $data = $_GET['map-data'];
                    if (isset($_GET['map-id'])) {
                        echo  "<h1> Edit the map </h1>";
                        $preName = get_map_name($_GET['map-id']);
                        echo "<input type='hidden' name='map_id' value='" . $_GET['map-id'] . "'>";
                    } else {
                        echo  "<h1> Publish the map </h1>";
                    }

                    echo "<input type='text' name='map_json' placeholder='Map data' value='$data'>";
                } else {
                    echo  "<h1> Upload a map </h1>";
                    echo '<label id="upload_label">Select file <input type="file" name="map_file" value="Upload a map" hidden></label>';
                    if ($emptyFile)
                        echo "<span class='error'>FICHIER VIDE</span>";
                }

                ?>
                <input type="text" name="map_name" placeholder="Map name" value="<?php echo $preName ?>">
                <input type="submit" name="upload" value="Upload map">

            </form>
        </div>



        <div class="map-container">
            <h2 style="color: white; text-align: center; text-shadow: 2px 2px 4px rgb(0 0 0);">Your maps</h2>
            <?php
            $uid = get_uid();
            $req = mysqli_query($connexion, "SELECT * from `user_map` WHERE `userID` = $uid");
            if ($req == true) {
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
                            <a id='edit' href='https://bafbi.github.io/2d-tilemap-editor/?map-id=$map_id&map-data=$map'>Edit</a>
                        </span> 
                </div>";
                } // https://bafbi.github.io/2d-tilemap-editor/
            }
            ?>
        </div>
    <?php } ?>
    <?php require("include/foot.php") ?>
</body>

</html>