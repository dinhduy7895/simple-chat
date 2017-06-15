<?php
include 'connect/config.php';


if (isset($_POST['submit'])) {
    $username = htmlspecialchars($_POST['username']);
    $pass = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM user WHERE username=:Name AND password=:Pass");
    $stmt->bindparam(":Name", $username);
    $stmt->bindparam(":Pass", $pass);
    $stmt->execute();
    if ($stmt->rowCount() == 0) {
        header('Location: login.php?mess="username hoac mat khau khong dung"');
    } else {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $_SESSION['user'] = $row['username'];
        $_SESSION['id'] = $row['id'];
        $_SESSION['avatar'] = $row['avatar'];
        $sql = $conn->prepare("UPDATE user SET status=1 WHERE id=?");
        $sql->execute(array($_SESSION['id']));
        header('Location: index.php');
    }

} else if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $pass = $_POST['pass'];
    $rePass = $_POST['rePass'];
    $reset = null;
    if ($pass != $rePass)
        header('Location: login.php?mess="Password khong khop"');
    else {
        $sql = "SELECT * FROM user WHERE username=:Name";
        $stmt = $conn->prepare($sql);
        $stmt->bindparam(":Name", $username);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($stmt->rowCount() == 0) {

            $stmt1 = $conn->prepare("INSERT INTO user(username, password, seen,status) VALUES (:username,:password,NOW(),1)");
            $stmt1->bindparam(":username", $username);
            $stmt1->bindparam(":password", $pass);
            $stmt1->execute();
            if ($stmt1) {
                $_SESSION['user'] = $name;
                $_SESSION['id'] = $conn->lastInsertId();
                $sql = "SELECT * FROM user ORDER BY id DESC LIMIT 1";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $_SESSION['avatar'] = $row['avatar'];
                header("location: index.php");
            } else {
                header("location: login.php?mess='input khong hop le'");
            }
        } else if ($stmt->rowCount() > 0) {
            header('Location: login.php?mess="Username da ton tai"');
        }
    }
} else {
    header('Location: login.php');
}
?>

