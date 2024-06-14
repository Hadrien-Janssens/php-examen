<?php
require_once __DIR__."/connexionDB.php";

function connecterUtilisateur($email, $password) {
    //la fonction ne fait que creer un variable de session
    try
    {
        $pdo = connexionDB();
        // rechercher les données de l'utilisateur en fonction du email entré
        $requete = "SELECT * FROM chris_Users WHERE UseEmail = :email";
        $stmt = $pdo->prepare($requete);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        //recupere toutes les données de l'utilisateur
        $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);
        //tester si le mot de passe correcspond a l'identifiant
        if (!empty($utilisateur) && password_verify($password, $utilisateur['UsePassword'])) {
         $_SESSION['utilisateur_id']= $utilisateur['UseId'];

        }
    }
    catch(\PDOException $e)
    {
        gerer_exceptions($e);
    }
}

function est_connecte($id) {
    if (isset($id)) {
        return true ;
    }
    else {
        return false ;
    }
}

function deconnecter_utilisateur() {
    session_destroy();
}