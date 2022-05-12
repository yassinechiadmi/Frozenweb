<header>
<nav> <!--Menu du site-->
    <ul class="menu">
		<li><a href="index.php"><i aria-hidden="true"></i> Home </a></li>
        <li><a href="Forum.php"><i aria-hidden="true"></i> Page 2 </a></li>
        <li><a href="p3.php"><i aria-hidden="true"></i> Page 3 </a></li>
        <li><a href="p4.php"><i aria-hidden="true"></i> Page 4 </a></li>
		<li><a href="p5.php"><i aria-hidden="true"></i> Page 5 </a></li>
		<?php
		if(isset($_SESSION["username"]) == NULL){
			
			echo "<li class='cnxn'><a href='Connexion.php'><i class='tkt' aria-hidden='true'></i>Connexion</a></li>";
		}
		else if(isset($_SESSION["username"])){
			
			echo "<li class='deco'><a href='Deconnexion.php'><i class='tkt' aria-hidden='true'></i>Déconnexion</a></li>";
		}
		else{
			echo "Erreur d'authentification.";
		}
		?>
	</ul>
</nav>
</header>