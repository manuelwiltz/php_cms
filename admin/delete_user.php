<?php

include '../DB_connection.php';

$toDelete = htmlspecialchars(stripcslashes(trim($_GET['id'])));

$statement = "DELETE FROM users WHERE users.id = " . $toDelete;

if ($res = $conn->query($statement)) {
    header("Location: users.php");
}
?>