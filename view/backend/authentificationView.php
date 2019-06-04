<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<html lang="fr">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Espace de connexion</title>
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
</head>
<body class=bg-body>
	<div id="formConnection" class="article bg-light container">
		<form action="authentification.html" method="post">
			<label for="name">Identifiant</label><input type="text" name="name" class="form-control" required>
			<label for="password">Mot de passe</label><input type="password" name="password" class="form-control" reuired><br>
			<input type="submit" value="Connexion" class="btn bg-color1 float-right"><br><br>
		</form>
	</div>
</body>
</html>