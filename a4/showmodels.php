<?php
    include('db.php');
    include('auth.php');

    $sql = "SELECT * FROM products";
    $result = mysqli_query($conn, $sql);

    //Check for errors
    if (!$result) {
        die("Query failed: " . mysqli_error($connection));
    }

    //Close DB connection
    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Models</title>
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
    <a href="logout.php">Logout</a> -->

    <h2>Show Models</h2>
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
                while ($row = mysqli_fetch_assoc($result)) {
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
