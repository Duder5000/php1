<?php
    include('db.php');
    include('auth.php');

    // Check if in URL
    if (isset($_GET['trackNum'])) {
        $trackNum = $_GET['trackNum'];
        $date = $_GET['date'];

        $sql = "SELECT * FROM restaurants WHERE TRACKINGNUMBER = '$trackNum'";
        $sqlInspections = "SELECT * FROM inspections1 WHERE TRACKINGNUMBER = '$trackNum'";
        $sqlDate = "SELECT * FROM inspections1 WHERE INSPECTIONDATE = '$date' AND TRACKINGNUMBER = '$trackNum'";
        
        $result = mysqli_query($conn, $sql);
        $resultInspections = mysqli_query($conn, $sqlInspections);
        $resultDate = mysqli_query($conn, $sqlDate);

        // Check for errors
        if (!$result) {
            die("Query failed - result: " . mysqli_error($connection));
        }
        if (!$resultInspections) {
            die("Query failed - resultInspections: " . mysqli_error($connection));
        }
        if (!$resultDate) {
            die("Query failed - resultDate: " . mysqli_error($connection));
        }

        // Fetch restaurant details as an associative array
        $restDetails = mysqli_fetch_assoc($result);
        $restDetailsInsp = mysqli_fetch_assoc($resultInspections);
        $restDetailsDate = mysqli_fetch_assoc($resultDate);

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
    <title>Inspections Details</title>
</head>

<body>

    <?php
        // echo $date;
        if ($restDetails) {
            echo '<p><a href = index.php>Back to Main List</a></p>';
            echo '<p><a href = details.php?trackNum=' . $trackNum . '>' . 'Back to Resterants Page' . '</a></p>';
            echo '<h2>' . $restDetails['NAME'] . '</h2>';
            echo '<p>Resterant Tracking Number: ' . $trackNum . '</p>';
            echo '<p>Address: ' . $restDetails['PHYSICALADDRESS'] . '</p>';
            echo '<p>Latitude: ' . $restDetails['LATITUDE'] . '</p>';
            echo '<p>Longitude: ' . $restDetails['LONGITUDE'] . '</p>';
            echo '<p>Inspection Date: ' . $restDetailsDate['INSPECTIONDATE'] . '</p>';
            echo '<p>Inspection Type: ' . $restDetailsDate['INSPTYPE'] . '</p>';
            echo '<p>Number of Critical Issues: ' . $restDetailsDate['NUMCRITICAL'] . '</p>';
            echo '<p>Number of Other Issues: ' . $restDetailsInsp['NUMNONCRITICAL'] . '</p>';
            echo '<p>Hazard Rating: ' . $restDetailsDate['HAZARDRATING'] . '</p>';
            echo '<p>VIOLLUMP: ' . $restDetailsDate['VIOLLUMP'] . '</p>';
            
        } else {
            echo '<p>Restaurant not found</p>';
        }
    ?>

</body>

</html>
