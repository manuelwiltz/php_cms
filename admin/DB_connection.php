<?php

$_db_host = "localhost";
$_db_datenbank = "cms_pages";
$_db_username = "root";
$_db_passwort = "";

$conn = new mysqli($_db_host, $_db_username, $_db_passwort, $_db_datenbank);

if ($conn->connect_error) {
    die("Connection failed" . $conn->connect_error);
}
?>