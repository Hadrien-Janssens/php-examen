<div class="mx-5">
    <h1 class="text-4xl text-center my-10">Inscription</h1>
    <p class="relative text-center translate-y-[-20px]">C'est facile et rapide</p>
    <form action="" method="POST" class="flex flex-col max-w-96 m-auto">

        <input type="hidden" name="formName" value="formInscription">

        <input type="text" id="pseudo" name="pseudo" required minlength="2" maxlength="255" placeholder="Pseudo"
            class="p-1 bg-gray-100 rounded mb-2 shadow shadow-xs" value=<?= $args['dataArrayClean']['pseudo']?? ''  ?>>
        <div id="name-erreur" class="erreur">
            <?= isset($args['erreur']['pseudo']) ?"<p class='text-red-500'>". $args['erreur']['pseudo'] : ''."</p>"?>
        </div>

        <input id="email" name="email" placeholder="email" class="p-1 bg-gray-100 rounded mb-2 shadow shadow-xs"
            value=<?= $args['dataArrayClean']['email']?? ''  ?>>
        <div id="name-erreur" class="erreur">
            <?= isset($args['erreur']['email']) ?"<p class='text-red-500'>". $args['erreur']['email'] : ''."</p>"?>
            <?= isset($args['erreur']['alreadyExist']) ?"<p class='text-red-500'>". $args['erreur']['alreadyExist'] : ''."</p>"?>
        </div>

        <input type="password" id="password" name="password" required minlength="8" maxlength="72"
            class="p-1 bg-gray-100 rounded mb-2 shadow shadow-xs" placeholder="Mot de passe"
            value=<?= $args['dataArrayClean']['password']?? ''  ?>>
        <div id="name-erreur" class="erreur">
            <?= isset($args['erreur']['password']) ?"<p class='text-red-500'>". $args['erreur']['password'] : ''."</p>"?>
        </div>

        <input type="password" id="confirmation" name="confirmation" placeholder="Confirmation" minlength="8"
            class="p-1 bg-gray-100 rounded mb-2 shadow shadow-xs" maxlength="72"
            value=<?= $args['dataArrayClean']['confirmation']?? ''  ?>>
        <div id="name-erreur" class="erreur">
            <?= isset($args['erreur']['confirmation']) ?"<p class='text-red-500'>". $args['erreur']['confirmation'] : ''."</p>"?>
        </div>

        <input type="submit" value="s'inscrire" class="p-1 bg-blue-500 rounded mb-2  text-white hover:cursor-pointer">
    </form>
</div>