<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../CSS/dashboard.css">
    <link rel="stylesheet" type="text/css" href="../CSS/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Email</title>
</head>
<body>
<div class="topnav">
    <a class="active" href="../Controller/SignOut.controller.php">Sign Out</a>
    <a href="../Controller/Dashboard.controller.php">Send an Email</a>
    <a href="../Controller/SendEmails.controller.php">Sent Emails</a>
    <a href="../Controller/Inbox.controller.php">Inbox</a>
</div>

<h2>Welcome <?= $username; ?></h2>

<form enctype="multipart/form-data" method="post" action="../Controller/Dashboard.controller.php">
    <div class="container">
        <input type="text" name="subject" placeholder="Subject"><br>
        <input type="text" name="send_to" placeholder="Email (To send email to many users separate them with ',' )">
        <textarea name="details"></textarea><br>
        <p>Attachment</p>
        <input type="file" name="attachment"><br>
        <input type="submit" name="send" value="send">
    </div>
</form>

<div class="show-massage">
    <?php if (count($errors) >= 1): ?>
        <?php foreach ($errors as $error): ?>
            <p class="error"> <?= $error ?> </p>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

</body>
</html>