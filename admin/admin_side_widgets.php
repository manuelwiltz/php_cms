
<div class="list-group">
    <a href="admin.php" class="list-group-item active main-color-bg">
        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard
    </a>
    <a href="pages.php" class="list-group-item"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Pages <span class="badge"><?php echo cms_getCountSites() ?></span></a>
    <a href="themes.php" class="list-group-item"><span class="glyphicon glyphicon-modal-window" aria-hidden="true"></span> Themes </a>
    <a href="users.php" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Users <span class="badge"><?php echo cms_getCountUsers() ?></span></a>
    <a href="profile.php" class="list-group-item"><span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span> Profile </a>
    <a href="settings.php" class="list-group-item"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> Settings </a>
</div>

<?php
/*
<div class="well">
    <h4>Disk Space Used</h4>
    <div class="progress">
        <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
            60%
        </div>
    </div>
    <h4>Bandwidth Used </h4>
    <div class="progress">
        <div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;">
            40%
        </div>
    </div>
</div>
*/
?>