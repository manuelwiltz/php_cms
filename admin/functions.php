<?php

if (is_file('./DB_connection.php')) {
    include './DB_connection.php';
} else {
    include 'admin/DB_connection.php';
}

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
    $statement = "SELECT count(*) from views;";

    if ($res = $conn->query($statement)) {
        if ($res->num_rows > 0) {
            $row = $res->fetch_assoc();

            $visitors = $row['count(*)'];
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

/**
 * Returns the Pages where the PageName matches the parameter
 * @global type $conn
 * @param type $pagename
 * @return string
 */
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
                $output .= '<td><a class="btn btn-default" href="edit.php?id=' . $id . '">Edit</a> <a class="btn btn-default btn-green" href="../index.php?id=' . $id . '">View</a> <a class="btn btn-danger" href="delete_page.php?id=' . $id . '">Delete</a></td></td>';
                $output .= '</tr>';
            }

            $output .= '</table>';
            echo $output;
        }
    }
    return "<p>No pages found.</p>";
}

/**
 * Returns the PageName of the SubPage
 * @global type $conn
 * @param type $id
 * @return string
 */
function cms_getSubPageTitle($id) {
    global $conn;
    $id = $conn->real_escape_string(htmlspecialchars(stripcslashes(trim($id))));
    $statement = "SELECT * FROM pages where id=" . $id;

    if ($res = $conn->query($statement)) {
        if ($res->num_rows > 0) {
            $row = $res->fetch_assoc();
            return $row['PageName'];
        }
    }
    return "<p>Title</p>";
}

/**
 * Returns the Descriptsion of the SubPage
 * @global type $conn
 * @param type $id
 * @return string
 */
function cms_getWebsiteDescription($id) {
    global $conn;
    $id = $conn->real_escape_string(htmlspecialchars(stripcslashes(trim($id))));
    $statement = "SELECT * FROM pages where id=" . $id;

    if ($res = $conn->query($statement)) {
        if ($res->num_rows > 0) {
            $row = $res->fetch_assoc();
            return $row['MetaDescription'];
        }
    }
    return "<p>Meta Description</p>";
}

/**
 * Returns the Keywords of the SubPage
 * @global type $conn
 * @param type $id
 * @return string
 */
function cms_getWebsiteKeywords($id) {
    global $conn;
    $id = $conn->real_escape_string(htmlspecialchars(stripcslashes(trim($id))));
    $statement = "SELECT * FROM pages where id=" . $id;

    if ($res = $conn->query($statement)) {
        if ($res->num_rows > 0) {
            $row = $res->fetch_assoc();
            return $row['Keywords'];
        }
    }
    return "<p>Keywords</p>";
}

/**
 * Creates a new view and inserts the details into the database.
 * @global type $conn
 * @param type $id
 * @return string
 */
function cms_addNewView($pagename) {
    global $conn;

    $pagename = $conn->real_escape_string(htmlspecialchars(stripcslashes(trim($pagename))));
    $statement = "INSERT INTO views (id, date, ip, pagename, browser, os) VALUES (NULL, CURRENT_TIMESTAMP, '" . $_SERVER['REMOTE_ADDR'] . "', '" . $pagename . "', '" . getBrowser() . "', '" . getOS() . "')";

    if ($res = $conn->query($statement)) {
        return true;
    }
    return false;
}

/**
 * Returns the OS which the client is using.
 * @return string
 */
function getOS() {
    $user_agent = $_SERVER['HTTP_USER_AGENT'];

    $os_platform = "Unknown OS Platform";

    $os_array = array(
        '/windows nt 10/i' => 'Windows 10',
        '/windows nt 6.3/i' => 'Windows 8.1',
        '/windows nt 6.2/i' => 'Windows 8',
        '/windows nt 6.1/i' => 'Windows 7',
        '/windows nt 6.0/i' => 'Windows Vista',
        '/windows nt 5.2/i' => 'Windows Server 2003/XP x64',
        '/windows nt 5.1/i' => 'Windows XP',
        '/windows xp/i' => 'Windows XP',
        '/windows nt 5.0/i' => 'Windows 2000',
        '/windows me/i' => 'Windows ME',
        '/win98/i' => 'Windows 98',
        '/win95/i' => 'Windows 95',
        '/win16/i' => 'Windows 3.11',
        '/macintosh|mac os x/i' => 'Mac OS X',
        '/mac_powerpc/i' => 'Mac OS 9',
        '/linux/i' => 'Linux',
        '/ubuntu/i' => 'Ubuntu',
        '/iphone/i' => 'iPhone',
        '/ipod/i' => 'iPod',
        '/ipad/i' => 'iPad',
        '/android/i' => 'Android',
        '/blackberry/i' => 'BlackBerry',
        '/webos/i' => 'Mobile'
    );

    foreach ($os_array as $regex => $value) {

        if (preg_match($regex, $user_agent)) {
            $os_platform = $value;
        }
    }

    return $os_platform;
}

/**
 * Returns the browser which the client is using.
 * @return string
 */
function getBrowser() {
    $user_agent = $_SERVER['HTTP_USER_AGENT'];

    $browser = "Unknown Browser";

    $browser_array = array(
        '/msie/i' => 'Internet Explorer',
        '/firefox/i' => 'Firefox',
        '/safari/i' => 'Safari',
        '/chrome/i' => 'Chrome',
        '/edge/i' => 'Edge',
        '/opera/i' => 'Opera',
        '/netscape/i' => 'Netscape',
        '/maxthon/i' => 'Maxthon',
        '/konqueror/i' => 'Konqueror',
        '/mobile/i' => 'Handheld Browser'
    );

    foreach ($browser_array as $regex => $value) {

        if (preg_match($regex, $user_agent)) {
            $browser = $value;
        }
    }

    return $browser;
}

/**
 * Returns the contact information of the site.
 * @global type $conn
 * @return string
 */
function cms_getContactInfo() {
    global $conn;


    $statement = "SELECT * FROM site_info;";
    $output = "";

    if ($res = $conn->query($statement)) {
        if ($res->num_rows == 1) {
            $output .= '<ul>';
            $row = $res->fetch_assoc();

            if (strlen($row['site_phonenumber']) > 0) {
                $output .= '<li><p>Phone: ' . $row['site_phonenumber'] . '</p></li>';
            }

            if (strlen($row['site_email']) > 0) {
                $output .= '<li><p>EMail: <a href="mailto:' . $row['site_email'] . '">' . $row['site_email'] . '</a></p></li>';
            }
            $output .= '</ul>';
        }
    }
    return $output;
}

/**
 * Returns all links of the website.
 * @global type $conn
 * @return string
 */
function cms_getWebsiteLinks() {
    global $conn;

    $statement = "SELECT * FROM pages;";
    $output = "";

    if ($_res = $conn->query($statement)) {
        if ($_res->num_rows > 0) {
            $output .= '<p> | ';
            while ($row = $_res->fetch_assoc()) {
                $page_id = $row['ID'];
                $name = $row['PageName'];
                $output .= ' <a href="index.php?id=' . $page_id . '">' . $name . '</a> |';
            }
            $output .= '</p>';
        }
    }
    return $output;
}

/**
 * Returns the social media icons as links.
 * @global type $conn
 * @return string
 */
function cms_getSocialMediaIcons() {
    global $conn;

    $output = "";

    $statement = "SELECT * FROM site_info;";
    $row = "";

    if ($res = $conn->query($statement)) {
        if ($res->num_rows == 1) {
            $row = $res->fetch_assoc();

            if (strlen($row['link_facebook']) > 0) {
                $output .= '<a href="' . $row['link_facebook'] . '" class="facebook"><i class="fa fa-facebook-official"></i></a>';
            }

            if (strlen($row['link_twitter']) > 0) {
                $output .= '<a href="' . $row['link_twitter'] . '" class="twitter"><i class="fa fa-twitter"></i></a>';
            }

            if (strlen($row['link_github']) > 0) {
                $output .= '<a href="' . $row['link_github'] . '" class="github"><i class="fa fa-github"></i></a>';
            }

            if (strlen($row['link_codepen']) > 0) {
                $output .= '<a href="' . $row['link_codepen'] . '" class="codepen"><i class="fa fa-codepen"></i></a>';
            }

            if (strlen($row['link_googleplus']) > 0) {
                $output .= '<a href="' . $row['link_facebook'] . '" class="google"><i class="fa fa-google-plus"></i></a>';
            }
        }
    }

    return $output;
}

?>