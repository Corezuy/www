<?php

//settings
$DB_HOST 			= '';
$DB_USER		= '';
$DB_PASS		= '';
$DB_NAME			= '';

//open mysql connection
$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

//output error and exit if there's an error
if ($mysqli->connect_error) {
    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
}
