<?php

function connectionInterface()
{
	include('view/backend/authentificationView.php');
}

function authentification($name, $password)
{
	$name = htmlspecialchars($name);
	$password = htmlspecialchars($password);
	$identhificationManager = new IdenthificationManager();
	$registeredPassword = $identhificationManager->getPassword($name);
	
	if (!password_verify($password, $registeredPassword))
	{
		throw new Exception("Identifiants incorrects.");	
	}
	else
	{
		session_start();
		$_SESSION['name'] = $name;
		header('Location:dashboard.html');
	}

}

function deconnection()
{
	$_SESSION = array();
	session_destroy();
	header('Location:connection.html');
}

function showDashboard()
{
	$postManager = new PostManager();
	$posts = $postManager->getAllPostsList();
	$draftPosts = $postManager->getDraftPostsList();
	
	$commentManager = new CommentManager();
	$warnedComments = $commentManager->countWarnedComments();

	$dashboardView = new View('dashboardView');
	$dashboardView->getViewBack(array('posts' => $posts), array('draftPosts' => $draftPosts), array('warnedComments' => $warnedComments), array('title' => 'Accueil'));
}

function showEditor()
{
	$editPostView = new View('editPostView');
	$editPostView->getViewBack(array('title' => 'Publier un post'));
}

function addAPost($title, $content, $alt, $draft, $image)
{
	
	if (!is_null($image['name']))
	{	
		$imageManager = New ImageManager();
		$imageName = $imageManager->addImage($image);
	}
	else
	{
		$imageName = null;
	}

	$newPost = new Post(array(
			'title'		=> $title,
			'content'	=> $content,
			'image'		=> $imageName,
			'alt' 		=> $alt,
			'draft'		=> $draft
		));
	
	$postManager = new PostManager();
	$affectedLines = $postManager->addAsPost($newPost);

	if ($affectedLines === false)
	{
		throw new Exception("Impossible d'ajouter le brouillon.");
	}
	else
	{
		header('Location:dashboard.html');
	}
	
}

function backToEditor($title, $content, $alt, $message)
{
	$newPost = new Post(array(
			'title'		=> $title,
			'content'	=> $content,
			'alt' 		=> $alt
		));

	$editPostView = new View('editPostView');
	$editPostView->getViewBack(array('newPost' => $newPost), array('message' => $message), array('title' => 'Publier un post'));
}

function showDraftInEditor($id)
{
	$postManager = new PostManager();
	$post = $postManager->getPost($id); 

	if (empty($post))
	{
		throw new Exception("Le brouillon demandé n'existe pas.");
	}
	else
	{
		$postView = new View('modifyDraftView');
		$postView->getViewBack(array('post' => $post), array('title' => 'Modifier brouillon'));
	}

}

function showPostInEditor($id)
{
	$postManager = new PostManager();
	$post = $postManager->getPost($id); 

	if (empty($post))
	{
		throw new Exception("Le brouillon demandé n'existe pas.");
	}
	else
	{
		$postView = new View('modifyPostView');
		$postView->getViewBack(array('post' => $post), array('title' => 'Modifier post'));
	}
}

function upadateAPost($id, $title, $content, $dateCreation, $alt, $draft, $formerImage, $image)
{
	if (empty($image['name']) && is_null($formerImage)) //pas d'image ni ancienne, ni nouvelle
	{
		$imageName = null;
	}
	elseif (empty($image['name']) && !is_null($formerImage))//on conserve l'image précédemment choisie
	{
		$imageName = $formerImage;
	}
	elseif (!empty($image['name']) && is_null($formerImage))//premier choix d'image pour modifier un brouillon
	{
		$imageManager = New ImageManager();
		$imageName = $imageManager->addImage($image);
	}
	elseif(!empty($image['name']) && !is_null($formerImage) && file_exists("assets/images/uploads/" . $formerImage))//on remplace l'image
	{
		$imageManager = New ImageManager();
		$imageName = $imageManager->addImage($image);
		$imageManager->deleteImage($formerImage);
	}
		
	
	$newPost = new Post(array(
			'id'			=> $id,
			'title'			=> $title,
			'content'		=> $content,
			'dateCreation'	=> $dateCreation,
			'image'			=> $imageName,
			'alt' 			=> $alt,
			'draft'			=> $draft
		));

	$postManager = new PostManager();
	if (is_null($dateCreation))
	{
		$affectedLines = $postManager->updateDraftToPost($newPost);
	}
	else
	{
		$affectedLines = $postManager->updatePost($newPost);
	}


	if ($affectedLines === false)
	{
		throw new Exception("Impossible de mettre à jour le post.");
	}
	else
	{
		header('Location:dashboard.html');
	}
}

function backToEditorPost($title, $content, $alt, $dateCreation, $draft, $message, $image, $formerImage, $id)
{
	if (is_null($image) && is_null($formerImage)) //pas d'image ni ancienne, ni nouvelle
	{
		$imageName = null;
	}
	elseif (is_null($image) && !is_null($formerImage))//on conserve l'image précédemment choisie
	{
		$imageName = $formerImage;
	}
	else 
	{
		$imageName = $image['name'];
	}
	

	$post = new Post(array(
			'id'			=> $id,
			'title'			=> $title,
			'content'		=> $content,
			'dateCreation'	=> $dateCreation,
			'image'			=> $imageName,
			'alt' 			=> $alt,
			'draft'			=> $draft
		));
	if ($draft == true)
	{
		$editPostView = new View('modifyDraftView');
	}
	else
	{
		$editPostView = new View('modifyPostView');
	}
	
	$editPostView->getViewBack(array('post' => $post), array('message' => $message), array('formerImage' => $formerImage), array('title' => 'Modifier post'));
}


function deleteAPost($id)
{
	$postManager = new PostManager();
	$post = $postManager->getPost($id);

	if (!is_null($post->image()) AND file_exists("assets/images/uploads/$post->image()"))
	{

		$imageManager = New ImageManager();
		$imageManager->deleteImage($post->image());
	}

	$postManager->deletePost($id);

	$commentManager = new CommentManager();
	$commentManager->deletePostCommentsList($id);

	header('Location:dashboard.html');
	
	
}


function showModerationInterface()
{
	$commentManager = new CommentManager();
	$warnedComments = $commentManager->getWarnedCommentsList();

	$moderateView = new View('moderateView');
	$moderateView->getViewBack(array('warnedComments' => $warnedComments), array('title' => 'Espace modération'));
}

function removeWarning($idComment)
{
	$commentManager = new CommentManager();
	$commentManager->deleteWarning($idComment);

	header('Location:moderation.html');
}

function deleteAComment($idComment)
{
	$commentManager = new CommentManager();
	$commentManager->deleteComment($idComment);

	header('Location:moderation.html');
}
