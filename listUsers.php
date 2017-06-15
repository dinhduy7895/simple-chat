<?php
include("connect/config.php");
?>

    <div class=" list-content col-lg-12">
        <?php $sql = $conn->prepare("SELECT id, status, username FROM user");
        $sql->execute();
        while ($r = $sql->fetch()) {
            if($r['id'] == $_SESSION['id']) continue;
            if($r['status'] == 1)
                echo "<div class='user online'><a href='newUser.php?id={$r['id']}'><span style='color: #4cae4c'>@ {$r['username']}</span></a></div>";
            else
                echo "<div class='user ofline'><a href='newUser.php?id={$r['id']}'><span style='color:#a0a0a0'>@ {$r['username']}</span></a></div>";
        }
        $sql = $conn->prepare("SELECT room.id, room.name FROM room 
                            INNER JOIN user_room 
                            on room.id = user_room.room_id
                            WHERE user_room.user_id = ?");
        $sql->execute(array($_SESSION['id']));

        while ($r = $sql->fetch()) {
                echo "<div class='user ofline'><a href='index.php?idRoom={$r['id']}'><span style='color:#a0a0a0'>@ {$r['name']}</span></a></div>";
        }
        ?>

    </div>
