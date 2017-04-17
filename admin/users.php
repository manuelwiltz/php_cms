<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin Area | Users</title>
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
                        <!-- Website Overview -->
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
                                    $statement = "SELECT * FROM users";

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
                                                echo '<td><a class="btn btn-default" href="edit.php">Edit</a> <a class="btn btn-danger" href="#">Delete</a></td>';
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

        <script>
            document.getElementById("cms_searchUser-btn").addEventListener("click", function () {
                var sendData = {};
                sendData["cms_searchUser"] = document.getElementById("cms_searchUser-value").value;
                $.post("functions.php", sendData, receiveDataFromPHP);
            });

            function receiveDataFromPHP(data, status) {
                console.log(data);
                document.getElementById("search-output").innerHTML = data;
            }
        </script>

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    </body>
</html>
