<section>
	<h2><?= htmlspecialchars($post->title()) ?></h2>
	<p>Publié le <?= $post->dateCreation() ?>
<?php
		if (!is_null($post->dateModif()))
		{
?>
		(modifié le <?= $post->dateModif() ?>) 

<?php	
		}
?>

		</p>
		<div class="text-center"><img src="assets/images/uploads/<?= $post->image() ?>" ></div>
		<p> <?= htmlspecialchars($post->content()) ?></p>

</section>
<section>
	<div>
		<h5>Ajouter un commentaire</h5>
		<form action="edit-comment.html&id=<?= $post->id() ?>" method="post">
			<label for="author">Nom</label><input type="text" name="author">
			<label for="comment">Commentaire</label><textarea name="comment"></textarea>
			<input type="submit" value="Envoyer">
		</form>
	</div>
	<div>
		<h5>Commentaires (<?= $nbComments ?>)</h5>
<?php 
	if (empty($comments))
	{
		echo "<p>Soyez le premier à poster un commentaire !</p>";
	}
	else
	{
		foreach ($comments as $comment): 

?>
	<div>
		<p><?= htmlspecialchars($comment->author()) ?> <?= $comment->dateCreation() ?></p>
		<p><?= htmlspecialchars($comment->content()) ?></p>
		<p><a href="warn-comment.html&id=<?= $post->id() ?>&idComment=<?= $comment->idComment() ?>&warning=<?= $comment->warning() ?>">Signaler</a></p>
	</div>
	
<?php endforeach;
	}
	if ($nbComments > 0)
	{
		if ($nbComments % 10 === 0)
		{
			$nbPages = $nbComments / 10;
		}
		else
		{
			$nbPages = $nbComments / 10 + 1;
		}
?>
		<p>Pages : 
<?php
		for ($i=1; $i <= $nbPages; $i++)
		{
?>
	<span> <a href="post.html?&id=<?= $post->id() ?>&pageCom=<?php echo $i ?>"><?php echo $i ?></a> </span>
<?php
		}
	}
?>
	</p>
	</div>
</section>