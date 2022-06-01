<?php require("include/head.php");?>
<head>
    <link rel="stylesheet" href="static/rank.css">
</head>
<body>
    <?php require("include/nav.php");?>
    <div class="center-div">
        <!-- <div class="sub-bg"> -->

        <?php
        require("include/connect_db.php");
        $diff = 1;
        $str = "SELECT id,username,H_score,score_date FROM user INNER JOIN user_stat ON user.id = user_stat.userID WHERE user_stat.difficulty = '$diff' ORDER BY user_stat.H_score DESC";
        $req = mysqli_query($connexion,$str);
        ?>
        <br>
        <div class="tbl-header">

            <h1>Community rank</h1>
            <!-- <h3>Check our best players !</h3> -->
            <table>
                    <tr><th>Rank</th><th>Username</th><th>Score</th><th>Date</th></tr>
            <table>
        </div>
        <div class='tbl-content'>
        <table>
            <?php
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

            
            if($req){
                $r = 1;
                while($row = mysqli_fetch_assoc($req))
                {
                    $u_name = $row['username'];
                    $u_score = $row['H_score'];
                    $u_date = $row['score_date'];
                    $id = (isset($_SESSION['username']) && $u_name == $_SESSION['username']) ? 'log_user': "";
                    echo "<tr id='$id'><td>$r</td><td>$u_name</td><td>$u_score</td><td>$u_date</td></tr>";
                    $r+=1;
                }
            }
            else{
                echo "arrarazd";
            }

            ?>
            </table>

        </div>
        <!-- </div> -->
        
    </div>
<?php require("include/foot.php")?>
</body>
</html>