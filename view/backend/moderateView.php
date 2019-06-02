<?php $title = 'Espace modération'; ?>

<h3>Les signalements de commentaires</h3>
	<table>
		<tr>
		   <th>Commentaire</th>
		   <th>Signalements</th>
		   <th>Date</th>
		   <th>Auteur</th>
		 </tr>
<?php
foreach ($warnedComments as $warnedComment):
?>
		<tr>
			<td><a href="post.html&id=<?= $warnedComment->postsId() ?>" target="_blank"><?= htmlspecialchars($warnedComment->content()) ?></a></td>
			<td><?= $warnedComment->warning() ?></td>
			<td><?= $warnedComment->dateCreation() ?></td>
			<td><?= $warnedComment->author() ?></td>
			<td><button><a href="remove-warning.html&id=<?= $warnedComment->idComment() ?>">Lever les signalements</a></button></td>
			<td><button><a href="delete-comment.html&id=<?= $warnedComment->idComment() ?>">Supprimer le commentaire</a></button></td>
		</tr>
<?php
endforeach;
?>
	</table>