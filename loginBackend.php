<?php
include "handel.errors.php";
include_once "session.php" ;
include "db.php" ;

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $username = $_POST["username"] ;
    $password = $_POST["password"] ;
    $connection = connect::getConnection() ;
    $stmt = $connection->prepare("select * from users where username = ?") ;
    $stmt->execute([$username]) ;
    $user = $stmt->fetch(PDO::FETCH_ASSOC) ;
    if($user && password_verify($password, $user["password"])){
        $_SESSION["user"] = [
            "id" => $user["id"],
            "username" => $user["username"],
            "first_name" => $user["f_name"],
            "last_name" => $user["l_name"] ,
            "img" => $user["img"]
        ] ;
        header("Location: users.view.php") ;
        exit() ;
    }else{
        $error = "Invalid username or password.";
        header("Location: login.php?error=$error");
        exit() ;
    }
}else{
       $error = "Invalid username or password.";
        header("Location: login.php?error=$error");
    exit() ;
}
