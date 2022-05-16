<header>
	<a id="home" href="index.php"><img src="rs/icone.jpg" width=100px height=50px></img></a>
	<nav> <!--Menu du site-->

        <a href="Forum.php">Page 2</a>
        <a href="p3.php">Page 3</a>
        <a href="FAQ.php">FAQ</a>
		<a href="p5.php">Page 5</a>

		<?php
		if(isset($_SESSION["username"]) == NULL){
			
			echo "<a id=\"connection\" href='Connexion.php'><i class='tkt' aria-hidden='true'></i>Connexion</a>";
		}
		else if(isset($_SESSION["username"])){
			
			echo "<a id=\"connection\" href='Deconnexion.php'><i class='tkt' aria-hidden='true'></i>Déconnexion</a>";
		}
		else{
			echo "Erreur d'authentification.";
		}
		?>
	</nav>

</header>