<?php require("include/head.php");?>
<head>
<link rel="stylesheet" href ="static/register.css"/>
</head>
<body>

<?php
    require("include/nav.php");
	require('include/connect_db.php');
    if(empty($_SESSION["pseudo"])){
?>

    <div class="form-container">
	<form method="post" action="inscription.php"> 
		
		<h1> Register </h1>
		<label> Username : </label> 
		<input type="text" name="login" placeholder="Example19" maxlength="14" required>
		<label> Password : </label>
		<input type="password" name="password" placeholder="Password123" maxlength="10" required> 
        <label> Confirmation : </label>
		<input type="password" name="password-conf" placeholder="Password123" maxlength="10" required> 

<?php
    }
    else echo"<br><a href=\"Deconnexion.php\">Déconnexion</a>";

	if(isset($_POST['login']) && isset($_POST['password'])){
		$login= $_POST['login'];
		$mdp = $_POST['password'];
		$conf = $_POST['password-conf'];
        $requete = mysqli_query($connexion, "SELECT * FROM user WHERE username = '$login'");
		if(mysqli_num_rows($requete) > 0){
            echo "<h3 class='error'> Utilisateur déjà existant</h3>";
		}
		else{
            $today = date("Y-m-d");
            $requete = mysqli_query($connexion,"INSERT INTO user (id,username,password,pseudo,creation_date) VALUES (NULL,'$login','$mdp','$login','$today')");
		}
	}
		?>
		<input type="submit" name="register" value="Register">
	</form>
    </div>

<?php
	
	if (!$connexion) {
		echo "Erreur de connexion".mysqli_connect_errno();
		die();
	}
	
?>

 

</body>
</html>