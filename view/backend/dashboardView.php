<?php $title = 'Accueil'; ?>
<div class="row">
	<section class="col-lg-6">
		<h3>Les posts publiés</h3>
		<table>
<?php
foreach ($posts as $post):
?>
			<tr>
				<td><a href="index.php?action=post.html&id=<?= $post->id() ?>" target="_blank"><?= htmlspecialchars($post->title()) ?></a></td>
				<td>Publié le <?= $post->dateCreationFormat() ?></td>
				<td><button><a href="modify-post.html&id=<?= $post->id() ?>">Modifier</a></button></td>
			</tr>
<?php
endforeach;
?>
		</table>
	</section>
	<div class="col-lg-4">
		<div class="row">
			<aside class="col-lg-6">
				<a href="moderation.html">
					<h3>Modération</h3>
<?php
if ($warnedComments <=1)
{
?>
					<p><?= $warnedComments ?> commentaire signalé</p>
<?php
}
else
{
?>
					<p><?= $warnedComments ?> commentaires signalés</p>
<?php
}
?>
				</a>
			</aside>
			<aside class="col-lg-12">
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
				<ul>
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
		</div>
	</div>
</div>

  
    