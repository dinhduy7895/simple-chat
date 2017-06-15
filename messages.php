<?php
include("connect/config.php");
if( $_SESSION['get'] == "room"){
    $sql = $conn->prepare("SELECT username,avatar, chat_room.* FROM chat_room, user WHERE chat_room.room_id =? AND chat_room.sender = user.username ORDER by id ASC ");
    $sql->execute(array($_SESSION['idChat']));
}
else{
    $sql = $conn->prepare("SELECT username,avatar, chat_user.* FROM chat_user, user WHERE chat_user.user_user_id =? AND chat_user.sender = user.username ORDER by id ASC ");
    $sql->execute(array($_SESSION['idChat']));
}

while ($r = $sql->fetch()) {
    if ($r['username'] == $_SESSION['user']) echo "<li class='self'>";
    else echo "<li class='other'>";
    $url = Image::getImage($r['avatar']);

    echo " <div class='wrapper-mess'>
      <div class='avatar' ><img src='{$url}' draggable='false'/></div>
      <div class='msg' title='{$r['posted']}'>
        <p>{$r['message']}</p>
        <time>{$r['posted']}</time>
      </div>
      </div>
      <div class='user-name'> {$r['username']} </div> ";
}

?>
