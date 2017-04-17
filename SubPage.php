<?php
session_start();

include './header.php';
include './menu.php';
?>

<div id="content">

    <?php
    $statement = "SELECT * FROM pages where id = " . $_GET['id'] . ";";

    if ($_res = $conn->query($statement)) {

        if ($_res->num_rows > 0) {

            while ($row = $_res->fetch_assoc()) {

                $page_id = $row['ID'];
                $name = $row['PageName'];
                $pageContent = $row['PageContent'];
            }

            echo "<h2>" . $name . "</h2>";
            echo $pageContent;
        } else {
            echo '<p>Diese Seite beinhaltet keinen Content</p>';
        }
    }
    ?>

</div>

<?php
include './footer.php';
?>

