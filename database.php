<?php

$server = 'localhost:8889';
$username = 'root';
$password = 'root';
$database = 'Universia';

try {
  $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch (PDOException $e) {
  die('Connection Failed: ' . $e->getMessage());
}

?>