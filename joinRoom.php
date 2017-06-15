<?php
include "connect/config.php";

if(isset($_POST['join']) && isset($_GET['idRoom'])){
    $id = $_GET['idRoom'];
        $sql = $conn->prepare("INSERT INTO user_room (user_id,room_id) VALUES (?,?)");
        $sql->execute(array($_SESSION['id'],$id));
        header("Location: index.php?idRoom=$id");
}
?>

<div class="join-room" title="true">
    Do you want to join this Room ?
    <form action="index.php?idRoom=<?php echo $_GET['idRoom']; ?>" method="post">
        <input type="submit"  class="btn btn-success" name="join" value="JOIN">
    </form>
</div>
