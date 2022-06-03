
<?php
// session_start();


function check_user_exists($username)
{
    require('include/connect_db.php');
    $req = mysqli_query($connexion, "SELECT * FROM user WHERE username = '$username'");
    return (mysqli_num_rows($req) > 0);
}

function edit_username()
{
    require('include/connect_db.php');
    if (isset($_POST['username'])) {
        if (empty($_POST['username']) or check_user_exists($_POST['username'])) {
            header('location:profile.php');
            die();
        }
        $username = $_SESSION['username'];
        $new = $_POST["username"];
        $req = mysqli_query($connexion, "UPDATE user SET username = '$new' WHERE username = '$username'");
        $_SESSION['username'] = $new;
        if (isset($_COOKIE["login"])) {
            setcookie('login', $new, time() + 182 * 24 * 3600, '/');
        }
        header("Location:profile.php");
    }
}

function edit_password()
{
    require('include/connect_db.php');
    if (isset($_POST['password'])) {
        if (empty($_POST['password'])) {
            header('location:profile.php');
            die();
        }
        $username = $_SESSION['username'];
        $pwd = $_POST["password"];
        $req = mysqli_query($connexion, "UPDATE user SET password = '$pwd' WHERE username = '$username'");
        if (isset($_COOKIE["mdp"])) {
            setcookie('mdp', $pwd, time() + 182 * 24 * 3600, '/');
        }
        header("Location:profile.php");
    }
}

function get_uid()
{
    require('include/connect_db.php');
    $username = $_SESSION['username'];
    $res = mysqli_query($connexion, "SELECT `id` FROM `user` WHERE `username` = '$username'");
    $uid = mysqli_fetch_assoc($res)["id"];
    return $uid;
}

function get_pfp()
{
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

function get_map_name(string $id)
{
    require('include/connect_db.php');
    $res = mysqli_query($connexion, "SELECT `map_name` FROM `user_map` WHERE `map_id` = '$id'");
    $name = mysqli_fetch_assoc($res)["map_name"];
    return $name;
}

function upload_map($map, $map_name)
{
    require('include/connect_db.php');
    $uid = get_uid();
    $_map = mysqli_real_escape_string($connexion, $map);
    $text = "INSERT INTO `user_map` (`userID`, `map`, `map_name`, `map_id`, `is_official`) VALUES ('$uid', '$map', '$map_name', NULL, '0');";
    $req = mysqli_query($connexion, $text);
    return $req;
}

function update_map($map, $map_name, $id)
{
    require('include/connect_db.php');
    $uid = get_uid();
    $text = "UPDATE `user_map` SET `map` = '$map', `map_name` = '$map_name' WHERE `userID` = '$uid' AND `map_id` = '$id';";
    $req = mysqli_query($connexion, $text);
    return $req;
}

function delete_map($map_id)
{
    require('include/connect_db.php');
    $uid = get_uid();
    $text = "DELETE FROM `user_map` WHERE `userID` = '$uid' AND `map_id` = '$map_id'";
    $req = mysqli_query($connexion, $text);
    return $req;
    header("Location:upload.php");
}
?>
