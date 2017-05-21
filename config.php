<?php

//settings
$DB_HOST 			= 'localhost';
$DB_USER		= 'root';
$DB_PASS		= 'qeASxvLUDE';
$DB_NAME			= 'db';

//open mysql connection
$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

//output error and exit if there's an error
if ($mysqli->connect_error) {
    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
}
