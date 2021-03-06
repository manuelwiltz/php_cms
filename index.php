<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/Menu.css" rel="stylesheet" type="text/css"/>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>

        <?php
        include './admin/functions.php';
        ?>

        <?php
        $statement = "SELECT * FROM pages;";

        if (isset($_GET['id'])) {
            $title = cms_getSubPageTitle($_GET['id']);
            $description = cms_getWebsiteDescription($_GET['id']);
            $autohor = cms_getWebsiteTitle();
            $keywords = cms_getWebsiteKeywords($_GET['id']);

            $statement = "SELECT * FROM pages where id = " . $_GET['id'] . ";";

            if ($_res = $conn->query($statement)) {
                if ($_res->num_rows > 0) {
                    while ($row = $_res->fetch_assoc()) {
                        $page_id = $row['ID'];
                        $name = $row['PageName'];
                        $pageContent = $row['PageContent'];
                    }

                } else {
                    $pageContent = '<p>Diese Seite beinhaltet keinen Content</p>';
                }
            }
        } else {
            if ($_res = $conn->query($statement)) {
                if ($_res->num_rows > 0) {
                    while ($row = $_res->fetch_assoc()) {

                        $page_id = $row['ID'];
                        $name = $row['PageName'];
                        $pageContent = $row['PageContent'];
                        break;
                    }

                    $title = cms_getSubPageTitle($page_id);
                    $description = cms_getWebsiteDescription($page_id);
                    $autohor = cms_getWebsiteTitle();
                    $keywords = cms_getWebsiteKeywords($page_id);
                } else {
                    $pageContent = '<p>Diese Seite beinhaltet keinen Content</p>';
                    $title = "Title";
                    $description = "No description available.";
                    $autohor = "No title available.";
                    $keywords = "No keywords available.";
                }
            }
        }

        cms_addNewView($title);
        ?>

        <title><?php echo $title; ?></title>
        <meta name="description" content="<?php echo $description; ?>">
        <meta name="author" content="<?php echo $autohor; ?>">
        <meta name="keywords" content="<?php echo $keywords; ?>">
        <meta property="og:type" content="website" />
        <meta property="og:title" content="<?php echo $title; ?>" />
        <meta property="og:description" content="<?php echo $description; ?>" />
    </head>
    <body>

        <div class="container">

            <div class="jumbotron" style="border-radius: 0; margin-bottom: 0;">
                <h2 class="text-center"><?php echo cms_getWebsiteTitle(); ?></h2>
            </div>

            <?php
            include './menu.php';
            ?>

            <div id="content">

                <?php
                echo "<h2>" . $name . "</h2>";
                echo $pageContent;
                ?>

            </div>

            <?php
            include './footer.php';
            ?>
