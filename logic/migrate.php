<?php
/**
 * Database Migration Script
 */

$host = 'localhost';
$username = 'root';
$password = '';

try {
    // Connect without dbname first to create it
    $temp_pdo = new PDO("mysql:host=$host;charset=utf8mb4", $username, $password);
    $temp_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $temp_pdo->exec("CREATE DATABASE IF NOT EXISTS dtr_system;");
    echo "Database 'dtr_system' created or already exists.\n";
    
    // Now switch to the database
    $temp_pdo->exec("USE dtr_system;");
    
    $sql = file_get_contents('database.sql');
    $temp_pdo->exec($sql);
    echo "Tables and initial data created successfully.\n";
    
} catch (PDOException $e) {
    die("Migration failed: " . $e->getMessage() . "\n");
}
