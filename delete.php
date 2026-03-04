<?php 
   include_once "session.php" ;
   include "handel.errors.php";
   include "db.php" ;
   $connection = connect::getConnection() ;
   $id = $_GET['user'];
   //delete image from folder
   $stmt = $connection->prepare("select img from users where id = ?") ;
   $stmt->execute([$id]) ;
   $user = $stmt->fetch(PDO::FETCH_ASSOC) ;
   if($user && file_exists($user['img'])){
      unlink($user['img']);
   }
   $stmt = $connection->prepare("delete from users where id = ?") ;
   $stmt->execute([$id]) ;
   header("location: users.view.php#deleted") ;
?>