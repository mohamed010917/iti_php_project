<?php
   include_once "session.php" ;
class Files{
    public function upload($file){

        $target_dir = "uploads/";
        
        $imageFileType = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));

        $allowed = ["jpg","jpeg","png"];
        
        if(!in_array($imageFileType, $allowed)){
            return false;
        }

        if($file["size"] > 2 * 1024 * 1024){
            return false;
        }

        if(getimagesize($file["tmp_name"]) === false){
            return false;
        }

        $newName = uniqid() . "." . $imageFileType;
        $target_file = $target_dir . $newName;

        if(move_uploaded_file($file["tmp_name"], $target_file)){
            return $target_file;
        }

        return false;
    }
}