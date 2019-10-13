<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>SignUp</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" type="text/css" href="../CSS/style.css">
</head>
<body>
<div class="login">
    <h1>Sign Up</h1>
    <form action="../Controller/SignUp.controller.php" method="post">
        <label for="username">
            <i class="fas fa-user"></i>
        </label>
        <input type="text" name="username" placeholder="Username" id="username" >
        <label for="password">
            <i class="fas fa-lock"></i>
        </label>
        <input type="password" name="password" placeholder="Password" id="password" >
        <label for="name">
            <i class="fa fa-address-book"></i>
        </label>
        <input type="text" name="name" placeholder="Name" id="name" >
        <label for="family">
            <i class="fa fa-address-book"></i>
        </label>
        <input type="text" name="family" placeholder="Family" id="family" >
        <label for="city">
            <i class="fa fa-globe"></i>
        </label>
        <input type="text" name="city" placeholder="City" id="city" >
        <input type="submit" name="SignUp" value="SignUp">
    </form>
    <a href="../Controller/LogIn.controller.php">
    <button style="width: 100% ; padding: 15px; margin-top: 20px;
    background-color: #3274d6; border: 0; cursor: pointer; font-weight: bold;
    color: #ffffff; transition: background-color 0.2s;">Login</button>
    </a>
</div>
<div class="show-massage">
    <?php if (count($errors) >= 1): ?>
    <?php foreach ($errors as $error): ?>
    <p class="error"> <?=$error?> </p>
    <?php endforeach;?>
    <?php elseif ($signup_flag): ?>
    <p class="success">You Signed Up Successfully</p>
    <?php endif;?>
</div>
</body>
</html>