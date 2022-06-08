<?php
$hostname = "localhost"; //nom du serveur (localhost)
$username = "root"; //nom d'utilisateur pour accéder au serveur (root)
$password = "root"; //mot de passe pour accéder au serveur (root)
$dbname = "frozen_maze"; //nom de la base de données	
$port = "3306"; //port de connexion
$connexion = mysqli_connect($hostname, $username, $password, $dbname, $port);
