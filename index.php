<?php

require('controller/frontend.php');

include_once('classes/Autoloader.php');

Autoloader::start();

try
{
    if (isset($_GET['action']))
    {
        $action = $_GET['action'];

        if ($action == 'home.html') //page d'accueil du blog
        {
            if (isset($_GET['pagePost']) && $_GET['pagePost'] > 0)
            {
                $pagePost = $_GET['pagePost'];
               
            }
            else
            {
                $pagePost = 1;
            }
            showBlog($pagePost);
            
        }
        else if ($action == 'post.html') //page article
        {
            if (isset($_GET['id']) && $_GET['id'] > 0) 
            {
                if (isset($_GET['pageCom']) && $_GET['pageCom'] > 0)
                {
                    $pageCom = $_GET['pageCom'];
                   
                }
                else
                {
                    $pageCom = 1;
                }
                showPost($_GET['id'], $pageCom);
            }
            else
            {
                throw new Exception('Erreur : Cet identifiant ne correspond à aucun post.');
            }
        }
        else if ($action == 'edit-comment.html') //publier un commentaire
        {
            if (isset($_GET['id']) && $_GET['id'] > 0 && isset($_POST['author']) && isset($_POST['comment']) && !empty($_POST['author']) && !empty($_POST['comment'])) 
            {
               editComment($_GET['id'], htmlspecialchars($_POST['author']), htmlspecialchars($_POST['comment']));
            }
            else
            {
                throw new Exception('Erreur : Le commentaire doit avoir un auteur, un contenu et être rattaché à un post.');
            }
        }
        else if ($action == 'warn-comment.html') //signaler un commentaire 
        {
            if (isset($_GET['id']) && $_GET['id'] > 0 && isset($_GET['idComment']) && $_GET['idComment'] > 0 && isset($_GET['warning'])) 
            {
                warnComment($_GET['id'], $_GET['idComment'], $_GET['warning']);
            }
            else
            {
                throw new Exception('Erreur : Signalement non-valide.');
            }
        }

    }
    else
    {
        showBlog(1);
    }

    
}
catch(Exception $e) 
{ 
    $errorMessage = $e->getMessage();
    require('view/frontend/errorView.php');
}



