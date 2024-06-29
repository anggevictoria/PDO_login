<!DOCTYPE html>

<?php
require '../API/conn.php';
session_start();

if (!isset($_SESSION['user'])) {
    header('location:../index.php');
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot Dashboard</title>
    <link rel="stylesheet" href="dashboardStyle.css">
    <script src="https://unpkg.com/react/umd/react.production.min.js"></script>
    <script src="https://unpkg.com/react-dom/umd/react-dom.production.min.js"></script>
    <script src="https://unpkg.com/babel-standalone/babel.min.js"></script>
    <script type="text/babel" src="../API/app.php" defer></script>
</head>

<body>
    <?php
    $id = $_SESSION['user'];
    $sql = $conn->prepare("SELECT * FROM `member` WHERE `mem_id`='$id'");
    $sql->execute();
    $fetch = $sql->fetch();
    ?>
    <div class="background"></div>
    <div id="app"></div>
</body>

</html>