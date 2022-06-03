<header>
	<?php
	if (session_status() != PHP_SESSION_ACTIVE) {
		session_start();
	}
	?>
	<nav>
		<ul>
			<li><a href="index.php">Home</a></li>
			<li><a href="game.php">Game - Levels</a></li>
			<li><a href="FAQ.php">F.A.Q</a></li>
			<li><a href="rank.php">Ranking</a></li>
			<!--Menu du site-->

			<!-- <div id="nav-btn-container"></div> -->
			<?php
			if (isset($_SESSION["username"]) == NULL) {
				echo "<li><a id=\"login\" href='login.php'><i class='nav-btn' aria-hidden='true'></i>Login</a></li>";
				echo "<li><a id=\"register\" href='register.php'><i class='nav-btn' aria-hidden='true'></i>Register</a></li>";
			} else if (isset($_SESSION["username"])) {
				echo "<li><a href=\"upload.php\">Upload Map</a></li>";
				echo "<li><a id=\"login\" href='profile.php'><i class='nav-btn' aria-hidden='true'></i>" . $_SESSION['username'] . "</a></li>";
				echo "<li><a id=\"logout\" href='logout.php'><i class='nav-btn' aria-hidden='true'></i>Logout</a></li>";
			} else {
				echo "Auth error.";
			}
			?>
		</ul>
	</nav>
</header>