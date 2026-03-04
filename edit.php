<?php    include_once "session.php" ; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" >
    <title>Registration Form</title>
   <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #4e73df, #1cc88a);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
            
        }

        .container {
            background: white;
            padding: 30px;
            width: 400px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            padding: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }

        input[type="text"],
        input[type="password"],
        select,
        textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
            outline: none;
            transition: 0.3s;
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: #4e73df;
            box-shadow: 0 0 5px rgba(78,115,223,0.5);
        }

        .radio-group,
        .checkbox-group {
            margin-top: 5px;
        }

        .radio-group input,
        .checkbox-group input {
            margin-right: 5px;
        }

        .buttons {
            margin-top: 20px;
            text-align: center;
        }

        input[type="submit"] {
            background-color: #1cc88a;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 10px;
        }

        input[type="submit"]:hover {
            background-color: #17a673;
        }

        input[type="reset"] {
            background-color: #e74a3b;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="reset"]:hover {
            background-color: #c0392b;
        }
    </style>
</head>

<body>
    
<?php 
  include "nav.php" ;
  define("DEP" , "iti") ;
  include "handel.errors.php" ;
  include "db.php" ;
  $connection = connect::getConnection() ;
  $id = $_GET["user"] ;
    $statment = $connection->prepare("select * from users where id = ?") ;
    $statment->execute([$id]) ;
    $user = $statment->fetch(PDO::FETCH_ASSOC) ;
?>
<div class="container w-[50%] mt-12">
    <h2>EDit user <?php echo $user['f_name'] ?></h2>

    <?php
    if(isset($_GET["error"]) ){
        $error = $_GET["error"] ;
        echo "<div style='background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px;'>
                Invalid input. Error: $error
                </div>" ;
    }
    ?>
    <form action="update.php" method="post" enctype="multipart/form-data">
         
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <label>First Name</label>
        <input required type="text" name="f_name" value="<?php echo $user['f_name'] ?>">
        <div class="error">
            <?php
            if(isset($_SESSION["errors"]["f_name"])){
                echo "<p style='color: red; font-size: 0.9em;'>{$_SESSION["errors"]["f_name"]}</p>" ;
            }
            ?>
        </div> 


        <label>Last Name</label>
        <input type="text" name="l_name" value="<?php echo $user['l_name'] ?>">
        <div class="error">
            <?php
            if(isset($_SESSION["errors"]["l_name"])){
                echo "<p style='color: red; font-size: 0.9em;'>{$_SESSION["errors"]["l_name"]}</p>" ;
            }
            ?>
        </div>
        <label>Address</label>
        <textarea required name="address" rows="3"><?php echo $user['address'] ?></textarea>
            <div class="error">
                <?php
                if(isset($_SESSION["errors"]["address"])){
                    echo "<p style='color: red; font-size: 0.9em;'>{$_SESSION["errors"]["address"]}</p>" ;
                }
                ?>
            </div>
        <label>Country</label>
        <select name="country">
            <option value="">Select Country</option>
            <option value="Egypt" <?php echo $user['country'] == "Egypt" ? "selected" : "" ?>>Egypt</option>
            <option value="USA" <?php echo $user['country'] == "USA" ? "selected" : "" ?>>USA</option>
            <option value="UK" <?php echo $user['country'] == "UK" ? "selected" : "" ?>>UK</option>
            <option value="Germany" <?php echo $user['country'] == "Germany" ? "selected" : "" ?>>Germany</option>
        </select>
            <div class="error">
                <?php
                if(isset($_SESSION["errors"]["country"])){
                    echo "<p style='color: red; font-size: 0.9em;'>{$_SESSION["errors"]["country"]}</p>" ;
                }
                ?>  
            </div>
        <label>Gender</label>
        <div class="radio-group">
            <input type="radio" name="gender" value="male" <?php echo $user['gender'] == "male" ? "checked" : "" ?>> Male
            <input type="radio" name="gender" value="female" <?php echo $user['gender'] == "female" ? "checked" : "" ?>> Female
        </div>
            <div class="error">
                <?php
                if(isset($_SESSION["errors"]["gender"])){
                    echo "<p style='color: red; font-size: 0.9em;'>{$_SESSION["errors"]["gender"]}</p>" ;
                }
                ?>
            </div>

        <label>Skills</label>
        <div class="checkbox-group">
            <input   type="checkbox" name="skills[]" value="html" <?php echo strpos($user['skills'], "html")  ? "checked" : "" ?>> HTML
            <input type="checkbox" name="skills[]" value="css" <?php echo strpos($user['skills'], "css")  ? "checked" : "" ?>> CSS
            <input type="checkbox" name="skills[]" value="js" <?php echo strpos($user['skills'], "js")  ? "checked" : "" ?>> JS
            <input type="checkbox" name="skills[]" value="php" <?php echo strpos($user['skills'], "php")  ? "checked" : "" ?>> PHP
            <input type="checkbox" name="skills[]" value="ruby" <?php echo strpos($user['skills'], "ruby")  ? "checked" : "" ?>> Ruby
        </div>
        <div class="error">
            <?php
            if(isset($_SESSION["errors"]["skills"])){
                echo "<p style='color: red; font-size: 0.9em;'>{$_SESSION["errors"]["skills"]}</p>" ;
            }
            ?>
        </div>

        <label>Username</label>
        <input type="text" name="username" value="<?php echo $user['username'] ?>">
        <div class="error">
            <?php
            if(isset($_SESSION["errors"]["username"])){
                echo "<p style='color: red; font-size: 0.9em;'>{$_SESSION["errors"]["username"]}</p>" ;
            }
            ?>
        </div>
     
        <label>Password</label>
        <input type="password" name="password">
        <div class="error">
            <?php
            if(isset($_SESSION["errors"]["password"])){
                echo "<p style='color: red; font-size: 0.9em;'>{$_SESSION["errors"]["password"]}</p>" ;
            }
            ?>
        </div>

        <label>Department</label>
        <input type="text" value="<?php echo $user['department'] ?>" name="department" readonly >
        <div class="error">
            <?php
            if(isset($_SESSION["errors"]["department"])){
                echo "<p style='color: red; font-size: 0.9em;'>{$_SESSION["errors"]["department"]}</p>" ;
            }
            ?>
        </div>

         <div>
            <label class="block font-semibold mb-2">Profile Picture</label>
            
            <input 
                type="file" 
                name="img"
                class="w-full p-2 border rounded-lg bg-gray-50 
                    file:mr-4 file:py-2 file:px-4 
                    file:rounded-lg file:border-0 
                    file:text-sm file:font-semibold 
                    file:bg-emerald-500 file:text-white 
                    hover:file:bg-emerald-600"
            >
        </div>
            <div class="error">
                <?php
                if(isset($_SESSION["errors"]["img"])){
                    echo "<p style='color: red; font-size: 0.9em;'>{$_SESSION["errors"]["img"]}</p>" ;
                }
                ?>
            </div>
        <div class="buttons">
         
            <input type="submit" value="Submit">
        </div>

    </form>
</div>

</body>
</html> 