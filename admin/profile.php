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
        <title>Admin | Profile</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="style.css" rel="stylesheet">
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
                        <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Profile<small> Manage your profile</small></h1>
                    </div>
                </div>
            </div>
        </header>

        <section id="breadcrumb">
            <div class="container">
                <ol class="breadcrumb">
                    <li><a href="admin.php">Dashboard</a></li>
                    <li class="active">Profile</li>
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
                                <h3 class="panel-title">Profile</h3>
                            </div>
                            <div class="panel-body">

                                <?php
                                $statement = "SELECT * FROM users where username = '" . $username . "';";

                                if ($res = $conn->query($statement)) {
                                    if ($res->num_rows > 0) {
                                        $row = $res->fetch_assoc();

                                        $firstname = $row['firstname'];
                                        $lastname = $row['lastname'];
                                        $username = $row['username'];
                                        $email = $row['email'];
                                        $password = $row['password'];
                                        $joined = $row['create_date'];
                                    }
                                } else {
                                    $firstname = "";
                                    $lastname = "";
                                    $username = "";
                                    $email = "";
                                    $password = "";
                                    $joined = "Unknown";
                                }
                                ?>

                                <div class="row">
                                    <div class="col-md-12 padding-md">
                                        <h3>Hello, <?php echo $username; ?></h3>
                                        <p class="small" style="color: #777">You joined:  <?php echo $joined; ?></p>
                                    </div>
                                </div>

                                <hr class="medium">

                                <div class="row padding-left-right-md">
                                    <div class="alert alert-info">
                                        <strong>Info!</strong> If you change your username or password you are going to be forwarded to the login page.
                                    </div>
                                </div>

                                <hr class="medium">

                                <div class="row padding-md">
                                    <h4 class="bold">Change your profile data:</h4>

                                    <?php
                                    if (isset($_POST['updateBtn']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['username']) && isset($_POST['email'])) {

                                        $errors = [];

                                        $firstname = $conn->real_escape_string(htmlspecialchars(stripcslashes(trim($_POST['firstname']))));
                                        $lastname = $conn->real_escape_string(htmlspecialchars(stripcslashes(trim($_POST['lastname']))));
                                        $usernameNew = $conn->real_escape_string(htmlspecialchars(stripcslashes(trim($_POST['username']))));
                                        $email = $conn->real_escape_string(htmlspecialchars(stripcslashes(trim($_POST['email']))));

                                        if (count($errors) == 0) {

                                            if ($username !== $usernameNew) {
                                                $statement = "UPDATE users SET firstname = '$firstname', lastname = '$lastname', username = '$usernameNew', email = '$email' WHERE username='" . $username . "'";
                                                if ($result = $conn->query($statement)) {
                                                    echo '<script>location.replace("login.php");</script>';
                                                }
                                            } else {
                                                $statement = "UPDATE users SET firstname = '$firstname', lastname = '$lastname', email = '$email' WHERE username='" . $username . "'";
                                                if ($result = $conn->query($statement)) {
                                                    echo '<p class="bold" style="color: #2ecc71;">SUCCESS - changes successfully applied</p>';
                                                }
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

                                    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                                        <div class="form-group">
                                            <label for="text">Firstname:</label>
                                            <input type="text" class="form-control" name="firstname" value="<?php echo $firstname; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="text">Lastname:</label>
                                            <input type="text" class="form-control" name="lastname" value="<?php echo $lastname; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="text">Username:</label>
                                            <input type="text" class="form-control" name="username" value="<?php echo $username; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email:</label>
                                            <input type="email" class="form-control" name="email" value="<?php echo $email; ?>">
                                        </div>
                                        <button type="submit" name="updateBtn" class="btn btn-default btn-green">Update Profile</button>
                                    </form>
                                </div>

                                <hr class="medium">

                                <div class="row padding-md">
                                    <h4 class="bold">Change your password:</h4>

                                    <?php
                                    if (isset($_POST['changePwBtn']) && isset($_POST['passwordOld']) && isset($_POST['passwordNew1']) && isset($_POST['passwordNew2'])) {

                                        $errors = [];

                                        $passwordOld = md5($conn->real_escape_string(htmlspecialchars(stripcslashes(trim($_POST['passwordOld'])))));
                                        $passwordNew1 = md5($conn->real_escape_string(htmlspecialchars(stripcslashes(trim($_POST['passwordNew1'])))));
                                        $passwordNew2 = md5($conn->real_escape_string(htmlspecialchars(stripcslashes(trim($_POST['passwordNew2'])))));

                                        $statement = "SELECT * FROM users where username = '" . $username . "';";
                                        if ($result = $conn->query($statement)) {
                                            if ($result->num_rows == 1) {

                                                if (!(($passwordNew1 === $passwordNew2) && ($passwordOld === $password))) {
                                                    array_push($errors, 'New passwords or old do not match! Please cheack your input!');
                                                }
                                            }
                                        }

                                        if (count($errors) == 0) {
                                            $statement = "UPDATE users SET password = '" . $passwordNew1 . "' WHERE username = '" . $username . "';";

                                            if ($result = $conn->query($statement)) {
                                                header("Location: login.php");
                                            }
                                        } else {
                                            echo '<div class="row padding-md">';
                                            foreach ($errors as $value) {
                                                echo '<p class="bold" style="color: red;">' . $value . '</p>';
                                                unset($_POST['passwordOld']);
                                                unset($_POST['passwordNew1']);
                                                unset($_POST['passwordNew2']);
                                            }
                                            echo '</div>';
                                        }
                                    }
                                    ?>

                                    <div class="row" id="passwordChange">

                                    </div>

                                    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                                        <div class="form-group">
                                            <label for="pwd">Old password:</label>
                                            <input type="password" class="form-control" name="passwordOld" placeholder="Enter old password">
                                        </div>
                                        <div class="form-group">
                                            <label for="pwd">New password:</label>
                                            <input type="password" class="form-control" name="passwordNew1" placeholder="Enter new password">
                                        </div>
                                        <div class="form-group">
                                            <label for="pwd">Repeat new password:</label>
                                            <input type="password" class="form-control" name="passwordNew2" placeholder="Repeat new password">
                                        </div>
                                        <button type="submit" name="changePwBtn" class="btn btn-default btn-green">Change Password</button>
                                    </form>
                                </div>

                                <br>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <?php
        include './admin_footer.php';
        ?>
    </body>
</html>
