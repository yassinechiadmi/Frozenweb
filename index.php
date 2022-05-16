<!DOCTYPE html>
<html lang="fr">

<head>
  <title>Home</title> 
  <link rel="stylesheet" href ="index.css"/>
  <link rel="stylesheet" href ="footer.css"/>
  <link rel="stylesheet" href ="default.css"/>
  <link rel="stylesheet" href ="header.css"/>
  <script src="https://kit.fontawesome.com/78909c4315.js" crossorigin="anonymous"></script>
</head>


<body>
<?php require("nav.php");?>
<div class="page1">
	<div id="p1-txt">
		<h1>Bienvenue dans NomduJeu </h1> 
		<p>C'est un plaisir de vous accueillir sur notre site, si tu es ici c'est que notre jeu t'intéresse alors laisse moi te le présenter en quelques mots. <br>Tout d'abord si tu es fan des jeux de réflexion où ton cerveau est mis à l'épreuve  tu es le bienvenue parmi nous.<br> De plus si tu aimes les ambiances glaciales et rafraichissantes viens donc glisser sur la patinoire et trouve la voie de la liberté !</p>
	</div>
	<img id="p1-pepe" class ="logo" src="https://img-16.stickers.cloud/packs/f622f526-ac45-41f8-ac83-6b5ccdcee42c/webp/84539cb9-711d-4398-ad52-53248c3dbc8c.webp" alt="Logo de Discord"/>
	<input type="button" id="p1-play" value="Jouer" onclick="window.location.href='#'"> <!--mettre le lien de la page-->
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
	
  <style>

    .page3 .faqcase{
      margin-bottom:10%;
    }

  </style>

<div class="page3">
    <h1> Qu'est-ce que c'est ? </h1> 
	<ul class="faqnav">
		<li>
			<div class="faqcase">
			<h3> Quel est le but du jeu ? </h3>
			<p class="faqtxt"> Le but du jeu est de parcourir la carte pour atteindre la sortie en utilisant le moins de déplacement possible, attention le sol glisse ! </p>
			<!--INSERER UN GIF-->
			</div>
		</li>

		<li>
			<div class="faqcase">
			<h3> Quel est le but du jeu ? </h3>
			<p class="faqtxt"> Le but du jeu est de parcourir la carte pour atteindre la sortie en utilisant le moins de déplacement possible, attention le sol glisse ! </p>
			<!--INSERER UN GIF-->
			</div>
		</li>

		<li>
			<div class="faqcase">
			<h3> Quel est le but du jeu ? </h3>
			<p class="faqtxt"> Le but du jeu est de parcourir la carte pour atteindre la sortie en utilisant le moins de déplacement possible, attention le sol glisse ! </p>
			<!--INSERER UN GIF-->
			</div>
		</li>

		<li>
			<div class="faqcase">
			<h3> Quel est le but du jeu ? </h3>
			<p class="faqtxt"> Le but du jeu est de parcourir la carte pour atteindre la sortie en utilisant le moins de déplacement possible, attention le sol glisse ! </p>
			<!--INSERER UN GIF-->
			</div>
		</li>

		<li>
			<div class="faqcase">
			<h3> Quel est le but du jeu ? </h3>
			<p class="faqtxt"> Le but du jeu est de parcourir la carte pour atteindre la sortie en utilisant le moins de déplacement possible, attention le sol glisse ! </p>
			<!--INSERER UN GIF-->
			</div>
		</li>
	</ul>
</div>
<?php require("foot.php")?>
</body>
</html>