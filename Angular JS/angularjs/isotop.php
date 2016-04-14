<html>
	<head>
		<title>Ajax Live search using AngularJs | Demo | Cipher Trick</title>
		<link href="css/site.css" rel="stylesheet" type="text/css" />
		<!-- <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.0.7/angular.min.js"></script> -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/2.2.2/isotope.pkgd.min.js"></script>
		<style>
		.grid-item { width: 25%;}
		.grid-item--width2 { width: 50%;}
		</style>
		
	</head>

	<body>

		<div class="grid js-isotope" data-isotope-options='{ "itemSelector": ".item", "layoutMode": "fitRows" }'>
			<div class="grid">
			  <div class="grid-item" style="border: 1px solid blue;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</div>
			  <div class="grid-item grid-item--width2" style="border: 1px solid blue;">...</div>
			  <div class="grid-item" style="border: 1px solid blue;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when </div>
			  <div class="grid-item" style="border: 1px solid blue;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when </div>
			  <div class="grid-item" style="border: 1px solid blue;">...</div>
			  <div class="grid-item" style="border: 1px solid blue;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when </div>
			  <div class="grid-item" style="border: 1px solid blue;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when </div>
			  <div class="grid-item" style="border: 1px solid blue;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</div>
			</div>
		</div>

		<script>
			$('.grid').isotope({
					  // options
					  itemSelector: '.grid-item',
					  layoutMode: 'fitRows'
					});
		
		</script>

	</body>
</html>
