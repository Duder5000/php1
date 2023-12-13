<?php
    include('auth.php');
    include('db.php');

    $tableName = preg_replace('/[^a-zA-Z0-9]/', '', $_SESSION['email']);

    $sqlTableCreate = "CREATE TABLE IF NOT EXISTS " . $tableName . " (id INT AUTO_INCREMENT PRIMARY KEY, code VARCHAR(255))";

    if ($conn->query($sqlTableCreate) === TRUE) {
    } else {
        echo "Error creating table: " . $conn->error . "<br/>";
    }

    if (isset($_GET['trackNum'])) {
        $trackNum = $_GET['trackNum'];
        // echo $trackNum;
    }

    $sqlAdd = "INSERT IGNORE INTO " . $tableName . " (code) VALUES ('$trackNum')";
    // echo $sqlAdd . "<br/>";

    $sqlCheckFor = "SELECT * FROM "  . $tableName . " WHERE code = '$trackNum'";
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
    $sqlJoin = "SELECT * FROM restaurants INNER JOIN " . $tableName . " ON restaurants.TRACKINGNUMBER = " . $tableName . ".code  ORDER BY id DESC";
    // echo $sqlJoin;

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
    <title>Favorites</title>
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
    </style>
</head>
<body>

    <p><a href = index.php>Back to Main List</a></p>
    <h2>Show Restaurants</h2>
    <table>
        <thead>
            <tr>
                <th>Restaurant Name</th>
                <th>Physical Address</th>
            </tr>
        </thead>
        <tbody>
            <?php
                while ($row = mysqli_fetch_assoc($joinResult)) {
                    echo '<tr>';
                    echo '<td><a href="details.php?trackNum=' . $row['TRACKINGNUMBER'] . '">' . $row['NAME'] . '</td>';
                    echo '<td>' . $row['PHYSICALADDRESS'] . '</td>';
                    echo '</tr>';
                }
            ?>
        </tbody>
    </table>

</body>
</html>
