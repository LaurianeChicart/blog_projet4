<?php
require('controller/backend.php');

include_once('classes/Autoloader.php');

Autoloader::start();
session_start();
try
{
    if (isset($_GET['action']))
    {
        $action = $_GET['action'];

        if ($action == 'connection.html')//interface de connexion
        {
        	connectionInterface();
        }
        elseif ($action == 'authentification.html')//vérification des données de connexion
        {
        	if (isset($_POST['name']) && isset($_POST['password']) && !empty($_POST['name']) && !empty($_POST['password']))
        	{
           		authentification($_POST['name'], $_POST['password']);
        	}
        	else
        	{
        		throw new Exception('Erreur : Mauvaise saisie des informations.');
        	}
        }
        elseif (isset($_SESSION['name']))
        {
	        if ($action == 'deconnection.html')//déconnexion
	        {
	        	deconnection();
	        }
	        elseif ($action == 'dashboard.html')//page du dashboard
	        {
	        	showDashboard();
	        }
	        elseif ($action == 'post-editor.html')//page de création de post
	        {
	        	showEditor();
	        }
	        elseif ($action == 'save-as-draft.html')//enregistré un post en brouillon
	        {

	        }
	        elseif ($action == 'edit-post.html')//publié un post
	        {

	        }
	        elseif ($action == 'modify-post.html')//page de modification de post
	        {

	        }
	        elseif ($action == 'update-post.html')//mise à jour du post modifié
	        {

	        }
	        elseif ($action == 'delete-post.html')//supprimer un post
	        {

	        }
	        elseif ($action == 'modify-draft.html')//page de modification de brouillon
	        {

	        }
	        elseif ($action == 'update-draft.html')//mise à jour du brouillon modifié
	        {

	        }
	        elseif ($action == 'edit-draft.html')//publier un brouillon
	        {

	        }
	        elseif ($action == 'moderation.html')//espace modération
	        {

	        }
	        elseif ($action == 'remove-warning.html')//lever le signalement
	        {

	        }
	        elseif ($action == 'delete-comment.html')//supprimer commentaire
	        {

	        }
	    }
	    else
	    {
	    	connectionInterface();
	    }

    }
    else
    {
        connectionInterface();
    }

    
}
catch(Exception $e) 
{ 
    $errorMessage = $e->getMessage();
    require('view/backend/errorView.php');
}