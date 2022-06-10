<?php require("include/head.php"); ?>

<head>
    <link rel="stylesheet" href="static/rank.css">
</head>

<body>
    <?php require("include/nav.php"); ?>
    <div class="center-div">
        <br>
        <div class="tbl-header">
            <h1>Community rank</h1>
            <table>
                <tr>
                    <th>Rank</th>
                    <th>Username</th>
                    <th>Score</th>
                    <th>Nb level</th>
                    <!-- <th>Date</th> -->
                </tr>
                <table>
        </div>
        <div class='tbl-content'>
            <table>
                <?php
                require("include/connect_db.php");
                $diff = isset($_GET["diff"]) ? $_GET["diff"] : 1;
                $str = "SELECT user.id, user.username, SUM(move) as score, COUNT(DISTINCT score.map_id) as nb FROM user INNER JOIN score ON user.id = score.user_id GROUP BY score.user_id ORDER BY score DESC, nb DESC, username ASC";
                $req = mysqli_query($connexion, $str);
                if ($req) {
                    $r = 1;
                    while ($row = mysqli_fetch_assoc($req)) {
                        $u_name = $row['username'];
                        $u_score = $row['score'];
                        $u_nb = $row['nb'];
                        $id = (isset($_SESSION['username']) && $u_name == $_SESSION['username']) ? 'log_user' : "";
                        echo "<tr id='$id'><td>$r</td><td>$u_name</td><td>$u_score</td><td>$u_nb</td></tr>";
                        $r += 1;
                    }
                } else {
                    echo "arrarazd";
                }

                ?>
            </table>

        </div>

    </div>
    <?php require("include/foot.php") ?>
</body>

</html>