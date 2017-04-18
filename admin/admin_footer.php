<footer id="footer">
    <p>Copyright <?php echo cms_getWebsiteTitle() . " &copy; " . date("Y") ?></p>

    <?php
    $statement = "SELECT * FROM pages;";
    if ($_res = $conn->query($statement)) {
        if ($_res->num_rows > 0) {

            while ($row = $_res->fetch_assoc()) {
                $page_id = $row['ID'];
                $name = $row['PageName'];
                $pageContent = $row['PageContent'];

                echo '<p><span class="glyphicon glyphicon-log-out"></span> <a href="../SubPage.php?id=' . $page_id . '">Back to Homepage</a></p>';
                break;
            }
        } else {
            echo '<p><span class="glyphicon glyphicon-log-out"></span> <a href="../SubPage.php">Back to website</a></p>';
        }
    }
    ?>

</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
