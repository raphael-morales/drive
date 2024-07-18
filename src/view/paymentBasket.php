<h2 style="text-align: center">Informations de paiement</h2>
<p class="px-3 fs-3 fw-bold ms-auto d-flex justify-content-center ">Total à payer : <?= $this->total2pay ?> € </p>
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
    <a href="index.php?page=paymentBasket&pay=true" class="btn btn-success">Payer</button>
    <!-- <a href="index.php?page=shoppingCart&valid=true" class="btn btn-success">Payer</button> -->
</form>


