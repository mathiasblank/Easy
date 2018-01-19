<?php

class EasyPaths {

	const APP_CONTROLLERS = 'app/controllers/';
	const APP_MODELS = 'app/models/';
	const APP_VIEWS = 'app/views/';
	const APP_LAYOUTS = 'app/views/layouts/';

	const FRAMEWORK_CONTROLLERS = 'framework/controllers/';
	const FRAMEWORK_MODELS = 'framework/models/';
	const FRAMEWORK_VIEWS = 'framework/views/';

	public static function get($type, $name = '', $options = array('is_app' => true)) {

		$path = null;
		switch (strtolower($type)) {
			case 'controller':
				$path = $options['is_app'] ? self::APP_CONTROLLERS : self::FRAMEWORK_CONTROLLERS;
				break;
			
			case 'model':
				$path = $options['is_app'] ? self::APP_MODELS : self::FRAMEWORK_MODELS;
				break;

			case 'view':
				$path = $options['is_app'] ? self::APP_VIEWS : self::FRAMEWORK_VIEWS;
				break;

			case 'layout':
				$path = self::APP_LAYOUTS;
				break;
		}

		return $path.$name;

	}


}