'use strict';

const express = require('express');

// Constants
const PORT = 8080;
const HOST = '0.0.0.0';

// App
const app = express();
const workdir = '/usr/src/app/appjs/';

app.get('/', (req, res) => {
    res.sendFile(workdir + 'index.html');
});

app.get('/js/script.js', (req, res) => {
    res.sendFile(workdir + 'js/script.js');
});

app.get('/css/style.css', (req, res) => {
    res.sendFile(workdir + 'css/style.css');
});

app.listen(PORT, HOST);
