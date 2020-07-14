<?php
require 'flight/Flight.php';

Flight::route('/', function(){
    Flight::render('main');
    $foo = array_map(function($ele){
    return pack('C',$ele);
}, array_fill(0, 104/8*212, 0));

file_put_contents('../black', implode('', $foo));
    exec('../epd');
});

Flight::start();
