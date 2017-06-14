<?php
include("connect/config.php");
$sql = $conn->prepare("SELECT username,avatar, messages.* FROM messages, chatters WHERE  messages.userId = chatters.id ORDER by id ASC ");
$sql->execute();
while ($r = $sql->fetch()) {
    if ($r['userId'] == $_SESSION['id']) echo "<li class='self'>";
    else echo "<li class='other'>";
    $url = Image::getImage($r['avatar']);

    echo " <div class='wrapper-mess'>
      <div class='avatar' ><img src='{$url}' draggable='false'/></div>
      <div class='msg' title='{$r['posted']}'>
        <p>{$r['msg']}</p>
        <time>{$r['posted']}</time>
      </div>
      </div>
      <div class='user-name'> {$r['username']} </div> ";
}

?>
