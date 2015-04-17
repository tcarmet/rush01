<?php

	namespace App;

	class Autoloader{
		
		static function register(){
			spl_autoload_register(array(__CLASS__, 'autoload'));
		}

		static function autoload($class){
			$class = str_replace('App\\', '', $class);
			$class = str_replace('\\', '/', $class);
			require 'app/' . $class . '.class.php';
		}
	}
?>