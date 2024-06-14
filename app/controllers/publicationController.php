<?php
require_once dirname(__DIR__,2)."/core/getInfoUser.php";
require_once dirname(__DIR__,2)."/constantes/constantes.php";
require_once dirname(__DIR__,2)."/core/gestionFormulaire.php";
require_once dirname(__DIR__)."/models/postModel.php";
require_once dirname(__DIR__)."/models/postModel.php";
require_once dirname(__DIR__,2)."/core/gestionVue.php";

function publication() {
    // renvoyer une erreur si l'utilisateur redige un post vid
        $dataArrayClean = xssSecurity($_POST);
        $regles = reglePost();
        $args['erreurs'] = [];
        $args['erreurs'] = traitement($regles, $_POST);

        if (!empty($args['erreurs'])) {
           
               $args['posts'] = getPosts();
                afficher_vue(obtenir_pageInfos(),'index',$args);
                return;
                
        }

        $utilisateur = getInfoUser($_SESSION['utilisateur_id']);
        $userId = $utilisateur['UseId'];
        $comment = $dataArrayClean['comment'];
        try {
            createPost($userId, $comment);
        // Rediriger l'utilisateur vers la même page pour éviter la resoumission du formulaire

        $args['posts'] = getPosts();
        afficher_vue(obtenir_pageInfos(),'index',$args);
        return;
            // header("Location: " . BASE_URL);


        } catch (\Throwable $th) {
            echo $th;
        }
    }

    function obtenir_pageInfos(): array
    {
        return [
            'vue' => 'accueil',
            'titre' => "Page d'Accueil",
            'description' => "Description de la page d'accueil..."
        ];
    }