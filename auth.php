<?php
    session_start(); // Start or resume the session

    // Check if the user is logged in
    if (isset($_SESSION['email'])) {
        // echo $_SESSION['email'] . "<br/>";
        // echo 'Account Type: ' . $_SESSION['type'] . "<br/>";
        echo "<a href=\"logout.php\">Logout</a><br/>";
    }else{
        // echo "Not Logged In!<br/>";
        echo "<a href=\"login.php\">Login</a><br/>";
    }

    include('db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous">
    <link rel="stylesheet" href="css/w3.css">
    <link rel="stylesheet" href="css/darkmode.css">
</head>