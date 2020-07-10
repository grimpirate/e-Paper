<?php
require 'flight/Flight.php';

Flight::route('/', function(){
    Flight::render('main');
    exec('../epd');
});

Flight::start();
