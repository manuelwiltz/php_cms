<?php
session_start();

if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin | Users</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="style.css" rel="stylesheet">
        <script src="http://cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>
    </head>
    <body>

        <?php
        include './admin_menu.php';
        include './functions.php';
        ?>

        <header id="header">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Users<small> Manage Site Users</small></h1>
                    </div>
                </div>
            </div>
        </header>

        <section id="breadcrumb">
            <div class="container">
                <ol class="breadcrumb">
                    <li><a href="admin.php">Dashboard</a></li>
                    <li class="active">Users</li>
                </ol>
            </div>
        </section>

        <section id="main">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <?php
                        include './admin_side_widgets.php';
                        ?>
                    </div>
                    <div class="col-md-9">
                        <div class="panel panel-default">
                            <div class="panel-heading main-color-bg">
                                <h3 class="panel-title">Users</h3>
                            </div>
                            <div class="panel-body">

                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="bold">Search username: </p>
                                        <input id="cms_searchUser-value" class="form-control" type="text" placeholder="Username to look for...">
                                        <input id="cms_searchUser-btn" type="submit" value="Search user" class="btn btn-default btn-green margin-top-sm margin-bottom-sm">
                                    </div>
                                    <div id="search-output" class="col-md-12">

                                    </div>
                                </div>

                                <hr class="medium">

                                <p class="bold">All users: </p>
                                <table class="table table-striped table-hover">
                                    <tr>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Joined</th>
                                        <th></th>
                                    </tr>

                                    <?php
                                    $statement = "SELECT * FROM users ORDER BY create_date DESC";

                                    if ($res = $conn->query($statement)) {

                                        if ($res->num_rows > 0) {

                                            while ($row = $res->fetch_assoc()) {

                                                $id = $row['id'];
                                                $name = $row['firstname'] . " " . $row['lastname'];
                                                $username = $row['username'];
                                                $email = $row['email'];
                                                $joined = $row['create_date'];

                                                echo '<tr>';
                                                echo '<td>' . $name . '</td>';
                                                echo '<td>' . $username . '</td>';
                                                echo '<td>' . $email . '</td>';
                                                echo '<td>' . $joined . '</td>';
                                                echo '<td><a class="btn btn-default" href="profile.php?id=' . $id . '">Edit</a> <a class="btn btn-danger" href="delete_user.php?id=' . $id . '">Delete</a></td>';
                                                echo '</tr>';
                                            }
                                        }
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-9">
                        <div class="panel panel-default">
                            <div class="panel-heading main-color-bg">
                                <h3 class="panel-title">Users</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row padding-md">
                                    <p class="bold">Add new user</p>
                                    <p>Fill in the form to register a new user</p>
                                    <hr class="medium">
                                </div>


                                <?php
                                if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password1']) && isset($_POST['password2'])) {

                                    $errors = [];

                                    $firstname = $conn->real_escape_string(htmlspecialchars(stripcslashes(trim($_POST['firstname']))));
                                    $lastname = $conn->real_escape_string(htmlspecialchars(stripcslashes(trim($_POST['lastname']))));

                                    $username = $conn->real_escape_string(htmlspecialchars(stripcslashes(trim($_POST['username']))));
                                    $email = $conn->real_escape_string(htmlspecialchars(stripcslashes(trim($_POST['email']))));

                                    $password1 = md5($conn->real_escape_string(htmlspecialchars(stripcslashes(trim($_POST['password1'])))));
                                    $password2 = md5($conn->real_escape_string(htmlspecialchars(stripcslashes(trim($_POST['password2'])))));

                                    $statement = "SELECT * FROM users where username = '" . $username . "';";
                                    if ($result = $conn->query($statement)) {
                                        if ($result->num_rows > 0) {
                                            array_push($errors, "Username is allready taken!");
                                        }
                                    }

                                    if (!($password1 === $password2)) {
                                        array_push($errors, 'Email or passwords do not match!');
                                    } else if ((strpos($email, "@") == FALSE) || (strpos($email, ".") == FALSE)) {
                                        array_push($errors, 'Email or passwords do not match!');
                                    }

                                    if (count($errors) == 0) {
                                        $statement = "INSERT INTO users (id, firstname, lastname, username, email, password, create_date) VALUES (NULL, '" . $firstname . "', '" . $lastname . "', '" . $username . "', '" . $email . "', '" . $password1 . "', CURRENT_TIMESTAMP);";

                                        if ($result = $conn->query($statement)) {
                                            echo '<script>window.location.replace("users.php");</script>';
                                        }
                                    } else {
                                        echo '<div class="row padding-md">';
                                        foreach ($errors as $value) {
                                            echo '<p class="bold" style="color: red;">' . $value . '</p>';
                                        }
                                        echo '</div>';
                                    }
                                }
                                ?>

                                <div class="row padding-md">
                                    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
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
                                        <button type="submit" class="btn btn-default btn-green">Register user</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </section>

        <?php
        include './admin_footer.php';
        ?>

        <script>
            document.getElementById("cms_searchUser-btn").addEventListener("click", function () {
                var sendData = {};
                sendData["cms_searchUser"] = document.getElementById("cms_searchUser-value").value;
                $.post("functions.php", sendData, receiveDataFromPHP);
            });

            function receiveDataFromPHP(data, status) {
                document.getElementById("search-output").innerHTML = data;
            }
        </script>

    </body>
</html>
