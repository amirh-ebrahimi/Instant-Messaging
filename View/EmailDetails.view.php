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
    <title>Email Details</title>
</head>
<body>
<div class="topnav">
    <a class="active" href="../Controller/SignOut.controller.php">Sign Out</a>
    <a href="../Controller/Dashboard.controller.php">Send an Email</a>
    <a href="../Controller/SendEmails.controller.php">Sent Emails</a>
    <a href="../Controller/Inbox.controller.php">Inbox</a>
</div>
<div class="detail-container">
<p>Subject : <?= $email["subject"] ?></p>
<p> Fom: <?= $email["email_from"] ?></p>
<p> To: <?= $email["email_to"] ?></p>
<p style="border: none"><?= $email["details"] ?></p>

<?php if (!empty($email["addr"])): ?>
    <a href="<?= $email["addr"] ?>">
        Attachment
    </a>
<?php endif; ?>
</div>
</body>
</html>