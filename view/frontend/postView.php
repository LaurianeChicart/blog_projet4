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
			<div class="text-center"><img src="assets/images/uploads/l<?= $post->image() ?>" srcset="assets/images/uploads/m<?= $post->image() ?> 500w" sizes="(max-width: 700px) 700px, 40vw" class="largeImage image"></div>
			<p class="text-justify"> <?= $post->content() ?></p>

	</section>
	<section>
		<div class="article bg-light">
			<h5><span class="fas fa-pen-fancy"></span> Ajouter un commentaire <small><a href="legal.html#rules" rel="nofollow">(Règlement du blog)</a></small></h5>
			
			<div class="d-flex justify-content-center">
				<form action="edit-comment.html&id=<?= $post->id() ?>" method="post" id="formComment">
					<div class="form-group">
						<label for="author">Nom</label><input type="text" name="author" id="author"class="form-control" required>
					</div>
					<div class="form-group">
						<label for="comment">Commentaire</label><textarea name="comment" class="form-control" id="comment" required></textarea>
					</div>
						<input type="submit" value="Envoyer" class="btn bg-primary float-right"><br><br>
				</form>
			</div>
		</div>
		<div id="com" class="article bg-light">
			<h5><span class="far fa-comment-alt"></span> Commentaires (<?= $nbComments ?>)</h5>
<?php 
	if ($nbComments == 0)
	{
		echo "<p>Soyez le premier à poster un commentaire !</p>";
	}
	else
	{
		foreach ($comments as $comment): 

?>
		<div class="comment">
			<p class="bg-primary"><?= htmlspecialchars($comment->author()) ?> <?= $comment->dateCreation() ?></p>
			<p><?= htmlspecialchars($comment->content()) ?></p>
<?php
		if (isset($_SESSION['warn' . $comment->idComment()]))
		{
?>
			<p class="float-right text-primary"><span class="fas fa-check-circle"></span> Commentaire signalé</p><br>
<?php
		}
		else
		{
?>
			<div class="float-right"><a href="warn-comment.html&id=<?= $post->id() ?>&idComment=<?= $comment->idComment() ?>&warning=<?= $comment->warning() ?>" class="warnComment"><span class="fas fa-exclamation-circle"></span> Signaler</a></div><br>
<?php
		}
?>
		</div>
	
<?php 	
		endforeach;
	
?>
	</div>
		<nav aria-label="Navigation comments" class="paginationBlock">
			<ul class="pagination justify-content-center">
<?php
?>
<?php
		if (isset($_GET['pageCom']))
		{
		    $pageCom = $_GET['pageCom'];
		   
		}
		else
		{
		    $pageCom = 1;
		}

		if ($pageCom == 1)
		{
?>
				<li class="page-item disabled"><a class="page-link bg-light" href="#"><span aria-hidden="true">&laquo;</span></a></li>
<?php
		}
		else
		{
			$previous = $pageCom - 1;
?>
				<li class="page-item"><a class="page-link bg-light" href="post.html?id=<?= $post->id() ?>&pageCom=<?= $previous?>#com"><span aria-hidden="true">&laquo;</span></a></li>
<?php
		}
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
			if($pageCom == $i)
			{
?>
				<li class="page-item"> <a class="page-link text-decoration-none bg-primary text-white" href="post.html?id=<?= $post->id() ?>&pageCom=<?php echo $i ?>#com"><?php echo $i ?></a> </li>
<?php
			}
			else
			{
?>
				<li class="page-item"> <a class="page-link bg-light" href="post.html?id=<?= $post->id() ?>&pageCom=<?php echo $i ?>#com"><?php echo $i ?></a> </li>
<?php
			}
		}
		if ($pageCom == $nbPages)
		{
?>	
				<li class="page-item disabled"><a class="page-link bg-light" href="#"><span aria-hidden="true">&raquo;</span></a></li>
<?php
		}
		else
		{
			$next = $pageCom + 1;
?>
				<li class="page-item"><a class="page-link bg-light" href="post.html?id=<?= $post->id() ?>&pageCom=<?= $next?>#com"><span aria-hidden="true">&raquo;</span></a></li>
<?php
		}
	}
	
?>
			</ul>
		</nav>

	
	</section>
</div>