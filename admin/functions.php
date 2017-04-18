<?php

include './DB_connection.php';

if (isset($_POST['cms_setWebsiteTitle'])) {
    cms_setWebsiteTitle($_POST['cms_setWebsiteTitle']);
} elseif (isset($_POST['cms_addPage'])) {
    cms_addPage($_POST['cms_addPage']);
} elseif (isset($_POST['cms_searchUser'])) {
    cms_getUsers($_POST['cms_searchUser']);
} elseif (isset($_POST['cms_searchPages'])) {
    cms_getPages($_POST['cms_searchPages']);
}

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

/**
 * Set the website title
 * @global type $conn
 * @param type $newTitle
 * @return string
 */
function cms_setWebsiteTitle($newTitle) {

    global $conn;
    $newTitle = $conn->real_escape_string(htmlspecialchars(stripcslashes(trim($newTitle))));
    $statement = "UPDATE site_info SET sitename = '" . $newTitle . "'";

    if ($res = $conn->query($statement)) {
        return "Success! Title changed";
    } else {
        return "Oups! An error occured, title not changed. Try later.";
    }
}

/**
 * Returns the amount of visitors
 * @global type $conn
 * @return string
 */
function cms_getVisitors() {

    global $conn;
    $statement = "SELECT * from site_info";

    if ($res = $conn->query($statement)) {
        if ($res->num_rows > 0) {
            $row = $res->fetch_assoc();

            $visitors = $row['views'];
            return $visitors;
        }
    }
    return "0";
}

/**
 * Returns the amount of users
 * @global type $conn
 * @return string
 */
function cms_getCountUsers() {

    global $conn;
    $statement = "SELECT count(*) from users";

    if ($res = $conn->query($statement)) {
        if ($res->num_rows > 0) {
            $row = $res->fetch_assoc();

            $amount = $row['count(*)'];
            return $amount;
        }
    }
    return "0";
}

/**
 * Returns the amount of pages.
 * @global type $conn
 * @return string
 */
function cms_getCountSites() {

    global $conn;
    $statement = "SELECT count(*) from pages";

    if ($res = $conn->query($statement)) {
        if ($res->num_rows > 0) {
            $row = $res->fetch_assoc();

            $amount = $row['count(*)'];
            return $amount;
        }
    }
    return "0";
}

/**
 * Inserts a new page into the database
 * @global type $conn
 * @param type $pageName
 * @return string
 */
function cms_addPage($pageName) {

    global $conn;
    $paneName = $conn->real_escape_string(htmlspecialchars(stripcslashes(trim($pageName))));
    $statement = "INSERT INTO pages (ID, PageName, PageContent, Keywords, MetaDescription, Timestamp) VALUES (NULL, '$pageName', NULL, NULL, NULL, CURRENT_TIMESTAMP)";

    if ($res = $conn->query($statement)) {
        return "Success! Site created";
    } else {
        return "Oups! An error occured, site not created. Try later.";
    }
}

/**
 * Search the users and returns them in a table
 * @global type $conn
 * @param type $username
 * @return string
 */
function cms_getUsers($username) {

    global $conn;
    $username = $conn->real_escape_string(htmlspecialchars(stripcslashes(trim($username))));
    $statement = "SELECT * FROM users where username like '%$username%'";

    if ($res = $conn->query($statement)) {
        if ($res->num_rows > 0) {
            $output = "<p class='bold'>We found the following users: </p>";
            $output .= '<table class="table table-striped table-hover" style="margin-bottom: 0"><tr><th>Name</th><th>Username</th><th>Email</th><th>Joined</th><th></th></tr>';

            while ($row = $res->fetch_assoc()) {

                $name = $row['firstname'] . " " . $row['lastname'];
                $username = $row['username'];
                $email = $row['email'];
                $joined = $row['create_date'];

                $output .= '<tr>';
                $output .= '<td>' . $name . '</td>';
                $output .= '<td>' . $username . '</td>';
                $output .= '<td>' . $email . '</td>';
                $output .= '<td>' . $joined . '</td>';
                $output .= '<td><a class="btn btn-default" href="edit.php">Edit</a> <a class="btn btn-danger" href="#">Delete</a></td>';
                $output .= '</tr>';
            }

            $output .= '</table>';
            echo $output;
        }
    }
    return "<p>No user found.</p>";
}

function cms_getPages($pagename) {
    global $conn;
    $pagename = $conn->real_escape_string(htmlspecialchars(stripcslashes(trim($pagename))));
    $statement = "SELECT * FROM pages where PageName like '%$pagename%'";

    if ($res = $conn->query($statement)) {
        if ($res->num_rows > 0) {
            $output = "<p class='bold'>We found the following pages: </p>";
            $output .= '<table class="table table-striped table-hover" style="margin-bottom: 0"><tr><th>Name</th><th>Username</th><th>Email</th><th>Joined</th><th></th></tr>';

            while ($row = $res->fetch_assoc()) {
                $id = $row['ID'];
                $name = $row['PageName'];
                $created = $row['Timestamp'];

                $output .= '<tr>';
                $output .= '<td>' . $name . '</td>';
                $output .= '<td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>';
                $output .= '<td>' . $created . '</td>';
                $output .= '<td><a class="btn btn-default" href="edit.php?id=' . $id . '">Edit</a> <a class="btn btn-default btn-green" href="../SubPage.php?id=' . $id . '">View</a> <a class="btn btn-danger" href="delete_page.php?id=' . $id . '">Delete</a></td></td>';
                $output .= '</tr>';
            }

            $output .= '</table>';
            echo $output;
        }
    }
    return "<p>No pages found.</p>";
}

?>