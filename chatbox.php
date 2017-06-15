<?php
if (isset($_GET['idRoom']) || isset($_GET['idUser'])) {
    if (isset($_GET['idRoom'])) {
        $_SESSION['get'] = "room";
        $_SESSION['idChat'] = $_GET['idRoom'];
        $sql = $conn->prepare("SELECT room.name , COUNT(user_room.user_id) AS countId 
                                FROM room INNER JOIN user_room 
                                ON room.id = user_room.room_id 
                                WHERE room.id = ? AND user_room.user_id = ?");
        $sql->execute(array($_SESSION['idChat'], $_SESSION['id']));
    } else {
        $_SESSION['get'] = "user";
        $_SESSION['idChat'] = $_GET['idUser'];
        $sql = $conn->prepare("SELECT user_user.id, username as name FROM user, user_user 
                              WHERE  user_user.id = ? 
                              AND ( sender = ? AND user.id = receiver OR receiver = ?  AND  user.id = sender) ");
        $sql->execute(array($_SESSION['idChat'], $_SESSION['id'], $_SESSION['id']));
    }
    if ($sql->rowCount() == 0) header("Location:index.php");
    else {
        $r = $sql->fetch();
        $receive = $r['name'];
    }
    ?>
    <div class="menu">
        <i class="fa fa-star-o favourite" aria-hidden="true"></i>
        <i class="fa fa-hashtag hastgtag" aria-hidden="true"></i>
        <div class="name text-center"> <?php echo $receive; ?></div>
    </div>
    <ol class='chat msgs'>
        <div class="msg" title="<?php echo time(); ?>"  style="display: none"></div>
        <?php 
        if($_SESSION['get'] == 'room'){
            if($r["countId"] == 0) include 'joinRoom.php';
            else         include("messages.php");
        }
        else include("messages.php"); 
        ?>
    </ol>
    <form id="msg_form">
        <input class="textarea" type="text" placeholder="Type here!"/></div>
    </form>
    <?php
} else {
    echo "Welcome to chat simple";
}
?>

