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