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
        <title>Admin | Themes</title>
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

                                <div class="row">
                                    <div class="col-md-12 padding-sm">
                                        <h3>Hello, <?php echo $username; ?></h3>
                                    </div>
                                </div>

                                <hr class="medium">

                                <?php
                                $statement = "SELECT * FROM users where username=" . $username . ";";

                                if ($res = $conn->query($statement)) {
                                    if ($res->row_nums = 1) {
                                        $row = $res->fetch_assoc();
                                        $firstname = $row['firstname'];
                                        $lastname = $row['lastname'];
                                        $username = $row['username'];
                                        $email = $row['email'];
                                        $password = $row['password'];
                                    }
                                } else {
                                    $row = $res->fetch_assoc();
                                    $firstname = "";
                                    $lastname = "";
                                    $username = "";
                                    $email = "";
                                    $password = "";
                                }
                                ?>

                                <div class="row padding-md">
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
                                        <div class="form-group">
                                            <label for="pwd">Password:</label>
                                            <input type="password" class="form-control" name="password1" >
                                        </div>
                                        <div class="form-group">
                                            <label for="pwd">Repeat password:</label>
                                            <input type="password" class="form-control" name="password2" >
                                        </div>
                                        <button type="submit" class="btn btn-default btn-green">Update Profile</button>
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
