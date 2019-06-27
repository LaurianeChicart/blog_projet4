<section class="article bg-light container">
	<h4>Les signalements de commentaires</h4>
<?php
if (empty($warnedComments))
{
?>
	<p>Aucun commentaire signalé actuellement.</p>
<?php
}
else
{
?>
	
	<table class="table table-hover table-responsive">
		<tr>
		   <th scope="col">Commentaire <span class="badge badge-pill bg-primary">Signalements</span></th>
		   <th scope="col"></th>
		   <th scope="col" class="d-none d-sm-table-cell">Date</th>
		   <th scope="col" class="d-none d-sm-table-cell">Auteur</th>
		 </tr>


<?php
	foreach ($warnedComments as $warnedComment):
?>
		<tr>
			<td><a href="post.html&id=<?= $warnedComment->postsId() ?>" target="_blank" class="text-decoration-none text-reset"><?= htmlspecialchars($warnedComment->content()) ?></a></td>
			<td><span class="badge badge-pill bg-primary"><?= $warnedComment->warning() ?></span></td>
			<td class="d-none d-sm-table-cell"><?= $warnedComment->dateCreation() ?></td>
			<td class="d-none d-sm-table-cell"><?= $warnedComment->author() ?></td>
			<td id="buttonsCell">
				<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#dialog-modal" data-message="Etes-vous sûr de vouloir remettre le compteur de signalements à 0 pour ce commentaire ?" data-link="remove-warning.html" data-id="<?= $warnedComment->idComment() ?>">Lever les signalements </button>
				<button class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#dialog-modal" data-message="Etes-vous sûr de vouloir supprimer définitivement ce commentaire ?" data-link="delete-comment.html" data-id="<?= $warnedComment->idComment() ?>">Supprimer le commentaire</button>
			</td>
		</tr>
<?php
	endforeach;
?>
	</table>
<?php
}
?>
</section>

   
