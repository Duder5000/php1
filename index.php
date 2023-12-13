<?php
    include('db.php');
    include('auth.php');

    $sql = "SELECT NAME, PHYSICALADDRESS, TRACKINGNUMBER FROM restaurants"; // Select only the columns you need
    $result = mysqli_query($conn, $sql);

    // Check for errors
    if (!$result) {
        die("Query failed: " . mysqli_error($connection));
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Show Restaurants</title>
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
        <?php
            if(isset($_SESSION['email']) && $_SESSION['type'] = 'a'){
                echo '<br/><a href="addRest.php' . $trackNum . '">Add New</a>';
            }
        ?>

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
                    while ($row = mysqli_fetch_assoc($result)) {
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

<?php
    // Close DB connection
    $conn->close();
?>
