<!DOCTYPE html>
<html lang="fr">

<head>
  <title>Le Guide de l'Invocateur</title> 
  <link rel="stylesheet" href ="css.css"/>
<script src="https://kit.fontawesome.com/78909c4315.js" crossorigin="anonymous"></script>
</head>

<style>

/*MENU DU SITE*/

.menu ul{
	border:outset #F9FB85;
    list-style-type: none;
    margin: auto;
    padding: 0;
	width:auto;
    background-color: #D5D8DC;
    overflow: hidden;
}


.menu li a{
    display: block;
    color: white;
    padding: 8px 30px;
    text-decoration: none;
	font-size : 15px ;
}

/*On place les cases les unes à côté des autres afin d'obtenir un menu horizontal.*/
li{
    float: left;
}

/*Ici on change la mise en forme de la case quand le curseur passe dessus.*/
.menu li a:hover{
    background-color: #C51E00;
	background-size:100%;
    color: white;
	font-size : 100% ;
}

/*FIN MENU DU SITE*/


/*Foot*/
.reseaux{
  position: relative;
  width: 100%;
  text-align: center;
  background-color: rgb(213, 216, 220);
  margin-top: 100px;
  padding-bottom: 100px;
  margin-bottom: 0;
}

div h3 {
  padding-top: 10px;
  color:#FFFFFF;
}

div ul{
  list-style-type: none;
  display: block;
}

div ul li{
  width: 25%;
  display:flex;
}
.cnxn{
	float: right;
	background-color: gold;
}

.deco{
	float: right;
	background-color: gold;
}

img {
  color:#FFFFFF;
}

#discord:hover {
  color:rgb(114, 100, 237);
}

#twitter:hover {
  color:rgb(237, 0, 245);
}

#instagram:hover {
  color:rgb(59, 193, 255);
}

div p{
  clear: both;
  color:#FFFFFF;
}

div a {
  color:#FFFFFF;
}/*Fin du foot*/
<!-- TL TWITTER -->

<!-- ------ -->

h2{
	color:black;
}
.page1{
	background-image: url("icegif.gif");
}

.page2{
	background-image: url("ice3.png");
}

.page3{
	background-image: url("ice4.png");
}

.case1{
  padding-bottom: 25%;
}

.case1 p{
	float:left;
	border: solid;
	color:white;
	font-size: 15px;
	line-height: 4;
}



.logo{
	float:right;
	width:30%;
	height:30%;
	
}

h1{
	text-indent : 5%;
	color:white;
}

.image{
  width: 20%;
}

.faqcase{
	border:solid;
	width:50%;
}
</style>


<body>
<?php require("nav.php");?>

<div class="page1">
<h1> Bienvenue dans NomduJeu </h1> 
  <div class="case1">
	<p>C'est un plaisir de vous accueillir sur notre site, si tu es ici c'est que notre jeu t'intéresse alors laisse moi te le présenter en quelques mots. <br>Tout d'abord si tu es fan des jeux de réflexion où ton cerveau est mis à l'épreuve  tu es le bienvenue parmi nous.<br> De plus si tu aimes les ambiances glaciales et rafraichissantes viens donc glisser sur la patinoire et trouve la voie de la liberté !</p>
	<img class ="logo" src="https://img-16.stickers.cloud/packs/f622f526-ac45-41f8-ac83-6b5ccdcee42c/webp/84539cb9-711d-4398-ad52-53248c3dbc8c.webp" alt="Logo de Discord"/>
	<br><br><br><br><br><br><br><br><br><br><br><br>
	</div>
<button onclick="">Jouer</button> <!--mettre le lien de la page-->
  </div>

  </div>
  <div class="page2">
  
  <div class="case1">
    <h1> Qui sommes nous ? </h1> 
  </div>
  
<div class="twit"><!--Tl twitter-->
<a class="twitter-timeline" data-lang="en" data-width="550" data-height="600" href="https://twitter.com/Froz_glisse">Tweets by Froz'Glisse</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
<!-- ----- -->
</div>
	</div>
	
<div class="page3">
    <h1> FAQ </h1> 
	
	<nav class="faqnav">
	<ul><div class="faqcase">
	<h3> Quel est le but du jeu ? </h3>
	<p class="faqtxt"> Le but du jeu est de parcourir la carte pour atteindre la sortie en utilisant le moins de déplacement possible, attention le sol glisse ! </p>
	<!--INSERER UN GIF-->
	</div>
	</ul><br><br>
	<ul><div class="faqcase">
	<h3> Quel est le but du jeu ? </h3>
	<p class="faqtxt"> Le but du jeu est de parcourir la carte pour atteindre la sortie en utilisant le moins de déplacement possible, attention le sol glisse ! </p>
	<!--INSERER UN GIF-->
	</div>
	</ul>
	
	</nav>
  
</div>
<?php require("foot.php")?>
</body>
</html>