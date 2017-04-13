<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/Layout.css" rel="stylesheet" type="text/css"/>
        <link href="css/Menu.css" rel="stylesheet" type="text/css"/>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <title></title>
    </head>
    <body>

        <div class="container">

            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#">WebSiteName</a>
                    </div>
                    <ul class="nav navbar-nav">

                        <!-- Menü ausgeben, aus der DB in Form von: <li></li> -->

                        <?php
                        include './DB_connection.php';

                        $statement = "SELECT * FROM pages;";

                        if ($_res = $conn->query($statement)) {

                            if ($_res->num_rows > 0) {

                                while ($row = $_res->fetch_assoc()) {

                                    $page_id = $row['ID'];
                                    $name = $row['PageName'];
                                    #$pageContent = $row['PageContent'];

                                    echo "<li><a href='SubPage.php?id=" . $page_id . "'>" . $name . "</a></li>";
                                }
                            } else {
                                echo '<p>Keine Menüpunkte</p>';
                            }
                        }
                        ?>


                    </ul>
                </div>
            </nav>



