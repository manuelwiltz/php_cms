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
        <title>Register</title>
    </head>
    <body>

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
                    array_push($errors, "<div><p>Username ist bereits vergeben!</p></div>");
                }
            }

            if (!($password1 === $password2)) {
                array_push($errors, '<div><p>Überprüfen Sie ob die Passwörter übereinstimmen!</p></div>');
            } else if ((strpos($email, "@") == FALSE) || (strpos($email, ".") == FALSE)) {
                array_push($errors, '<div><p>Überprüfen Sie ob die Email korrekt ist!</p></div>');
            }

            if (count($errors) == 0) {
                $statement = "INSERT INTO users (id, firstname, lastname, username, email, password, create_date) VALUES (NULL, '" . $firstname . "', '" . $lastname . "', '" . $username . "', '" . $email . "', '" . $password1 . "', CURRENT_TIMESTAMP);";

                if ($result = $conn->query($statement)) {
                    echo '<div><h2 class="text-center">Glückwunsch, Benutzer angelegt!</h2></div>';
                    header("Location: login.php");
                }
            } else {
                foreach ($errors as $value) {
                    echo '<h2 class="text-center" style="color: red;">' . $value . '</h2>';
                }
            }
        }
        ?>

        <div class="container">
            <h2>Registrieren: </h2>
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="form-group">
                    <label for="text">Vorname:</label>
                    <input type="text" class="form-control" name="firstname" placeholder="Vorname eingeben">
                </div>
                <div class="form-group">
                    <label for="text">Nachname:</label>
                    <input type="text" class="form-control" name="lastname" placeholder="Nachname eingeben">
                </div>
                <div class="form-group">
                    <label for="text">Benutzername:</label>
                    <input type="text" class="form-control" name="username" placeholder="Benutzername eingeben">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" name="email" placeholder="Email eingeben">
                </div>
                <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input type="password" class="form-control" name="password1" placeholder="Passwort eingeben">
                </div>
                <div class="form-group">
                    <label for="pwd">Password Wiederholen:</label>
                    <input type="password" class="form-control" name="password2" placeholder="Passwort erneut eingeben">
                </div>
                <button type="submit" class="btn btn-default">Registrieren</button>
            </form>
            <p class="padding-sm">Allready have an account? <a href="login.php">Login yet!</a></p>
        </div>

    </body>
</html>
