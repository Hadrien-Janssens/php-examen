<?php
require_once dirname(__DIR__,2)."/core/getInfoUser.php";
require_once dirname(__DIR__,2)."/constantes/constantes.php";
require_once dirname(__DIR__,2)."/core/gestionFormulaire.php";
require_once dirname(__DIR__)."/models/postModel.php";


function dislike(?string $chemin= null) {

    $utilisateur = getInfoUser($_SESSION['utilisateur_id']);
  
        // $_POST['dislike'] etant l'ID du post 
        dislikePost($utilisateur['UseId'],$_POST['dislike']);
          // Rediriger l'utilisateur vers la même page pour éviter la resoumission du formulaire

          //me pose pas de question la dessus c'est juste horrible
          if ($chemin == null) {
            if (BASE_URL ==='') {
              header("Location: /");
              exit();
            }
          header("Location: ".BASE_URL);
          exit();
          }
          header("Location: /" . $chemin );
          exit();
    
}