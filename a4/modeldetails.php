<?php
    include('db.php');
    include('auth.php');

    // Check if in URL
    if (isset($_GET['productCode'])) {
        $productCode = $_GET['productCode'];

        $sql = "SELECT * FROM products WHERE productCode = '$productCode'";
        $result = mysqli_query($conn, $sql);

        // Check for errors
        if (!$result) {
            die("Query failed: " . mysqli_error($connection));
        }

        // Fetch product details as an associative array
        $productDetails = mysqli_fetch_assoc($result);
    } else {
        // Redirect to showmodels.php if productCode is not provided
        header("Location: showmodels.php");
        exit();
    }
    
    // Close DB connection
    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Model Details</title>
</head>

<body>

  <!--   <a href="login.php">Login</a><br/>
    <a href="logout.php">Logout</a><br/> -->

    <!-- <form method="post" action="addtowatchlist.php">
        <input type="submit" name="submitButton" value="Add to Watch List">
    </form> -->

    <?php
        if (isset($_SESSION['email'])) {
            echo '<a href="addtowatchlist.php?productCode=' . $productCode . '">Add to Wishlist</a>';
        }

        if ($productDetails) {
            echo '<h2>' . $productDetails['productName'] . '</h2>';
            echo '<p>Product Code: ' . $productDetails['productCode'] . '</p>';
            echo '<p>Product Line: ' . $productDetails['productLine'] . '</p>';
            echo '<p>Product Scale: ' . $productDetails['productScale'] . '</p>';
            echo '<p>Product Vendor: ' . $productDetails['productVendor'] . '</p>';
            echo '<p>Product Description: ' . $productDetails['productDescription'] . '</p>';
            echo '<p>Quantity In Stock: ' . $productDetails['quantityInStock'] . '</p>';
            echo '<p>Buy Price: ' . $productDetails['buyPrice'] . '</p>';
            echo '<p>MSRP: ' . $productDetails['MSRP'] . '</p>';
        } else {
            echo '<p>Product not found</p>';
        }
    ?>

</body>

</html>
