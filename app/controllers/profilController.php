<?php
    require_once dirname(__DIR__,2)."/constantes/constantes.php";
    require_once dirname(__DIR__,2)."/core/gestionAuthentification.php";
    require_once dirname(__DIR__,2)."/core/getInfoUser.php";
    require_once dirname(__DIR__)."/models/userModel.php";
    require_once dirname(__DIR__)."/models/postModel.php";
    require_once dirname(__DIR__,2)."/core/gestionFormulaire.php";
    require_once dirname(__DIR__,2)."/core/gestionVue.php";

    if (!isset(($_SESSION['utilisateur_id'])) || !est_connecte($_SESSION['utilisateur_id'])) {
        header('Location:'. BASE_URL .'/connection');
        exit();
    }
  

// modifier son avatar-----------------------------------------
function saveImg () {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['img-form'])) {
       
    $path = dirname(__DIR__).'/uploads/';
    $time = time();

        $utilisateur = getInfoUser($_SESSION['utilisateur_id']);    
        move_uploaded_file($_FILES['img']['tmp_name'], "./public/uploads/img_" .$time. basename($_FILES['img']['name']));

        $imgPath = "/uploads/img_" .$time. basename($_FILES['img']['name']);

        saveImgToDb($utilisateur['UseId'],$imgPath );
        header("Location: ".BASE_URL."/profil" );
        exit;
    }
}
    // modifier son nom-----------------------------------------
    function updateName () {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name-form'])) {
            $utilisateur = getInfoUser($_SESSION['utilisateur_id']);
            updateUser($utilisateur['UseId'], "UsePseudo", $_POST['name']);
            header("Location: ".BASE_URL."/profil" );
            exit;
        }
    }
    // modifier son mail-----------------------------------------
    function updateEmail () {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['mail-form'])) {
            $utilisateur = getInfoUser($_SESSION['utilisateur_id']);
            updateUser($utilisateur['UseId'], "UseEmail", $_POST['email']);
            header("Location: ".BASE_URL."/profil" );
            exit;
        }
    }
    // supprimer son compte-----------------------------------------
    function deleteUser () {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete-account'])) {
            $utilisateur = getInfoUser($_SESSION['utilisateur_id']);
            deleteUserDB($utilisateur['UseId']);
            deconnecter_utilisateur();
            // header("Location: /" );
            // exit;


            if (BASE_URL ==='') {
                header("Location: /");
                exit();
              }
            header("Location: ".BASE_URL);
            exit();
        }
    }


function obtenir_pageInfos(): array
{
    return [
        'vue' => 'profil',
        'titre' => "Page de profil",
        'description' => "Description de la page de profil..."
    ];
}

function index () {
    $args['utilisateur']= getInfoUser($_SESSION['utilisateur_id']);
    $args['posts'] = getUserPosts($_SESSION['utilisateur_id']);
  afficher_vue(obtenir_pageInfos(),'index',$args);
}


function indexId () {
    $id = $_POST['id'];
    $args['utilisateur']= getInfoUser($id);
    $args['posts'] = getUserPosts($id);
  afficher_vue(obtenir_pageInfos(),'index',$args);
}

function deletePost($id) {
    deletePostDB($id);
    header("Location: ".BASE_URL."/profil" );
    exit();
}

function updatePost($id) {
    $newComment = $_POST['newcomment'];
    updatePostDB($id,$newComment);
    header("Location: ".BASE_URL."/profil" );
    exit();
}