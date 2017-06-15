<?php
include("connect/config.php");
if (isset($_SESSION['user']) && isset($_POST['msg'])) {
    $id = $_SESSION['idChat'];
    $msg = $_POST['msg'];
    if($_SESSION['get'] == "room"){
        $table = "chat_room";
        $foreign ="room_id";
    }
    else{
        $table = "chat_user";
        $foreign ="user_user_id";
    }
    if ($msg != "") {
        $sql = $conn->prepare("INSERT INTO $table (sender,message,posted,$foreign) VALUES (?,?,NOW(),?)");
        $sql->execute(array($_SESSION['user'], $msg,$id));
    }
}
?>
