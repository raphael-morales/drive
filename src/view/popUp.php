<?php 

if ($this->msg) { ?>
    <div class="boxAlert">
        <div class="boxAlertBody">
            <div class="mx-auto text-center mb-3">
                <p><?= $this->msg ?></p>
            </div>
            <a class="btn btn-dark w-25" href='<?= $this->param ?>' alt='<?= $this->altParam ?>'><?=  $this->displayValue ?></a>
        </div>
    </div>
<?php }