<?php

$host = 'localhost';
$dbname = 'aliftech';
$user = 'root';
$password = '';

$mysqli = new mysqli($host, $user, $password);
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

if (!$mysqli->query("CREATE DATABASE IF NOT EXISTS $dbname")) {
    echo "Failed to create database: (" . $mysqli->errno . ") " . $mysqli->error;
} else {
    echo "Database created successfully" . PHP_EOL;
}

$mysqli->select_db($dbname);

$createTable = "
CREATE TABLE reservations (
    room_id INT NOT NULL,
    start_time DATETIME NOT NULL,
    end_time DATETIME NOT NULL,
    reserved_by VARCHAR(255) NOT NULL
);";

if (!$mysqli->query($createTable)) {
    echo "Failed to create table: (" . $mysqli->errno . ") " . $mysqli->error;
} else {
    echo "Table created successfully";
}