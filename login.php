<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-gradient-to-r from-blue-500 to-emerald-500 flex items-center justify-center">

    <div class="bg-white w-full max-w-md p-8 rounded-2xl shadow-2xl">

        <!-- Logo / Title -->
        <h2 class="text-3xl font-bold text-center text-gray-700 mb-6">
            Welcome Back 👋
        </h2>

        <!-- Login Form -->
        <form action="loginBackend.php" method="POST" class="space-y-5">

            <!-- Username -->
            <div>
                <label class="block text-gray-600 font-semibold mb-1">
                    Username
                </label>
                <input 
                    type="text" 
                    name="username" 
                    required
                    placeholder="Enter your username"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 transition"
                >
            </div>

            <!-- Password -->
            <div>
                <label class="block text-gray-600 font-semibold mb-1">
                    Password
                </label>
                <input 
                    type="password" 
                    name="password" 
                    required
                    placeholder="Enter your password"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-400 transition"
                >
            </div>

      

            <!-- Error Message Example -->
           <?php 
           if(isset($_GET["error"])){
               echo "<p class='text-red-500 text-sm text-center'>" . $_GET["error"] . "</p>";
           }
           ?>
        
            

            <!-- Submit Button -->
            <button 
                type="submit"
                class="w-full bg-emerald-500 text-white py-2 rounded-lg font-semibold hover:bg-emerald-600 transition duration-300"
            >
                Login
            </button>

        </form>

        <!-- Register Link -->
        <p class="text-center text-gray-600 text-sm mt-6">
            Don't have an account?
            <a href="register.php" class="text-blue-500 font-semibold hover:underline">
                Register
            </a>
        </p>

    </div>

</body>
</html>