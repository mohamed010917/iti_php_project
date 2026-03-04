<?php 
   include_once "session.php" ;
   include "handel.errors.php";
   include "db.php" ;
   $connection = connect::getConnection() ;
   $id = $_GET['user'];
   $stmt = $connection->prepare("delete from users where id = ?") ;
   $stmt->execute([$id]) ;
   header("location: users.view.php#deleted") ;
?>