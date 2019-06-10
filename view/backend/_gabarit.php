<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	
	<!--viewport -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title><?= $title ?> - Billet simple pour l'Alaska</title>
	<!-- favicon-->
	<link rel="icon" type="image/png" href="assets/images/images/imgholdr-image(15).png"/>
	<!-- pas d'indexation moteurs de recherche-->
	<meta name="robots" content="noindex">
	
	<!-- FontAwesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<!-- GoogleFont -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css?family=Shadows+Into+Light&display=swap" rel="stylesheet"> 
	<!-- Bootstrap -->
	<!-- <link rel="stylesheet" type="text/css" href="assets/style/css/bootstrap-4.3.1/bootstrap.min.css"> -->
	<link rel="stylesheet" type="text/css" href="assets/style/css/bootstrap-4.3.1/compiled/bootstrap.css">
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
		
  </script>
</head>
<body class="container ">
	
		<nav class="navbar navbar-expand-md">
			<h3><a href="dashboard.html" class="text-decoration-none">Billet simple pour l'Alaska</a></h3>
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
				<p  class="d-none d-lg-block">Bonjour <?= $_SESSION['name'] ?> !<br>
				<span class="fas fa-power-off"></span> <a href="deconnection.html" class="font-weight-bold">Se déconnecter</a></p>
				<a href="deconnection.html" class="btn btn-primary d-block d-lg-none text-center" id="deconnection"><span class="fas fa-power-off"></span></a>
			</div>
		</nav>
	
	<section class="row">
<?= $contentPage ?>
	</section>

		<footer class="text-center">
			<p>© 2019 Tous droits réservés</p>
		</footer>


		<div id="dialog-modal" class="modal" tabindex="-1" role="dialog">
		  	<div class="modal-dialog modal-dialog-centered" role="document">
		  		<div class="modal-content">
		  			<form id="formDelete" method="POST">
			  			<div class="modal-body">
			  				<div><button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button></div><br>
					        <p id="message" class="font-weight-bold"></p>
					        <input type="hidden" name="id" id="id">
						</div>
						<div class="modal-footer">
					        <button class="btn btn-primary" type="button" data-dismiss="modal">Annuler</button>
					        <button class="btn btn-primary" type="submit" >Valider</button>
				      	</div> 
				    </form>
			    </div>
			</div>
		</div>

<!-- JQUERY -->
<script src="assets/javascript/jquery-3.4.1.min.js"></script>
<!-- BOOTSTRAP -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> 

<!-- SCRIPT -->
<script src="assets/javascript/script.js"></script>
</body>
</html>