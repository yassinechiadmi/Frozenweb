<?php
	session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head> 
	<meta charset="utf-8"/>
   <title>Connexion</title>
</head>

<style>
body{
	background: url(ice1.gif) left top repeat;;
}
#case{
	width:400px;
    margin: 35%;
    margin-top:10%;
}

form {
    width:100%;
    padding: 30px;
    border: 1px groove black;
    background: #D5D8DC;
}

h1{
    width: 38%;
    margin: 0 auto;
    padding-bottom: 10px;
}

label {
	width: 38%;
    margin: 0 auto;
    padding-bottom: 10px;
}

input[type=text], input[type=password]{
	width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

input[type=submit]{
	background-color: #53af57;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

input[type=submit]:hover {
    background-color: white;
    color: #53af57;
    border: 1px solid #53af57;
}

.erreur{
	color: red;
}

*{
	 border-radius: 10px;
}
</style>

<body>
<?php
    $hostname= "localhost"; //nom du serveur (localhost)
	$username="root";//nom d'utilisateur pour accéder au serveur (root)
	$password="root"; //mot de passe pour accéder au serveur (root)
	$dbname="projetfindannee"; //nom de la base de données
	
	$connexion = mysqli_connect($hostname, $username, $password, $dbname);

?>

<?php
	if(empty($_SESSION["pseudo"])){
?>

<div id="case">
	<form method="post" action="Connexion.php"> 
		
		<h1> Connexion </h1>
		<label> Username : </label> 
		<input type="text" name="login" placeholder="Example19" maxlength="14" required>
		<br><br> 
		<label> Password : </label>
		<input type="password" name="password" placeholder="Password123" maxlength="10" required> 
		<br><br>
<?php
		}
		else
			echo"<br><a href=\"Deconnexion.php\">Déconnexion</a>";
		?>
		
		<?php 
		

	if(isset($_POST['login']) && isset($_POST['password'])){
		$login= $_POST['login'];
		$mdp = $_POST['password'];
		$requete = mysqli_query($connexion, "SELECT password FROM user WHERE username = '$login'");
		if(mysqli_num_rows($requete) > 0){
			$row = mysqli_fetch_assoc($requete);
			
			if($mdp == $row['password']){
			$_SESSION["username"]=$login;
			header("Location:index.php"); 
		}
		}
		else{
			echo "<h3 style='text-align: center; color : red;'> Identifiant ou mot de passe incorrect </h3>";
			echo "Aucune des informations saisies ne correspondent à la base de données, souhaitez vous devenir membre ?";
			?> 
			<a href="formulaire.php" type="submit"> <input type="button" value="Sign up"> </a>
			<?php
		}
	}	
		?>
		<input type="submit" name="Se connecter" value="Se connecter">
		
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