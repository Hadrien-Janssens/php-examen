<?php
    require_once dirname(__DIR__,2).'/core/connexionDB.php';

    function reglePost() {
        return [
            'comment' => [
                'require' => true,
                'min' => 1,
                'max' => 255
            ]
        ];
    
    }

function createPost($userId,$comment, $img_url=null ) {
    try
    {
        // Instancier la connexion à la base de données.
        $pdo = connexionDB();
        // Préparer la requête SQL :
        $requete = "INSERT INTO chris_posts (user_id, comment, img_url) VALUES (:userId, :comment, :img_url)";
        $stmt = $pdo->prepare($requete);
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':comment', $comment);
        $stmt->bindParam(':img_url', $img_url);
        // Exécuter la requête.
        $stmt->execute();
    }
    catch(\PDOException $e)
    {
        gerer_exceptions($e);
        throw new Exception($e);
    }
}

function getPosts(){
    try {
        $pdo = connexionDB();
        // rechercher les données de l'utilisateur en fonction du pseudo entré
        $requete = "SELECT * FROM chris_posts";
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
function getNumberLike($id) {
    try {
        $pdo = connexionDB();
        // Préparer la requête avec des paramètres nommés pour éviter les injections SQL
        $requete = "SELECT COUNT(*) FROM chris_likes WHERE post_id = :id";
        $stmt = $pdo->prepare($requete);
        $stmt->execute([':id' => $id]);
        
        // Récupérer le nombre de likes (première colonne de la première ligne du résultat)
        //merci chatGPT
        $likeCount = $stmt->fetchColumn();
        
        return $likeCount;

    } 
    catch(\PDOException $e) {
        gerer_exceptions($e);
    }
}

function postIsLikedByConnectedUser($userId, $postId) {
    try {
        $pdo = connexionDB();
        // Préparer la requête avec des paramètres nommés pour éviter les injections SQL
        $requete = "SELECT count(*) FROM chris_likes WHERE post_id = :postId AND user_id = :userId";
        $stmt = $pdo->prepare($requete);
        $stmt->bindParam(':postId', $postId);
        $stmt->bindParam(':userId', $userId);

        $stmt->execute();

        //ça c'est chatGpt qui m'a aidé, j'avoue
        $isLiked = $stmt->fetchColumn() > 0;
        
        return $isLiked;

    } 
    catch(\PDOException $e) {
        gerer_exceptions($e);
    }
}


function likePost($userId, $postId) {
    try {
        $pdo = connexionDB();
        
        // Préparer la requête avec des paramètres nommés
        $requete = "INSERT INTO  chris_likes (user_id, post_id)
                    VALUE (:userId , :postId)";
        
        $stmt = $pdo->prepare($requete);
        
        // Exécuter la requête avec les paramètres
        $stmt->execute([
            ':userId' => $userId,
            ':postId' => $postId
        ]);
        
    } 
    catch(\PDOException $e) {
        gerer_exceptions($e);
    }
}
function dislikePost($userId , $postId) {
    try {
        $pdo = connexionDB();
        
        // Préparer la requête avec des paramètres nommés
        $requete = "DELETE FROM chris_likes WHERE post_id = :postId AND user_id = :userId";
        
        $stmt = $pdo->prepare($requete);
        
        // Exécuter la requête avec les paramètres
        $stmt->execute([
            ':postId' => $postId,
            ':userId' => $userId
        ]);
    } 
    catch(\PDOException $e) {
        gerer_exceptions($e);
    }
}


function deletePostDB($id) {
    try
    {
        $pdo = connexionDB();

        $requete = "DELETE FROM chris_posts WHERE id = :idPost ";
        $stmt = $pdo->prepare($requete);
        $stmt->bindValue(':idPost', $id, PDO::PARAM_INT);

        $stmt->execute();
    }
    catch(PDOException $e)
    {
        gerer_exceptions($e);
    }
}


function updatePostDB($id, $newComment) {
    try
    {
        $pdo = connexionDB();

        $requete = "UPDATE chris_posts SET comment ='$newComment'  WHERE id = :idPost";
        $stmt = $pdo->prepare($requete);
        $stmt->bindValue(':idPost', $id, PDO::PARAM_INT);

        $stmt->execute();
    }
    catch(PDOException $e)
    {
        gerer_exceptions($e);
    }
}