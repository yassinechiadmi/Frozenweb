<header>
	<?php session_start(); ?>
	<nav>
		<ul>
			<li><a href="index.php">Home</a></li>
			<li><a href="p3.php">Game - building</a></li>
			<li><a href="Forum.php">Forum</a></li>
			<li><a href="FAQ.php">Q & A</a></li>
			<li><a href="rank.php">Ranking - building</a></li>
			<!--Menu du site-->

			<!-- <div id="nav-btn-container"></div> -->
			<?php
			if (isset($_SESSION["username"]) == NULL) {

				echo "<li><a id=\"login\" href='login.php'><i class='nav-btn' aria-hidden='true'></i>Login</a></li>";
				echo "<li><a id=\"register\" href='register.php'><i class='nav-btn' aria-hidden='true'></i>Register</a></li>";
			} else if (isset($_SESSION["username"])) {
				echo "<li><a id=\"login\" href='profile.php'><i class='nav-btn' aria-hidden='true'></i>" . $_SESSION['username'] . "</a></li>";
				echo "<li><a id=\"logout\" href='logout.php'><i class='nav-btn' aria-hidden='true'></i>Logout</a></li>";
			} else {
				echo "Auth error.";
			}
			?>
		</ul>
	</nav>
</header>