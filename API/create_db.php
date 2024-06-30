<?php
$servername = "localhost";
$username = "root";
$password = "";

try {
    // Create connection
    $conn = new PDO("mysql:host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create database if it doesn't exist
    $dbname = "db_login"; // Your desired database name
    $create_db_sql = "CREATE DATABASE IF NOT EXISTS $dbname";
    $conn->exec($create_db_sql);
    
    // Switch to the newly created or existing database
    $conn->exec("USE $dbname");

    // Create member table if it doesn't exist
    $create_table_sql = "CREATE TABLE IF NOT EXISTS member (
        mem_id INT(11) AUTO_INCREMENT PRIMARY KEY,
        firstname VARCHAR(50) NOT NULL,
        lastname VARCHAR(50) NOT NULL,
        username VARCHAR(30) NOT NULL,
        password VARCHAR(12) NOT NULL
    )";
    $conn->exec($create_table_sql);

    echo "Database and table setup completed.";
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
