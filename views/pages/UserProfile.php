<div class="modal-dialog modal-dialog-centered br-1" style="max-width: 800px;">
    <div class="modal-content br-1">
        <div class="modal-body">
            <div class="mb-3 row">
                <label for="name" class="col-sm-2 col-form-label">Nombres</label>
                <div class="col-sm-10">
                    <?= $user['names'] ?>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="name" class="col-sm-2 col-form-label">Apellidos</label>
                <div class="col-sm-10">
                   <?= $user['surnames'] ?>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="price" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                  <?= $user['email'] ?>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="price" class="col-sm-2 col-form-label">Celular</label>

                <div class="col-sm-10">
                    <?= $user['mobile'] ?>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="stock" class="col-sm-2 col-form-label">Direccion</label>
                <div class="col-sm-10">
                    <?= $user['address'] ?>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="stock" class="col-sm-2 col-form-label">Foto de perfil</label>
                <div class="col-sm-10">
                    <img id="image-view" src="/tienda_e5/images_users/<?= $user['image'] ?>" style="max-height: 18rem;width:18rem">

                </div>
            </div>
            <div class="mb-3 py-2 px-4 row">
                <a class="btn btn-primary" href="/tienda_e5/edit_profile">Editar perfil</a>
            </div>
        </div>
    </div>
</div>
