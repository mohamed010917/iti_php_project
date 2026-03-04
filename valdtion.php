<?php
include_once "session.php" ;
class valdtion{

    public function create(){
        $errors = [] ;
        $_SESSION["old"] = [
            "first_name" => $_POST["first_name"] ?? "" ,
            "last_name" => $_POST["last_name"] ?? "" ,
            "address" => $_POST["address"] ?? "" ,
            "country" => $_POST["country"] ?? "" ,
            "gender" => $_POST["gender"] ?? "" ,
            "username" => $_POST["username"] ?? "" ,
            "department" => $_POST["department"] ?? "" ,
             "skills" => $_POST["skills"] ?? [] ,
        ] ;

        if($_SERVER["REQUEST_METHOD"] != "POST"){
            $error = "Invalid request method.";
            header("Location: index.php?error=$error");
            exit;
        }

        if(!isset($_POST["first_name"]) || trim($_POST["first_name"]) == "" || preg_match("/^[a-zA-Z]+$/", $_POST["first_name"]) == 0){
            $error = "Invalid first name.";
            $errors["first_name"] = $error ;
        }else{
            unset($errors["first_name"]) ;
        }

        if(!isset($_POST["last_name"]) || trim($_POST["last_name"]) == "" || preg_match("/^[a-zA-Z]+$/", $_POST["last_name"]) == 0){
            $error = "Invalid last name.";
            $errors["last_name"] = $error ;
        }else{
            unset($errors["last_name"]) ;
        }

        if(!isset($_POST["address"]) || trim($_POST["address"]) == ""){
            $error = "Invalid address.";
            $errors["address"] = $error ;
        }else{
            unset($errors["address"]) ;
        }

        if(!isset($_POST["country"]) || trim($_POST["country"]) == ""){
            $error = "Invalid country.";
            $errors["country"] = $error ;
            
        }else{
            unset($errors["country"]) ;
        }

        if(!isset($_POST["gender"]) || ($_POST["gender"] != "male" && $_POST["gender"] != "female")){
            $error = "Invalid gender.";
            $errors["gender"] = $error ;
        }else{
            unset($errors["gender"]) ;
        }

        if(!isset($_POST["username"]) || trim($_POST["username"]) == ""){
            $error = "Invalid username.";
            $errors["username"] = $error ;
        }else{
            unset($errors["username"]) ;
        }
        

        if(!isset($_POST["department"]) || trim($_POST["department"]) == ""){
            $error = "Invalid department.";
            $errors["department"] = $error ;
        }else{
            unset($errors["department"]) ;
        }

       if(
            !isset($_POST["password"]) ||
            trim($_POST["password"]) == "" ||
            strlen($_POST["password"]) != 8 ||
            !preg_match("/^[a-z0-9_]+$/", $_POST["password"])
            ){
                $error = "Password must be exactly 8 characters, lowercase letters, numbers and underscore only.";
                $errors["password"] = $error ;
            }else{
                unset($errors["password"]) ;
            }

        if(!isset($_POST["skills"]) || !is_array($_POST["skills"]) || count($_POST["skills"]) == 0){
            $error = "Invalid skills.";
            $errors["skills"] = $error ;
        }else{
            unset($errors["skills"]) ;
        }

        if(!isset($_FILES["img"]) || $_FILES["img"]["error"] != 0){
            $error = "Invalid profile picture.";
            $errors["img"] = $error ;
        }else{
            unset($errors["img"]) ;
        }

        if(count($errors) > 0){
            $_SESSION["errors"] = $errors ;
            header("Location: index.php");
            exit;
        }
        $_SESSION["errors"] = [] ;
        $_SESSION["old"] = [] ;
        return true ;
    }


    public function update(){
        $valid = true ;
        $masseg = "" ;

        if($_SERVER["REQUEST_METHOD"] != "POST"){
        $valid = false ;
        $masseg = "invalid request method" ;
        header("Location: edit.php?user={$_POST["id"]}&error=$masseg") ;
        exit() ;
        }


        if(!is_string($_POST["f_name"]) || strlen(trim($_POST["f_name"])) == 0){
            $valid = false ;
            $masseg = "invalid first name" ;
            header("Location: edit.php?user={$_POST["id"]}&error=$masseg") ;
            exit() ;
        }
       
        if( !is_string($_POST["l_name"]) || strlen(trim($_POST["l_name"])) == 0){
        $valid = false ;
        $masseg = "invalid last name" ;
        header("Location: edit.php?user={$_POST["id"]}&error=$masseg") ;
        exit() ;
        }
       
        if(!is_string($_POST["address"]) || strlen(trim($_POST["address"])) == 0){
            $valid = false ;
            $masseg = "invalid address" ;
            header("Location: edit.php?user={$_POST["id"]}&error=$masseg") ;
            exit() ;
        }
    
        if( !is_string($_POST["country"]) || strlen(trim($_POST["country"])) == 0){
            $valid = false ;
            $masseg = "invalid country" ;
            header("Location: edit.php?user={$_POST["id"]}&error=$masseg") ;
            exit() ;
        }

      
        if( !is_string($_POST["gender"]) || ($_POST["gender"] != "male" && $_POST["gender"] != "female")){
            $valid = false ;
            $masseg = "invalid gender" ;
            header("Location: edit.php?user={$_POST["id"]}&error=$masseg") ;
            exit() ;
        }
        if( !is_string($_POST["username"]) || strlen(trim($_POST["username"])) == 0){
            $valid = false ;
            $masseg = "invalid username" ;
            header("Location: edit.php?user={$_POST["id"]}&error=$masseg") ;
            exit() ;
        }
       
        if( !is_string($_POST["department"]) || strlen(trim($_POST["department"])) == 0){
             
            $valid = false ;
            $masseg = "invalid department" ;
            header("Location: edit.php?user={$_POST["id"]}&error=$masseg") ;
            exit() ;
        }
   
   
        if( !is_string($_POST["password"]) || strlen(trim($_POST["password"])) == 0){
            $valid = false ;
            $masseg = "invalid password" ;
            header("Location: edit.php?user={$_POST["id"]}&error=$masseg") ;
            exit() ;    
        }
        if(!$valid){
            header("Location: edit.php?user={$_POST["id"]}&error=invalid_input") ;
            exit() ;
        }

        return true ;

    }
}