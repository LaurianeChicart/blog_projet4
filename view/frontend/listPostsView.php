<section class="col-lg-9">
<?php 
	foreach ($posts as $post):

?>
	<div class="article"><a href="post.html&id=<?= $post->id() ?>">
		<h4><?= htmlspecialchars($post->title()) ?></h4>
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
		<p class="text-center"><img src="assets/images/uploads/<?= $post->image() ?>" class="image"></p>
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
		<p><?= htmlspecialchars($content) ?>... <a class="suite" href="post.html&id=<?= $post->id() ?>">Lire la suite</a></p>
	
		<p><?= $commentManager->countComments($post->id()) ?> commentaires</p>
	</a></div>

<?php 
	endforeach;
	if ($nbPosts % 5 === 0)
	{
		$nbPages = $nbPosts / 5;
	}
	else
	{
		$nbPages = $nbPosts / 5 + 1;
	}
?>
		<p>Pages : 
<?php
	for ($i=1; $i <= $nbPages; $i++)
	{
?>
	<span> <a href="home.html?pagePost=<?php echo $i ?>"><?php echo $i ?></a> </span>
<?php
	}
?>
	</p>

</section>
<section class="col-lg-3">
	<div class="row">
		<aside class="col-xs-12 text-center">
			<h3>A propos de l'auteur</h3>
			<img src="assets/images/images/morten-pedersen-781801-unsplash.jpg" id="auteur" alt="Jean Forteroche">
			<p>Donec tristique eget augue non efficitur. Duis pharetra sollicitudin erat, eu commodo ipsum pharetra sit amet. Nulla facilisi. Morbi congue urna arcu, in sodales libero fringilla vitae. Suspendisse eu enim viverra, tristique odio congue, congue nulla. Mauris hendrerit bibendum mauris in varius. Aenean consectetur, ante id mattis volutpat, mi eros pulvinar leo, eget fringilla dui erat blandit nisi. Nunc ut mi faucibus, semper neque ac, vehicula nunc. Integer vitae lectus tortor. Donec porttitor massa est. Pellentesque laoreet aliquam nibh, non tincidunt magna mollis non.</p>
		</aside>
		<aside class="col-xs-12">
			<h3>Liste des chapitres</h3>
			<ul>
<?php 
	foreach ($posts as $post):
?>		
				<li><a href="index.php?action=post&id=<?= $post->id() ?>"><?= $post->title() ?>
				</a></li>
<?php 
	endforeach;

?>
			</ul>
		</aside>
	</div>
</section>