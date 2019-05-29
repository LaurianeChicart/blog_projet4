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
	        	if (isset($_FILES['image']) && $_FILES['image']['error'] == 0 && isset($_POST['title'] && !empty($_POST['title']) && isset($_POST['content']) && isset($_POST['alt']))
	        	{
	        		if ($_FILES['image']['size'] <= 1000000)
	        		{
	        			addADraft($_FILES['image']), $_POST['title'], $_POST['content'], $_POST['alt']);
	        		}
	        		else
	        		{
	        			throw new Exception('Erreur : La taille de l\'image dépasse 1 Mo');
	        		}
	        	}
	        	else
	        	{
	        		throw new Exception('Erreur : Il manque des informations pour enregistrer ce brouillon');
	        	}
	        }
	        elseif ($action == 'edit-post.html')//publier un post
	        {
	        	if (isset($_FILES['image']) && $_FILES['image']['error'] == 0 && !empty($_FILES['image']) && isset($_POST['title'] && !empty($_POST['title']) && isset($_POST['content']) && !empty($_POST['content']) && isset($_POST['alt']))
	        	{
	        		if (!empty($_FILES['image']) 
	        		{
	        			if ($_FILES['image']['size'] <= 1000000)
	        			{
	        				upadateAPost($_GET['id'], $_FILES['image']), $_POST['title'], $_POST['content'], $_POST['alt']));
	        			}
	        			else
		        		{
		        			throw new Exception('Erreur : L\'image ne doit pas dépasser 1Mo;');
		        		}
	        		}
	        		else
	        		{
	        			throw new Exception('Erreur : Le post doit être accompagné d\'une image.');
	        		}
	        	}
	        	else
	        	{
	        		throw new Exception('Erreur : Il manque des informations pour publier ce post.');
	        	}
	        }

	        elseif ($action == 'modify-post.html')//page de modification de post
	        {
	        	if (isset($_GET['id']) && $_GET['id'] > 0) 
	        	{
	        		showPostInEditor($_GET['id']);
	        	}
	        	else
	        	{
	        		throw new Exception('Erreur : Post inconnu');
	        	}
	        }
	        elseif ($action == 'update-post.html')//mise à jour du post modifié
	        {
	        	if (isset($_GET['id']) && $_GET['id'] > 0) 
	        	{
		        	if (isset($_FILES['image']) && $_FILES['image']['error'] == 0 && !empty($_FILES['image']) && isset($_POST['title'] && !empty($_POST['title']) && isset($_POST['content']) && !empty($_POST['content']) && isset($_POST['alt']) && isset($_POST['formerImage']))
		        	{
		        		if (!empty($_FILES['image']) !empty($_POST['formerImage'])) //remplacement d'image 
		        		{
		        			if ($_FILES['image']['size'] <= 1000000)
		        			{
		        				upadateAPost($_GET['id'], $_FILES['image']), $_POST['title'], $_POST['content'], $_POST['alt'], $_POST['formerImage']));
		        			}
		        			else
			        		{
			        			throw new Exception('Erreur : L\'image ne doit pas dépasser 1Mo;');
			        		}
		        		}
		        		elseif (empty($_FILES['image']) && !empty($_POST['formerImage'])) //on ne modifie pas l'image précédemment sélectionnée
		        		{
		        			upadateAPost($_GET['id'], $_POST['title'], $_POST['content'], $_POST['alt'], $_POST['formerImage']));
		        		}
		        		else
		        		{
		        			throw new Exception('Erreur : Le post doit être accompagné d\'une image.');
		        		}
		        	else
		        	{
		        		throw new Exception('Erreur : Il manque des informations pour mettre à jour ce post');
		        	}
		        }
	        	else
	        	{
	        		throw new Exception('Erreur : Post inconnu');
	        	}
	        	
	        }
	        elseif ($action == 'delete-post.html')//supprimer un post
	        {
	        	if (isset($_GET['id']) && $_GET['id'] > 0) 
	        	{
	        		deleteAPost($_GET['id']));
	        	}
	        	else
	        	{
	        		throw new Exception('Erreur : Post inconnu');
	        	}
	        }
	        elseif ($action == 'modify-draft.html')//page de modification de brouillon
	        {
	        	if (isset($_GET['id']) && $_GET['id'] > 0) 
	        	{
	        		showDraftInEditor($_GET['id']));
	        	}
	        	else
	        	{
	        		throw new Exception('Erreur : Brouillon inconnu');
	        	}
	        }
	        elseif ($action == 'update-draft.html')//mise à jour du brouillon modifié
	        {
	        	if (isset($_GET['id']) && $_GET['id'] > 0) 
	        	{	
		        	if (isset($_FILES['image']) && $_FILES['image']['error'] == 0 && isset($_POST['title'] && !empty($_POST['title']) && isset($_POST['content']) && isset($_POST['alt']) && isset($_POST['formerImage']))
		        	{
		        		
			        	if (!empty($_FILES['image']) && empty($_POST['formerImage'])) //première sélection d'image 
		        		{
		        			if ($_FILES['image']['size'] <= 1000000)
		        			{
		        				upadateADraft($_GET['id'], $_FILES['image']), $_POST['title'], $_POST['content'], $_POST['alt']);
		        			}
		        			else
			        		{
			        			throw new Exception('Erreur : L\'image ne doit pas dépasser 1Mo;');
			        		}
		        		}
		        		if (!empty($_FILES['image']) !empty($_POST['formerImage'])) //remplacement d'image 
		        		{
		        			if ($_FILES['image']['size'] <= 1000000)
		        			{
		        				upadateADraft($_GET['id'], $_FILES['image']), $_POST['title'], $_POST['content'], $_POST['alt'], $_POST['formerImage']));
		        			}
		        			else
			        		{
			        			throw new Exception('Erreur : L\'image ne doit pas dépasser 1Mo;');
			        		}
		        		}
		        		else //on n'ajoute ni ne modifie d'image
		        		{
		        			upadateADraft($_GET['id'], $_POST['title'], $_POST['content'], $_POST['alt'], $_POST['formerImage']));
		        		}
		        		
		        	}
		        	else
		        	{
		        		throw new Exception('Erreur : Il manque des informations pour mettre à jour ce brouillon');
		        	}
		        else
	        	{
	        		throw new Exception('Erreur : Brouillon inconnu');
	        	}
	        }
	        elseif ($action == 'edit-draft.html')//publier un brouillon
	        {
	        	if (isset($_GET['id']) && $_GET['id'] > 0) 
	        	{
		        	if (isset($_FILES['image']) && $_FILES['image']['error'] == 0 && !empty($_FILES['image']) && isset($_POST['title'] && !empty($_POST['title']) && isset($_POST['content']) && !empty($_POST['content']) && isset($_POST['alt']) && isset($_POST['formerImage']))
		        	{
		        		if (!empty($_FILES['image']) && empty($_POST['formerImage'])) //première sélection d'image 
		        		{
		        			if ($_FILES['image']['size'] <= 1000000)
		        			{
		        				upadateAPost($_GET['id'], $_FILES['image']), $_POST['title'], $_POST['content'], $_POST['alt']);
		        			}
		        			else
			        		{
			        			throw new Exception('Erreur : L\'image ne doit pas dépasser 1Mo;');
			        		}
		        		}
		        		if (!empty($_FILES['image']) !empty($_POST['formerImage'])) //remplacement d'image 
		        		{
		        			if ($_FILES['image']['size'] <= 1000000)
		        			{
		        				upadateAPost($_GET['id'], $_FILES['image']), $_POST['title'], $_POST['content'], $_POST['alt'], $_POST['formerImage']));
		        			}
		        			else
			        		{
			        			throw new Exception('Erreur : L\'image ne doit pas dépasser 1Mo;');
			        		}
		        		}
		        		elseif (empty($_FILES['image']) && !empty($_POST['formerImage'])) //on ne modifie pas l'image précédemment sélectionnée
		        		{
		        			upadateAPost($_GET['id'], $_POST['title'], $_POST['content'], $_POST['alt'], $_POST['formerImage']));
		        		}
		        		else
		        		{
		        			throw new Exception('Erreur : Le post doit être accompagné d\'une image.');
		        		}
		        	}
		        	else
		        	{
		        		throw new Exception('Erreur : Il manque des informations pour publier ce post');
		        	}
		        else
	        	{
	        		throw new Exception('Erreur : Brouillon inconnu');

	        }
	        elseif ($action == 'moderation.html')//espace modération
	        {
	        	showModerationInterface();
	        }
	        elseif ($action == 'remove-warning.html')//lever le signalement
	        {
	        	if (isset($_GET['id']) && $_GET['id'] > 0)
	        	{
	        		removeWarning($_GET['id']);
	        	}
	        	else
	        	{
	        		throw new Exception('Erreur : Commentaire inconnu');
	        	}
	        }
	        elseif ($action == 'delete-comment.html')//supprimer commentaire
	        {
	        	if (isset($_GET['id']) && $_GET['id'] > 0)
	        	{
	        		deleteAComment($_GET['id']);
	        	}
	        	else
	        	{
	        		throw new Exception('Erreur : Commentaire inconnu');
	        	}
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