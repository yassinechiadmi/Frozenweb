<?php
define('GAME_URL', 'http://localhost/glagla/');
// define('GAME_URL', 'https://bafbi.github.io/glagla/');
require("include/head.php") ?>

<body>

    <?php require("include/nav.php"); ?>

    <?php
    require_once("include/connect_db.php");
    if(isset($_POST['rng'])){
        $req_umap = mysqli_query($connexion, "SELECT * from user_map");
        $map_array = array();
        if ($req_umap == true) {
            while ($res_map = mysqli_fetch_assoc($req_umap)) {
                $data_map = $res_map["map"];
                array_push($map_array,$data_map);
            }
            $rand_number = rand(0,count($map_array));
            $endpoint = $map_array[$rand_number];
            $newloc = GAME_URL.'?map-data='.$endpoint;
            $newloc = str_replace(array("\n","\r"," "),'',$newloc);  
            header("Location:$newloc");      
            // echo "<meta http-equiv='refresh' content='0;url=$newloc'>";
        }


    }
    ?>
    <form action="game.php" method="post" style="margin-inline: auto; width: max-content;">
        <input type="submit" name="rng" value="Random map" style="width: 50vw;">
    </form>
    <div class="selector">
        <label>Official maps</label>
        <div id="left_arrow_offi" class="arrow left" style="opacity: 0;"><img src="rs/arrown.png" alt=""></div>
        <ul id="level_list_offi" class="level-list">

            <?php
            require_once("include/connect_db.php");
            require_once("backend/interactDB.php");
            $req = mysqli_query($connexion, "SELECT * from user_map WHERE is_official = 1");
            if ($req == true) {
                while ($res = mysqli_fetch_assoc($req)) {
                    $data = $res["map"];
                    $path = $res["solution"];
                    $id = $res["map_id"];
                    $map_name = $res["map_name"];
                    $u_name = get_username($res["userID"]);
                    echo "<li>
                            <a href='" . GAME_URL . "' data-map='$data' data-id='$id' data-path='$path' class='card'>
                                <img src='' class='card__image' alt='' />
                                <div class='card__header'>
                                    <h3 class='card__title'>$map_name</h3>
                                    <span class='card__status'>$u_name</span>
                                </div>
                            </a>
                        </li>";
                }
            }
            ?>
        </ul>
        <div id="right_arrow_offi" class="arrow right"><img src="rs/arrown.png" alt=""></div>

    </div>

    <div class="selector">
        <label>Community maps</label>
        <div id="left_arrow" class="arrow left" style="opacity: 0;"><img src="rs/arrown.png" alt=""></div>
        <ul id="level_list" class="level-list">

            <?php
            require_once("include/connect_db.php");
            require_once("backend/interactDB.php");
            $req = mysqli_query($connexion, "SELECT * from user_map WHERE is_official != 1");
            if ($req == true) {
                while ($res = mysqli_fetch_assoc($req)) {
                    $data = $res["map"];
                    $path = json_encode(json_decode($res["solution"])->path);
                    $id =  $res["map_id"];
                    $map_name = $res["map_name"];
                    $u_name = get_username($res["userID"]);
                    echo "<li>
                            <a href='" . GAME_URL . "' data-map='$data' data-id='$id' data-path='$path' class='card'>
                                <img src='' class='card__image' alt='' />
                                <div class='card__header'>
                                    <h3 class='card__title'>$map_name</h3>
                                    <span class='card__status'>$u_name</span>
                                </div>
                            </a>
                        </li>";
                }
            }
            ?>
        </ul>
        <div id="right_arrow" class="arrow right"><img src="rs/arrown.png" alt=""></div>

    </div>


    <?php require("include/foot.php") ?>
    <script src="static/preview.js"> </script>

</body>

</html>