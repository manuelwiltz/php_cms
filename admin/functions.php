<?php

include '../DB_connection.php';

/**
 * Returns the website name
 * @global type $conn
 * @return string
 */
function cms_getWebsiteTitle() {

    global $conn;
    $statement = "SELECT * from site_info";

    if ($res = $conn->query($statement)) {

        if ($res->num_rows > 0) {
            $row = $res->fetch_assoc();

            $sitename = $row['sitename'];
            return $sitename;
        }
    }
    return "Title";
}

function cms_setWebsiteTitle($newTitle) {
    
    global $conn;
    $statement = "UPDATE site_info SET sitename = '".$newTitle."'";

    if ($res = $conn->query($statement)) {
        return "Success! Title changed";
    } else {
        return "Oups! An error occured, title not changed. Try later.";
    }
}
?>