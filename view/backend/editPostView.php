<?php $title = 'Publier un post';
?>
<section class="article bg-light container">
	<h4>Ecrire un nouveau post</h4>
<?php
if(isset($newPost) && !is_null($message))
{
?>
	<p class="alert alert-danger" role="alert"><?= $message ?></p>
<?php
}
?>
	<form action="edit-post.html" method="post" enctype="multipart/form-data">
		<div class="form-group">
<?php 
if(isset($newPost) && !is_null($newPost->title()))
{
?> 
			<label for="title">Titre</label><input type="text" name="title" required value="<?= $newPost->title() ?>" class="form-control">
<?php
}
else
{
?> 
			<label for="title">Titre</label><input type="text" name="title" required class="form-control">
<?php	
}
?>
		</div>
<?php
if(isset($newPost) && !is_null($newPost->content()))
{
?>
		<textarea id="postTextarea" name="content" class="form-control"><?= $newPost->content() ?></textarea><br>
<?php
}
else
{
?> 
		<textarea id="postTextarea" name="content" class="form-control"></textarea><br>
<?php	
}
?> 
		<div class="form-group">
			<label for="image">Image d'illustration </label> <br> <input type="file" name="image" accept="image/png, image/jpeg"/><span class="form-text text-muted">1Mo maximum</span>
		</div>
		<div class="form-group">
<?php	

if(isset($newPost) && !is_null($newPost->alt()))
{
?>
			<label for="alt">Texte alternatif de l'image</label><input type="text" name="alt" value="<?= $newPost->alt() ?>" class="form-control">

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


			<input type="submit" formaction="save-as-draft.html" value="Enregistrer en brouillon" class="btn bg-color1">


		    <input type="submit" value="Publier" class="btn bg-color1">
		</div>
	</form>
</section>