<?php require('include/head.php');?>
<head>
<link rel="stylesheet" href ="static/register.css"/>
</head>
<body>


<?php
	require("include/nav.php");
	require('include/connect_db.php');
	if(empty($_SESSION["pseudo"])){
?>

<div id="case">
	<form method="post" action="login.php"> 
		
		<h1> Log in </h1>
		<label> Username : </label> 
		<input type="text" name="login" placeholder="Example19" maxlength="14" required>
		<br><br> 
		<label> Password : </label>
		<input type="password" name="password" placeholder="Password123" maxlength="10" required> 
		<br><br>
<?php
		}
		else
			echo"<br><a href=\"logout.php\">Logout</a>";
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
			<a href="register.php" type="submit"> <input type="button" value="Sign up"> </a>
			<?php
		}
	}	
		?>
		<input type="submit" name="login" value="Log in">
		
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