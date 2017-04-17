<?php
session_start();

if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
}

include './header.php';
include './menu.php';
?>

<div id="content">

    <h2>Edit Page</h2>

    <?php
    if ((isset($_POST['pageContent']) && $_POST['pageContent'] != "") || (isset($_POST['keywords']) && $_POST['keywords'] != "") || (isset($_POST['metaDescription']) && $_POST['metaDescription'] != "")) {
        $statement = "UPDATE pages SET PageContent = '" . $_POST['pageContent'] . "', Keywords = '" . $_POST['keywords'] . "', MetaDescription = '" . $_POST['metaDescription'] . "' WHERE pages.ID = " . $_GET['id'];
    }


    if ($_res = $conn->query($statement)) {
        echo 'SUCCESS';
    } else {
        echo 'FAILURE';
        echo $conn->error;
    }

    $statement = "SELECT * FROM pages where id = " . $_GET['id'] . ";";

    if ($_res = $conn->query($statement)) {

        if ($_res->num_rows > 0) {

            while ($row = $_res->fetch_assoc()) {
                $page_id = $row['ID'];
                $name = $row['PageName'];
                $pageContent = $row['PageContent'];
                $keywords = $row['Keywords'];
                $metaDescription = $row['MetaDescription'];
            }
        } else {
            $page_id = "no content available";
            $name = "no content available";
            $pageContent = "no content available";
            $keywords = "no content available";
            $metaDescription = "no content available";
        }
    }
    ?>

    <form id="form1" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">

        <div class="form-group">
            <label for="comment">Page Content:</label>
            <textarea class="form-control" name="pageContent" rows="10" id="comment"><?php echo trim($pageContent); ?></textarea>
        </div>

        <div class="form-group">
            <label for="comment">Keywords (max. 255 chars):</label>
            <textarea class="form-control" name="keywords" rows="5" id="comment"><?php echo trim($keywords); ?></textarea>
        </div>

        <div class="form-group">
            <label for="comment">Meta Description (max. 400 chars):</label>
            <textarea class="form-control" name="metaDescription" rows="5" id="comment"><?php echo trim($metaDescription); ?></textarea>
        </div>

        <button id="update">Update Page</button>

    </form>

</div>

<?php
include './footer.php';
?>
