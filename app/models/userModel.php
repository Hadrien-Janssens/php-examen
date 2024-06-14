<?php
    require_once dirname(__DIR__,2).'/core/connexionDB.php';


    $reglesChangementEmail = [
        "email" => [
            "require" => true,
            "max" => 255,
            "min" => 2,
            "unique" => true
        ],
];
function getReglesConnection( ){
    return [
        "email" => [
          "require" => true,
          "max" => 255,
          "min" => 2,
          "unique"=> true
        ],
        "password" => [
            "require" => true,
            "max" => 72,
            "min" => 8
        ]
    ];

};

function getReglesInscritpion(){
    return [
        "pseudo" => [
          "require" => true,
          "max" => 255,
          "min" => 2
        ],
        "password" => [
            "require" => true,
            "max" => 72,
            "min" => 8
        ],
        "email" => [
            "require" => true,
            "max" => 255,
            "min" => 2,
            "unique" => true
        ],
        "confirmation" => [
            "require" => true,
            "max" => 72,
            "min" => 8
        ]
    ];
}

function createUser($pseudo,$email, $password ) {
    $motDePasseHashed = password_hash($password,PASSWORD_BCRYPT );
    try
    {
        // Instancier la connexion à la base de données.
        $pdo = connexionDB();
        // Préparer la requête SQL :
        $requete = "INSERT INTO chris_Users (UsePseudo, UseEmail, UsePassword) VALUES (:pseudo, :email, :password)";
        $stmt = $pdo->prepare($requete);
        $stmt->bindParam(':pseudo', $pseudo);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $motDePasseHashed);
        // Exécuter la requête.
        $stmt->execute();
    }
    catch(\PDOException $e)
    {
        gerer_exceptions($e);
        throw new Exception($e);
    }
}

function saveImgToDb($id, $pathImg) {
    try {
        $pdo = connexionDB();
        
        // Préparer la requête avec des paramètres nommés
        $requete = "UPDATE chris_Users
                    SET img_profil = :pathImg
                    WHERE UseId = :id";
        
        $stmt = $pdo->prepare($requete);
        
        // Exécuter la requête avec les paramètres
        $stmt->execute([
            ':pathImg' => $pathImg,
            ':id' => $id
        ]);
    } 
    catch(\PDOException $e) {
        gerer_exceptions($e);
    }
}
function updateUser($userId, $champs , $value) {
    try {
        $pdo = connexionDB();
        // Préparer la requête avec des paramètres nommés
        $requete = "UPDATE chris_Users
                    SET $champs = :value
                    WHERE UseId = :userId";
        $stmt = $pdo->prepare($requete);
        // Exécuter la requête avec les paramètres
        $stmt->execute([
            ':value' => $value,
            ':userId' => $userId
        ]);
    } 
    catch(\PDOException $e) {
        gerer_exceptions($e);
    }

}
function getUserPosts($id){
    try {
        $pdo = connexionDB();
        // rechercher les données de l'utilisateur en fonction du pseudo entré
        $requete = "SELECT * FROM chris_posts WHERE user_id = $id";
        $stmt = $pdo->prepare($requete);
        $stmt->execute();
        //recupere toutes les posts
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $posts;

    } 
    catch(\PDOException $e){
        gerer_exceptions($e);
    }
}

function deleteUserDB($userId){
    try {
        $pdo = connexionDB();
        
  
        // Supprimer l'utilisateur
        $requete = "DELETE FROM chris_Users WHERE UseId = :userId";
        $stmt = $pdo->prepare($requete);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();

    } 
    catch(\PDOException $e){
        gerer_exceptions($e);
    }
}