<header>
	<?php session_start();?>
	<a id="home" href="index.php"><img src="rs/icone.jpg" width=100px height=50px></img></a>
	<nav> <!--Menu du site-->

        <a href="Forum.php">Forum</a>
        <a href="p3.php">Page 3</a>
        <a href="FAQ.php">FAQ</a>
		<a href="p5.php">Page 5</a>

		<div id="nav-btn-container">
		<?php
		if(isset($_SESSION["username"]) == NULL){
			
			echo "<a id=\"connection\" href='login.php'><i class='nav-btn' aria-hidden='true'></i>Login</a>";
			echo "<a id=\"inscription\" href='register.php'><i class='nav-btn' aria-hidden='true'></i>Register</a>";
		
		}
		else if(isset($_SESSION["username"])){
			
			echo "<a id=\"connection\" href='logout.php'><i class='nav-btn' aria-hidden='true'></i>Logout</a>";
		}
		else{
			echo "Auth error.";
		}
		?>
		</div>
	</nav>

</header>