<?php
session_start();
require __DIR__ . "/db.php";

$error = "";

/* =======================
   SIGNUP
======================= */
// if (isset($_POST["signup"])) {

//     $username = trim($_POST["username"]);
//     $password = $_POST["password"];
//     // if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d).{6,}$/', $password)) {

//     //     $error = "Password must be at least 6 characters and contain at least one letter and one number.";

//     // } 
//     // else {

//     $check = mysqli_prepare($conn, "SELECT id FROM users WHERE username = ?");
//     mysqli_stmt_bind_param($check, "s", $username);
//     mysqli_stmt_execute($check);
//     $res = mysqli_stmt_get_result($check);

//     if (mysqli_fetch_assoc($res)) {
//         $error = "Username already exists";
//     } else {

//         $hashed = password_hash($password, PASSWORD_BCRYPT);

//         $stmt = mysqli_prepare($conn, "INSERT INTO users (username, password) VALUES (?, ?)");
//         mysqli_stmt_bind_param($stmt, "ss", $username, $hashed);
//         mysqli_stmt_execute($stmt);

//         $_SESSION["user_id"] = mysqli_insert_id($conn);
//         $_SESSION["username"] = $username;

//         header("Location: dashboard.php");
//         exit;
//     }
// //   }  
// }

/* =======================
   LOGIN
======================= */
if (isset($_POST["login"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];
    // if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d).{6,}$/', $password)) {

    //     $error = "Password must be at least 6 characters and contain at least one letter and one number.";

    // } else {

    $stmt = mysqli_prepare($conn, "SELECT id, username, password FROM users WHERE username = ?");
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($user = mysqli_fetch_assoc($result)) {

        if (password_verify($password, $user["password"])) {

            $_SESSION["user_id"] = $user["id"];
            $_SESSION["username"] = $user["username"];

            header("Location: dashboard.php");
            exit;

        } else {
            $error = "Invalid password";
        }

    } else {
        $error = "User not found";
    }
//   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Auth</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background: linear-gradient(135deg, #0d6efd, #6f42c1);
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

.auth-card {
    width: 420px;
    background: #fff;
    border-radius: 15px;
    padding: 30px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}

.toggle-btns button {
    width: 50%;
}

.hidden {
    display: none;
}
</style>
</head>

<body>

<div class="auth-card">

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <!-- TOGGLE -->
    <div class="btn-group w-100 mb-3 toggle-btns">
        <button class="btn btn-primary" onclick="showLogin()">Login</button>
        <!-- <button class="btn btn-outline-primary" onclick="showSignup()">Signup</button> -->
    </div>

    <!-- LOGIN -->
    <form method="POST" id="loginForm">

        <h4 class="text-center mb-3">Welcome Back Admin</h4>

        <input type="text" name="username" class="form-control mb-2" placeholder="Username" required>

        <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>

        <button name="login" class="btn btn-primary w-100">Login</button>
        <a href="../index.php" class="btn btn-outline-secondary w-100 mt-3">
        العودة إلى الصفحة الرئيسية
        </a>
    </form>

    <!-- SIGNUP -->
    <!-- <form method="POST" id="signupForm" class="hidden">

        <h4 class="text-center mb-3">Create Account</h4>

        <input type="text" name="username" class="form-control mb-2" placeholder="Username" required>

        <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>

        <button name="signup" class="btn btn-success w-100">Signup</button>
        <a href="../index.php" class="btn btn-outline-secondary w-100 mt-3">
        العودة إلى الصفحة الرئيسية
        </a>
    </form> -->

</div>

<script>
function showLogin() {
    document.getElementById("loginForm").classList.remove("hidden");
    document.getElementById("signupForm").classList.add("hidden");
}

function showSignup() {
    document.getElementById("signupForm").classList.remove("hidden");
    document.getElementById("loginForm").classList.add("hidden");
}
</script>

</body>
</html>