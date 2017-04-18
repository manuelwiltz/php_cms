<?php
session_start();

if (isset($_SESSION['userid'])) {
    unset($_SESSION['userid']);
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin | Login</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="style.css" rel="stylesheet">
        <script src="http://cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>
    </head>
    <body>

        <?php
        include './functions.php';
        ?>

        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="admin.php">Admin Panel</a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">

                </div>
            </div>
        </nav>

        <header id="header">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="text-center"> Login <small>into the admin area</small></h1>
                    </div>
                </div>
            </div>
        </header>

        <section id="main">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <form id="login" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" class="well">
                            <div class="form-group">
                                <label>Username</label>
                                <input name="username" type="text" class="form-control" placeholder="Enter username">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input name="password" type="password" class="form-control" placeholder="Password">
                            </div>
                            <button type="submit" class="btn btn-default btn-block">Login</button>
                        </form>
                    </div>
                </div>
                <div class="row">
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
                                    header("Location: admin.php");
                                } else {
                                    array_push($errors, "Incorrect username or password!");
                                }
                            } else {
                                array_push($errors, "Incorrect username or password!");
                            }
                        } else {
                            array_push($errors, "An error occured!");
                        }

                        if (count($errors) > 0) {
                            foreach ($errors as $value) {
                                echo '<p class="text-center" style="color: red; font-weight: bold;">' . $value . '</p>';
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </section>

        <?php
        include './admin_footer.php';
        ?>

        <script>
            CKEDITOR.replace('editor1');
        </script>

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    </body>
</html>
