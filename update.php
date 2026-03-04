<?php
include_once "session.php" ; 
include "handel.errors.php" ;
include "db.php" ;
include "valdtion.php" ;
   include_once "uplodeImg.php" ;

$connection = connect::getConnection() ;
$vald = new valdtion ;
if($vald->update()){

    $id = $_POST["id"] ;
    $user = $connection->prepare("select * from users where id = ?") ;
    $user->execute([$id]) ;
    $user = $user->fetch(PDO::FETCH_ASSOC) ;
    if(!$user){
        header("Location: edit.php?user={$_POST["id"]}&error=user_not_found") ;
        exit() ;
    }
     
    if(isset($_FILES["img"]) && $_FILES["img"]["error"] == 0){
        $file = new Files ;
        $img = $file->upload($_FILES["img"]) ;
        if(! $img){
            $error = "Failed to upload profile picture.";
            $_SESSION["errors"]["img"] = $error ;
            header("Location: edit.php?user={$_POST["id"]}");
            exit;
        }
        // delete old image
        if(file_exists($user["img"])){
            unlink($user["img"]) ;
        }
        
    }
    
    // save data to file
    $data = [
        "f_name" => $_POST["f_name"],
        "l_name" => $_POST["l_name"],
        "address" => $_POST["address"],
        "country" => $_POST["country"],
        "gender" => $_POST["gender"],
        "username" => $_POST["username"],
        "department" => $_POST["department"],
        "password" => password_hash($_POST["password"], PASSWORD_DEFAULT),
        "skills" =>  implode("_" , $_POST["skills"]),
        "img" => $img ?? $user["img"],
        "id" => $id 
    ];
    $stmt = $connection->prepare("update users set f_name = ? , l_name = ? , address = ? , country = ?, gender = ?, username = ?, department = ?, password = ?, skills = ? , img = ? where id = ?") ;
    $stmt->execute(array_values($data));
    
    header("Location: users.view.php#updated") ;
}



?>