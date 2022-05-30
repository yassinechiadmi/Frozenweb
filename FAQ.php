<?php require("include/head.php") ?>

<body>
	<?php require("include/nav.php"); ?>
	<script src="static/faq.js"> </script>

	<div class="container-faq">
		<h1 class="faqh">Q & A :</h1>

		<button onclick="myFunction(this);">
			<div class="question">
				<div class="visible-pannel">
					<h2>Where did we get the idea for this game ?</h2>
					<img src="rs/plus.png" alt="ouais de ouf">
					<!-- <button><img src="plus.png" alt="ouais de ouf"></button> -->
				</div>
				<div class="toggle-pannel">
					<h4>From a famous game !</h4>
					<p>At the beginning, we wanted to make a maze but it made our
						game too "classic".
						We were then inspired by the famous Pokémon ice arena, the concept
						of sliding to a ratchet was perfect to meet the needs of this project.</p>
					<i class="fa-solid fa-sun-haze"></i>
				</div>
			</div>
		</button>

		<button onclick="myFunction(this);">
			<div class="question">
				<div class="visible-pannel">
					<h2>How does the card designer work?</h2>
					<img src="rs/plus.png" alt="ouais de ouf">

					<!-- <img src="ice.jpg" alt="ouais de ouf"> -->
				</div>
				<div class="toggle-pannel">
					<h4>It couldn't be simpler!</h4>
					<p>Create your level by placing the
						walls and then the rocks,
						make sure it can be solved and you're done.</p>
				</div>
			</div>
		</button>
		<button onclick="myFunction(this);">
			<div class="question">
				<div class="visible-pannel">
					<h2>Can we save them and play them again?</h2>
					<img src="rs/plus.png" alt="ouais de ouf">

					<!--<img src="ice.jpg" alt="ouais de ouf">-->
				</div>
				<div class="toggle-pannel">
					<h4>Of course you can! They will be saved.</h4>
					<p>And those on your account, so
						log in to access your cards. From there, you can choose to publish them,
						they will then be playable by the whole community !</p>
				</div>
			</div>
		</button>
		<button onclick="myFunction(this);">
			<div class="question">
				<div class="visible-pannel">
					<h2>I have more questions,
						or a comment to make. How do I do it?</h2>
					<img src="rs/plus.png" alt="ouais de ouf">
				</div>
				<div class="toggle-pannel">
					<h4>Contact us !</h4>
					<p>Log in, go to the forum page and send us your sweet word.
						We will answer you as soon as possible, we promise.</p>
				</div>
			</div>
		</button>
	</div>
	<?php require("include/foot.php") ?>
</body>

</html>