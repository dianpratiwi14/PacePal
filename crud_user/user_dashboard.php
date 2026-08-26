<?php
session_start();

if ($_SESSION['level'] != 'User') {
    header("Location: ../LoginForms/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <!-- CSS dan script lainnya -->
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION['nama']; ?>! This is the User Dashboard.</h1>
    <!-- Konten dashboard user lainnya -->
    <a href="logout.php">Logout</a>
</body>
</html>
