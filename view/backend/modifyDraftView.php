<?php $title = 'Modifier brouillon';
?>

<h3>Modifier brouillon</h3>
<?php
if(isset($message))
{
?>
	<p><?= $message ?></p>
<?php
}
?>
<form method="post" enctype="multipart/form-data">

	<label for="title">Titre</label><input type="text" name="title" required value="<?= $post->title() ?>">
	<input type="hidden" name="draft" value="<?= $post->draft() ?>"/>
	<input type="hidden" name="dateCreation" value="<?= $post->dateCreation() ?>"/>
<?php	

if(!is_null($post->content()))
{
?>
	<textarea id="postTextarea" name="content"><?= $post->content() ?></textarea>
<?php
}
else
{
?> 
	<textarea id="postTextarea" name="content"></textarea>
<?php	
}
if(!is_null($post->image()))
{
?>
	<label for="image">Image d'illustration (1Mo maximum)</label><input type="file" name="image" accept="image/png, image/jpeg"/>
	<img src="assets/images/uploads/s<?= $post->image() ?>">
	<input type="hidden" name="formerImage" value="<?= $post->image() ?>"/>
	

<?php
}
else
{
?> 
	<label for="image">Image d'illustration (1Mo maximum)</label><input type="file" name="image" accept="image/png, image/jpeg"/>
<?php	
}
if(!is_null($post->alt()))
{
?>
		<label for="alt">Texte alternatif de l'image</label><input type="text" name="alt" value="<?= $post->alt() ?>"><br>
<?php
}
else
{
?> 
		<label for="alt">Texte alternatif de l'image</label><input type="text" name="alt"><br>
<?php	
}
?>
	   
    <a href="dashboard.html"><button>Abandonner</button></a>

	<input type="submit" formaction="delete-post.html&id=<?= $post->id() ?>" value="Supprimer le brouillon">

	<input type="submit" formaction="update-draft.html&id=<?= $post->id() ?>" value="Enregistrer les modifications">

	<input type="submit" formaction="edit-draft.html&id=<?= $post->id() ?>" value="Publier">
</form>
</form>