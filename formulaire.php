<?php require('include/head.php'); ?>

<head>
	<meta charset="utf-8" />
	<title>Formulaire</title>
	<link rel="stylesheet" href="static/form.css">
</head>

<body>

	<fieldset>

		<body>
			<form method="post" action="">
				<h1> Sign up :</h1>
				<label> Name : </label>
				<input type="text" name="Name" placeholder="	Ex: DUPEL ">
				<br><br>
				<label> Surname : </label>
				<input type="text" name="Surname" placeholder="	  Ex : Quentin ">
				<br><br>
				<!--$_POST['Nom']=$nom  // $nom, nbre de freres et soeur, dans db avec INSERT nouvelle ligne >
// idée : time() renvoie de la date aujourd'hui -->


				<legend>I am : </legend>

				<input type="radio" id="Homme" name="sexe" value="homme">
				<label for="Homme">Male</label><br />

				<input type="radio" id="Femme" name="sexe" value="femme">
				<label for="Femme">Female</label><br />

				<input type="radio" id="NB" name="sexe" value="non binaire">
				<label for="NB"> Other </label>

				<br>
				<br>
				<br>

				<div>
					<label for="username">Username :</label>
					<input type="text" id="username" name="username">
				</div>

				<br>

				<br>

				<div>
					<label for="password">Password (8 characters minimum):</label>
					<input type="password" id="pass" name="password" minlength="8" required>
				</div>

				<br>
				<br>

				<div>
					<label for="password"> Confirm password :</label>
					<input type="password" id="pass" name="passwordconf" minlength="8" required>
				</div>




	</fieldset>
	<input type="submit" name="submit" id="submit" value="Validate">
	</fieldset>
	</form>
	<?php
	if (isset($_POST['submit'])) {

		if (isset($_POST['identifiant']) && isset($_POST['password']) &&  isset($_POST['Annee'])  && isset($_POST['name'])) {
			$ident = $_POST['identifiant'];
			$password = $_POST['password'];
			$annee = $_POST['Annee'];
			$name = $_POST['name'];
			$passwordconf = $_POST['passwordconf'];
			$nom = $_POST['Nom'];
			$prenom = $_POST['Prenom'];
			$sexe = $_POST['sexe'];


			$db_username = 'root';
			$db_password = 'root';
			$db_name     = 'projetfindannee'; // buildDB 
			$db_host     = 'localhost';

			$db = mysqli_connect($db_host, $db_username, $db_password, $db_name);
			if (!$db) {
				echo "erreur de connexion à la DB";
				die();
			}



			$requete = "INSERT INTO user VALUES (NULL, '$annee','$name','$ident','$password','$passwordconf','$nom','$prenom','$sexe')";
			$variable = mysqli_query($db, "SELECT * FROM user WHERE username ='$ident'");

			if (($password != $passwordconf)) {

				echo "Reconfirmer votre Mdp";
			} else {
				if (mysqli_num_rows($variable) == 0) {

					$result = mysqli_query($db, $requete);
					if (isset($_COOKIE["login"])) {
						$_COOKIE["login"] = $ident;
					} else setcookie("login", $ident, time() + (365 * 24 * 3600));
					if (isset($_COOKIE["mdp"])) {
						$_COOKIE["mdp"] = $password;
					} else setcookie("mdp", $password, time() + (365 * 24 * 3600));
					header("Location:Connexion.php");
				} else {
					echo "identifiant déjà prit";
				}
			}
		}
		mysqli_close($db); // fermer la connexion
	}

	?>
</body>

</html>