<?php $title = 'Publier un post';?>

<h3>Ecrire un nouveau post</h3>
<form action="edit-post.html" method="post" enctype="multipart/form-data">
	<label for="title">Titre</label><input type="text" name="title" required>
    <textarea id="postTextarea" name="content"></textarea>
   	<label for="image">Choisir une image d'illustration</label><input type="file" name="image" accept="image/png, image/jpeg"/><p>1Mo maximum</p>
    <a href="dashboard.html"><button>Abandonner</button></a>
    <input type="submit" formaction="save-as-draft.html" value="Enregistrer en brouillon">
    <input type="submit" value="Publier">
</form>
