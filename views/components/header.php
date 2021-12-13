<nav class="navbar navbar-expand-md navbar-light" style="background:#00dc82;height: 6rem;">
  <div class="container">
    <a class="navbar-brand" href="/tienda_e5/"><i class="bi bi-bootstrap-fill"></i>Tienda web</a>
    <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav container d-flex justify-content-between">
        <li class="nav-item dropdown ">
          <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Categorias
          </a>
          <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
            <?php

            use E5\Category\CategoryRepository;

            $_cr = new CategoryRepository();
            $categories = $_cr->findAll();
            foreach ($categories as $cat) {
              echo '<li><a class="dropdown-item" href="/tienda_e5/products/category/' . $cat['id'] . '">' . $cat['name'] . '</a></li>';
            }
            ?>
          </ul>
        </li>


        <form class="d-flex mx-5 w-50">
          <div class="input-group">
            <input required type="search" class="form-control" id="search" style="border: #ededed solid 1px;" placeholder="Buscar productos">
            <a class="btn " id="search-btn" style="background:#ededed;" href="#"><i class="bi bi-search"></i></a>
          </div>
        </form>
        <script>
          let search_input = document.getElementById('search');
          let search_button = document.getElementById('search-btn');
          search_input.addEventListener('change', (e) => {
            search_button.setAttribute('href', '/tienda_e5/products/search/' + e.target.value)
          })
        </script>
        <ul class="navbar-nav">
          <?php
          if (!isset($_SESSION['session_id'])) { ?>
            <a class="mx-1 nav-link" href="/tienda_e5/signup" type="submit">Registrar</a>
            <a class="mx-1 nav-link" href="/tienda_e5/login" type="submit">Ingresar</a>
          <?php
          } else {
          ?>
            <div class="dropdown">
              <a href="#" class=" nav-link d-flex align-items-center text-decoration-none dropdown-toggle " id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">

                <span id="user-name"><img src="/tienda_e5/images_users/<?= $_SESSION['user']['image'] ?>" style="width: 1rem;height: 1rem;border-radius: 50%;transform: scale(2) translateX(0.4rem);" alt=""> <i class="bi bi-person-circle"></i> <?= $_SESSION['user']['names'] ?></span>
              </a>
              <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser1">

                <li><a class="dropdown-item" href="/tienda_e5/my_products">Mis Productos</a></li>
                <li><a class="dropdown-item" href="/tienda_e5/my_orders">Mis Pedidos</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="/tienda_e5/profile">Perfil</a></li>

                <li><a class="dropdown-item" href="/tienda_e5/controllers/singout">Cerrar Session</a></li>
              </ul>
            </div>
          <?php
          }

          $stock_cart = 0;
          if (isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $prod_id => $stock) {
              $stock_cart += $stock;
            }
          }
          ?>

          <a class=" nav-link position-relative mx-2" href="/tienda_e5/cart" type="submit">
            <i class="bi bi-cart"></i>
            <span class="position-absolute top-30 start-100 translate-middle badge rounded-pill bg-success" style="font-size: 0.55em;" id='stock-cart'><?= $stock_cart ?></span>
          </a>
        </ul>
      </ul>
    </div>

  </div>
</nav>
