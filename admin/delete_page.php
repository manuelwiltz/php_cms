<?php

include '../DB_connection.php';

$toDelete = htmlspecialchars(stripcslashes(trim($_GET['id'])));

$statement = "DELETE FROM pages WHERE pages.id = " . $toDelete;

if ($res = $conn->query($statement)) {
    header("Location: pages.php");
} else {
    echo $conn->error;
}
?>
