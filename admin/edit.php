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
        <title>Admin | Edit Page</title>
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
                        <div class="panel panel-default">
                            <div class="panel-heading main-color-bg">
                                <h3 class="panel-title">Edit Page</h3>
                            </div>
                            <div class="panel-body">

                                <?php
                                if ((isset($_POST['title']) && $_POST['title'] != "") || (isset($_POST['editor1']) && $_POST['editor1'] != "") || (isset($_POST['keywords']) && $_POST['keywords'] != "") || (isset($_POST['meta']) && $_POST['meta'] != "")) {

                                    $id = htmlspecialchars(stripcslashes(trim($_GET['id'])));
                                    $title = $conn->real_escape_string((stripcslashes(trim($_POST['title']))));
                                    $editor1 = $conn->real_escape_string((stripcslashes(trim($_POST['editor1']))));
                                    $keywords = $conn->real_escape_string((stripcslashes(trim($_POST['keywords']))));
                                    $meta = $conn->real_escape_string((stripcslashes(trim($_POST['meta']))));

                                    $statement = "UPDATE pages SET PageName = '" . $title . "', PageContent = '" . $editor1 . "', Keywords = '" . $keywords . "', MetaDescription = '" . $meta . "' WHERE pages.ID = " . $id;

                                    if ($_res = $conn->query($statement)) {
                                        echo '<p class="bold" style="color: #2ecc71;">SUCCESS - changes successfully applied</p>';
                                    } else {
                                        echo '<p class="bold" style="color: red;">FAILURE - changes NOT applied</p>';
                                        echo $conn->error;
                                    }
                                }




                                $id = htmlspecialchars(stripcslashes(trim($_GET['id'])));

                                $statement = "SELECT * FROM pages WHERE pages.id = " . $id;

                                if ($res = $conn->query($statement)) {
                                    if ($res->num_rows > 0) {
                                        $row = $res->fetch_assoc();

                                        $title = $row['PageName'];
                                        $content = $row['PageContent'];
                                        $keywords = $row['Keywords'];
                                        $meta = $row['MetaDescription'];
                                    }
                                } else {
                                    $title = "";
                                    $content = "";
                                    $keywords = "";
                                    $meta = "";
                                }
                                ?>

                                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                                    <div class="form-group">
                                        <label>Page Title</label>
                                        <input name="title" type="text" class="form-control" placeholder="Page Title" value="<?php echo $title ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Page Body</label>
                                        <textarea name="editor1" class="form-control" placeholder="Page Body">
                                            <?php echo $content; ?>
                                        </textarea>
                                    </div>
                                    <!--
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" checked> Published
                                        </label>
                                    </div>
                                    -->
                                    <div class="form-group">
                                        <label>Meta Tags (key1, key2, ...)</label>
                                        <input name="keywords" type="text" class="form-control" placeholder="Add Some Tags..." value="<?php echo $keywords; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Meta Description</label>
                                        <input type="text" class="form-control" placeholder="Add Meta Description..." value="<?php echo $meta; ?>">
                                    </div>
                                    <input name="meta" type="submit" class="btn btn-default btn-green" value="Submit">
                                </form>
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
