<?php
require 'vendor/autoload.php';

use Mike42\GfxPhp\Image;

error_reporting(0);

if(
	!password_verify($_SERVER['PHP_AUTH_USER'], getenv('E_PAPER_USER_HASH')) ||
	!password_verify($_SERVER['PHP_AUTH_PW'], getenv('E_PAPER_PASSWORD_HASH'))
) {
	header('WWW-Authenticate: Basic realm="E-Paper"');
	header('HTTP/1.0 401 Unauthorized');
	die();
}

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
	Flight::render('post');
	/*$foo = array_map(function($ele){
		return pack('C',$ele);
	}, array_merge(array_fill(0, 104/8*212/2, 0xff),array_fill(0, 104/8*212/2, 0x00)));
	file_put_contents('black', implode('', $foo));*/
});

Flight::route('GET /', function(){
	Flight::render('post');
});

Flight::start();
