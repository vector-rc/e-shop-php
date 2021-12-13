<div class="modal-dialog modal-dialog-centered br-1" style="max-width: 600px;">
  <div class="modal-content br-1">
    <div class="modal-header">
      <h5 class="modal-title" id="modalLabel">Nuevo Usuario</h5>
    </div>
    <div class="modal-body">
      <form action="/tienda_e5/controllers/signup" method="POST">
        <div class=" form-floating mb-3">
          <input type="text" class="form-control" required name="names">
          <label for="floatingname" class=" col-form-label">Nombres</label>
        </div>

        <div class=" form-floating mb-3">
          <input type="text" class="form-control" required name="surnames">
          <label for="name" class=" col-form-label">Apellidos</label>
        </div>

        <div class=" form-floating mb-3">
          <input type="email" class="form-control" required name="email">
          <label for="name" class=" col-form-label">Email</label>
        </div>

        <div class=" form-floating mb-3">
          <input type="password" class="form-control" required name="password">
          <label for="name" class=" col-form-label">Contraseña</label>
          <small id="emailHelp" class="form-text text-muted">Maximo 16 caracteres</small>
        </div>

        <div class=" form-floating mb-3">
          <input type="text" class="form-control" required name="mobile" maxlength="9">
          <label for="name" class=" col-form-label">Celular</label>
        </div>

        <div class=" form-floating mb-3">
          <input type="text" class="form-control" name="address">
          <label for="inputPassword" class=" col-form-label">Direccion</label>
        </div>

        <div class="mb-3">
          <label for="stock" class=" col-form-label">Foto de perfil</label>
          <input type="file" class="form-control" accept=".png,.jpg,.jpeg,.webp" id="image" name="image">
          <img id="image-view" src="" style="max-height: 18rem;width:18rem">
        </div>

        <div class="mb-3 ">
          <button type="submit" class="btn btn-primary mx-auto">Registrarse</button>
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
