<header>
	<?php session_start();?>
	<a id="home" href="index.php"><img src="rs/logo.gif" width=100px height=50px></img></a>
	<nav> <!--Menu du site-->
		<a href="p3.php">Game - building</a>
		<a href="Forum.php">Forum</a>
        <a href="FAQ.php">FAQ</a>
		<a href="rank.php">Ranking - building</a>

		<div id="nav-btn-container">
			<?php
			if(isset($_SESSION["username"]) == NULL){
				
				echo "<a id=\"login\" href='login.php'><i class='nav-btn' aria-hidden='true'></i>Login</a>";
				echo "<a id=\"register\" href='register.php'><i class='nav-btn' aria-hidden='true'></i>Register</a>";
			
			}
			else if(isset($_SESSION["username"])){
				echo "<a id=\"login\" href='profile.php'><i class='nav-btn' aria-hidden='true'></i>".$_SESSION['username']."</a>";			
				echo "<a id=\"logout\" href='logout.php'><i class='nav-btn' aria-hidden='true'></i>Logout</a>";
			}
			else{
				echo "Auth error.";
			}
			?>
		</div>
	</nav>
</header>