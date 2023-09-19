<?php 
 
// Database configuration 
$dbHost     = "103.90.227.186"; 
$dbUsername = "hd"; 
$dbPassword = "hd@123"; 
$dbName     = "lk_pepsi"; 
 
// Create database connection 
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName); 
 
// Check connection 
if ($db->connect_error) { 
    die("Connection failed: " . $db->connect_error); 
} 
 
?>