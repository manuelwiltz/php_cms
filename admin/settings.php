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

                                        <?php
                                        if (isset($_POST['submit'])) {
                                            $site_name = $conn->real_escape_string(htmlspecialchars(stripcslashes(trim($_POST['site_name']))));
                                            
                                            $phonenumber = $conn->real_escape_string(htmlspecialchars(stripcslashes(trim($_POST['phonenumber']))));
                                            $site_email = $conn->real_escape_string(htmlspecialchars(stripcslashes(trim($_POST['site_email']))));
                                            
                                            $site_facebook = $conn->real_escape_string(htmlspecialchars(stripcslashes(trim($_POST['site_facebook']))));
                                            $site_twitter = $conn->real_escape_string(htmlspecialchars(stripcslashes(trim($_POST['site_twitter']))));
                                            $site_github = $conn->real_escape_string(htmlspecialchars(stripcslashes(trim($_POST['site_github']))));
                                            $site_codepen = $conn->real_escape_string(htmlspecialchars(stripcslashes(trim($_POST['site_codepen']))));
                                            $site_googleplus = $conn->real_escape_string(htmlspecialchars(stripcslashes(trim($_POST['site_googleplus']))));
                                            
                                            $statement = "UPDATE site_info SET sitename = '', site_phonenumber = '', site_email = '', link_facebook = '', link_twitter = '', link_github = '', link_codepen = '', link_googleplus = '' WHERE `site_info`.`sitename` = 'Goats'";
                                            
                                            if ($res = $conn->query($statement)) {
                                                //header("Location: admin.php");
                                                echo '<script>location.replace("settings.php");</script>';
                                            }
                                        }
                                        ?>

                                        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                                        <?php
                                        $statement = "SELECT * FROM site_info;";

                                        if ($_res = $conn->query($statement)) {
                                            if ($_res->num_rows > 0) {
                                                $row = $_res->fetch_assoc();
                                                $sitename = $row['sitename'];
                                                $site_phonenumber = $row['site_phonenumber'];
                                                $site_email = $row['site_email'];
                                                $link_facebook = $row['link_facebook'];
                                                $link_twitter = $row['link_twitter'];
                                                $link_github = $row['link_github'];
                                                $link_codepen = $row['link_codepen'];
                                                $link_googleplus = $row['link_googleplus'];
                                            }
                                        }
                                        ?>

                                            <h3>Website title</h3>

                                            <div class="form-group">
                                                <p class="bold">Website title: </p>
                                                <input id="cms_setWebsiteTitle-value" class="form-control" type="text" value="<?php echo cms_getWebsiteTitle() ?>">
                                            </div>

                                            <hr class="medium">

                                            <h3>Contact information</h3>

                                            <div class="form-group">
                                                <label for="text">Phonenumber:</label>
                                                <input type="text" class="form-control" id="" name="phonenumber" <?php echo strlen($site_phonenumber) > 0 ? "value='$site_phonenumber'" : "placeholder='Enter Phonenumber'"; ?>>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email:</label>
                                                <input type="email" class="form-control" id="email" name="email" <?php echo strlen($site_email) > 0 ? "value='$site_email'" : "placeholder='Enter E-Mail'"; ?>>
                                            </div>

                                            <hr class="medium">

                                            <h3>Social media links</h3>

                                            <div class="form-group">
                                                <label for="text">Facebook:</label>
                                                <input type="text" class="form-control" id="facebook" name="facebook" <?php echo strlen($link_facebook) > 0 ? "value='$link_facebook'" : "placeholder='Enter Facebook link'"; ?>>
                                            </div>
                                            <div class="form-group">
                                                <label for="text">Twitter:</label>
                                                <input type="text" class="form-control" id="twitter" name="twitter" <?php echo strlen($link_twitter) > 0 ? "value='$link_twitter'" : "placeholder='Enter Twitter link'"; ?>>
                                            </div>
                                            <div class="form-group">
                                                <label for="text">Github:</label>
                                                <input type="text" class="form-control" id="github" name="github" <?php echo strlen($link_github) > 0 ? "value='$link_github'" : "placeholder='Enter Github link'"; ?>>
                                            </div>
                                            <div class="form-group">
                                                <label for="text">CodePen:</label>
                                                <input type="text" class="form-control" id="codepen" name="codepen" <?php echo strlen($link_codepen) > 0 ? "value='$link_codepen'" : "placeholder='Enter CodePen link'"; ?>>
                                            </div>
                                            <div class="form-group">
                                                <label for="text">GooglePlus:</label>
                                                <input type="text" class="form-control" id="googleplus" name="googleplus" <?php echo strlen($link_googleplus) > 0 ? "value='$link_googleplus'" : "placeholder='Enter Google Plus link'"; ?>>
                                            </div>

                                            <input id="cms_setWebsiteTitle-btn" name="submit" type="submit" value="Submit" class="btn btn-default btn-green margin-top-sm">

                                        </form>

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

        <!--<script>
            document.getElementById("cms_setWebsiteTitle-btn").addEventListener("click", function () {
                var sendData = {};
                sendData["cms_setWebsiteTitle"] = document.getElementById("cms_setWebsiteTitle-value").value;
                $.post("functions.php", sendData, receiveDataFromPHP);
            });

            function receiveDataFromPHP(data, status) {
                location.reload();
            }
        </script>-->
    </body>
</html>
