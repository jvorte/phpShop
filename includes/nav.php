<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>SuperTshirt</title>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../style.css" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
      crossorigin="anonymous"
    />
  </head>
  <body>
    <!-- 1. container -->
    <div class="container">
      <!-- navbar section -->
      <nav class="navbar navbar-expand-lg">
        <div class="container-fluid ">
          <h1 class="navbar-brand" href="#">SuperTshirt</h1>
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto  mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link " href="../store.php">Store</a>
              </li>
              <li class="nav-item dropdown">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                >
                  Products
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="./mens.php">Mens's</a></li>
                  <li><a class="dropdown-item" href="./womens.php">Women's</a></li>
                  <li><hr class="dropdown-divider" /></li>
                  <li>
                    <a class="dropdown-item" href="./accessories.php">Accessories</a>
                  </li>
         
                </ul>
              </li>
              <li>
                <i class="bi bi-cart ps-5"  style="font-size: 1.4rem; color: rgb(237, 100, 157);"></i> Basket
              </li>
            </ul>
            <div class="d-flex" role="login">
   
              <a href="loginSystem\login.php" class="btn btn-outline-danger" type="submit">
                Login
              </a>

            </div>
          </div>
        </div>
      </nav>
      <!--end  navbar section -->    
    </div>

         
    <!-- end 1. container -->