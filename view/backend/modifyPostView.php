<?php $title = 'Modifier post';
?>
<section class="article bg-light container">
	<h4>Modifier post</h4>
<?php
if(isset($message))
{
?>
		<p class="alert alert-danger" role="alert"><?= $message ?></p>
<?php
}
?>
	<form method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label for="title">Titre</label><input type="text" name="title" required value="<?= $post->title() ?>" class="form-control">
		</div>
		<input type="hidden" name="draft" value="<?= $post->draft() ?>"/>
		<input type="hidden" name="dateCreation" value="<?= $post->dateCreation() ?>"/>	

		<textarea id="postTextarea" name="content" required class="form-control"><?= $post->content() ?></textarea><br>
		<img src="assets/images/uploads/s<?= $post->image() ?>">
		<div class="form-group">
			<label for="image">Modifier l'image d'illustration </label> <br> <input type="file" name="image" accept="image/png, image/jpeg"/><span class="form-text text-muted">1Mo maximum</span>
		</div>
		
		<input type="hidden" name="formerImage" value="<?= $post->image() ?>"/>

		<div class="form-group">
<?php	

if(!is_null($post->alt()))
{
?>			
			<label for="alt">Texte alternatif de l'image</label><input type="text" name="alt" value="<?= $post->alt() ?>" class="form-control">
<?php
}
else
{
?> 
			<label for="alt">Texte alternatif de l'image</label><input type="text" name="alt" class="form-control">
<?php	
}
?>
		</div>
		<div id="buttons" class="d-flex justify-content-end flex-wrap">
		    <button class="btn bg-color1"><a href="dashboard.html" class="text-decoration-none text-white">Abandonner</a></button>

			 <input type="submit" formaction="delete-post.html&id=<?= $post->id() ?>" value="Supprimer le post" class="btn bg-color1">

		    <input type="submit" formaction="update-post.html&id=<?= $post->id() ?>" value="Mettre à jour" class="btn bg-color1">
		</div>
	</form>
</section>

