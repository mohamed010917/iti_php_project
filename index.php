<?php
include_once "session.php";
include "handel.errors.php";

define("DEP", "iti");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-r from-blue-500 to-emerald-500 min-h-screen">

<?php include "nav.php"; ?>

<div class="flex justify-center items-center py-10 px-4 mt-16">
    <div class="bg-white w-full max-w-2xl rounded-2xl shadow-2xl p-8">

        <h2 class="text-3xl font-bold text-center text-gray-700 mb-6">
            Create Account
        </h2>

        <div class="text-right mb-4">
            <a href="users.view.php" 
               class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
               View All Users
            </a>
        </div>

        <form action="backend.php" method="post" enctype="multipart/form-data" class="space-y-4">

            <!-- First Name -->
            <div>
                <label class="font-semibold">First Name</label>
                <input required type="text" name="first_name"
                       value="<?= $_SESSION["old"]["first_name"] ?? '' ?>"
                       class="w-full mt-1 p-2 border rounded-lg focus:ring-2 focus:ring-blue-400">
                <p class="text-red-500 text-sm">
                    <?= $_SESSION["errors"]["first_name"] ?? '' ?>
                </p>
            </div>

            <!-- Last Name -->
            <div>
                <label class="font-semibold">Last Name</label>
                <input required type="text" name="last_name"
                       value="<?= $_SESSION["old"]["last_name"] ?? '' ?>"
                       class="w-full mt-1 p-2 border rounded-lg focus:ring-2 focus:ring-blue-400">
                <p class="text-red-500 text-sm">
                    <?= $_SESSION["errors"]["last_name"] ?? '' ?>
                </p>
            </div>

            <!-- Address -->
            <div>
                <label class="font-semibold">Address</label>
                <textarea required name="address" rows="3"
                    class="w-full mt-1 p-2 border rounded-lg focus:ring-2 focus:ring-blue-400"><?= $_SESSION["old"]["address"] ?? '' ?></textarea>
                <p class="text-red-500 text-sm">
                    <?= $_SESSION["errors"]["address"] ?? '' ?>
                </p>
            </div>

            <!-- Country -->
            <div>
                <label class="font-semibold">Country</label>
                <select name="country"
                        class="w-full mt-1 p-2 border rounded-lg focus:ring-2 focus:ring-blue-400">
                    <option value="">Select Country</option>
                    <?php
                    $countries = ["Egypt", "USA", "UK", "Germany"];
                    foreach ($countries as $country) {
                        $selected = (($_SESSION["old"]["country"] ?? '') == $country) ? "selected" : "";
                        echo "<option $selected>$country</option>";
                    }
                    ?>
                </select>
                <p class="text-red-500 text-sm">
                    <?= $_SESSION["errors"]["country"] ?? '' ?>
                </p>
            </div>

            <!-- Gender -->
            <div>
                <label class="font-semibold">Gender</label>
                <div class="flex gap-4 mt-1">
                    <?php $oldGender = $_SESSION["old"]["gender"] ?? ''; ?>
                    <label><input type="radio" name="gender" value="male" <?= $oldGender=="male"?'checked':'' ?>> Male</label>
                    <label><input type="radio" name="gender" value="female" <?= $oldGender=="female"?'checked':'' ?>> Female</label>
                </div>
                <p class="text-red-500 text-sm">
                    <?= $_SESSION["errors"]["gender"] ?? '' ?>
                </p>
            </div>

            <!-- Skills -->
            <div>
                <label class="font-semibold">Skills</label>
                <div class="flex flex-wrap gap-4 mt-1">
                    <?php
                    $skillsList = ["html","css","js","php","ruby"];
                    $oldSkills = $_SESSION["old"]["skills"] ?? [];
                    foreach ($skillsList as $skill) {
                        $checked = in_array($skill, $oldSkills) ? "checked" : "";
                        echo "<label><input type='checkbox' name='skills[]' value='$skill' $checked> ".strtoupper($skill)."</label>";
                    }
                    ?>
                </div>
                <p class="text-red-500 text-sm">
                    <?= $_SESSION["errors"]["skills"] ?? '' ?>
                </p>
            </div>

            <!-- Username -->
            <div>
                <label class="font-semibold">Username</label>
                <input required type="text" name="username"
                       value="<?= $_SESSION["old"]["username"] ?? '' ?>"
                       class="w-full mt-1 p-2 border rounded-lg focus:ring-2 focus:ring-blue-400">
                <p class="text-red-500 text-sm">
                    <?= $_SESSION["errors"]["username"] ?? '' ?>
                </p>
            </div>

            <!-- Password -->
            <div>
                <label class="font-semibold">Password</label>
                <input required type="password" name="password"
                       class="w-full mt-1 p-2 border rounded-lg focus:ring-2 focus:ring-blue-400">
                <p class="text-red-500 text-sm">
                    <?= $_SESSION["errors"]["password"] ?? '' ?>
                </p>
            </div>

            <!-- Department -->
            <div>
                <label class="font-semibold">Department</label>
                <input type="text" name="department"
                       value="<?= DEP ?>"
                       readonly
                       class="w-full mt-1 p-2 border bg-gray-100 rounded-lg">
                <p class="text-red-500 text-sm">
                    <?= $_SESSION["errors"]["department"] ?? '' ?>
                </p>
            </div>

            <!-- Profile Picture -->
            <div>
                <label class="font-semibold">Profile Picture</label>
                <input type="file" name="img"
                       class="w-full mt-1 p-2 border rounded-lg bg-gray-50">
                <p class="text-red-500 text-sm">
                    <?= $_SESSION["errors"]["img"] ?? '' ?>
                </p>
            </div>

            <!-- Buttons -->
            <div class="flex justify-between mt-6">
                <input type="reset" value="Reset"
                       class="bg-red-500 text-white px-6 py-2 rounded-lg hover:bg-red-600 transition">
                <input type="submit" value="Submit"
                       class="bg-emerald-500 text-white px-6 py-2 rounded-lg hover:bg-emerald-600 transition">
            </div>

        </form>
    </div>
</div>

</body>
</html>