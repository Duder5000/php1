<?php
    include('auth.php');
    include('db.php');

    // Close DB connection
    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Restaurant</title>
</head>
<body>

    <p><a href="index.php">Back to Main List</a></p>
    <?php
        echo '<h2>Add Restaurant</h2>';
    ?>

    <form action="processAddRest.php" method="post">

        <label for="trackingNum">Tracking Number:</label>
        <input type="text" name="trackingNum" required><br>

        <label for="restName">Name:</label>
        <input type="text" name="restName" required><br>

        <label for="address">Address:</label>
        <input type="text" name="address" required><br>

        <label for="city">City:</label>
        <input type="text" name="city" required><br>

        <label for="facType">Facility Type:</label>
        <input type="text" name="facType" required><br>

        <label for="lat">Latitude:</label>
        <input type="text" name="lat" required><br>

        <label for="long">Longitude:</label>
        <input type="text" name="long" required><br>

        <input type="submit" value="Add Restaurant">
    </form>

</body>
</html>
