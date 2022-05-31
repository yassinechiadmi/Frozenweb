<?php require("include/head.php") ?>

<body>
    <?php require("include/nav.php"); ?>
    <div style="overflow: scroll; max-height: 60vh; background-color: rgba(20, 20, 20, 0.8); padding: 20px; width: 900px;">
        <?php
        require("include/connect_db.php");
        $req = mysqli_query($connexion, "SELECT `userID`, `map_name` from `user_map`");
        while ($res = mysqli_fetch_assoc($req)) {
            $user = $res['userID'];
            $map_name = $res['map_name'];
            echo
            "<div class='text-background'>
                    <h4>Community maps</h4>
                    <label>Username: $user</label>
                    <label for='map_name'>Map name: $map_name</label>
                </div>";
        }
        ?>
    </div>
    <?php require("include/foot.php") ?>
</body>

</html>