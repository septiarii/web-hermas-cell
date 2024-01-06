<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$dbname = 'db_bukawarung';

$conn = new mysqli($hostname, $username, $password, $dbname) or die ('gagal terhubung ke database');
?>
