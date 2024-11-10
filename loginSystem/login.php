<?php

session_start();
// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: welcome.php");
    exit;
}

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if username is empty
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter username.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if (empty($username_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = :username";

        if ($stmt = $pdo->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Check if username exists, if yes then verify password
                if ($stmt->rowCount() == 1) {
                    if ($row = $stmt->fetch()) {
                        $id = $row["id"];
                        $username = $row["username"];
                        $hashed_password = $row["password"];
                        if (password_verify($password, $hashed_password)) {
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            $_SESSION["password"] = $password;
                            // Redirect user to welcome page
                            header("location: ../index.php");
                        } else {
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else {
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }

    // Close connection
    unset($pdo);
}
?>

<!-- ----------------------------------------------------------------- -->


<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>SuperTshirt</title>
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="../style.css" />
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
    crossorigin="anonymous" />
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
          aria-label="Toggle navigation">
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
                aria-expanded="false">
                Products
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="./mens.php">Mens's</a></li>
                <li><a class="dropdown-item" href="./womens.php">Women's</a></li>
                <li>
                  <hr class="dropdown-divider" />
                </li>
                <li>
                  <a class="dropdown-item" href="./accessories.php">Accessories</a>
                </li>

              </ul>
            </li>
            <li>
              <i class="bi bi-cart ps-5" style="font-size: 1.4rem; color: rgb(237, 100, 157);"></i> Basket
            </li>
          </ul>
    
        </div>
      </div>
    </nav>
    <!--end  navbar section -->
  </div>


  <!-- end 1. container -->

<!-- title section -->
<div class="container">
    <h1 class="text-center mt-5 mainTile">
        SuperTshirt
        <span><img
                class="imgTitle"
                src="../assets\img\Hawaiian-Flower.png"
                alt=""
                srcset="" /></span>
    </h1>
    <!--end  title section -->

    <!--paragraph title section -->
    <h5 class="text-center paragraphTitle">
        Lorem ipsum dolor sit amet consectetut.
    </h5>
    <!--end paragraph  title section -->
</div>

<div class="container mt-5">
    <nav class="navbar my-4 bg-light ">
        <div class="container-fluid ">
            <h5 class="navbar-text ">Women's</h5>
            <h5 class="text-end">WINTER SALES %</h5>
        </div>
    </nav>


</div>

<!-- ====================login form============================= -->
<div class="container">

    <div class="row">
        <div class="col-6 col-md-6">
            <h2>Infos</h2>
            <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat temporibus nam alias quis quisquam ipsam,
            voluptate est dolorum porro saepe quos obcaecati sint totam rerum nulla labore illum doloribus quasi.
            </p>
        </div>

        <div class="col-6 col-md-6">
            <h2>Login</h2>
            <p>Please fill in your credentials to login.</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="row g-3">
                    <div class="col">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control  <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>" aria-label="First name">
                        <span class="invalid-feedback"><?php echo $username_err; ?></span>
                    </div>
                    <div class="col">
                        <label for="password" class="form-label">Password</label>
                        <input type="text" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" aria-label="Last name">
                        <span class="invalid-feedback"><?php echo $password_err; ?></span>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Sign in</button>
                    </div>
                    <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
                </div>
            </form>
        </div>

    </div>

</div>

<!-- ==================end login form=============================== --

<?php include '../includes/footer.php' ?>




