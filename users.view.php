<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Users</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10">
<?php 
include_once "session.php" ;
include "nav.php" ;

 include "handel.errors.php" ;
 include "db.php" ;

 $connection = connect::getConnection() ;
 $statment = $connection->prepare("select * from users") ;
 $statment->execute() ;
 $users = $statment->fetchAll(PDO::FETCH_ASSOC) ;
?>

<div class="max-w-6xl mx-auto bg-white shadow-lg mt-12 rounded-xl p-6">
   
    <h2 class="text-2xl font-bold mb-6 text-center text-gray-700">All Users</h2>
   
    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-300 text-center">
            
            <thead class="bg-blue-500 text-white">

                <tr>
                    <th class="py-3 px-4 border">ID</th>
                    <th class="py-3 px-4 border">First Name</th>
                    <th class="py-3 px-4 border">Last Name</th>
                    <!-- <th class="py-3 px-4 border">Address</th> -->
                    <th class="py-3 px-4 border">Country</th>
                    <th class="py-3 px-4 border">Gender</th>
                    <!-- <th class="py-3 px-4 border">Username</th> -->
                    <th class="py-3 px-4 border">Department</th>
                   
                    <!-- <th class="py-3 px-4 border">Skills</th> -->
                    <th class="py-3 px-4 border">actions</th>

                </tr>
            </thead>

            <tbody class="bg-gray-50 text-xs sm:text-sm md:text-base">
                <?php
                foreach($users as $i => $user){
                 
               echo "
                <tr class='hover:bg-gray-200 transition'>
                    <td class='py-2 px-4 border'>{$user['id']}</td>
                    <td class='py-2 px-4 border'>{$user['f_name']}</td>
                    <td class='py-2 px-4 border'>{$user['l_name']}</td>
                
                    <td class='py-2 px-4 border'>{$user['country']}</td>
                    <td class='py-2 px-4 border'>{$user['gender']}</td>
            
                    <td class='py-2 px-4 border'>{$user['department']}</td>
                   
                    <td class='py-2 px-4 border flex gap-2 justify-center'>
                    <a class='bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600' href='delete.php?user={$user['id']}'>Delete</a>
                    <a class='bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600' href='edit.php?user={$user['id']}'>Edit</a>
                    <a class='bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600' href='show.view.php?user={$user['id']}'>View</a>
                    </td>
                </tr>
                ";
                }
                ?>
            </tbody>

        </table>
    </div>

</div>


<div id="msg"
     class="hidden fixed top-5 left-1/2 -translate-x-1/2 
            bg-red-500 text-white px-6 py-3 rounded-lg 
            shadow-lg transition-opacity duration-500 z-50">
    User deleted successfully
</div>

<div id="ADD"
     class="hidden fixed top-5 left-1/2 -translate-x-1/2 
            bg-blue-500 text-white px-6 py-3 rounded-lg 
            shadow-lg transition-opacity duration-500 z-50">
    User ADD successfully
</div>
<div id="updated"
     class="hidden fixed top-5 left-1/2 -translate-x-1/2 
            bg-green-500 text-white px-6 py-3 rounded-lg 
            shadow-lg transition-opacity duration-500 z-50">
    User updated successfully
</div>
<script>
    
    window.onload = function() {

        if (window.location.hash === "#deleted") {
            let msg = document.getElementById("msg");
            msg.classList.remove("hidden");
            setTimeout(function() {
                msg.classList.add("hidden") ;
                history.replaceState(null, null, window.location.pathname);
            }, 3000);
        }
        if (window.location.hash === "#add") {
            let add = document.getElementById("ADD");
            add.classList.remove("hidden");
            setTimeout(function() {
                add.classList.add("hidden") ;
                history.replaceState(null, null, window.location.pathname);
            }, 3000);
        }
        if (window.location.hash === "#updated") {
            let updated = document.getElementById("updated");
            updated.classList.remove("hidden");
            setTimeout(function() {
                updated.classList.add("hidden") ;
                history.replaceState(null, null, window.location.pathname);
            }, 3000);
        }

    };
</script>

</body>
</html>