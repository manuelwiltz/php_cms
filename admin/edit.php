<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin Area | Edit Page</title>
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
                        <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Edit Page<small>About</small></h1>
                    </div>
                </div>
            </div>
        </header>

        <section id="breadcrumb">
            <div class="container">
                <ol class="breadcrumb">
                    <li><a href="admin.php">Dashboard</a></li>
                    <li><a href="pages.php">Pages</a></li>
                    <li class="active">Edit Page</li>
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
                                <h3 class="panel-title">Edit Page</h3>
                            </div>
                            <div class="panel-body">
                                <form>
                                    <div class="form-group">
                                        <label>Page Title</label>
                                        <input type="text" class="form-control" placeholder="Page Title" value="About">
                                    </div>
                                    <div class="form-group">
                                        <label>Page Body</label>
                                        <textarea name="editor1" class="form-control" placeholder="Page Body">
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                        </textarea>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" checked> Published
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label>Meta Tags</label>
                                        <input type="text" class="form-control" placeholder="Add Some Tags..." value="tag1, tag2">
                                    </div>
                                    <div class="form-group">
                                        <label>Meta Description</label>
                                        <input type="text" class="form-control" placeholder="Add Meta Description..." value="  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et ">
                                    </div>
                                    <input type="submit" class="btn btn-default" value="Submit">
                                </form>
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
