<?php
	class Autoloader{
		
		static function register(){
			spl_autoload_register(array(__CLASS__, 'autoload'));
		}

		static function autoload($class_name){
			require 'app/' . $class_name . '.class.php';
		}
	}
?>