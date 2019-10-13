<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" type="text/css" href="../CSS/style.css">
</head>
<body>
<div class="login">
    <h1>Login</h1>
    <form action="../Controller/LogIn.controller.php" method="post">
        <label for="username">
            <i class="fas fa-user"></i>
        </label>
        <input type="text" name="username" placeholder="Username" id="username" >
        <label for="password">
            <i class="fas fa-lock"></i>
        </label>
        <input type="password" name="password" placeholder="Password" id="password" >
        <p>Remember Me</p>
        <input type="checkbox" name="remember" style="position: relative; top: 20px">
        <input type="submit" name="LogIn" value="Login">
    </form>
    <a href="../Controller/SignUp.controller.php">
        <button style="width: 100% ; padding: 15px; margin-top: 20px;
    background-color: #3274d6; border: 0; cursor: pointer; font-weight: bold;
    color: #ffffff; transition: background-color 0.2s;">Sign Up
        </button>
    </a>
</div>

</body>
</html>