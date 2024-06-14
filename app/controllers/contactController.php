<?php
require_once dirname(__DIR__)."/models/contactModel.php";
require_once dirname(__DIR__,2)."/core/envoyerMail.php";
require_once dirname(__DIR__,2)."/core/gestionVue.php";

function contact() {

    $reglesContact = [
        "name" => [
          "require" => true,
          "max" => 255,
          "min" => 2
        ],
        "firstname" => [
          "require" => false,
          "max" => 255,
          "min" => 2
        ],
        "email" => [
            "require" => true,
            "max" => 255,
            "min" => 2
        ],
        "message" => [
            "require" => true,
            "max" => 3000,
            "min" => 2
          ]
        ];
    $args['postData'] = xssSecurity($_POST);
    $args['erreur']  = traitement($reglesContact,$args['postData']);
    if (isset($_POST) && empty($args['erreur'])) {
        envoyerMail($_POST['name'],'postmaster@hadrien-janssens.com', $_POST['message'],"hadrien.janssens7@gmail.com");
        $validationFormulaire = "formulaire a été envoyé 🥳";
        echo $validationFormulaire;
        index();
    }
    else {
        afficher_vue(obtenir_pageInfos(),'index',$args);
    }

}

//tentative mvc

function obtenir_pageInfos(): array
{
    return [
        'vue' => 'contact',
        'titre' => "Page de contact",
        'description' => "Description de la page de contact..."
    ];
}

function index () {
  afficher_vue(obtenir_pageInfos(),'index');
}