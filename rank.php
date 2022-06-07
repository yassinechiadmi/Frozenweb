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
            <form action="" method="get">
                <label style="color:white;">Select difficulty:
                    <select name="diff" method="get">
                        <option value="">...</option>
                        <option value="1" <?php if (isset($_GET["diff"]) && $_GET["diff"] == 1) echo "selected='selected'"; ?>>Easy</option>
                        <option value="2" <?php if (isset($_GET["diff"]) && $_GET["diff"] == 2) echo "selected='selected'"; ?>>Medium</option>
                        <option value="3" <?php if (isset($_GET["diff"]) && $_GET["diff"] == 3) echo "selected='selected'"; ?>>Hard</option>
                    </select>
                </label>
                <input type="submit" value="Select" style="width: fit-content; height: fit-content;">
            </form>
            <table>
                <tr>
                    <th>Rank</th>
                    <th>Username</th>
                    <th>Score</th>
                    <th>Date</th>
                </tr>
                <table>
        </div>
        <div class='tbl-content'>
            <table>
                <?php
                require("include/connect_db.php");
                $diff = isset($_GET["diff"]) ? $_GET["diff"] : 1;
                $str = "SELECT id,username,H_score,score_date FROM user INNER JOIN user_stat ON user.id = user_stat.userID WHERE user_stat.difficulty = '$diff' ORDER BY user_stat.H_score DESC";
                $req = mysqli_query($connexion, $str);
                // if(isset($_SESSION['username'])){
                //     $s = $_SESSION['username'];
                //     $str = "SELECT id,username,H_score,score_date FROM user INNER JOIN user_stat ON user.id = user_stat.userID WHERE user_stat.difficulty = '$diff' ORDER BY user_stat.H_score DESC";

                //     $req2 = mysqli_query($connexion,$str);
                //     $iterator = 1;
                //     while($res2 = mysqli_fetch_assoc($req2)){
                //         if($res2['username'] == $s){
                //             $log_score = $res2['H_score'];
                //             $log_date = $res2['score_date'];
                //             echo "<tr id='log_user'><td>$iterator</td><td>".$_SESSION['username']."</td><td>$log_score</td><td>$log_date</td></tr>";
                //             break;
                //         }
                //         $iterator +=1;
                //     }

                // }


                if ($req) {
                    $r = 1;
                    while ($row = mysqli_fetch_assoc($req)) {
                        $u_name = $row['username'];
                        $u_score = $row['H_score'];
                        $u_date = $row['score_date'];
                        $id = (isset($_SESSION['username']) && $u_name == $_SESSION['username']) ? 'log_user' : "";
                        echo "<tr id='$id'><td>$r</td><td>$u_name</td><td>$u_score</td><td>$u_date</td></tr>";
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