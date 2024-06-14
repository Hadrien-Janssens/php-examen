<?php
require_once dirname(__DIR__,2)."/constantes/constantes.php";
require_once dirname(__DIR__,2)."/core/gestionVue.php";

//tentative mvc

function obtenir_pageInfos(): array
{
    return [
        'vue' => 'succesInscription',
        'titre' => "Page d'succesInscription",
        'description' => "Description de la page d'succesInscription..."
    ];
}

function index () {
  afficher_vue(obtenir_pageInfos(),'index');
}