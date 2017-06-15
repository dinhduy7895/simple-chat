<?php 
    include "connect/config.php";

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = $conn->prepare("SELECT id FROM user_user WHERE (sender = ? and receiver = ?) OR (sender = ? and receiver = ?)");
        $sql->execute(array($id,$_SESSION['id'],$_SESSION['id'],$id));

        if($sql->rowCount() == 0) {

            $sql = $conn->prepare("INSERT INTO user_user (sender,receiver) VALUES (?,?)");
            $sql->execute(array($id,$_SESSION['id']));
            $lastId = $conn->lastInsertId();

        }
        else{

            $r = $sql->fetch();
            $lastId = $r['id'];
            
        }
        header("Location: index.php?idUser=$lastId");
    }
    else{

        header("Location: index.php");

    }

?>