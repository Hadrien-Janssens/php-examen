<?php
require_once dirname(__DIR__,2)."/core/getInfoUser.php";
require_once dirname(__DIR__,2)."/constantes/constantes.php";
require_once dirname(__DIR__)."/models/postModel.php";
require_once dirname(__DIR__,2)."/constantes/constantes.php";


function like(?string $chemin = null ){
    $utilisateur = getInfoUser($_SESSION['utilisateur_id']);
    
    // $_POST['like'] etant l'ID du post 
    likePost($utilisateur['UseId'],$_POST['like']);

      // Rediriger l'utilisateur vers la même page pour éviter la resoumission du formulaire
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
// gerer le dislike 