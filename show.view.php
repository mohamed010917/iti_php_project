<?php
    include_once "session.php" ;
    include "handel.errors.php";
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-6">

<?php 
include "nav.php" ;
include "handel.errors.php";
include "db.php";

$connection = connect::getConnection();
$id = $_GET['user'];

$statment = $connection->prepare("select * from users where id = ?");
$statment->execute([$id]);
$user = $statment->fetch(PDO::FETCH_ASSOC);

$skills = !empty($user['skills']) ? explode("_", $user['skills']) : [];
?>

<div class="bg-white w-full mt-12 max-w-2xl rounded-2xl shadow-xl p-8">

    <!-- Header -->
    <div class="border-b pb-4 mb-6">
        <h2 class="text-2xl flex items-center gap-2 font-bold text-gray-800">
            <img src="<?= $user['img'] ?>" class="w-16 h-16 rounded-full object-cover" alt="">
            <?php echo $user['gender'] == "male" ? "Mr. {$user['f_name']}" : "Ms. {$user['f_name']}" ?>
        </h2>
      
    </div>

    <!-- User Info -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-gray-700">

        <div class>
             
            <p class="text-sm text-gray-500">First Name</p>
            <p class="font-semibold"><?php echo $user['f_name'] ?></p>
        </div>

        <div>
            <p class="text-sm text-gray-500">Last Name</p>
            <p class="font-semibold"><?php echo $user['l_name'] ?></p>
        </div>

        <div>
            <p class="text-sm text-gray-500">Address</p>
            <p class="font-semibold"><?php echo $user['address'] ?></p>
        </div>

        <div>
            <p class="text-sm text-gray-500">Country</p>
            <p class="font-semibold"><?php echo $user['country'] ?></p>
        </div>

        <div>
            <p class="text-sm text-gray-500">Gender</p>
            <p class="font-semibold capitalize"><?php echo $user['gender'] ?></p>
        </div>

        <div>
            <p class="text-sm text-gray-500">Username</p>
            <p class="font-semibold"><?php echo $user['username'] ?></p>
        </div>

        <div>
            <p class="text-sm text-gray-500">Department</p>
            <p class="font-semibold"><?php echo $user['department'] ?></p>
        </div>

    </div>

    <!-- Skills Section -->
    <div class="mt-8">
        <p class="text-sm text-gray-500 mb-2">Skills</p>

        <?php if (!empty($skills)) { ?>
            <div class="flex flex-wrap gap-2">
                <?php foreach($skills as $skill){ ?>
                    <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-medium">
                        <?php echo $skill ?>
                    </span>
                <?php } ?>
            </div>
        <?php } else { ?>
            <p class="text-gray-400">No skills selected</p>
        <?php } ?>
    </div>

    <!-- Buttons -->
    <div class="mt-8 flex flex-wrap gap-4">

        <a href="users.view.php"
           class="flex-1 text-center bg-gray-500 text-white py-2 rounded-lg hover:bg-gray-600 transition duration-300">
            Back
        </a>

        <a href="edit.php?user=<?php echo $id ?>"
           class="flex-1 text-center bg-green-500 text-white py-2 rounded-lg hover:bg-green-600 transition duration-300">
            Edit
        </a>

        <a href="delete.php?user=<?php echo $id ?>"
           class="flex-1 text-center bg-red-500 text-white py-2 rounded-lg hover:bg-red-600 transition duration-300">
            Delete
        </a>

    </div>

</div>

</body>
</html>