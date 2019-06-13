<?php

require('controller/frontend.php');
require('controller/backend.php');

include_once('classes/Autoloader.php');

Autoloader::start();
session_start();
try
{
    if (isset($_GET['action']))
    {
        $action = $_GET['action'];
    //PAGE D'ACCUEIL DU BLOG
        if ($action == 'home.html') 
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
    //PAGE D'ARTICLE
        else if ($action == 'post.html') 
        {
            if (isset($_GET['id']) && $_GET['id'] > 0) //et ce post existe
            {
                if (isset($_GET['pageCom']) && $_GET['pageCom'] > 0) 
                {
                    $pageCom = $_GET['pageCom'];
                    showPost($_GET['id'], $pageCom);
                   
                }
                else
                {
                    $pageCom = 1;
                    showPost($_GET['id'], $pageCom);
                }
                
            }
            
        }
    //PUBLIER UN COMMENTAIRE
        else if ($action == 'edit-comment.html') 
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
    //SIGNALER UN COMMENTAIRE
        else if ($action == 'warn-comment.html') 
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
    //PAGE DE CONTACT
        elseif ($action == "contact.html")
        {
            contactPage();
        }
    //ENVOI DU MAIL
        elseif ($action == "send-mail.html") 
        {
            if (isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['mail']) && !empty($_POST['mail']) && isset($_POST['subject']) && !empty($_POST['subject']) && isset($_POST['message']) && !empty($_POST['message'])) 
            {
                if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", htmlspecialchars($_POST['mail'])))
                {
                        sendMail(htmlspecialchars($_POST['name']), htmlspecialchars($_POST['mail']), htmlspecialchars($_POST['subject']), htmlspecialchars($_POST['message']));
                }
                else
                {
                    backToContact(htmlspecialchars($_POST['name']), htmlspecialchars($_POST['mail']), htmlspecialchars($_POST['subject']), htmlspecialchars($_POST['message']), "Adresse e-mail incorrecte");
                }
            }
            else
            {
                backToContact(htmlspecialchars($_POST['name']), htmlspecialchars($_POST['mail']), htmlspecialchars($_POST['subject']), htmlspecialchars($_POST['message']), "Merci de remplir tous les champs du formulaire");
            }
            
        }
    //MENTIONS LEGALES
        elseif ($action == "legal.html") 
        {
            legalMentions();
        }
    //INTERFACE DE CONNEXION
        elseif ($action == 'connection.html')
        {
            connectionInterface();
        }
    //VERIFICATION DES DONNEES DE CONNEXION
        elseif ($action == 'authentification.html')
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
            //DECONNEXION
                if ($action == 'deconnection.html')
                {
                    deconnection();
                }
            //PAGE DU DASHBOARD
                elseif ($action == 'dashboard.html')
                {
                    showDashboard();
                }
            //PAGE DE L'EDITEUR DE TEXTE VIDE
                elseif ($action == 'post-editor.html')
                {
                    showEditor();
                }
            //ENREGISTRER LE POST EN BROUILLON
                elseif ($action == 'save-as-draft.html')
                {
                    if (isset($_POST['content']) && !empty($_POST['content']))
                    {
                        $content = $_POST['content'];
                    }
                    else
                    {
                        $content = null;
                    }
                    if (isset($_POST['alt']) && !empty($_POST['alt']))
                    {
                        $alt = $_POST['alt'];
                    }
                    else
                    {
                        $alt = null;
                    }
                    if (isset($_POST['title']) && !empty($_POST['title']))
                    {

                        if (isset($_FILES['image']) && !empty($_FILES['image']['name'])  && $_FILES['image']['error'] == 0) 
                        {
                            if ($_FILES['image']['size'] <= 1000000)
                            {
                                addAPost($_POST['title'], $content, $alt, true, $_FILES['image']);
                            }
                            else
                            {
                                backToEditor($_POST['title'], $content, $alt, 'L\'image ne doit pas dépasser 1Mo.');
                            }
                        }
                        else
                        {
                            addAPost($_POST['title'], $content, $alt, true, null);
                        }
                    }
                    else
                    {
                        throw new Exception('Erreur : Il manque des informations pour enregistrer ce brouillon');
                    }
                }
            //PUBLIER UN POST
                elseif ($action == 'edit-post.html')
                {
                    if (!empty($_POST['title']) && isset($_POST['content']) && !empty($_POST['content']) && isset($_POST['alt']))
                    {
                        if (isset($_FILES['image']) && !empty($_FILES['image']['name'])  && $_FILES['image']['error'] == 0) 
                        {
                            if ($_FILES['image']['size'] <= 1000000)
                            {
                                addAPost($_POST['title'], $_POST['content'], $_POST['alt'], false, $_FILES['image']);
                            }
                            else
                            {
                                backToEditor($_POST['title'], $_POST['content'], $_POST['alt'], 'L\'image ne doit pas dépasser 1Mo.');
                                
                            }
                        }
                        else
                        {
                            backToEditor($_POST['title'], $_POST['content'], $_POST['alt'], 'Pour publier, vous devez choisir une image.');
                        }
                    }
                    else
                    {
                        backToEditor($_POST['title'], $_POST['content'], $_POST['alt'], 'Il manque des informations pour publier ce post.');
                        
                    }
                }
            //PAGE DE MODIFICATION DE POST
                elseif ($action == 'modify-post.html')
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
            //MISE A JOUR DU POST MOFIFIE
                elseif ($action == 'update-post.html')
                {

                    if (isset($_GET['id']) && $_GET['id'] > 0) 
                    {
                        if (isset($_POST['content']) && !empty($_POST['content']))
                        {
                            $content = $_POST['content'];
                        }
                        else
                        {
                            $content = null;
                        }
                        if (isset($_POST['alt']) && !empty($_POST['alt']))
                        {
                            $alt = $_POST['alt'];
                        }
                        else
                        {
                            $alt = null;
                        }
                        

                        if (isset($_POST['title']) && !empty($_POST['title']) && isset($_POST['content']) && !is_null($content) && !is_null($alt) && isset($_POST['dateCreation']) && !is_null($_POST['formerImage']) && isset($_POST['formerImage']) && !empty($_POST['formerImage']))
                        {
                            if (isset($_FILES['image']) && !empty($_FILES['image']['name'])  && $_FILES['image']['error'] == 0) //remplacement d'image 
                            {
                                if ($_FILES['image']['size'] <= 1000000)
                                {
                                    upadateAPost($_GET['id'], $_POST['title'], $content, $_POST['dateCreation'], $alt, false, $_POST['formerImage'], $_FILES['image']);
                                }
                                else
                                {
                                    backToEditorPost($_POST['title'],$content,  $alt, $_POST['dateCreation'], false, 'L\'image ne doit pas dépasser 1Mo.', null, $_POST['formerImage'], $_GET['id']);
                                }
                            }
                            elseif (empty($image['name'])) //on ne modifie pas l'image précédemment sélectionnée
                            {
                                upadateAPost($_GET['id'], $_POST['title'], $content, $_POST['dateCreation'], $alt, false, $_POST['formerImage'], null);
                            }
                            
                        }
                        else
                        {
                            
                            backToEditorPost($_POST['title'], $content, $alt, $_POST['dateCreation'], false, 'Il manque des informations pour mettre à jour ce post.',  null, $_POST['formerImage'], $_GET['id']);
                        }
                    }
                    else
                    {
                        throw new Exception('Erreur : Post inconnu');
                    }
                    
                }
            //SUPPRIMER POST
                elseif ($action == 'delete-post.html')
                {
                    if (isset($_POST['id']) && $_POST['id'] > 0) 
                    {
                        deleteAPost($_POST['id']);
                    }
                    else
                    {
                        throw new Exception('Erreur : Post inconnu');
                    }
                }
            //PAGE DE MODIFICATION D'UN BROUILLON
                elseif ($action == 'modify-draft.html')
                {
                    if (isset($_GET['id']) && $_GET['id'] > 0) 
                    {
                        showDraftInEditor($_GET['id']);
                    }
                    else
                    {
                        throw new Exception('Erreur : Brouillon inconnu');
                    }
                }
            //MISE A JOUR DU BROUILLON MODIFIE
                elseif ($action == 'update-draft.html')
                {
                    if (isset($_GET['id']) && $_GET['id'] > 0) 
                    {
                        if (isset($_POST['content']) && !empty($_POST['content']))
                        {
                            $content = $_POST['content'];
                        }
                        else
                        {
                            $content = null;
                        }
                        if (isset($_POST['alt']) && !empty($_POST['alt']))
                        {
                            $alt = $_POST['alt'];
                        }
                        else
                        {
                            $alt = null;
                        }
                        if (isset($_POST['formerImage']) && !empty($_POST['formerImage']))
                        {
                            $formerImage = $_POST['formerImage'];
                        }
                        else
                        {
                            $formerImage = null;
                        }
                        

                        if (isset($_POST['title']) && !empty($_POST['title']) && isset($_POST['dateCreation']))
                        {

                            if(isset($_FILES['image']) && $_FILES['image']['error'] == 0 && !empty($_FILES['image']['name'])) //nouvelle image
                            {
                                
                                if ($_FILES['image']['size'] <= 1000000)
                                {
                                    upadateAPost($_GET['id'], $_POST['title'], $content, $_POST['dateCreation'], $alt, true, $formerImage, $_FILES['image']);
                                }
                                else
                                {
                                    backToEditorPost($_POST['title'], $content, $alt, $_POST['dateCreation'], true, 'L\'image ne doit pas dépasser 1Mo.', null, null, $_GET['id']);
                                }
                                
                            }
                            elseif(empty($_FILES['image']['name'])) //on conserve l'image précédente
                            {
                                upadateAPost($_GET['id'], $_POST['title'], $content, $_POST['dateCreation'], $alt, true, $formerImage, null);
                            }
                        
                        }
                        else
                        {
                            backToEditorPost($_POST['title'], $content, $alt, $_POST['dateCreation'], true, 'Un brouillon doit avoir un titre', null, $formerImage, $_GET['id']);
                        }
                        
                    }
                    else
                    {
                        throw new Exception('Erreur : Brouillon inconnu');
                    }

                }
            //PUBLIER UN BROUILLON
            elseif ($action == 'edit-draft.html')
            {
                if (isset($_GET['id']) && $_GET['id'] > 0) 
                {
                    if (isset($_POST['content']) && !empty($_POST['content']))
                    {
                        $content = $_POST['content'];
                    }
                    else
                    {
                        $content = null;
                    }
                    if (isset($_POST['alt']) && !empty($_POST['alt']))
                    {
                        $alt = $_POST['alt'];
                    }
                    else
                    {
                        $alt = null;
                    }
                    if (isset($_POST['formerImage']) && !empty($_POST['formerImage']))
                    {
                        $formerImage = $_POST['formerImage'];
                    }
                    else
                    {
                        $formerImage = null;
                    }

                    if (isset($_POST['title']) && !empty($_POST['title']) && isset($_POST['dateCreation']) && !is_null($content))
                    {

                        if(isset($_FILES['image']) && $_FILES['image']['error'] == 0 && !empty($_FILES['image']['name']) && !is_null($content)) //nouvelle image
                        {
                            
                            if ($_FILES['image']['size'] <= 1000000)
                            {
                                upadateAPost($_GET['id'], $_POST['title'], $content, null, $alt, false, $formerImage, $_FILES['image']);
                            }
                            else
                            {
                                backToEditorPost($_POST['title'], $content, $alt, $_POST['dateCreation'], true, 'L\'image ne doit pas dépasser 1Mo.', null, $formerImage, $_GET['id']);
                            }
                            
                        }
                        elseif(empty($_FILES['image']['name']) && !is_null($formerImage))//pas de nouvelle image
                        {
                            upadateAPost($_GET['id'], $_POST['title'], $content, null, $alt, false, $formerImage, null);
                        }
                        else//pas d'image du tout
                        {
                            backToEditorPost($_POST['title'], $content, $alt, $_POST['dateCreation'], true, 'Pour publier, vous devez choisir une image.', null, $formerImage, $_GET['id']);
                        }
                    
                    }
                    else
                    {
                        backToEditorPost($_POST['title'], $content, $alt, $_POST['dateCreation'], true, 'Veuillez remplir tous les champs.', null, $formerImage, $_GET['id']);
                    }
                    
                }
                else
                {
                    throw new Exception('Erreur : Brouillon inconnu');
                }

            }
        //ESPACE MODERATION
            elseif ($action == 'moderation.html')
            {
                showModerationInterface();
            }
        //LEVER LE SIGNALEMENT
            elseif ($action == 'remove-warning.html')
            {
                if (isset($_POST['id']) && $_POST['id'] > 0)
                {
                    removeWarning($_POST['id']);
                }
                else
                {
                    throw new Exception('Erreur : Commentaire inconnu');
                }
            }
        //SUPPRIMER UN COMMENTAIRE
            elseif ($action == 'delete-comment.html')
            {
                if (isset($_POST['id']) && $_POST['id'] > 0)
                {
                    deleteAComment($_POST['id']);
                }
                else
                {
                    throw new Exception('Erreur : Commentaire inconnu');
                }
            }
            else
            {
                throw new Exception('Erreur : Page inconnue');
            
            }    
        }
        else
        {
            throw new Exception('Erreur : Page inconnue');
        
        }    
    }
      
    else
    {
        showBlog(1);
    }

    
}
catch(Exception $e) 
{ 
	header("HTTP/1.0 404 Not Found");
    $errorMessage = $e->getMessage();
    require('view/frontend/errorView.php');
}




    
    

