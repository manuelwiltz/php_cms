<?php
session_start();
if (!isset($_SESSION['login'])) {
    echo '<script>window.location.replace("login.php");</script>';
}
if (is_file('./root/.$DB_info$')) {
    include './root/.$DB_info$';
} else {
    include './admin/root/.$DB_info$';
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Install</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="style.css" rel="stylesheet">
        <style>
            .padding-md {
                padding: 15px;
            }
        </style>
    </head>
    <body>

        <div class="container">

            <div class="jumbotron text-center">
                <p>Welcome ^-^</p>
                <p>You are only few clicks away ;)</p>
                <p>Enter the form, click Install and you will be automatically forwarded to the login page of your CMS.</p>
            </div>

            <div class="row">
                <?php
                if ((isset($_POST['site_name']) && strlen($_POST['site_name']) > 0) &&
                        (isset($_POST['firstname']) && strlen($_POST['firstname']) > 0) &&
                        (isset($_POST['lastname']) && strlen($_POST['lastname']) > 0) &&
                        (isset($_POST['username']) && strlen($_POST['username']) > 0) &&
                        (isset($_POST['email']) && strlen($_POST['email']) > 0) &&
                        (isset($_POST['password1']) && strlen($_POST['password1']) > 0) &&
                        (isset($_POST['password2']) && strlen($_POST['password2']) > 0) &&
                        ($_POST['password1'] == $_POST['password2'])
                ) {

                    $conn = new mysqli($_db_host, $_db_username, $_db_passwort);

                    if ($conn->connect_error) {
                        echo $conn->connect_error;
                    } else {

                        $statement = "CREATE DATABASE $_db_datenbank";
                        if ($conn->query($statement)) {

                            $conn = new mysqli($_db_host, $_db_username, $_db_passwort, "$_db_datenbank");

                            if (!$conn->connect_error) {

                                $statements = array(
                                    "CREATE TABLE `pages` (`ID` int(11) NOT NULL,`PageName` varchar(255) DEFAULT NULL,`PageContent` text,`Keywords` varchar(255) DEFAULT NULL,`MetaDescription` varchar(400) DEFAULT NULL,`Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP) ENGINE=InnoDB DEFAULT CHARSET=latin1;",
                                    "CREATE TABLE `site_info` (`sitename` varchar(255) NOT NULL,`site_phonenumber` varchar(255) NOT NULL,`site_email` varchar(255) NOT NULL,`link_facebook` varchar(255) NOT NULL,`link_twitter` varchar(255) NOT NULL,`link_github` varchar(255) NOT NULL,`link_codepen` varchar(255) NOT NULL,`link_googleplus` varchar(255) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=latin1;",
                                    "CREATE TABLE `users` (`id` int(11) NOT NULL,`firstname` varchar(255) NOT NULL,`lastname` varchar(255) NOT NULL,`username` varchar(255) NOT NULL,`email` varchar(255) NOT NULL,`password` varchar(255) NOT NULL,`create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP) ENGINE=InnoDB DEFAULT CHARSET=latin1;",
                                    "CREATE TABLE `views` (`id` int(11) NOT NULL, `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,`ip` varchar(300) NOT NULL,`pagename` varchar(255) NOT NULL,`browser` varchar(255) NOT NULL,`os` varchar(255) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=latin1;",
                                    "ALTER TABLE `pages` ADD PRIMARY KEY (`ID`);",
                                    "ALTER TABLE `site_info` ADD PRIMARY KEY (`sitename`);",
                                    "ALTER TABLE `users` ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`);",
                                    "ALTER TABLE `views` ADD PRIMARY KEY (`id`);",
                                    "ALTER TABLE `pages` MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;",
                                    "ALTER TABLE `users` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;",
                                    "ALTER TABLE `views` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;"
                                );
                                $errorCount = 0;

                                foreach ($statements as $value) {
                                    if (!$conn->query($value)) {
                                        $errorCount++;
                                    }
                                }

                                $site_name = $conn->real_escape_string(htmlspecialchars(stripcslashes(trim($_POST['site_name']))));

                                $firstname = $conn->real_escape_string(htmlspecialchars(stripcslashes(trim($_POST['firstname']))));
                                $lastname = $conn->real_escape_string(htmlspecialchars(stripcslashes(trim($_POST['lastname']))));

                                $username = $conn->real_escape_string(htmlspecialchars(stripcslashes(trim($_POST['username']))));
                                $email = $conn->real_escape_string(htmlspecialchars(stripcslashes(trim($_POST['email']))));

                                $password1 = md5($conn->real_escape_string(htmlspecialchars(stripcslashes(trim($_POST['password1'])))));
                                $password2 = md5($conn->real_escape_string(htmlspecialchars(stripcslashes(trim($_POST['password2'])))));

                                $phonenumber = "";
                                $site_email = "";
                                $site_facebook = "";
                                $site_twitter = "";
                                $site_github = "";
                                $site_codepen = "";
                                $site_googleplus = "";

                                if (isset($_POST['phonenumber'])) {
                                    $phonenumber = $conn->real_escape_string(htmlspecialchars(stripcslashes(trim($_POST['phonenumber']))));
                                }
                                if (isset($_POST['site_email'])) {
                                    $site_email = $conn->real_escape_string(htmlspecialchars(stripcslashes(trim($_POST['site_email']))));
                                }
                                if (isset($_POST['site_facebook'])) {
                                    $site_facebook = $conn->real_escape_string(htmlspecialchars(stripcslashes(trim($_POST['site_facebook']))));
                                }
                                if (isset($_POST['site_twitter'])) {
                                    $site_twitter = $conn->real_escape_string(htmlspecialchars(stripcslashes(trim($_POST['site_twitter']))));
                                }
                                if (isset($_POST['site_github'])) {
                                    $site_github = $conn->real_escape_string(htmlspecialchars(stripcslashes(trim($_POST['site_github']))));
                                }
                                if (isset($_POST['site_codepen'])) {
                                    $site_codepen = $conn->real_escape_string(htmlspecialchars(stripcslashes(trim($_POST['site_codepen']))));
                                }
                                if (isset($_POST['site_googleplus'])) {
                                    $site_googleplus = $conn->real_escape_string(htmlspecialchars(stripcslashes(trim($_POST['site_googleplus']))));
                                }

                                $inserts = array(
                                    "INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `email`, `password`, `create_date`) VALUES (NULL, '" . $firstname . "', '" . $lastname . "', '" . $username . "', '" . $email . "', '" . $password1 . "', CURRENT_TIMESTAMP)",
                                    "INSERT INTO `site_info` (`sitename`, `site_phonenumber`, `site_email`, `link_facebook`, `link_twitter`, `link_github`, `link_codepen`, `link_googleplus`) VALUES ('" . $site_name . "', '" . $phonenumber . "', '" . $site_email . "', '" . $site_facebook . "', '" . $site_twitter . "', '" . $site_github . "', '" . $site_codepen . "', '" . $site_googleplus . "')",
                                    "INSERT INTO `pages` (`ID`, `PageName`, `PageContent`, `Keywords`, `MetaDescription`, `Timestamp`) VALUES (NULL, 'Home', '<h1>Welcome</h1> <p> login into the admin area to change the contetn, add users, manage pages and much more </p>', 'welcome', 'This is a new CMS installation', CURRENT_TIMESTAMP)"
                                );

                                foreach ($inserts as $value) {
                                    if (!$conn->query($value)) {
                                        $errorCount++;
                                    }
                                }

                                if ($errorCount == 0) {
                                    unset($_SESSION['login']);
                                    echo '<script>window.location.replace("login.php");</script>';
                                } else {
                                    echo '<p>Sorry, something went wrong!</p>';
                                }
                            } else {
                                echo '<p>Es ist ein Fehler aufgetreten</p>';
                            }
                        } else {
                            echo '<h1 class="text-center">Your CMS is allready installed!</h1>';
                        }
                    }
                }
                ?>
            </div>

            <div class="row padding-md">

                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">

                    <h2>Settings </h2>

                    <div class="alert alert-success">
                        <p><strong>Note:</strong> The site name is required and will be displayed in the main navigation. Choose wisely.</p>
                    </div>

                    <div class="form-group">
                        <label for="text">Site name: *</label>
                        <input type="text" class="form-control" name="site_name" placeholder="Enter Site name">
                    </div>

                    <hr class="medium">

                    <h2>Create a USER:</h2>
                    <div class="alert alert-success">
                        <p><strong>Note:</strong> This will be the Super User which you need to login the first time.</p>
                    </div>

                    <div class="form-group">
                        <label for="text">Firstname:</label>
                        <input type="text" class="form-control" name="firstname" placeholder="Enter firstname">
                    </div>
                    <div class="form-group">
                        <label for="text">Lastname:</label>
                        <input type="text" class="form-control" name="lastname" placeholder="Enter lastname">
                    </div>
                    <div class="form-group">
                        <label for="text">Username:</label>
                        <input type="text" class="form-control" name="username" placeholder="Enter username">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" name="email" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Password:</label>
                        <input type="password" class="form-control" name="password1" placeholder="Enter password">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Repeat password:</label>
                        <input type="password" class="form-control" name="password2" placeholder="Repeat password">
                    </div>

                    <hr class="medium">

                    <h2>Contact Information</h2>
                    <div class="alert alert-info">
                        <p><strong>Note:</strong> Will be displayed in the footer! Not required!</p>
                    </div>

                    <div class="form-group">
                        <label for="text">Contact, Phone Number: </label>
                        <input type="text" class="form-control" name="phonenumber" placeholder="Enter Contact Phone Number">
                    </div>
                    <div class="form-group">
                        <label for="email">Contact, Email:</label>
                        <input type="email" class="form-control" name="site_email" placeholder="Enter Contact email">
                    </div>

                    <hr class="medium">

                    <h2>Social Media Links</h2>
                    <div class="alert alert-info">
                        <p><strong>Note:</strong> Will be displayed in the footer! Not required!</p>
                    </div>

                    <div class="form-group">
                        <label for="text">Facebook link:</label>
                        <input type="text" class="form-control" name="site_facebook" placeholder="Enter Facebook Link">
                    </div>
                    <div class="form-group">
                        <label for="text">Twitter link:</label>
                        <input type="text" class="form-control" name="site_twitter" placeholder="Enter Twitter Link">
                    </div>
                    <div class="form-group">
                        <label for="text">Github link:</label>
                        <input type="text" class="form-control" name="site_github" placeholder="Enter Github Link">
                    </div>
                    <div class="form-group">
                        <label for="text">CodePen link:</label>
                        <input type="text" class="form-control" name="site_codepen" placeholder="Enter CodePen Link">
                    </div>
                    <div class="form-group">
                        <label for="text">Google Plus link:</label>
                        <input type="text" class="form-control" name="site_googleplus" placeholder="Enter Google Plus Link">
                    </div>

                    <hr class="medium">

                    <h2>Install</h2>
                    <div class="alert alert-danger">
                        <p><strong>Note:</strong> After the settings are checked and the installation is set up you will be forwarded to the login page of the Admin Area</p>
                    </div>

                    <button type="submit" class="btn btn-default btn-green">Install</button>

                    <hr class="medium">
                </form>
            </div>
        </div>

    </body>
</html>

