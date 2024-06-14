<?php
if(session_status() !== PHP_SESSION_ACTIVE) {
ini_set('session.use_strict_mode', 1);
ini_set('session.use_only_cookies', 1);
session_set_cookie_params([
    'path' => '/',
    'secure' => false,
    'httponly' => false,
    'samesite' => 'lax'
]);
session_start();
}


require_once dirname(__DIR__,3)."/constantes/constantes.php";
require_once dirname(__DIR__,3)."/core/gestionAuthentification.php";
require_once dirname(__DIR__,3)."/core/getInfoUser.php";

if (isset($_SESSION['utilisateur_id']) && est_connecte($_SESSION['utilisateur_id'])) {
    $utilisateur = getInfoUser($_SESSION['utilisateur_id']);
}



function classSuivantLeChemin () {
    $pages = [
        BASE_URL."/" => '<i class="fa-solid fa-house"></i>',
        BASE_URL.'/contact' => '<i class="fa-solid fa-file-signature"></i>',
        BASE_URL.'/profil'=> '<i class="fa-solid fa-user"></i>'
    ];
    foreach ($pages as $page => $label) {
        $class = ($_SERVER['REQUEST_URI'] ==  $page) ? 'active' : '';
        echo "<li class='py-1 px-3 rounded duration-200 hover:bg-slate-100 hover:cursor-pointer '><a href= $page  class= $class > $label </a></li>";
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?=$metaDescription?? ''?>">
    <!-- <link rel="stylesheet" href="./assets/css/style.css"> -->
    <link href="./public/src/output.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title><?=$pageTitre?? ''?></title>
</head>

<body class="bg-slate-50">
    <nav class="flex justify-between bg-white text-blue-500 p-2">

        <p class="font-bold">
            <?php 
echo isset($utilisateur['UsePseudo']) 
    ? "Bonjour $utilisateur[UsePseudo], 👋" 
    : '<a href="./" class="p-2">Logo</a>';
?>
        </p>
        <ul class="flex">
            <?php classSuivantLeChemin(); ?>
        </ul>
        <?php
            if ( isset($_SESSION['utilisateur_id']) && est_connecte($_SESSION['utilisateur_id'])) {

                
               echo '  
           <a href="'.BASE_URL.'/logout" class="px-2 text-gray-500 duration-200 hover:text-blue-600 " > <i class="fa-solid fa-arrow-right-from-bracket"></i> </a>';
            }
            else {
                echo ' 
                <ul class="flex">
                    <li class="py-1 px-2 rounded duration-200 hover:bg-slate-100 hover:cursor-pointer"><a href="./connection ">connection</a></li>
                    <li class="py-1 px-2 rounded duration-200 hover:bg-slate-100 hover:cursor-pointer"><a href="./inscription ">inscription</a></li>
                </ul> ';
            }
        ?>

    </nav>