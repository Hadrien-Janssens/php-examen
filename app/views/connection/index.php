<div class="m-5">
    <h1 class="text-4xl text-center my-10">Connexion</h1>
    <form class="flex flex-col max-w-96 m-auto" action="" method="POST">
        <input type="hidden" name="formName" value="formConnection">
        <input type="email" id="email" name="email" placeholder="email" required minlength="2" maxlength="255"
            class="p-1 bg-gray-100 rounded mb-2 shadow shadow-xs">
        <?=  isset($args['email'])? "<p class='text-red-500'>". $args['email']."</p>":"" ?>
        <input type="password" id="password" name="password" required minlength="8" maxlength="72"
            placeholder="Mot de passe" class="p-1 bg-gray-100 rounded mb-2 shadow shadow-xs">
        <?=  isset($args['password'])? "<p class='text-red-500'>". $args['password']."</p>":"" ?>

        <input type="submit" value="se connecter" class="p-1 bg-blue-500 rounded mb-2  text-white hover:cursor-pointer">
    </form>

</div>