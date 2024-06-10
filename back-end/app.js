const express = require('express');
const path = require('path');
const router = require('./route/route.js');
const app = express();

const server = app.listen(3000, () => {
    console.log('Server is running on port 3000');
});

const io = require('socket.io')(server, {
    cors: {
        origin: ['http://127.0.0.1:8000'],
    },
});

io.on('connection', socket => {
    app.use(router);
    console.log(socket.id);
    socket.emit('socket-id', socket.id); // Send socket ID to the client
});

// Apply router
app.use(router);
