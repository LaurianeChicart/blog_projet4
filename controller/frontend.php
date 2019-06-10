<?php

// CONTROLLER

function showBlog($pagePost) //page d'accueil du blog
{
	$postManager = new PostManager();
	$posts = $postManager->getPostsList($pagePost); 
	$allPosts = $postManager->getAllPostsList();
	$nbPosts = $postManager->countPosts(); 
	$commentManager = new CommentManager();

	if (empty($posts))
	{
		throw new Exception("Aucun article à afficher sur cette page.");
	}
	else
	{
		$blogView = new View('listPostsView');
		$blogView->getViewFront(array('posts' => $posts), array('commentManager' => $commentManager), array('nbPosts' => $nbPosts), array('allPosts' => $allPosts));
	}

}
function showPost($id, $pageCom) //page article
{
	$postManager = new PostManager();
	$post = $postManager->getPost($id); 

	$commentManager = new CommentManager();
	$comments = $commentManager->getCommentsList($id, $pageCom);
	$nbComments = $commentManager->countComments($id);

	if (is_null($post->id()))
	{
		throw new Exception("L'article demandé n'existe pas.");
	}
	// elseif(empty($comments) && $nbComments !=0)
	// {
	// 	throw new Exception("La page demandée n'existe pas.");
	// }
	else
	{
		$postView = new View('postView');
		$postView->getViewFront(array('post' => $post), array('comments' => $comments), array('nbComments' => $nbComments));
	}
}
function editComment($id, $author, $content) //publier un commentaire
{
	 $newComment = new Comment(array(
		'idComment'	   => null,
		'postsId'      => $id,
		'author'  	   => $author,
		'content'      => $content,
		'dateCreation' => null,
		'warning'      => 0
	));
	$commentManager = new CommentManager();
	$affectedLines = $commentManager->addComment($newComment);
	if ($affectedLines === false)
	{
		throw new Exception("Impossible d'ajouter le commentaire.");
	}
	else
	{
		header('Location: post.html&id=' . $id . '#com');
	}
}
function  warnComment($id, $idComment, $warning) //signaler un commentaire 
{
	$_SESSION['warn' . $idComment] = $idComment;
	$commentManager = new CommentManager();
	$affectedLines = $commentManager->warnComment($warning, $idComment);
	if ($affectedLines === false)
	{
		throw new Exception("Impossible de signaler le commentaire");
	}
	else
	{
		header('Location: post.html&id=' . $id . '#com');
	}
}
function contactPage() //afficher la page de contact
{
	$contactView = new View('contactView');
	$contactView->getViewFront();
}
function backToContact($name, $mail, $subject, $message, $errorMessage)
{
	$contactView = new View('contactView');
	$contactView->getViewFront(array('name' => $name), array('mail' => $mail), array('subject' => $subject), array('message' => $message), array('errorMessage' => $errorMessage));
}
function sendMail($name, $mail, $subject, $message)
{
	$message = '
	<html>
	<body>
		<p>Mail de : <?= $name ?></p>
		<p>Adresse mail : <?= $mail ?></p>
		<p>Sujet : <?= $subject ?></p>
		<p>Message : <br> <?= $message ?></p>
	</body>
	</html>';
	 

	// Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
     $headers = "MIME-Version: 1.0" . "\r\n" . "Content-type: text/html; charset=UTF-8" . "\r\n"; 
	mail('chicartlauriane@gmail.com', $subject, $message, $headers);
}
function legalMentions() //afficher la page des mentions légales
{
	include('view\frontend\legalMentionsView.php');
}