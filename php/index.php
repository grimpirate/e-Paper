<?php
require 'vendor/autoload.php';

use Mike42\GfxPhp\Image;

error_reporting(E_ALL);

Flight::route('/', function(){
	Flight::render('main');

	/*$foo = array_map(function($ele){
		return pack('C',$ele);
	}, array_merge(array_fill(0, 104/8*212/2, 0xff),array_fill(0, 104/8*212/2, 0x00)));
	file_put_contents('black', implode('', $foo));*/
	$img = Image::fromFile("test.png");
	file_put_contents('black', $img->toBlackAndWhite()->getRasterData());
	
	while(!file_exists('black')) usleep(500);
	exec('../epd');
	unlink('black');
});

Flight::start();
