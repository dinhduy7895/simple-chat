<?php
include("connect/config.php");



if (isset($_SESSION['user']) && isset($_POST['msg'])) {

    $msg = htmlspecialchars($_POST['msg']);
    if ($msg != "") {
        $sql = $conn->prepare("INSERT INTO messages (userId,msg,posted) VALUES (?,?,NOW())");
        $sql->execute(array($_SESSION['id'], $msg));
    }
}
?>
