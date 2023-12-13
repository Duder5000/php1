<?php
    include('auth.php');

    include('db.php');

    // $sql = "SELECT * FROM products";
    // $result = mysqli_query($conn, $sql);

    // //Check for errors
    // if (!$result) {
    //     die("Query failed: " . mysqli_error($conn));
    // }

    $tableName = preg_replace('/[^a-zA-Z0-9]/', '', $_SESSION['email']);
    //$tableName = "india";

    $sqlTableCreate = "CREATE TABLE IF NOT EXISTS " . $tableName . " (id INT AUTO_INCREMENT PRIMARY KEY, code VARCHAR(255))";

    // echo $sqlTableCreate . "<br/>";

    if ($conn->query($sqlTableCreate) === TRUE) {
        // echo "Table created successfully! <br/>";
    } else {
        echo "Error creating table: " . $conn->error . "<br/>";
    }

    if (isset($_GET['productCode'])) {
        $productCode = $_GET['productCode'];
        // echo $productCode;
    }

    $sqlAdd = "INSERT IGNORE INTO " . $tableName . " (code) VALUES ('$productCode')";
    // echo $sqlAdd . "<br/>";

    $sqlCheckFor = "SELECT * FROM "  . $tableName . " WHERE code = '$productCode'";
    // echo $sqlCheckFor . "<br/>";
    $checkForResult = mysqli_query($conn, $sqlCheckFor);
    $rowCount = mysqli_num_rows($checkForResult);
    // echo $rowCount;

    if($rowCount < 1){
        if ($conn->query($sqlAdd) === TRUE) {
            // echo "Code added <br/>";
        } else {
            echo "Error adding: " . $conn->error . "<br/>";
        }
    }

    //Inner Join sql
    $sqlJoin = "SELECT * FROM products INNER JOIN " . $tableName . " ON products.productCode = " . $tableName . ".code  ORDER BY id DESC";
    // echo $sqlJoin . "<br/>";
    $joinResult = mysqli_query($conn, $sqlJoin);

    //Check for errors
    if (!$joinResult) {
        die("Query failed: " . mysqli_error($conn));
    }

    //Close DB connection
    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<!--     <a href="login.php">Login</a><br/>
    <a href="logout.php">Logout</a><br/> -->
    <a href="showmodels.php">Go Home</a>

    <h2>Watch List</h2>

    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Buy Price</th>
                <th>Quantity In Stock</th>
                <th>Product Description</th>
                
            </tr>
        </thead>
        <tbody>
            <?php
                while ($row = mysqli_fetch_assoc($joinResult)) {
                    echo '<tr>';
                    echo '<td><a href="modeldetails.php?productCode=' . $row['productCode'] . '">' . $row['productName'] . '</a></td>';
                    echo '<td>$' . $row['buyPrice'] . '</td>';
                    echo '<td>' . $row['quantityInStock'] . '</td>';
                    echo '<td>' . $row['productDescription'] . '</td>';                 
                    echo '</tr>';
                }
            ?>
        </tbody>
    </table>

</body>
</html>
