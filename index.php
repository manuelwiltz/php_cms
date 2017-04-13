<?php
include './header.php';
?>

<div id="content">

    <?php
    $statement = "SELECT * FROM pages where id = 1;";

    if ($_res = $conn->query($statement)) {

        if ($_res->num_rows > 0) {

            while ($row = $_res->fetch_assoc()) {

                $page_id = $row['ID'];
                $name = $row['PageName'];
                $pageContent = $row['PageContent'];

                echo $pageContent;
            }
        } else {
            echo '<p>Diese Seite beinhaltet keinen Content</p>';
        }
    }
    ?>

</div>

<?php
include './footer.php';
?>
