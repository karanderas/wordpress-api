'use strict';

// Variables
var express = require('express');
var app = express();
var workdir = '/usr/src/app/appjs/';

// Constants
const PORT = 8080;
const HOST = '0.0.0.0';

app.get('/', (req, res) => {
    res.sendFile(workdir + 'home.html');
});

app.get('/products', (req, res) => {
    res.sendFile(workdir + 'products.html');
});

app.get('/product/:id', (req, res) => {
    res.sendFile(workdir + 'product.html');
});

app.get('/js/script.js', (req, res) => {
    res.sendFile(workdir + 'js/script.js');
});

app.get('/css/style.css', (req, res) => {
    res.sendFile(workdir + 'css/style.css');
});

app.listen(PORT, HOST);
