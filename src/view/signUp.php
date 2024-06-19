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
    <div class="mb-3 w-50">
        <label for="firstname" class="form-label">Prénom</label>
        <input type="text" class="form-control" id="firstname" name="firstname">
    </div>
    <div class="mb-3 w-50">
        <label for="lastname" class="form-label">Nom</label>
        <input type="text" class="form-control" id="lastname" name="lastname">
    </div>
    <div class="mb-3 w-50">
        <label for="address" class="form-label">adresse</label>
        <input type="text" class="form-control" id="address" name="address">
    </div>
    <div class="w-50 d-flex justify-content-between">
        <div class="mb-3">
            <label for="zipcode" class="form-label">code postale</label>
            <input type="text" class="form-control" id="zipcode" name="zipcode">
        </div>
        <div class="mb-3">
            <label for="city" class="form-label">ville</label>
            <input type="text" class="form-control" id="city" name="city">
        </div>
    </div>
    <div class="mb-3 w-50">
        <label for="phone" class="form-label">Numéro de téléphone</label>
        <input type="tel" class="form-control" id="phone" name="phone">
    </div>
    <div class="mb-3 w-50">
        <label for="birthday" class="form-label">Date d'anniversaire</label>
        <input type="date" class="form-control" id="birthday" name="birthday">
    </div>
    <button type="submit" class="w-50 btn btn-primary">S'inscrire</button>
</form>