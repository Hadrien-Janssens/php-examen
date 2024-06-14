<h1 class="text-xl text-center my-10">verification d'identité</h1>

<form action="<?=BASE_URL."/verificationIdentite" ?>" method="POST" class="flex flex-col max-w-64 m-auto mt-5">
    <input type="hidden" name="formVerificationIdentitie">
    <input type="text" name="verification_code" require maxlength="5" placeholder="Votre code à 5 chiffres .."
        minlength="5" id="verification_code" class="p-1 bg-gray-100 rounded mb-2 shadow shadow-xs">
    <?= $erreurs['verification_code']?? '' ?>
    <input type="submit" value="Vérifier" class="p-1 bg-blue-500 rounded mb-2  text-white hover:cursor-pointer">
</form>
<?= $messageMail ?? '' ?>
<p class="text-center">ou</p>
<form class="flex justify-center" action="" method="POST">
    <input type="hidden" name="formEnvoyerCode">
    <input type="submit" value="nouveau code"
        class="p-1 border shadow mt-3 shadow-xs rounded duration-200 hover:cursor-pointer hover:bg-blue-100">
</form>