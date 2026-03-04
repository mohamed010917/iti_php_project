<?php 
    include_once "session.php" ;

   include_once "handel.errors.php" ;
   include_once "db.php" ;
   include_once "valdtion.php" ;
   include_once "uplodeImg.php" ;


   $connection = connect::getConnection() ;
 
   $valdit = new valdtion ;
   if($valdit->create()){
       
       $file = new Files ;
       $img = $file->upload($_FILES["img"]) ;
       if($img === false){
        $error = "Failed to upload profile picture.";
        $_SESSION["errors"]["img"] = $error ;
        header("Location: index.php");
        exit;
       }
       $_SESSION["errors"] = [];

       $data = [
           "first_name" => $_POST["first_name"],
           "last_name" => $_POST["last_name"],
           "address" => $_POST["address"],
           "country" => $_POST["country"],
           "gender" => $_POST["gender"],
           "username" => $_POST["username"],
           "department" => $_POST["department"],
           "password" => password_hash($_POST["password"], PASSWORD_DEFAULT),
           "skills" =>  implode("_" , $_POST["skills"]),
            "img" => $img
       ];
   
   
       $stmt = $connection->prepare("insert into users (f_name, l_name, address, country, gender, username, department, password, skills, img) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
       $stmt->execute(array_values($data)) ;
       header("Location: users.view.php#add") ;
   }

?>
    
