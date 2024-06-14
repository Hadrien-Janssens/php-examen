<?php
require_once __DIR__."/connexionDB.php";

function getInfoUser($id) {
  
    try
    {
        $pdo = connexionDB();
        // rechercher les données de l'utilisateur en fonction du pseudo entré
        $requete = "SELECT * FROM chris_Users WHERE UseId = :id";
        $stmt = $pdo->prepare($requete);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        //recupere toutes les données de l'utilisateur
        $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);
        return $utilisateur;
}
catch(\PDOException $e)
    {
        gerer_exceptions($e);
    }
}
?>