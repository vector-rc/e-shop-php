 <div class="modal-dialog modal-dialog-centered br-1" style="max-width: 800px;">
     <?php

        use E5\Category\CategoryRepository;
        ?>
     <div class="modal-content br-1">
         <div class="modal-body">
             <form id='form_add_edit' action="/tienda_e5/controllers/edit_product/<?= $id ?>" method="POST" enctype="multipart/form-data">
                 <div class="mb-3 row">
                     <label for="name" class="col-sm-2 col-form-label">Nombre</label>
                     <div class="col-sm-10">
                         <input type="text" class="form-control" required id="name" name="name" value="<?= $product['name'] ?>">
                     </div>
                 </div>
                 <div class="mb-3 row">
                     <label for="description" class="col-sm-2 col-form-label">Descripcion</label>

                     <div class="col-sm-10">
                         <textarea class="form-control" id="description" name="description" style="height:10rem ;"><?= $product['description'] ?></textarea>
                     </div>
                 </div>
                 <div class="mb-3 row">
                     <label for="price" class="col-sm-2 col-form-label">Precio</label>
                     <div class="col-sm-10">
                         <input type="number" class="form-control" required id="price" name="price" value="<?= $product['price'] ?>">
                     </div>
                 </div>
                 <div class="mb-3 row">
                     <label for="state" class="col-sm-2 col-form-label">Estado</label>

                     <div class="col-sm-10">
                         <input type="number" class="form-control" required id="state" name="state" value="<?= $product['state'] ?>">
                         <span>¿Entre 1 y 10 en que estado se encuentra el producto?</span>
                     </div>
                 </div>
                 <div class="mb-3 row">
                     <label for="stock" class="col-sm-2 col-form-label">Cantidad</label>
                     <div class="col-sm-10">
                         <input type="number" class="form-control" required id="stock" name="stock" value="<?= $product['stock'] ?>">
                     </div>
                 </div>
                 <div class="mb-3 row">
                     <label for="inputPassword" class="col-sm-2 col-form-label">Categoria</label>
                     <div class="col-sm-10">
                         <select class="form-select br-1" aria-label="Default select example" id="categories" name="category_id">
                             <?php
                                $_cr = new CategoryRepository();
                                $categories = $_cr->findAll();
                                foreach ($categories as $cat) {
                                    if ($product['category_id'] == $cat['id']) {
                                        echo '<option selected value="' . $cat['id'] . '">' . $cat['name'] . '</option>';
                                        continue;
                                    }
                                    echo '<option value="' . $cat['id'] . '">' . $cat['name'] . '</option>';
                                }
                                ?>
                         </select>
                     </div>

                 </div>
                 <div class="mb-3 row">
                     <label for="stock" class="col-sm-2 col-form-label">Imagen</label>
                     <div class="col-sm-10">
                         <input type="file" class="form-control" accept=".png,.jpg,.jpeg,.webp" id="image" name="image">
                        <img id="image-view" src="/tienda_e5/images_products/<?=$product['image']?>" style="max-height: 18rem;width:18rem">

                     </div>
                 </div>
                 <div class="mb-3 py-2 px-4 row">
                     <button type="submit" class="btn btn-primary" id="btn-add-edit">Guardar Producto</button>
                 </div>
             </form>
         </div>
     </div>
 </div>
 <script>
let field_quantity = document.getElementById('stock')
    field_quantity.onchange = e => {
        if (e.target.value < 1) e.target.value = 1;
    }
    let field_price= document.getElementById('price')
    field_price.onchange = e => {
        if (e.target.value < 1) e.target.value = 1;
    }
    let field_state= document.getElementById('state')
    field_state.onchange = e => {
        if (e.target.value < 1) e.target.value = 1;
        if (e.target.value > 10) e.target.value = 10;
    }


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
