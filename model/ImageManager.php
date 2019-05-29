<?php
session_start();
// Testons si le fichier a bien été envoyé et s'il n'y a pas d'erreur
if (isset($_FILES['image']) && $_FILES['image']['error'] == 0 && isset($_POST['title'] && !empty($_POST['title']) && isset($_POST['content']) && isset($_POST['alt']))
{
        // Testons si le fichier n'est pas trop gros
        if ($_FILES['image']['size'] <= 1000000)
        {
                // Testons si l'extension est autorisée
                $infosfichier = pathinfo($_FILES['image']['name']);
                $extension_upload = $infosfichier['extension'];
                $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
                if (in_array($extension_upload, $extensions_autorisees))
                {
                       
                        // On peut valider le fichier et le stocker définitivement
                        move_uploaded_file($_FILES['image']['tmp_name'], 'assets/images/uploads/' . basename($_SESSION['id'] . '.' . $extension_upload));
                        
                }
        }
}
