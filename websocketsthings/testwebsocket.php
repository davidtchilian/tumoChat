<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    the test
    <script>
        var conn = new WebSocket('wss://localhost:8080/petitchat');
        conn.onopen = function(e) {
            console.log("Connection established!");
            conn.send('Hello World');
        };

        conn.onmessage = function(e) {
            console.log(e.data);
        };
    </script>
</body>

</html>