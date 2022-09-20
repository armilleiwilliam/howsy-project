<?php

// Database connection
try {
    $conn = new PDO("mysql:host=" . SERVER_NAME . ";dbname=" . DATABASE_NAME , DATABASE_USER, DATABASE_PASS);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}