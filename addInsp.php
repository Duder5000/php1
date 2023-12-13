<?php
    include('auth.php');
    include('db.php');

    // Check if in URL
    if (isset($_GET['trackNum'])) {
        $trackNum = $_GET['trackNum'];

        $sql = "SELECT * FROM restaurants WHERE TRACKINGNUMBER = '$trackNum'";
        
        $result = mysqli_query($conn, $sql);

        // Check for errors
        if (!$result) {
            die("Query failed - result: " . mysqli_error($connection));
        }

        // Fetch restaurant details as an associative array
        $restDetails = mysqli_fetch_assoc($result);

    } else {
        echo "ERROR";
        // header("Location: index.php");
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
    <title>Add Inspection</title>
</head>
<body>

    <p><a href="index.php">Back to Main List</a></p>
    <?php
        echo '<h2>Add Inspection for ' . $restDetails['NAME'] . '</h2>';
        echo '<p>Facility Number: ' . $restDetails['TRACKINGNUMBER'] . '</p>';
    ?>

    <form action="processAddInsp.php" method="post">
        <input type="hidden" name="trackNum" value="<?php echo $trackNum; ?>">
        
 <!--        <label for="inspectionDate">Inspection Date:</label>
        <input type="date" name="inspectionDate" required><br> -->
        <label for="inspectionDate">Inspection Date (YYYYMMDD):</label>
        <input type="text" name="inspectionDate" pattern="[0-9]{8}" title="Please enter a valid date in the format YYYYMMDD" required><br>


        <label for="inspType">Inspection Type:</label>
        <select name="inspType" required>
            <option value="Routine">Routine</option>
            <option value="Follow-Up">Follow-Up</option>
            <!-- Add more options as needed -->
        </select><br>

        <label for="numCritical">Number of Critical Issues:</label>
        <input type="number" name="numCritical" required><br>

        <label for="numNonCritical">Number of Non-Critical Issues:</label>
        <input type="number" name="numNonCritical" required><br>

        <label for="violLump">Violation Lump:</label>
        <textarea name="violLump" rows="4" required></textarea><br>

        <label for="hazardRating">Hazard Rating:</label>
        <select name="hazardRating" required>
            <option value="Low">Low</option>
            <option value="High">High</option>
        </select><br>

        <input type="submit" value="Add Inspection">
    </form>

</body>
</html>
