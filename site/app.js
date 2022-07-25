const express = require('express');
const app = express();
const server = require('http').createServer(app);
const io = require('socket.io')(server);

app.get('/', (req, res) => {
    res.redirect(307,"http://localhost:8888/site" + "/views/index.php");
});

server.listen(3000, () => {
    console.log("Server has started.")
});