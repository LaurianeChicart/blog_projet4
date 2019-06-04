<div class="container">
	<section class="article bg-light">
		<h4><?= htmlspecialchars($post->title()) ?></h4>
		<p>Publié le <?= $post->dateCreationFormat() ?>
<?php
		if (!is_null($post->dateModifFormat()))
		{
?>
			(modifié le <?= $post->dateModifFormat() ?>) 

<?php	
		}
		if (empty($post->alt()))
		{
			$alt = 'Image d\'illustration du chapitre ' .$post->title();
		}
		else
		{
			$alt = $post->alt();
		}
?>

			</p>
			<div class="text-center"><img src="assets/images/uploads/l<?= $post->image() ?>" alt="<?= $alt ?>" class="largeImage image"></div>
			<p class="text-justify"> <?= $post->content() ?></p>

	</section>
	<section>
		<div class="article bg-light">
			<h5><span class="fas fa-pen-fancy"></span> Ajouter un commentaire</h5>
			<div class="d-flex justify-content-center">
				<form action="edit-comment.html&id=<?= $post->id() ?>" method="post" id="formComment">
					<div class="form-group">
						<label for="author">Nom</label><input type="text" name="author"class="form-control" required>
					</div>
					<div class="form-group">
						<label for="comment">Commentaire</label><textarea name="comment" class="form-control" required></textarea>
					</div>
						<input type="submit" value="Envoyer" class="btn bg-color1 float-right"></br></br>
				</form>
			</div>
		</div>
		<div id="com" class="article bg-light">
			<h5><span class="far fa-comment-alt"></span> Commentaires (<?= $nbComments ?>)</h5>
<?php 
	if (empty($comments))
	{
		echo "<p>Soyez le premier à poster un commentaire !</p>";
	}
	else
	{
		foreach ($comments as $comment): 

?>
		<div class="comment">
			<p class="commentHead"><?= htmlspecialchars($comment->author()) ?> <?= $comment->dateCreation() ?></p>
			<p><?= htmlspecialchars($comment->content()) ?></p>
			<p class="commentWarn float-right"><a href="warn-comment.html&id=<?= $post->id() ?>&idComment=<?= $comment->idComment() ?>&warning=<?= $comment->warning() ?>" class="text-color1"><span class="fas fa-exclamation-circle"></span> Signaler</a></p></br>
		</div>
	
<?php endforeach;
	}
?>
	</div>
<?php
	if ($nbComments > 0)
	{
?>
	<nav aria-label="Navigation comments" class="paginationBlock">
			<ul class="pagination justify-content-center">
				<li class="page-item"><a class="page-link bg-light text-color1" href="#"><span aria-hidden="true">&laquo;</span></a></li>
<?php
		if ($nbComments % 10 === 0)
		{
			$nbPages = $nbComments / 10;
		}
		else
		{
			$nbPages = $nbComments / 10 + 1;
		}
		for ($i=1; $i <= $nbPages; $i++)
		{
?>
			<li class="page-item"> <a class="page-link bg-light text-color1" href="post.html?&id=<?= $post->id() ?>&pageCom=<?php echo $i ?>#com"><?php echo $i ?></a> </li>
<?php
		}
?>	
			<li class="page-item"><a class="page-link bg-light text-color1" href="#"><span aria-hidden="true">&raquo;</span></a></li>
		</ul>
	</nav>
<?php
	}
	
?>
	
	</section>
</div>