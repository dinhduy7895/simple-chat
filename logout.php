<?php
session_start();
include("connect/config.php");
$sql = $conn->prepare("UPDATE chatters SET status=0 WHERE id=?");
$sql->execute(array($_SESSION['id']));
session_destroy();
header("Location: login.php");
?>
