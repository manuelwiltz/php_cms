<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin Area | Pages</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="style.css" rel="stylesheet">
        <script src="http://cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>
    </head>
    <body>

        <?php
        include './admin_menu.php';
        ?>

        <header id="header">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Pages<small> Manage Site Pages</small></h1>
                    </div>
                </div>
            </div>
        </header>

        <section id="breadcrumb">
            <div class="container">
                <ol class="breadcrumb">
                    <li><a href="admin.php">Dashboard</a></li>
                    <li class="active">Pages</li>
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
                                <h3 class="panel-title">Pages</h3>
                            </div>
                            <div class="panel-body">

                                <div class="row">
                                    <div class="col-md-12 padding-sm">
                                        <p class="bold">Add a new page to the site: </p>
                                        <input class="form-control" type="text" placeholder="Page name">
                                        <input type="submit" value="Create page" class="btn btn-default btn-green margin-top-sm">
                                    </div>
                                </div>

                                <hr class="medium">

                                <div class="row">
                                    <div class="col-md-12">
                                        <input class="form-control" type="text" placeholder="Filter Pages...">
                                    </div>
                                </div>
                                <br>
                                <table class="table table-striped table-hover">
                                    <tr>
                                        <th>Title</th>
                                        <th>Published</th>
                                        <th>Created</th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <td>Home</td>
                                        <td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                                        <td>Dec 12, 2016</td>
                                        <td><a class="btn btn-default" href="edit.php">Edit</a> <a class="btn btn-danger" href="#">Delete</a></td>
                                    </tr>
                                    <tr>
                                        <td>About</td>
                                        <td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                                        <td>Dec 13, 2016</td>
                                        <td><a class="btn btn-default" href="edit.php">Edit</a> <a class="btn btn-danger" href="#">Delete</a></td>
                                    </tr>
                                    <tr>
                                        <td>Services</td>
                                        <td><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></td>
                                        <td>Dec 13, 2016</td>
                                        <td><a class="btn btn-default" href="edit.php">Edit</a> <a class="btn btn-danger" href="#">Delete</a></td>
                                    </tr>
                                    <tr>
                                        <td>Contact</td>
                                        <td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                                        <td>Dec 14, 2016</td>
                                        <td><a class="btn btn-default" href="edit.php">Edit</a> <a class="btn btn-danger" href="#">Delete</a></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <footer id="footer">
            <p>Copyright AdminStrap, &copy; 2017</p>
        </footer>

        <script>
            CKEDITOR.replace('editor1');
        </script>

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    </body>
</html>
