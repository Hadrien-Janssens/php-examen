<?php
require_once dirname(__DIR__)."/core/connexionDB.php";

function stockerCodeActivation($id, $codeActivation) {
    try {
        $pdo = connexionDB();
        $requete = "UPDATE chris_Users SET UseCodeActivation = :codeActivation WHERE UseId = :id";
        $stmt = $pdo->prepare($requete);
        $stmt->bindParam(':codeActivation', $codeActivation, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    } 
    catch(\PDOException $e) {
        gerer_exceptions($e);
        throw new Exception($e->getMessage());
    }
}
function generateCode($nombreDeCaracteres):string {
    $code = '';
    for ($i=0; $i < $nombreDeCaracteres; $i++) { 
        $code .= rand(0,9);
    }
    return $code;
}

function verifieCodeActivation($codeActivation, $codeInput) {
    if ($codeActivation == $codeInput) {
        return true;
    }
    else {
        return false;
    }
}

function activerCompte($id) {
    try
    {
        $pdo = connexionDB();
        $requete = "UPDATE chris_Users SET UseActivated = 1 WHERE UseId = :id";
        $stmt = $pdo->prepare($requete);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
       
}
catch(\PDOException $e)
    {
        gerer_exceptions($e);
    }
}
?>