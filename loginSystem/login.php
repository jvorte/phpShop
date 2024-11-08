<?php
// Initialize the session
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


<?php include '../includes/nav.php' ?>

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




