<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" id="main-left" href="#"> CMS</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
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
            <form class="navbar-form navbar-right">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
            </form>
        </div>
    </div>
</nav>