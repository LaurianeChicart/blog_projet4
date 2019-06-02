<?php $title = 'Publier un post';
?>

<h3>Ecrire un nouveau post</h3>
<?php
if(isset($newPost) && !is_null($message))
{
?>
	<p><?= $message ?></p>
<?php
}
?>
<form action="edit-post.html" method="post" enctype="multipart/form-data">

<?php 
if(isset($newPost) && !is_null($newPost->title()))
{
?> 
	<label for="title">Titre</label><input type="text" name="title" required value="<?= $newPost->title() ?>">
<?php
}
else
{
?> 
	<label for="title">Titre</label><input type="text" name="title" required>
<?php	
}
if(isset($newPost) && !is_null($newPost->content()))
{
?>
	<textarea id="postTextarea" name="content"><?= $newPost->content() ?></textarea>
<?php
}
else
{
?> 
	<textarea id="postTextarea" name="content"></textarea>
<?php	
}
?> 
	<label for="image">Image d'illustration (1Mo maximum)</label><input type="file" name="image" accept="image/png, image/jpeg"/>
<?php	

if(isset($newPost) && !is_null($newPost->alt()))
{
?>
		<label for="alt">Texte alternatif de l'image</label><input type="text" name="alt" value="<?= $newPost->alt() ?>"><br>
<?php
}
else
{
?> 
		<label for="alt">Texte alternatif de l'image</label><input type="text" name="alt"><br>
<?php	
}
?>
	   
    <button><a href="dashboard.html">Abandonner</a></button>


	 <input type="submit" formaction="save-as-draft.html" value="Enregistrer en brouillon">


    <input type="submit" value="Publier">
</form>
