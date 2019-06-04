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
		throw new Exception("Aucun article à afficher.");
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

	if (empty($post))
	{
		throw new Exception("L'article demandé n'existe pas.");
	}
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
		header('Location: post.html&id=' . $id);
	}
}
function  warnComment($id, $idComment, $warning) //signaler un commentaire 
{
	$commentManager = new CommentManager();
	$affectedLines = $commentManager->warnComment($warning, $idComment);
	if ($affectedLines === false)
	{
		throw new Exception("Impossible de signaler le commentaire");
	}
	else
	{
		header('Location: post.html&id=' . $id);
	}
}
