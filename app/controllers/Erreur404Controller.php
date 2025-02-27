<?php
// Importer le gestionnaire de vues.
require_once dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'gestionVue.php';

// Communiquer les informations de la page nécessaire au bon fonctionnement de la vue :
function obtenir_pageInfos(): array
{
    return [
        'vue' => 'erreur404',
        'titre' => "Page d'Erreur 404",
        'description' => "Description de la page d'erreur 404..."
    ];
}

// index : Afficher la liste des utilisateurs (il s'agit de la partie chargée par défaut) :
function index(): void
{
    // Indiquer au navigateur qu'il s'agit d'une erreur 404.
    header("HTTP/1.0 404 Not Found");
    // Charger la vue pour la page d'erreur 404.
    afficher_vue(obtenir_pageInfos(), 'index');
    exit();
}
?>