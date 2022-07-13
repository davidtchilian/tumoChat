
<?php

$to = 'areg.movsesyan.y@tumo.org';
$subject = 'Subject';
$message = 'Hello! How are you?';

$headers = "From: <areg.movsesyan.y@tumo.org>"."\r\n";

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <button onclick="<?php mail($to,$subject,$message,$headers); ?>">Send</button>
</body>
</html>
