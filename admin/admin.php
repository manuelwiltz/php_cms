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
        <title>Admin | Dashboard</title>
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
                        <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard <small>Manage Your Site</small></h1>
                    </div>

                </div>
            </div>
        </header>

        <section id="breadcrumb">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="active">Dashboard</li>
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
                                <h3 class="panel-title">Website Overview</h3>
                            </div>
                            <div class="panel-body">
                                <div class="col-md-4">
                                    <div class="well dash-box">
                                        <h2><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?php echo cms_getCountUsers() ?></h2>
                                        <h4>Users</h4>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="well dash-box">
                                        <h2><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> <?php echo cms_getCountSites() ?></h2>
                                        <h4>Pages</h4>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="well dash-box">
                                        <h2><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> <?php echo cms_getVisitors(); ?></h2>
                                        <h4>Hits</h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Latest Sites</h3>
                            </div>
                            <div class="panel-body">
                                <table class="table table-striped table-hover">
                                    <tr>
                                        <th>Title</th>
                                        <th>Published</th>
                                        <th>Created</th>
                                        <th></th>
                                    </tr>

                                    <?php
                                    $statement = "SELECT * FROM pages ORDER BY Timestamp DESC LIMIT 2";

                                    if ($res = $conn->query($statement)) {
                                        if ($res->num_rows > 0) {
                                            while ($row = $res->fetch_assoc()) {
                                                $id = $row['ID'];
                                                $name = $row['PageName'];
                                                $created = $row['Timestamp'];

                                                echo '<tr>';
                                                echo '<td>' . $name . '</td>';
                                                echo '<td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>';
                                                echo '<td>' . $created . '</td>';
                                                echo '<td><a class="btn btn-default" href="edit.php?id=' . $id . '">Edit</a> <a class="btn btn-default btn-green" href="../SubPage.php?id=' . $id . '">View</a> <a class="btn btn-danger" href="delete_page.php?id=' . $id . '">Delete</a></td></td>';
                                                echo '</tr>';
                                            }
                                        }
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Newest User</h3>
                            </div>
                            <div class="panel-body">
                                <table class="table table-striped table-hover">
                                    <tr>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Joined</th>
                                        <th></th>
                                    </tr>
                                    <?php
                                    $statement = "SELECT * FROM users ORDER BY create_date DESC LIMIT 1";

                                    if ($res = $conn->query($statement)) {
                                        if ($res->num_rows > 0) {
                                            while ($row = $res->fetch_assoc()) {

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
            </div>
        </section>

        <?php
        include './admin_footer.php';
        ?>

    </body>
</html>
