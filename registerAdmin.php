<?php
    include('db.php');

    $sqlTableCreate = "CREATE TABLE IF NOT EXISTS logins (id INT AUTO_INCREMENT PRIMARY KEY, firstName VARCHAR(60), lastName VARCHAR(60), email VARCHAR(60), password VARCHAR(60))";
    $conn->query($sqlTableCreate);


    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirmPassword = $_POST["confirm_password"];

        // Perform basic validation
        if (empty($firstName) || empty($lastName) || empty($email) || empty($password) || empty($confirmPassword)) {
            $errorMessage = "All fields are required.";
        } elseif ($password != $confirmPassword) {
            $errorMessage = "Passwords do not match.";
        } else {
            // Hash the password before storing it in the database
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            $sql = "INSERT INTO logins (firstName, lastName, email, password, type) VALUES ('$firstName', '$lastName', '$email', '$hashedPassword', 'a')";
            $conn->query($sql);


            // Redirect to a success page or login page
            header("Location: login.php");
            exit();
        }
    }

    //Close DB connection
    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous">
        <link rel="stylesheet" href="css/w3.css">
        <link rel="stylesheet" href="css/darkmode.css">

        <title>Register Admin</title>
    </head>
    <body>

    <h2>Register</h2>

    <?php
        //Show Errors
        if (isset($errorMessage)) {
            echo '<p style="color: red;">' . $errorMessage . '</p>';
        }
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="firstName">First Name:</label>
        <input type="text" name="firstName" required><br>

        <label for="lastName">Last Name:</label>
        <input type="text" name="lastName" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <label for="confirm_password">Confirm Password:</label>
        <input type="password" name="confirm_password" required><br>

        <input type="submit" value="Register">
    </form>

    <p>(Admins can add new restaurants)</p>
    <p>Already have an account <a href="login.php">Login here</a>.</p>

    </body>
</html>
