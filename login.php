<?php
session_start();

include './DB_connection.php';
include './menu.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/Layout.css" rel="stylesheet" type="text/css"/>
        <link href="css/Menu.css" rel="stylesheet" type="text/css"/>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <title>Login</title>
    </head>
    <body>

        <?php
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $errors = [];

            $username = $conn->real_escape_string(htmlspecialchars(stripcslashes(trim($_POST['username']))));
            $password = md5($conn->real_escape_string(htmlspecialchars(stripcslashes(trim($_POST['password'])))));

            $statement = "select * from users where username = '" . $username . "';";
            if ($res = $conn->query($statement)) {

                if ($res->num_rows > 0) {

                    $row = $res->fetch_assoc();

                    if (($row['username'] == $username) && ($row['password'] == $password)) {
                        $_SESSION['userid'] = $row['id'];
                       header("Location: AddPages.php");
                    } else {
                        array_push($errors, "<p>Login Daten stimmen nicht überein!</p>");
                    }
                } else {
                    array_push($errors, "<p>Login Daten stimmen nicht überein!</p>");
                }
            } else {
                array_push($errors, "<p>Es ist ein Fehler aufgetreten.</p>");
            }

            if (count($errors) > 0) {
                foreach ($errors as $value) {
                    echo '<h2 class="text-center" style="color: red;">' . $value . '</h2>';
                }
            }
        }
        ?>

        <div class="container">
            <h2>Login: </h2>
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="form-group">
                    <label for="text">Benutzername:</label>
                    <input type="text" class="form-control" name="username" placeholder="Benutzername eingeben">
                </div>
                <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input type="password" class="form-control" name="password" placeholder="Passwort eingeben">
                </div>
                <button type="submit" class="btn btn-default">Login</button>
            </form>
            <p class="padding-sm">No Account? <a href="register.php">Register yet!</a></p>
        </div>

    </body>
</html>
