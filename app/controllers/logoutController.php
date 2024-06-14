<?php
require_once dirname(__DIR__,2)."/constantes/constantes.php";
function deconnecter_utilisateur() {
    session_destroy();
    header('Location:'. BASE_URL.'/connection');
    exit();

}