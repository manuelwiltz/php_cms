<?php
if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
}

include './DB_connection.php';

$statement = "SELECT username FROM users where id = " . $_SESSION['userid'];

if ($res = $conn->query($statement)) {
    if ($res->num_rows > 0) {
        $row = $res->fetch_assoc();
        $username = $row['username'];
    }
} else {
    $username = "";
}

?>

<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="admin.php">Admin Panel</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="admin.php"><span class="glyphicon glyphicon-cog"></span> Dashboard</a></li>
                <li><a href="pages.php"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Pages</a></li>
                <li><a href="themes.php"><span class="glyphicon glyphicon-modal-window" aria-hidden="true"></span> Themes</a></li>
                <li><a href="users.php"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Users</a></li>
                <li><a href="profile.php"><span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span> Profile</a></li>
                <li><a href="settings.php"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> Settings</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="profile.php"><span class="glyphicon glyphicon-user"></span> Welcome, <?php echo $username ?></a></li>
                <li><a href="login.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
            </ul>
        </div>
    </div>
</nav>