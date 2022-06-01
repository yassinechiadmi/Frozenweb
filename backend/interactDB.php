
<?php
// session_start();


function check_user_exists($username){
    require('include/connect_db.php');
    $req = mysqli_query($connexion,"SELECT * FROM user WHERE username = '$username'");
    return (mysqli_num_rows($req) > 0);
    // if(mysqli_num_rows($req) > 0){
    //     return True;
    // }
    // return False;
}

function edit_username(){
    require('include/connect_db.php');
    if(isset($_POST['username'])){
        if(empty($_POST['username']) or check_user_exists($_POST['username'])){
            header('location:profile.php');
            die();
        }
        $username = $_SESSION['username'];
        $new = $_POST["username"];
        $req = mysqli_query($connexion,"UPDATE user SET username = '$new' WHERE username = '$username'");
        $_SESSION['username'] = $new;
        if (isset($_COOKIE["login"])){
            setcookie('login', $new, time() + 182 * 24 * 3600, '/');
        }
        header("Location:profile.php");
    }
}

function edit_password(){
    require('include/connect_db.php');
    if(isset($_POST['password'])){
        if(empty($_POST['password'])){
            header('location:profile.php');
            die();
        }
        $username = $_SESSION['username'];
        $pwd = $_POST["password"];
        $req = mysqli_query($connexion,"UPDATE user SET password = '$pwd' WHERE username = '$username'");
        if (isset($_COOKIE["mdp"])){
            setcookie('mdp', $pwd, time() + 182 * 24 * 3600, '/');
        }
        header("Location:profile.php");
    }
}

function get_uid() {
    require('include/connect_db.php');
    $username = $_SESSION['username'];
    $res = mysqli_query($connexion, "SELECT `id` FROM `user` WHERE `username` = '$username'");
    $uid = mysqli_fetch_assoc($res)["id"];
    return $uid;
}

function get_pfp() {
    require('include/connect_db.php');
    $uid = get_uid();
    $pfp = mysqli_query($connexion, "SELECT pfp FROM user_pfp WHERE userID = '$uid'");
    return $pfp;
}

function get_username($uid)
{
    require('include/connect_db.php');
    $res = mysqli_query($connexion, "SELECT `username` FROM `user` WHERE `id` = '$uid'");
    $username = mysqli_fetch_assoc($res)["username"];
    return $username;
}

function upload_map($map, $map_name)
{
    require('include/connect_db.php');
    $uid = get_uid();
    $_map = mysqli_real_escape_string($connexion, $map);
    $text = "INSERT INTO `user_map` (`userID`, `map`, `map_name`, `map_id`) VALUES ('$uid', '$_map', '$map_name', NULL)";
    $req = mysqli_query($connexion, $text);
    return $req;
}

?>
