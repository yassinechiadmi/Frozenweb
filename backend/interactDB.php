
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
    }
}

?>
