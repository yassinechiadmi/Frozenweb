<?php require('include/head.php');?>
<head>
<link rel="stylesheet" href ="static/register.css"/>
</head>
<body>


<?php
	require("include/nav.php");
	require('include/connect_db.php');
	if(empty($_SESSION["pseudo"])){
	
		$log = (isset($_COOKIE["login"]) && isset($_COOKIE['choice']) && $_COOKIE['choice'] == 'on')? $_COOKIE["login"] : "";
    	$mdp = (isset($_COOKIE["mdp"]) && isset($_COOKIE['choice']) && $_COOKIE['choice'] == 'on') ? $_COOKIE["mdp"] : "";
		$checkVal = (isset($_COOKIE['choice']) && $_COOKIE['choice'] == 'on') ? "value='on' checked" : "";
?>

<div id="case">
	<form method="post" action="login.php" class="logform"> 
		
		<h1> Log in </h1>
		<label> Username : </label> 
		<input type="text" name="username" placeholder="Example19" maxlength="14" required <?php if (!empty($log)) echo "value = '$log'";?>>
		<br><br> 
		<label> Password : </label>
		<input type="password" name="password" placeholder="Password123" maxlength="10" required <?php if (!empty($mdp)) echo "value = '$mdp'";?>> 
		<br><br>
		<span>
			
		</span>
		<label for="check"> Remember me : </label>
		<input type="checkbox" name="remember" id="check" <?php if (!empty($checkVal)) echo "$checkVal";?>>
		<br><br>
<?php
		}
		else
			echo"<br><a href=\"logout.php\">Logout</a>";
		?>
		
		<?php 
		

	if(isset($_POST['username']) && isset($_POST['password']))
	{
		$login = $_POST['username'];
		$mdp = $_POST['password'];
		$requete = mysqli_query($connexion,"SELECT * FROM user WHERE username = '$login'");

		if(mysqli_num_rows($requete) > 0)
		{
			$row = mysqli_fetch_assoc($requete);
			if($mdp == $row['password'])
			{
				$_SESSION["username"]=$login;

				if (isset($_POST['remember']) && $_POST['remember'] == 'on')
				{
					setcookie("login", $login, time() + 182 * 24 * 3600);
					setcookie("mdp", $mdp, time() + 182 * 24 * 3600);
				}
				setcookie("choice", $_POST['remember'], time() + 182 * 24 * 3600);

				header("Location:index.php"); 
			}
		}
		else
		{
			echo "<h3 style='text-align: center; color : red;'> Identifiant ou mot de passe incorrect </h3>";
			?>
			<!-- <a href="register.php" type="submit"> <input type="button" value="Sign up"> </a> -->
			<a href="register.php" type="submit"></a>
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