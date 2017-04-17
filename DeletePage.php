<?php

include './DB_connection.php';

$statement = "DELETE FROM `pages` WHERE `pages`.`ID` = " . $_GET['id'];

if ($res = $conn->query($statement)) {
    header("Location: admin/admin.php");
}

?>