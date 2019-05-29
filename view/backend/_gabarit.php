<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<html lang="fr">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?= $title ?> - Billet simple pour l'Alaska</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<script src="https://cloud.tinymce.com/5/tinymce.min.js?apiKey=fmo6hd89jewvgpwcxmm1ejmobvetxbrj411mdfnlhgt2oy0w"></script> 
	<script>
		tinymce.init({
			selector: '#postTextarea'
		});
  </script>
</head>
<body class="container-fluid">
	<header>
		<h1><a href="dashboard.html">Billet simple pour l'Alaska</a></h1>
		<nav>
			<ul>
				<li><a href="dashboard.html">Accueil</a></li>
				<li><a href="post-editor.html">Publier</a></li>
				<li><a href="moderation.html">Modérer</a></li>
			</ul>
		</nav>
		<p>Bonjour <?= $_SESSION['name'] ?></p>
		<p><a href="deconnection.html">Se déconnecter</a></p>
	</header>

	<section>
<?= $contentPage ?>
	</section>

	<footer>
		<p class="text-center">Pied de page</p>
	</footer>
</body>
</html>