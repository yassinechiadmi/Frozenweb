<?php
// define('GAME_URL', 'http://localhost:5500/');
define('GAME_URL', 'https://bafbi.github.io/glagla/');
require("include/head.php") ?>

<body>

    <?php require("include/nav.php"); ?>

    <div class="selector">
        <label>Official Maps</label>
        <div id="left_arrow" class="arrow left" style="opacity: 0;"><img src="rs/arrown.png" alt=""></div>
        <ul id="level_list" class="level-list">

            <?php
            require_once("include/connect_db.php");
            require_once("backend/interactDB.php");
            $req = mysqli_query($connexion, "SELECT * from user_map WHERE is_official = 1");
            if ($req == true) {
                while ($res = mysqli_fetch_assoc($req)) {
                    $data = $res["map"];
                    $map_name = $res["map_name"];
                    $u_name = get_username($res["userID"]);
                    echo "<li>
                            <a href='" . GAME_URL . "' data-map='$data' class='card'>
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

    <div class="selector">
        <label>Community Maps</label>
        <div id="left_arrow" class="arrow left" style="opacity: 0;"><img src="rs/arrown.png" alt=""></div>
        <ul id="level_list" class="level-list">

            <?php
            require_once("include/connect_db.php");
            require_once("backend/interactDB.php");
            $req = mysqli_query($connexion, "SELECT * from user_map WHERE is_official != 1");
            if ($req == true) {
                while ($res = mysqli_fetch_assoc($req)) {
                    $data = $res["map"];
                    $map_name = $res["map_name"];
                    $u_name = get_username($res["userID"]);
                    echo "<li>
                            <a href='" . GAME_URL . "' data-map='$data' class='card'>
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