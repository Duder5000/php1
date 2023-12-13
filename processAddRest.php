<?php
    include('auth.php');
    include('db.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $trackingNum = $_POST['trackingNum']; 
        $restName = $_POST['restName'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $facType = $_POST['facType'];
        $lat = $_POST['lat'];
        $long = $_POST['long'];

        $sql = "INSERT INTO restaurants (TRACKINGNUMBER, NAME, PHYSICALADDRESS, PHYSICALCITY, FACTYPE, LATITUDE, LONGITUDE)
                VALUES ('$trackingNum', '$restName', '$address', '$city', '$facType', '$lat', '$long')";

        echo $sql;

        $result = mysqli_query($conn, $sql);

        // Check for errors
        if (!$result) {
            die("Query failed - result: " . mysqli_error($connection));
        }

        // Redirect back to the original page or another destination
        header("Location: index.php");
        exit();
    } else {
        // Handle cases where the form was not submitted
        echo "Error: Form not submitted.";
    }
?>