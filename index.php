<?php
error_reporting(E_ALL);

ini_set("display_errors", 1);
require_once __DIR__."/core/router.php";


$patterns = [
            'id' => '\d+',
            'slug' => '[a-zA-Z0-9\-\_\/]*',
            ];

$routes = [
    obtenir_route('GET','/','accueilController','index'),
    obtenir_route('GET','/connection','connectionController','index'),
    obtenir_route('POST','/connection','connectionController','connection'),
    obtenir_route('GET','/profil','profilController','index'),
    obtenir_route('POST','/profil','profilController','indexId'),
    obtenir_route('GET','/contact','contactController','index'),
    obtenir_route('POST','/contact','contactController','contact'),
    obtenir_route('GET','/inscription','inscriptionController','index'),
    obtenir_route('POST','/inscription','inscriptionController','inscription'),
    obtenir_route('GET','/succesInscription','successInscriptionController','index'),
    obtenir_route('GET','/verificationIdentite','verificationIdentiteController','verification'),
    obtenir_route('POST','/verificationIdentite','verificationIdentiteController','verification'),
    obtenir_route('GET','/logout','logoutController','deconnecter_utilisateur'),
    obtenir_route('POST','/publication','publicationController','publication'),
   
    //like manager
    obtenir_route('POST','/like','likeController','like'),
    obtenir_route('POST','/dislike','dislikeController','dislike'),
    obtenir_route('POST','/like/{slug}','likeController','like'),
    obtenir_route('POST','/dislike/{slug}','dislikeController','dislike'),

    //update infos user
    obtenir_route('POST','/profil/img','profilController','saveImg'),
    obtenir_route('POST','/profil/name','profilController','updateName'),
    obtenir_route('POST','/profil/email','profilController','updateEmail'),
    obtenir_route('POST','/profil/delete','profilController','deleteUser'),

    //Post routing
    obtenir_route('GET','/deletePost/{id}','profilController','deletePost'),
    obtenir_route('POST','/updatePost/{id}','profilController','updatePost'),


];

demarrer_routeur($routes,$patterns);
?>