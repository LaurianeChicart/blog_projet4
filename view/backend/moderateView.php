<?php $title = 'Espace modération'; ?>
<section class="article bg-light container">

	<h4>Les signalements de commentaires</h4>
	<table class="table table-hover table-sm table-responsive">
		<tr>
		   <th scope="col">Commentaire <span class="badge badge-pill bg-color1">Signalements</span></th>
		   <th scope="col"></th>
		   <th scope="col" class="d-none d-sm-table-cell">Date</th>
		   <th scope="col" class="d-none d-sm-table-cell">Auteur</th>
		 </tr>
<?php
foreach ($warnedComments as $warnedComment):
?>
		<tr>
			<td><a href="post.html&id=<?= $warnedComment->postsId() ?>" target="_blank" class="text-decoration-none text-reset"><?= htmlspecialchars($warnedComment->content()) ?></a></td>
			<td><span class="badge badge-pill bg-color1"><?= $warnedComment->warning() ?></span></td>
			<td class="d-none d-sm-table-cell"><?= $warnedComment->dateCreation() ?></td>
			<td class="d-none d-sm-table-cell"><?= $warnedComment->author() ?></td>
			<td id="buttonsCell"><button class="btn bg-color1 btn-sm"><a href="remove-warning.html&id=<?= $warnedComment->idComment() ?>" class="text-decoration-none text-white">Lever les signalements</a></button>
				<button class="btn bg-color1 btn-sm"><a href="delete-comment.html&id=<?= $warnedComment->idComment() ?>" class="text-decoration-none text-white">Supprimer le commentaire</a></button></td>
		</tr>
<?php
endforeach;
?>
	</table>
</section>