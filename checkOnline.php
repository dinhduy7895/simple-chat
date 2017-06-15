<?php
if (isset($_SESSION['user'])) {
    $sqlm = $conn->prepare("SELECT username FROM user WHERE id=?");
    $sqlm->execute(array($_SESSION['id']));
    if ($sqlm->rowCount() != 0) {
        $sql = $conn->prepare("UPDATE user SET seen=NOW() WHERE id=?");
        $sql->execute(array($_SESSION['id']));
    }
}
$sql = $conn->prepare("SELECT * FROM user");
$sql->execute();
while ($r = $sql->fetch()) {
    $curtime = strtotime(date("Y-m-d H:i:s", strtotime('-60 seconds', time())));
    if (strtotime($r['seen']) < $curtime) {
        $stmt = $conn->prepare("UPDATE user SET status=0 WHERE id=?");
        $stmt->execute(array($r['id']));
    }

}
?>
