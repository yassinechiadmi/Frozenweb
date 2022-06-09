<?php require("include/head.php"); ?>

<head>
    <link rel="stylesheet" href="static/rank.css">
</head>

<body>
    <?php require("include/nav.php"); ?>
    <div class="center-div">
        <!-- <div class="sub-bg"> -->
        <br>
        <div class="tbl-header">
            <h1>Community rank</h1>
            <!-- <form action="" method="get">
                <label style="color:white;">Select difficulty:
                    <select name="diff" method="get">
                        <option value="">...</option>
                        <option value="1" <?php if (isset($_GET["diff"]) && $_GET["diff"] == 1) echo "selected='selected'"; ?>>Easy</option>
                        <option value="2" <?php if (isset($_GET["diff"]) && $_GET["diff"] == 2) echo "selected='selected'"; ?>>Medium</option>
                        <option value="3" <?php if (isset($_GET["diff"]) && $_GET["diff"] == 3) echo "selected='selected'"; ?>>Hard</option>
                    </select>
                </label>
                <input type="submit" value="Select" style="width: fit-content; height: fit-content;">
            </form> -->
            <table>
                <tr>
                    <th>Rank</th>
                    <th>Username</th>
                    <th>Score</th>
                    <!-- <th>Date</th> -->
                </tr>
                <table>
        </div>
        <div class='tbl-content'>
            <table>
                <?php
                require("include/connect_db.php");
                $diff = isset($_GET["diff"]) ? $_GET["diff"] : 1;
                $str = "SELECT user.id, user.username, SUM(move) / COUNT(DISTINCT score.map_id) as score FROM user INNER JOIN score ON user.id = score.user_id GROUP BY score.user_id ORDER BY score ";
                $req = mysqli_query($connexion, $str);
                if ($req) {
                    $r = 1;
                    while ($row = mysqli_fetch_assoc($req)) {
                        // print_r($row);
                        $u_name = $row['username'];
                        $u_score = $row['score'];
                        $id = (isset($_SESSION['username']) && $u_name == $_SESSION['username']) ? 'log_user' : "";
                        echo "<tr id='$id'><td>$r</td><td>$u_name</td><td>$u_score</td></tr>";
                        $r += 1;
                    }
                } else {
                    echo "arrarazd";
                }

                ?>
            </table>

        </div>
        <!-- </div> -->

    </div>
    <?php require("include/foot.php") ?>
</body>

</html>