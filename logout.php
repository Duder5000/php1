<?php
    session_start(); // Start or resume the session
    if(isset($_SESSION['itineraries']))
        $itineraries = $_SESSION['itineraries'];
    else
        $itineraries = $_SESSION['itineraries'] = [];

    // Check if the user is logged in
    if (isset($_SESSION['itineraries'])) {
        echo $_SESSION['email'] . "<br/>";
        echo "Session ID: " . session_id() . "<br/>";
        echo "Logged In!";
    }else{
        echo "Not Logged In!";
    }

    include('db.php');

    $sql = "SELECT * FROM products";
    $result = mysqli_query($conn, $sql);

    //Check for errors
    if (!$result) {
        die("Query failed: " . mysqli_error($connection));
    }


    // Check if the user is logged in, then logout
    if (isset($_SESSION['itineraries'])) {
        unset($_SESSION['itineraries']);
        session_destroy();
    }

    //Close DB connection
    $conn->close();
    
    header('Location: index.php');
    exit();                                           
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
</head>
<body>

    <h2>Logout</h2>

</body>
</html>
