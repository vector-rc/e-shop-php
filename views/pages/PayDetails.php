<div class="card" style="width: 18rem;">
    <div class="card-header">
        Detalles de la compra
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">Subtotal: S/ <?= $order['subtotal'] ?></li>
        <li class="list-group-item">IGV(18%): S/ <?= $order['subtotal'] * 0.18 ?></li>
        <li class="list-group-item">Descuento: S/ <?= $order['discount'] ?></li>

        <li class="list-group-item">Total: S/ <?= $order['total'] ?> </li>
        <li class="list-group-item">
            <label for="">medio de pago</label>
            <select data-order-id="<?= $order_id ?>" name="" id="type-pay">
                <option selected value="credit_card">tarjeta de credito</option>
                <option value="debit_card">tarjeta de debito</option>
                <option value="deposit">deposito</option>
            </select>
        </li>
    </ul>
    <div class="card-footer">
        <a id='pay-btn' class="btn btn-success" href="/tienda_e5/pay/<?= "$order_id" ?>/credit_card">Realizar pago</a>
    </div>
</div>
<script>
    let type_pay = document.getElementById('type-pay');
    let pay_button = document.getElementById('pay-btn');
    type_pay.addEventListener('change', (e) => {
        pay_button.setAttribute('href', '/tienda_e5/pay/' + e.target.dataset.orderId + '/' + e.target.value)
    })
</script>
