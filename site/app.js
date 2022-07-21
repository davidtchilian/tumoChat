const express = require('express');
const app = express();
const server = require('http').createServer(app);
const io = require('socket.io')(server);
const res = require('express/lib/response');
var phpnode = require('php-node'); 
// var engine  = require('ejs-locals');

// app.engine( 'ejs', engine );
app.set( 'view engine', 'ejs' );
app.engine('php', phpnode);
app.set('view engine', 'php');

app.get('/', (req, res) => {  
    res.render("index.php"); 
});

server.listen(3000, () => {
    console.log("Server has started.")
});
