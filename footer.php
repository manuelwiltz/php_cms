</div>

<footer id="myFooter">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-xs-12 myCols">
                <h5>Contact us</h5>
                <ul>
                    <li><p>Phone: <a href="#">0660 0011 2233</a></p></li>
                    <li><p>EMail: <a href="#">this@contact.com</a></p></li>
                    <li></li>
                </ul>
            </div>
            <div class="col-sm-4 col-xs-12 myCols">
                <h5>Links</h5>
                <?php
                $statement = "SELECT * FROM pages;";

                if ($_res = $conn->query($statement)) {
                    if ($_res->num_rows > 0) {
                        echo '<p> | ';
                        while ($row = $_res->fetch_assoc()) {
                            $page_id = $row['ID'];
                            $name = $row['PageName'];
                            echo ' <a href="Subpage.php?id=' . $page_id . '">' . $name . '</a> |';
                        }
                        echo '</p>';
                    }
                }
                ?>
                <p></p>
            </div>
            <div class="col-sm-4 col-xs-12 myCols">
                <h5>Login</h5>
                <form class="navbar-form navbar-right">
                    <div class="form-group text-center">
                        <input type="text" class="form-control search" placeholder="Search">
                    </div>
                    <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                </form>
            </div>
            <p class="text-center"><?php echo cms_getWebsiteDescription($page_id); ?></p>
        </div>
    </div>
    <div class="social-networks">
        <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
        <a href="#" class="facebook"><i class="fa fa-facebook-official"></i></a>
        <a href="#" class="google"><i class="fa fa-google-plus"></i></a>
    </div>
    <div class="footer-copyright">
        <p><a href="admin/admin.php">Admin - Area</a></p>
        <p>Copyright <?php echo cms_getWebsiteTitle() . " &copy; " . date("Y") ?></p>
    </div>
</footer>

</body>
</html>
