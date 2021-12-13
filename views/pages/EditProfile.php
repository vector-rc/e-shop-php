<div class="modal-dialog modal-dialog-centered br-1" style="max-width: 800px;">
    <div class="modal-content br-1">
        <div class="modal-body">
            <form id='form_add_edit' action="/tienda_e5/controllers/edit_profile" method="POST" enctype="multipart/form-data">
                <div class="mb-3 row">
                    <label for="name" class="col-sm-2 col-form-label">Nombres</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="names" value="<?= $user['names'] ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="name" class="col-sm-2 col-form-label">Apellidos</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="surnames" value="<?= $user['surnames'] ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="price" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" name="email" value="<?= $user['email'] ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="price" class="col-sm-2 col-form-label">Contraseña</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" name="password" value="">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="price" class="col-sm-2 col-form-label">Celular</label>

                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="mobile" value="<?= $user['mobile'] ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="stock" class="col-sm-2 col-form-label">Direccion</label>
                    <div class="col-sm-10">
                        <input type="address" class="form-control" id="stock" name="address" value="<?= $user['address'] ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="stock" class="col-sm-2 col-form-label">Foto de perfil</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" accept=".png,.jpg,.jpeg,.webp" id="image" name="image">
                        <img id="image-view" src="/tienda_e5/images_users/<?= $user['image'] ?>" style="max-height: 18rem;width:18rem">

                    </div>
                </div>
                <div class="mb-3 py-2 px-4 row">
                    <button type="submit" class="btn btn-primary" id="btn-add-edit">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    let image_file = document.getElementById('image')
    let image_view = document.getElementById('image-view')

    image_file.onchange = (e) => {

        let reader = new FileReader();
        reader.readAsDataURL(image_file.files[0]);
        reader.onloadend = () => {
            image_view.src = reader.result
        };

    }
</script>
