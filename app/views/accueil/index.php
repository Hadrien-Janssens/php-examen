<h1 class=" text-4xl mb-3 font-extrabold m-6">Fil d'actualité</h1>
<div class=" flex flex-col md:m-auto max-w-[700px]">
    <div class=" flex rounded-xl overflow-hidden p-5 grow ">

        <form class=" flex flex-col gap-3 grow" method="post" action=<?= BASE_URL."/publication"  ?>>
            <input type="hidden" name="post">
            <textarea class="block w-full rounded-2xl shadow p-2" rows="5" name="comment" id=""
                placeholder="Comment vous-sentez vous ?"></textarea>
            <?php if (isset($args['erreurs']['comment'])) {
                  echo "<div class='text-red-500'>".$args['erreurs']['comment']."</div>";
                } ?>
            <button class="border self-end border-blue-600 bg-blue-600 rounded px-3 text-white  ">Publier</button>
        </form>
    </div>

    <div id="posts" class="flex flex-col m-3 gap-3 ">
        <?php
        //affichage des posts
        for ($i=count($args['posts'])-1; $i >= 0 ; $i--) { 
            $post = $args['posts'][$i];
            //nombre de like par post
            $like = getNumberLike($post['id']);
       $user =  getInfoUser($post['user_id']);
       $date = new DateTime($post['created_at']);
       $date = $date->format('d/m/y');


        // gestion du coeur couleur 
            $isLiked = postIsLikedByConnectedUser($utilisateur['UseId'], $post['id']);
        

       echo " 
    <div class=' m-3 bg-white rounded-lg shadow'>
        <div class='flex justify-between border-b p-2 text-gray-500' >
        <div class='flex gap-4'>

     
        <form method='POST' action=".BASE_URL."/profil>
        <input type='hidden' name='id' value='".$user['UseId']."' />
       <button> <img src='".BASE_URL."/public/".$user['img_profil']."' width='50px'  class='rounded-[100%] border-2 border-blue-500 h-[50px] object-cover'/> </button>
        </form>

        <form method='POST' action=".BASE_URL."/profil>
        <input type='hidden' name='id' value='".$user['UseId']."' />
         <button class='font-black text-black'>".$user['UsePseudo']."</button>
        </form>
        </div>
            <div>
                
                <div class='italic'>
                    publié le :".$date."
                </div>
            </div>
        </div>
        <div class='my-5 p-2'>
             ".$post['comment']."
        </div>
        <div class=' flex justify-between gap-3 p-2'>
            <form method='post' action='".BASE_URL.($isLiked ?"/dislike" :"/like")."'>
                <input type='hidden' name='".($isLiked ?"dislike" :"like")."' value='".$post['id']."'  />
                <button class='flex items-center hover:bg-slate-100 duration-200 px-10 py-1 rounded-sm'>".$like."
                <i class='".($isLiked ?"fa-solid fa-heart text-red-500 ":"fa-regular fa-heart " )."pl-1'></i><p class='hidden md:block ml-2'>J'aime</p>
                </button> 
            </form>

            <button class='flex items-center hover:bg-slate-100 duration-200 px-10 py-1 rounded-sm'><i class='fa-regular fa-comments'></i><p class='ml-2 hidden md:block'>Commenter</p>
            </button>

            <button class='flex items-center hover:bg-slate-100 duration-200 px-10 py-1 rounded-sm'>
            <i class='fa-solid fa-share'></i><p class='ml-2 hidden md:block'>Partager</p>
            </button>
        </div>
    </div>";
    };
        ?>

    </div>
</div>