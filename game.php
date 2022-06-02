<?php
define('GAME_URL', 'http://localhost:5500/');
require("include/head.php") ?>

<body>

    <?php require("include/nav.php"); ?>


    <div class="selector">
        <div id="left_arrow" class="arrow left" style="opacity: 0;"><img src="rs/arrown.png" alt=""></div>
        <ul id="level_list" class="level-list">

            <?php
            require_once("include/connect_db.php");
            require_once("backend/interactDB.php");
            $req = mysqli_query($connexion, "SELECT * from user_map");
            if ($req == true) {
                while ($res = mysqli_fetch_assoc($req)) {
                    $data = $res["map"];
                    $map_name = $res["map_name"];
                    echo "<li>
                            <a href='" . GAME_URL . "' data-map='$data' class='card'>
                                <img src='' class='card__image' alt='' />
                                <div class='card__header'>
                                    <h3 class='card__title'>$map_name</h3>
                                    <span class='card__status'>EASY</span>
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