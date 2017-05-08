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
        <title>Admin | Settings</title>
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
                        <div class="panel panel-default">
                            <div class="panel-heading main-color-bg">
                                <h3 class="panel-title">Settings</h3>
                            </div>
                            <div class="panel-body">

                                <div class="row">
                                    <div class="col-md-12 padding-sm">
                                        <div class="form-group">
                                            <p class="bold">Website title: </p>
                                            <input id="cms_setWebsiteTitle-value" class="form-control" type="text" value="<?php echo cms_getWebsiteTitle() ?>">
                                        </div>
                                        
                                        <hr class="medium">
                                        
                                        <div class="form-group">
                                            <label for="text">Phonenumber:</label>
                                            <input type="text" class="form-control" id="" name="phonenumber" placeholder="Enter Phonenumber">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email:</label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                                        </div>
                                        
                                        <hr class="medium">
                                        
                                        <div class="form-group">
                                            <label for="text">Facebook:</label>
                                            <input type="text" class="form-control" id="facebook" name="facebook" placeholder="Enter Facebook link">
                                        </div>
                                        <div class="form-group">
                                            <label for="text">Twitter:</label>
                                            <input type="text" class="form-control" id="twitter" name="twitter" placeholder="Enter Twitter link">
                                        </div>
                                        <div class="form-group">
                                            <label for="text">Github:</label>
                                            <input type="text" class="form-control" id="github" name="github" placeholder="Enter Github link">
                                        </div>
                                        <div class="form-group">
                                            <label for="text">CodePen:</label>
                                            <input type="text" class="form-control" id="codepen" name="codepen" placeholder="Enter CodePen link">
                                        </div>
                                        <div class="form-group">
                                            <label for="text">GooglePlus:</label>
                                            <input type="text" class="form-control" id="googleplus" name="googleplus" placeholder="Enter GooglePlus link">
                                        </div>
                                        
                                        <input id="cms_setWebsiteTitle-btn" type="submit" value="Submit" class="btn btn-default btn-green margin-top-sm">
                                    </div>
                                </div>

                                <hr class="medium">

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

        <script>
            document.getElementById("cms_setWebsiteTitle-btn").addEventListener("click", function () {
                var sendData = {};
                sendData["cms_setWebsiteTitle"] = document.getElementById("cms_setWebsiteTitle-value").value;
                $.post("functions.php", sendData, receiveDataFromPHP);
            });

            function receiveDataFromPHP(data, status) {
                location.reload();
            }
        </script>
    </body>
</html>
