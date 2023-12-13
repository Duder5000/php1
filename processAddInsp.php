<?php
    include('auth.php');
    include('db.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $trackNum = $_POST['trackNum']; 
        $inspectionDate = $_POST['inspectionDate'];
        $inspType = $_POST['inspType'];
        $numCritical = $_POST['numCritical'];
        $numNonCritical = $_POST['numNonCritical'];
        $violLump = $_POST['violLump'];
        $hazardRating = $_POST['hazardRating'];

        $sql = "INSERT INTO inspections1 (TRACKINGNUMBER, INSPECTIONDATE, INSPTYPE, NUMCRITICAL, NUMNONCRITICAL, VIOLLUMP, HAZARDRATING)
                VALUES ('$trackNum', '$inspectionDate', '$inspType', '$numCritical', '$numNonCritical', '$violLump', '$hazardRating')";

        echo $sql;

        $result = mysqli_query($conn, $sql);

        // Check for errors
        if (!$result) {
            die("Query failed - result: " . mysqli_error($connection));
        }

        // Redirect back to the original page or another destination
        header("Location: details.php?trackNum=$trackNum");
        exit();
    } else {
        // Handle cases where the form was not submitted
        echo "Error: Form not submitted.";
    }
?>