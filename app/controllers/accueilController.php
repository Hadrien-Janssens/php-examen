<?php
require_once dirname(__DIR__,2)."/constantes/constantes.php";
require_once dirname(__DIR__,2)."/core/gestionFormulaire.php";
require_once dirname(__DIR__)."/models/postModel.php";
require_once dirname(__DIR__)."/models/userModel.php";
require_once dirname(__DIR__,2)."/core/gestionVue.php";
require_once dirname(__DIR__,2)."/core/gestionAuthentification.php";

// Vérifier si l'utilisateur est connecté
if (!isset(($_SESSION['utilisateur_id'])) || !est_connecte($_SESSION['utilisateur_id'])) {
    header('Location:'. BASE_URL .'/connection');
    exit();
}
// $posts = getPosts();
function obtenir_pageInfos(): array
{
    return [
        'vue' => 'accueil',
        'titre' => "Page d'Accueil",
        'description' => "Description de la page d'accueil..."
    ];
}
function index () {
  $args['posts'] = getPosts();
  afficher_vue(obtenir_pageInfos(),'index',$args);
}
// function deconnecter_utilisateur() {
//     session_destroy();
//     header('Location:'. BASE_URL.'/connection');
//     exit();
// }