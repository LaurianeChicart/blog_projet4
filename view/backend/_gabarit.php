<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<html lang="fr">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?= $title ?> - Billet simple pour l'Alaska</title>
	<!-- Bootstrap -->
	<link rel="stylesheet" type="text/css" href="assets/style/css/bootstrap.min.css">
	 
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<!-- FontAwesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<!-- GoogleFont -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css?family=Shadows+Into+Light&display=swap" rel="stylesheet"> 
	<!-- Style -->
	<link rel="stylesheet" type="text/css" href="assets/style/css/style.css">
	<!-- tiny mce -->
	<script src="https://cloud.tinymce.com/5/tinymce.min.js?apiKey=fmo6hd89jewvgpwcxmm1ejmobvetxbrj411mdfnlhgt2oy0w"></script> 
	<script>
		tinymce.init({
			selector: '#postTextarea',
			theme: 'silver',
			mobile: {
			    theme: 'mobile',
			    plugins: [ 'autosave', 'lists', 'autolink' ]

			}
		});
  </script>
</head>
<body class="container bg-body">
	
		<nav class="navbar navbar-expand-md">
			<h3><a href="dashboard.html" class="text-color1 text-decoration-none">Billet simple pour l'Alaska</a></h3>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			    <span class="fas fa-bars"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mx-auto">
					<li class="nav-item"><a href="dashboard.html" class="nav-link text-reset active font-weight-bold">Accueil</a></li>
					<li class="nav-item"><a href="post-editor.html" class="nav-link text-reset font-weight-bold">Publier</a></li>
					<li class="nav-item"><a href="moderation.html" class="nav-link text-reset font-weight-bold">Modérer</a></li>
				</ul>
			</div>
			<div>
				<p class="d-none d-lg-block">Bonjour <?= $_SESSION['name'] ?> !<br>
				<span class="fas fa-power-off"></span> <a href="deconnection.html" class="text-color1 font-weight-bold">Se déconnecter</a></p>
				<button class="bg-color1 btn d-block d-lg-none"><span class="fas fa-power-off"><a href="deconnection.html" class="text-white"></a></span></button>
			</div>
		</nav>
	
	<section class="row">
<?= $contentPage ?>
	</section>

</body>
</html>