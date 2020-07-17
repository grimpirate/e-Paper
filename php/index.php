<?php
require 'vendor/autoload.php';

use Mike42\GfxPhp\Image;

error_reporting(E_ALL);

Flight::route('POST /', function() {
	if(!is_null(Flight::request()->files->upload)) {
		$uploads = array_map(function($ele) {
			$temp = Image::fromFile($ele)->toBlackAndWhite();
			$temp->invert();
			return $temp->getRasterData();
		}, Flight::request()->files->upload['tmp_name']);

		file_put_contents('black', $uploads[0]);
		file_put_contents('red', $uploads[1]);

		while(!file_exists('black') || !file_exists('red')) usleep(500);

		exec('../epd');
	
		unlink('black');
		unlink('red');
	}
	Flight::render('get');
	/*$foo = array_map(function($ele){
		return pack('C',$ele);
	}, array_merge(array_fill(0, 104/8*212/2, 0xff),array_fill(0, 104/8*212/2, 0x00)));
	file_put_contents('black', implode('', $foo));*/
});

Flight::route('GET /', function(){
	Flight::render('post');
});

Flight::start();
