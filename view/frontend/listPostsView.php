<section class="col-lg-9">
	<div>
<?php 
	foreach ($posts as $post):

?>
		<div class="article bg-light">
			<h4><?= htmlspecialchars($post->title()) ?></h4>
			<p>Publié le <?= $post->dateCreationFormat() ?>
<?php
		if (!is_null($post->dateModifFormat()))
		{
?>
			(modifié le <?= $post->dateModifFormat() ?>) </p>

<?php	
		}
		else
		{
?>
			</p>
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

		
			<p class="text-center"><a href="post.html?id=<?= $post->id() ?>" class="text-reset text-decoration-none"><img src="assets/images/uploads/m<?= $post->image() ?>" alt="<?= $alt ?>" class="image"></a></p>
<?php
		if(strlen($post->content()) <= 1000)
		{
			$content = $post->content();
		}
		else
		{
			$content = substr($post->content(), 0, 1000);
		}
?>
			<p class="text-justify"><?= $content ?>... </p>
			<div class="d-flex justify-content-between align-items-baseline">
<?php
		$nbComments = $commentManager->countComments($post->id());
		if ($nbComments <= 1)
		{
?>
			<p><span class="far fa-comment-alt"></span> <?= $nbComments ?> commentaire</p>
<?php
		}
		else
		{
?>
			<p><span class="far fa-comment-alt"> <?= $nbComments ?></span> commentaires</p>
<?php
		}
?>
			<p><button class="btn btn-primary" href="post.html?id=<?= $post->id() ?>">Lire la suite</button></p></div>
		</div>
	</div>
	
<?php 
	endforeach;
?>
	
	<nav aria-label="Navigation comments">
		<ul class="pagination justify-content-center">

<?php
if (isset($_GET['pagePost']))
{
    $pagePost = $_GET['pagePost'];
   
}
else
{
    $pagePost = 1;
}

if ($pagePost == 1)
{
?>
			<li class="page-item disabled"><a class="page-link bg-light" href="#" tabindex="-1"><span aria-hidden="true">&laquo;</span></a></li>
<?php
}
else
{
	$previous = $pagePost - 1;
?>
			<li class="page-item"><a class="page-link bg-light" href="home.html?pagePost=<?= $previous ?>" tabindex="-1"><span aria-hidden="true">&laquo;</span></a></li>
<?php
}
	if ($nbPosts % 5 === 0)
	{
		$nbPages = $nbPosts % 5;
	}
	else
	{
		$nbPages = $nbPosts % 5 + 1;
	}
	for ($i=1; $i <= $nbPages; $i++)
	{
		if($pagePost == $i)
		{
?>
			<li class="page-item"> <a class="page-link text-decoration-none bg-primary text-white" href="home.html?pagePost=<?php echo $i ?>"><?php echo $i ?></a> </li>
<?php
		}
		else
		{
?>
			<li class="page-item"> <a class="page-link bg-light" href="home.html?pagePost=<?php echo $i ?>"><?php echo $i ?></a> </li>
<?php
		}
	}
	if ($pagePost == $nbPages)
	{
?>
			<li class="page-item disabled"><a class="page-link bg-light"><span aria-hidden="true">&raquo;</span></a></li>
<?php
	}
	else
	{
		$next = $pagePost + 1;
?>
			<li class="page-item"><a class="page-link bg-light" href="home.html?pagePost=<?= $next ?>"><span aria-hidden="true">&raquo;</span></a></li>
<?php
	}
?>

		</ul>
	</nav>

</section>
<section class="col-lg-3">
	
	<aside class="col-12 text-center bg-light">
		<h3>A propos de l'auteur</h3>
		<img src="assets/images/images/morten-pedersen-781801-unsplash.jpg" id="auteur" alt="Jean Forteroche">
		<p>Donec tristique eget augue non efficitur. Duis pharetra sollicitudin erat, eu commodo ipsum pharetra sit amet. Nulla facilisi. Morbi congue urna arcu, in sodales libero fringilla vitae. Suspendisse eu enim viverra, tristique odio congue, congue nulla. Mauris hendrerit bibendum mauris in varius. Aenean consectetur, ante id mattis volutpat, mi eros pulvinar leo, eget fringilla dui erat blandit nisi. Nunc ut mi faucibus, semper neque ac, vehicula nunc. Integer vitae lectus tortor. Donec porttitor massa est. Pellentesque laoreet aliquam nibh, non tincidunt magna mollis non.</p>
	</aside>
	<aside class="col-12 text-center bg-light">
		<h3>Liste des chapitres</h3>
		<ul class="list-unstyled">
<?php 
	foreach ($allPosts as $allPost):
?>		
			<li><a href="index.php?action=post&id=<?= $allPost->id() ?>" rel="nofollow"><?= $allPost->title() ?>
			</a></li>
<?php 
	endforeach;

?>
		</ul>
	</aside>
</section>