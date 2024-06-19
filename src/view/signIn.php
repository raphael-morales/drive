<?php
?>
<h1 class="title" style="text-align: center"><?= $this->title ?></h1>
<form class=" d-flex flex-column align-items-center" method="post">
    <div class="mb-3 w-50">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email">
    </div>
    <div class="mb-3 w-50">
        <label for="password" class="form-label">Mot de passe</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>
    <button type="submit" class="w-50 btn btn-primary">Se connecter</button>
</form>
