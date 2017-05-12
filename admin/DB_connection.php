<?php

if (is_file('./root/.$DB_info$')) {
    include './root/.$DB_info$';
} else {
    include './admin/root/.$DB_info$';
}

//$conn = new mysqli($_db_host, $_db_username, $_db_passwort, $_db_datenbank);
//
//if ($conn->connect_error) {
//    die("Connection failed" . $conn->connect_error);
//}

$conn = new mysqli($_db_host, $_db_username, $_db_passwort, $_db_datenbank);
global $conn;

if ($conn->connect_error) {
    $errorName = $conn->connect_error;

    if (strpos($errorName, "Unknown database") !== false) {
        session_start();
        $_SESSION['login'] = TRUE;
        header("Location: admin/install.php");
    }
}
?>