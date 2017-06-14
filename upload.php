<?php
include "connect/config.php";
if(isset($_POST)){
    $image = $_FILES['image']['name'];
    
    Image::upload($_FILES['image']);
    $sql = $conn->prepare("UPDATE chatters SET avatar=? WHERE id=?");
    $sql->execute(array($image,$_SESSION['id']));
    $_SESSION['avatar'] = $image;
    header('Location: index.php');
}

?>