<!DOCTYPE html>
<html lang="en">

<?php require("include/head.php");
// define('GAME_URL', 'https://bafbi.github.io/glagla/');
define('GAME_URL', 'http://localhost/glagla/');

$emptyFile = false;
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

require("include/connect_db.php");
require("backend/interactDB.php");


if (!isset($_SESSION["username"])) {
    header("Location:login.php");
    die();
}

if (isset($_POST['generator'])) {
    $size = $_POST['size'];
    $diff = $_POST['diff'];
    $path = getcwd();
    $map_name = "map.json";
    $prog_name = "PathGenerator.exe";
    $cmd = "$path\\backend\\$prog_name gen $size $size $diff $map_name";
    exec("$path\\backend\\$prog_name gen $size $size $diff $map_name");
    exec("$path\\backend\\$prog_name solve $size $size $diff $map_name");
    $raw_data = file_get_contents("exported/map.json");
    $solved_info = json_decode(file_get_contents("solved/map.json"));
    $move_count = count($solved_info->path);
    echo $move_count;
    $game_location = GAME_URL . '?map-data=' . $raw_data;//.'&path=' . json_encode($solved_info->path);
    $game_location = str_replace(array("\n", "\r"), '', $game_location);
    header("Location:$game_location");
}

if (isset($_POST["upload"])) {  // if the user has submitted the form
    if (isset($_POST["map_json"])) {  // if the user pressed the publish button
        $map = $_POST["map_json"];
        if (isset($_POST["map_id"])) { // if the user is on edit mode
            $map_id = $_POST["map_id"];
            $map_name = $_POST["map_name"];
            $ret = update_map($map, $map_name, $map_id);
            header("Location:create.php");
            die();
        }
    } else {
        $_file = $_FILES["map_file"]["tmp_name"]; // On choppe le nom du fichier
        try {
            $map = file_get_contents($_file); // On lit le texte
            
            $solved_info = json_decode($map);
            $size = $solved_info->width;
            $diff = "1";
            $path = getcwd();
            $map_name = "map.json";
            $prog_name = "PathGenerator.exe";
            exec("$path\\backend\\$prog_name solve $size $size $diff $map_name");
            $solution = file_get_contents("solved/map.json");

        } catch (\Throwable $th) {
            $emptyFile = true;  // On indique que le fichier est vide
            goto here;
        }
        unlink($_file); // On supprime le fichier temp
    }

    $map_name = $_POST["map_name"];
    print_r($solution);
    $ret = upload_map($map, $map_name, $solution);
    $uid = get_uid();
    if (!$ret) echo "$ret, $uid";
    //header("Location:create.php");
}

here:

?>

<body>
    <link rel="stylesheet" href="static/forum.css">
     <?php
    //require("include/nav.php");
    ?> 




    <div id="case" class="row-container">
        <form action="create.php" method="post" class="map_generator">
            <label>Map size :</label>
            <input type="number" name="size" min=5 max=100 value=10>
            <label>Difficulty :</label>
            <select name="diff">
                <option value="1">Easy</option>
                <option value="2">Medium</option>
                <option value="3">Hard</option>
            </select>
            <!-- <input type="number" min=1 max=3 name="diff" value=1> -->
            <input type="submit" name="generator" value="Gen new map">
        </form>

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
                echo '<label id="upload_label">Select map file <input type="file" name="map_file" value="Upload a map" hidden></label>';
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
    <?php require("include/foot.php") ?>
</body>

</html>