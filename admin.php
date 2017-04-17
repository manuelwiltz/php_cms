<?php
session_start();

if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
}

include './header.php';
include './menu.php';
?>

<div id="content" class="text-center padding-sm">

    <form class="form-inline" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
        <div class="form-group">
            <label for="text">Page name:</label>
            <input type="text" class="form-control" name="newPageName">
        </div>
        <button type="submit" class="btn btn-default">Add Page</button>
    </form>

    <div class="padding-sm margin-top-lg">
        <?php
        if (isset($_POST['newPageName'])) {

            $statement = "INSERT INTO `pages` (`ID`, `PageName`, `PageContent`, `Keywords`, `MetaDescription`, `Timestamp`) VALUES (NULL, '" . $_POST['newPageName'] . "', NULL, NULL, NULL, CURRENT_TIMESTAMP)";

            if ($_res = $conn->query($statement)) {
                echo 'Seite erfolgreich hinzugefügt.';
                header("Location: admin.php");
                exit;
            } else {
                echo 'Error: ';
                echo $conn->error;
            }
        }
        ?>

        <?php
        $statement = "SELECT * FROM pages;";

        if ($_res = $conn->query($statement)) {

            if ($_res->num_rows > 0) {

                while ($row = $_res->fetch_assoc()) {

                    echo '<div class="well">';

                    $page_id = $row['ID'];
                    $name = $row['PageName'];
                    #$pageContent = $row['PageContent'];

                    echo "<p><a href='SubPage.php?id=" . $page_id . "'>" . $name . "</a></p>";

                    echo "<p>";
                    echo "<a href='EditPage.php?id=" . $page_id . "'> Edit Page </a>";
                    echo ' - ';
                    echo "<a href='DeletePage.php?id=" . $page_id . "'> Delete Page </a>";
                    echo '</p>';

                    echo '</div>';
                }
            } else {
                echo '<p>Keine Seiten vorhanden</p>';
            }
        }
        ?>

    </div>


</div>

<?php
include './footer.php';
?>
