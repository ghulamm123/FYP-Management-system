<?php
$server = 'localhost';
$username = 'id8403841_admin';
$password = 'admin@1234#';
$database = 'id8403841_fypms';

try{
	$conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch(PDOException $e){
	die( "Connection failed: " . $e->getMessage());
}
