<?php

class EasyAutoloader
{

	static $_paths = [
		'framework/controllers/',
		'framework/models/',
		'framework/classes/',
		'framework/exceptions/',
		'app/controllers/',
		'app/models/',
		'app/classes/'
	];

	public static function register() {
		spl_autoload_register(array(__CLASS__, 'autoload'));
	}

	private static function autoload($name) {

		foreach (self::$_paths as $path) {
			$file = "{$path}{$name}.php";
			if (file_exists($file)) {
				require_once $file;
			}
		}

	}

}