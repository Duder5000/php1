<?php
    include('auth.php');
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Perform basic validation
        if (empty($email) || empty($password)) {
            $errorMessage = "Both email and password are required.";
        } else {
            // Retrieve user data from the database
            $query = "SELECT * FROM logins WHERE email = '$email'";
            $result = mysqli_query($conn, $query);
            $user = mysqli_fetch_assoc($result);

            if ($user && password_verify($password, $user["password"])) {
                // Store user information in the session
                $_SESSION["user_id"] = $user["user_id"];
                $_SESSION["email"] = $user["email"];
                $_SESSION["type"] = $user["type"];

                header("Location: index.php");
                //echo $_SESSION['email'] . "<br/>";
                exit();
            } else {
                $errorMessage = "Failed to login";
            }
        }
    }

    // Close DB connection
    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
    </head>

    <body>

    <h2>Login</h2>

    <?php
        // Show Errors
        if (isset($errorMessage)) {
            echo '<p style="color: red;">' . $errorMessage . '</p>';
        }
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <input type="submit" value="Login">
    </form>

    <p>Not registered yet? <a href="register.php">Register here</a>.</p>

    </body>
</html>
