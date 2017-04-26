</div>

<footer id="myFooter">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-xs-12 myCols">
                <h5>Contact us</h5>

                <?php
                echo cms_getContactInfo();
                ?>
            </div>
            <div class="col-sm-4 col-xs-12 myCols">
                <h5>Links</h5>
                <?php
                echo cms_getWebsiteLinks();
                ?>
                <p></p>
            </div>
            <div class="col-sm-4 col-xs-12 myCols">
                <h5>Login</h5>
                <form class="navbar-form">
                    <div class="form-group text-center">
                        <input type="text" class="form-control search" placeholder="Search">
                    </div>
                    <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                </form>
            </div>
        </div>
    </div>
    <div class="social-networks">

        <?php
        echo cms_getSocialMediaIcons();
        ?>
    </div>
    <div class="footer-copyright">
        <p><a href="admin/admin.php">Admin - Area</a></p>
        <p>Copyright <?php echo cms_getWebsiteTitle() . " &copy; " . date("Y") ?></p>
    </div>
</footer>

</body>
</html>
