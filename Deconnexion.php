<?php 
	session_start(); 
	if(isset($_SESSION["identifiant"])){
		session_unset();
		session_destroy();
		header("Location:p1.php");
	}
	else{
		header("Location:Connexion.php");
	}
?>
