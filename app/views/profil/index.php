<div class="flex items-center justify-between m-6">
    <?php if ($_SESSION['utilisateur_id'] == $args['utilisateur']['UseId']) : ?>
    <div>
        <h1 class=" text-4xl font-extrabold  ">Profile </h1>
    </div>
    <div>
        <button class="sm:hidden" id="gear"><i class="fa-solid fa-gear text-xl"></i></button>
    </div>
    <?php endif; ?>
</div>
<div class="py-5 sm:px-5  flex gap-5 items-start max-w-[1000px] m-auto ">


    <?php if ($_SESSION['utilisateur_id'] == $args['utilisateur']['UseId']) : ?>
    <div id="div-menu-secondary" class=" p-3 bg-slate-100 basis-[20%] shrink rounded  hidden sm:block">
        <button id="close-menu" class="absolute sm:hidden right-2"><i class="fa-solid fa-xmark"></i></button>
        <h2 class="text-xl font-medium">Paramètre</h2>
        <!-- nav secondaire  -->
        <ul id="menu-secondary">

            <li id="profil" class=" hover:bg-white hover:cursor-pointer rounded-md text-blue-500 px-2 duration-100">
                Profile
            </li>
            <li id="post" class=" hover:bg-white hover:cursor-pointer rounded-md px-2 duration-100">Historique</li>
            <li id="compte" class=" hover:bg-white hover:cursor-pointer rounded-md px-2 duration-100">Compte</li>
        </ul>
    </div>
    <?php endif; ?>


    <!-- container profile  -->
    <div id="profil-container" class="grow m-5 sm:m-0">
        <div class="bg-slate-100 p-2 rounded grow  ">
            <div class="flex flex-col items-center gap-3 ">
                <figure><img src="<?php echo BASE_URL."/public/".$args['utilisateur']['img_profil'] ?>" alt=""
                        class="object-cover h-[100px]  sm:h-[200px] w-[100px] sm:w-[200px] rounded-full  relative translate-y-[-25%] border-4 border-blue-500 ">
                </figure>
                <div>
                    <p class="text-4xl text-left font-bold"><?= $args['utilisateur']['UsePseudo'] ?></p>
                </div>
            </div>
        </div>
        <!-- post ecrit par lui -->
        <div class="flex flex-col items-center gap-3 w-full ">
            <?php
                       for ($i=count($args['posts'])-1; $i >= 0 ; $i--) { 
                        $post = $args['posts'][$i];
                      $like = getNumberLike($post['id']);
                           // gestion du coeur couleur 
            $isLiked = postIsLikedByConnectedUser($args['utilisateur']['UseId'], $post['id']);
            //date 
            $date = new DateTime($post['created_at']);
            $date = $date->format('d/m/y');

                        echo "<div class=' m-3 bg-white rounded-lg shadow w-full'>
                        <div class='flex justify-between border-b p-2 text-gray-500' >
                        <div class='flex gap-4'>
                            <img src='".BASE_URL."/public/".$args['utilisateur']['img_profil']."' width='50px'  class='rounded-[100%] border-2 border-blue-500 h-[50px] object-cover'/>
                            <div class='font-black text-black'>".$args['utilisateur']['UsePseudo']."</div>
                        </div>
                            <div>
                            <div class='update flex justify-end items-center gap-2'>
                            <div><i class='fa-solid fa-pencil'></i></div>
                            <a href='".BASE_URL."/deletePost/".$post['id']."'><i class='fa-solid fa-xmark'></i></a>
                            
                        </div>
                                <div class='italic'>
                                    publié le :".$date."
                                </div>
                            </div>
                        </div>
                        <div id='".$post['id']."' class='my-5 p-2 updating-comment'>".$post['comment']."</div>
                        <div class=' flex justify-between gap-3 p-2'>
                        <form method='post' action='".BASE_URL.($isLiked ?"/dislike" :"/like").BASE_URL."/profil'>
                            <input type='hidden' name='".($isLiked ?"dislike" :"like")."' value='".$post['id']."'  />
                                <button class='flex items-center hover:bg-slate-100 duration-200 px-10 py-1 rounded-sm'>".$like."
                                <i class='".($isLiked ?"fa-solid fa-heart text-red-500 ":"fa-regular fa-heart " )."pl-1'></i><p class='hidden md:block ml-2'>J'aime</p>
                                </button> 
                                </button> 
                            </form>
                
                            <button class='flex items-center hover:bg-slate-100 duration-200 px-10 py-1 rounded-sm'><i class='fa-regular fa-comments'></i><p class='ml-2 hidden md:block'>Commenter</p>
                            </button>
                
                        </div>
                    </div>";
                    }
                ?>
        </div>
    </div>
    <?php if ($_SESSION['utilisateur_id'] == $args['utilisateur']['UseId']) : ?>
    <!-- container de posts  -->
    <div class="bg-slate-100 p-2 rounded grow hidden" id="post-container">
        <h3 class="text-xl font-medium">historique</h3>
        <div class="flex flex-col items-center gap-3 ">
            <div class="flex justify-between w-96 border p-2 rounded">
                <div>Fonctionalité pas encore développée</div>
            </div>
        </div>
    </div>
    <!-- container compte  -->
    <div class="bg-slate-100 p-2 rounded grow hidden max-w-100%" id="compte-container">
        <h3 class="text-xl font-medium">Compte</h3>
        <div class="flex flex-col items-center gap-3 ">
            <!-- /formulaire name -->
            <div class="flex flex-col w-full border p-2 rounded">
                <div class="flex justify-between">
                    <div> <?= $utilisateur['UsePseudo']?></div>
                    <label id="btn-name" for="name"
                        class="border border-green-600 bg-green-600 rounded px-3 py-1 text-white hover:cursor-pointer">modifier</label>
                </div>
                <form action="<?= BASE_URL."/profil/name"  ?>" method="post" id="name-form" class="h-0 overflow-hidden">
                    <div class="flex justify-between items-center my-1">
                        <input type="hidden" name="name-form">
                        <input type="text" placeholder="nouveau nom" class="" id="name" name="name">
                        <button class="text-white bg-blue-500  rounded px-3 py-1">confirmer</button>
                    </div>
                </form>
            </div>
            <!-- ---------------------- -->

            <div class="flex flex-col w-full border p-2 rounded">
                <div class="flex justify-between">
                    <div> <?= $utilisateur['UseEmail']?></div>
                    <?= $erreur['email']?? '' ?>
                    <label id="btn-mail" for="mail"
                        class="border border-green-600 bg-green-600 rounded px-3 py-1 text-white hover:cursor-pointer">modifier</label>
                </div>
                <form action="<?= BASE_URL."/profil/email"  ?>" method="post" id="mail-form"
                    class="h-0 overflow-hidden">
                    <div class="flex justify-between items-center my-1">
                        <input type="hidden" name="mail-form">
                        <input type="text" placeholder="nouveau mail" class="" id="mail" name="email">
                        <button class="text-white bg-blue-500  rounded px-3 py-1">confirmer</button>
                    </div>
                </form>
            </div>

            <!-- /formulaire photo profil -->
            <div class="flex flex-col w-full border p-2 rounded">
                <div class="flex justify-between">
                    <div> <?= $utilisateur['img_profil']??'aucune'?></div>
                    <label for="img_url"
                        class="border border-green-600 bg-green-600 rounded px-3 py-1 text-white hover:cursor-pointer">modifier</label>
                </div>
                <form action="<?= BASE_URL."/profil/img"  ?>" method="post" id="img-form" class="h-0 overflow-hidden"
                    enctype="multipart/form-data">
                    <div class="flex justify-between items-center my-1">
                        <input type="hidden" name="img-form">
                        <input type="file" class="" id="img_url" name="img">
                        <button class="text-white bg-blue-500  rounded px-3 py-1">confirmer</button>
                    </div>
                </form>
            </div>
            <!-- /fin formulaire photo profil -->
            <button>Modifier le mot de passe</button>
            <form id="delete-account" action=<?= BASE_URL.'/profil/delete'?> method="post">
                <input type="hidden" name="delete-account">
                <button class=" bg-red-500 rounded px-3 text-white">Supprimer mon compte</button>
            </form>
        </div>
    </div>
    <?php endif; ?>
</div>
<script>
<?php require_once __DIR__."/profil.js";?>
</script>
<?php require_once dirname(__DIR__)."/templates/footer.php";?>