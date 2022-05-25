<?php require("include/head.php") ?>
<body>
<?php require("include/nav.php");?>
<script src="static/faq.js"> </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.0/gsap.min.js"></script>

<div class="container-faq">
	<h1 class="faqh">Q & A :</h1>

	<button onclick="myFunction(this);">
		<div class="question">
			<div class="visible-pannel">
				<h2>Questions</h2>
				<img src="rs/plus.png" alt="ouais de ouf">
				<!-- <button><img src="plus.png" alt="ouais de ouf"></button> -->
			</div>
			<div class="toggle-pannel">
				<h4>Where did we get the idea for this game ?</h4>
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
			<h2>Questions</h2>
			<img src="rs/plus.png" alt="ouais de ouf">

			<!-- <img src="ice.jpg" alt="ouais de ouf"> -->
		</div>
		<div class="toggle-pannel">
			<h4>Titre</h4>
			<p>Blablablababalbalbalabalbabalbalablablablaba</p>
		</div>
	</div>
	</button>
	<button onclick="myFunction(this);">
	<div class="question">
		<div class="visible-pannel">
			<h2>Questions</h2>
			<img src="rs/plus.png" alt="ouais de ouf">

			<!--<img src="ice.jpg" alt="ouais de ouf">-->
		</div>
		<div class="toggle-pannel">
			<h4>Titre</h4>
			<p>Blablablababalbalbalabalbabalbalablablablaba</p>
		</div>
	</div>
	</button>
	<button onclick="myFunction(this);">
	<div class="question">
		<div class="visible-pannel">
			<h2>Questions</h2>
			<img src="rs/plus.png" alt="ouais de ouf">
		</div>
		<div class="toggle-pannel">
			<h4>Titre</h4>
			<p>Blablablababalbalbalabalbabalbalablablablaba</p>
		</div>
	</div>
	</button>
</div>
<?php require("include/foot.php")?>
</body>
</html>