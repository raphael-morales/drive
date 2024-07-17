<h2 style="text-align: center">Informations de paiement</h2>
<form action="index.php?page=processPayment" method="post" class="container-fluid d-flex flex-column align-items-center">
    <div class="mb-3" style="width: 50%;">
        <label for="card_number" class="form-label">Numéro de carte</label>
        <input type="text" class="form-control" id="card_number" name="card_number" required>
    </div>
    <div class="mb-3" style="width: 50%;">
        <label for="card_expiry" class="form-label">Date d'expiration</label>
        <input type="text" class="form-control" id="card_expiry" name="card_expiry" placeholder="MM/YY" required>
    </div>
    <div class="mb-3" style="width: 50%;">
        <label for="card_cvc" class="form-label">CVC</label>
        <input type="text" class="form-control" id="card_cvc" name="card_cvc" required>
    </div>
    <button type="submit" class="btn btn-success">Payer</button>
</form>


