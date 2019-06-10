<?php $title = 'Accueil'; ?>

<section class="col-lg-4">
	<aside class="col-12 bg-light">
		<a href="moderation.html" class="text-decoration-none text-reset">
			<h3>Modération</h3>

<?php
if ($warnedComments == 0)
{
?>
			<p>Pas de commentaire signalé actuellement</p>
<?php
}
elseif ($warnedComments <=1)
{
?>
			<p><span class="fas fa-exclamation-circle"></span> Commentaire signalé <span class="badge badge-pill bg-primary"><?= $warnedComments ?></span></p>
<?php
}
else
{
?>
			<p><span class="fas fa-exclamation-circle"></span> Commentaires signalés <span class="badge badge-pill bg-primary"><?= $warnedComments ?></span></p>
<?php
}
?>
		</a>
	</aside>
	<aside class="col-12 bg-light">
		<h3>Les posts enregistrés en brouillon</h3>
<?php 
if (empty($draftPosts))
{
?>
		<p>Pas de brouillon actuellement.</p>
<?php
}
else
{
?>
		<ul class="list-unstyled">
<?php
foreach ($draftPosts as $draftPost):
?>
			<li><a href="modify-draft.html&id=<?= $draftPost->id() ?>"><?= htmlspecialchars($draftPost->title()) ?></a> (<?= $draftPost->dateCreationFormat() ?>)</li>
<?php
endforeach;
}
?>
		</ul>
	</aside>
</section>
<section class="col-lg-8">
	<div class="article bg-light">
		<h3>Les posts publiés</h3>
		<table class="table table-hover table-sm">
<?php
foreach ($posts as $post):
?>
			<tr>
				<td><a href="index.php?action=post.html&id=<?= $post->id() ?>" target="_blank"><?= htmlspecialchars($post->title()) ?></a></td>
				<td class="d-none d-sm-block">Publié le <?= $post->dateCreationFormat() ?></td>
				<td><a href="modify-post.html&id=<?= $post->id() ?>" class="text-decoration-none btn btn-primary">Modifier</a></td>
			</tr>
<?php
endforeach;
?>
		</table>
	</div>
</section>


  
    