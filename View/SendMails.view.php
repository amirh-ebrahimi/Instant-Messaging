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
    <title>Sent Mails</title>
</head>
<body>
<div class="topnav">
    <a class="active" href="../Controller/SignOut.controller.php">Sign Out</a>
    <a href="../Controller/Dashboard.controller.php">Send an Email</a>
    <a href="../Controller/SendEmails.controller.php">Sent Emails</a>
    <a href="../Controller/Inbox.controller.php">Inbox</a>
    <div class="search-container">
        <form method="get" action="../Controller/Search.controller.php">
            <label>Just attachment files</label>
            <input type="checkbox" name="attachment">
            <input type="text" placeholder="Search.." name="q">
            <button type="submit" name="search" value="sent"><i class="fa fa-search"></i></button>
        </form>
    </div>
</div>

<?php foreach ($sent_mails as $sent_mail): ?>
    <div class="container clearfix" style="margin: 20px ">
        <p>Subject: <span><?= $sent_mail["subject"] ?></span></p>
        <p>To : <span><?= $sent_mail["email_to"] ?></span></p>
        <?php if ($sent_mail["seen_status"] == 1): ?>
            <p><i class="fa fa-eye"></i></p>

        <?php else: ?>
            <p><i class="fa fa-eye-slash"></i></p>
        <?php endif; ?>
        <a href="../Controller/EmailDetails.controller.php?id=<?= $sent_mail["ID"] ?>">View Details</a>
    </div>
<?php endforeach; ?>
</body>
</html>



