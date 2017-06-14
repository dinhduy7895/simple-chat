<?php
include("connect/config.php");
?>

    <div class=" list-content col-lg-12">
        <?php $sql = $conn->prepare("SELECT status, username FROM chatters");
        $sql->execute();
        while ($r = $sql->fetch()) {
            if($r['status'] == 1)
                echo "<div class='user online'><span style='color: #4cae4c'>@ </span>{$r['username']}</div>";
            else
                echo "<div class='user ofline'><span style='color:#a0a0a0'>@ </span>{$r['username']}</div>";
        }
        ?>

    </div>
