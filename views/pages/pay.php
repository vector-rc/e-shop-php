<div class="modal-dialog modal-dialog-centered br-1" style="max-width: 600px;">


    <div class="modal-content br-1">
        <div class="modal-header">
            <h5 class="modal-title" id="modalLabel">Realizar pago</h5>
        </div>
        <?php
        if ($type_pay == 'deposit') {

        ?>
            <div class="modal-body">
                <form action="/tienda_e5/controllers/pay/<?=$order_id?>" method="POST" class="px-4">
                    <div class="row mb-3 ">
                        realiza el pago a trabes del bcp con el codigo:
                        <input type="number" class="form-control" required name="pay_code" value="<?=time()?>">

                    </div>

                    <div class="mb-3 ">
                        <button type="submit" class="btn btn-primary mx-auto">OK</button>
                    </div>
                </form>
            </div>


        <?php
        } else {
        ?>

            <div class="modal-body">
                <form action="/tienda_e5/controllers/pay/<?=$order_id?>" method="POST">
                    <div class=" form-floating mb-3">

                        <input type="text" class="form-control" required name="card-number">
                        <label for="floatingname" class=" col-form-label">Numero de tajeta</label>

                    </div>
                    <div class=" form-floating mb-3">

                        <input type="text" class="form-control" required name="names">
                        <label for="floatingname" class=" col-form-label">Nombres del titular</label>


                    </div>
                    <div class=" form-floating mb-3">
                        <input type="text" class="form-control" required name="surnames">

                        <label for="name" class=" col-form-label">Apellidos del titular</label>


                    </div>

                    <div class=" form-floating mb-3">

                        <input type="number" maxlength="3" class="form-control" required name="ccv">
                        <label for="name" class=" col-form-label">CCV</label>
                    </div>
                    <div class=" form-floating mb-3">

                        <input type="month" maxlength="3" class="form-control" required name="date_expire">
                        <label for="name" class=" col-form-label">Fecha de vencimiento</label>
                    </div>

                    <div class="mb-3 ">
                        <button type="submit" class="btn btn-primary mx-auto">Realizar pago</button>
                    </div>
                </form>
            </div>

        <?php
        }
        ?>

    </div>
</div>
