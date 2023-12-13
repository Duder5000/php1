<?php
    include('db.php');
    include('auth.php');

    // Check if in URL
    if (isset($_GET['trackNum'])) {
        $trackNum = $_GET['trackNum'];

        $sql = "SELECT * FROM restaurants WHERE TRACKINGNUMBER = '$trackNum'";
        $sqlInspections = "SELECT * FROM inspections1 WHERE TRACKINGNUMBER = '$trackNum'";
        
        $result = mysqli_query($conn, $sql);
        $resultInspections = mysqli_query($conn, $sqlInspections);

        // Check for errors
        if (!$result) {
            die("Query failed - result: " . mysqli_error($connection));
        }
        if (!$resultInspections) {
            die("Query failed - resultInspections: " . mysqli_error($connection));
        }

        // Fetch restaurant details as an associative array
        $restDetails = mysqli_fetch_assoc($result);
        $restDetailsInsp = mysqli_fetch_assoc($resultInspections);

        $restDetailsInspLen = mysqli_num_rows($resultInspections);
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
    <title>Restaurant Details</title>
</head>

<body>

    <?php
        if (isset($_SESSION['email'])) {
            echo '<a href="favorites.php?trackNum=' . $trackNum . '">Add to Favorites</a><br/>';
            echo '<a href="addInsp.php?trackNum=' . $trackNum . '">Add an Inspection</a>';
            if($_SESSION['type'] = 'a'){
                echo '<br/><a href="editRest.php?trackNum=' . $trackNum . '">Edit this Page</a>';
            }
        }

        if ($restDetails) {
            echo '<p><a href = index.php>Back to Main List</a></p>';
            echo '<h2>' . $restDetails['NAME'] . '</h2>';
            echo '<p>Facility Number: ' . $restDetails['TRACKINGNUMBER'] . '</p>';
            // echo '<p>Building Type: ' . $restDetails['FACTYPE'] . '</p>';
            echo '<p>City: ' . $restDetails['PHYSICALCITY'] . '</p>';
            echo '<p>Address: ' . $restDetails['PHYSICALADDRESS'] . '</p>';
            // echo '<p>Latitude: ' . $restDetails['LATITUDE'] . '</p>';
            // echo '<p>Longitude: ' . $restDetails['LONGITUDE'] . '</p>';
            
            $haz = 'na';
            $dateTemp = 0;

            mysqli_data_seek($resultInspections, 0);
            while ($row = mysqli_fetch_assoc($resultInspections)) {
                if($row['INSPECTIONDATE'] > $dateTemp){
                    $dateTemp = $row['INSPECTIONDATE'];
                    $haz = $row['HAZARDRATING'];
                }
            }

            echo '<p>Latest Rating: ' . $haz . '</p>';          
            echo '<h3>Inspections: ' . $restDetailsInspLen . '</h3>'; 

            mysqli_data_seek($resultInspections, 0);
            while ($row = mysqli_fetch_assoc($resultInspections)) {
                echo '<p>Date: <a href = inspDetails.php?trackNum=' . $trackNum . '&date=' . $row['INSPECTIONDATE'] . '>' . $row['INSPECTIONDATE'] . '</a>' . ' (' . $row['HAZARDRATING'] . ')</p>';
            }
            
        } else {
            echo '<p>Restaurant not found</p>';
        }
    ?>

</body>

</html>
