<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin Area | Settings</title>
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
                        <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Settings<small> Change settings</small></h1>
                    </div>
                </div>
            </div>
        </header>

        <section id="breadcrumb">
            <div class="container">
                <ol class="breadcrumb">
                    <li><a href="admin.php">Dashboard</a></li>
                    <li class="active">Settings</li>
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
                                <h3 class="panel-title">Settings</h3>
                            </div>
                            <div class="panel-body">

                                <div class="row">
                                    <div class="col-md-12 padding-sm">
                                        <p class="bold">Website title: </p>
                                        <input class="form-control" type="text" placeholder="Enter new website title">
                                        <input type="submit" value="Change title" class="btn btn-default btn-green margin-top-sm">
                                    </div>
                                </div>

                                <hr class="medium">

                                <div class="row">
                                    <div class="col-md-12">
                                        <input class="form-control" type="text" placeholder="Filter Settings...">
                                    </div>
                                </div>
                                
                                <hr class="medium">
                                
                                <div class="row padding-md">
                                    <div class="col-md-12">
                                        <input type="submit" value="Save settings" class="btn btn-default btn-green margin-top-sm">
                                    </div>
                                </div>
                                
                                <br>
                                
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
