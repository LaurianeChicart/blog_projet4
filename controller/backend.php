<?php

function connectionInterface()
{
	include('view\backend\authentificationView.php');
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
	header('Location:connexion.html');
}

function showDashboard()
{
	$postManager = new PostManager();
	$posts = $postManager->getAllPostsList();
	$draftPosts = $postManager->getDraftPostsList();

	$commentManager = new CommentManager();
	$warnedComments = $commentManager->countWarnedComments();
	
	$dashboardView = new View('dashboardView');
	$dashboardView->getViewBack(array('posts' => $posts), array('draftPosts' => $draftPosts), array('warnedComments' => $warnedComments));
}

function showEditor()
{
	$editPostView = new View('editPostView');
	$editPostView->getViewBack();
}

function addADraft($image, $title, $content, $alt)
{
	if !empty($image)
	//ajouter image à upload
	$newPost = new Post(array(
			'id'		=> $id,
			'title'		=> $title,
			'content'	=> $content,
			'image'		=> $image['name'],
			'alt' 		=> $alt
		));
	if
	//ajouter image à upload
	$postManager = new PostManager();
	$affectedLines = $postManager->updatePost($newPost);

	if ($affectedLines === false)
	{
		throw new Exception("Impossible de mettre à jour le post.");
	}
	else
	{
		header('Location:dashboard.html');
	}
	
}

function addAPost($image, $title, $content, $alt)
{
	header('Location:dashboard.html');
}

function showPostInEditor($id)
{

}

function upadateAPost($id, $image, $title, $content, $alt, $formerImage)
{
	if !empty($image)
	{
		//renommer $image['name']
		//rajouter image à uploads
		//supprimer $formerImage d'uploads
		$imageName = $image['name'];
	}
	else
	{
		$imageName = $formerImage
	}

	$newPost = new Post(array(
			'id'		=> $id,
			'title'		=> $title,
			'content'	=> $content,
			'image'		=> $imageName,
			'alt' 		=> $alt
		));

	$postManager = new PostManager();
	$affectedLines = $postManager->updatePost($newPost);

	if ($affectedLines === false)
	{
		throw new Exception("Impossible de mettre à jour le post.");
	}
	else
	{
		header('Location:dashboard.html');
	}
}

function deleteAPost($id)
{
	header('Location:dashboard.html');
}

function showDraftInEditor($id)
{

}

function upadateADraft($id, $image, $title, $content, $alt, $formerImage)
{
	
}

function draftToPost($id, $image, $title, $content, $alt, $formerImage)
{

}

function showModerationInterface()
{

}

function removeWarning($idComment)
{

}

function deleteAComment($idComment)
{

}
