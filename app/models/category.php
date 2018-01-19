<?php

class Category extends MainModel
{

	public $relations = [
		'Article' => 'has_one',
		'Car' => 'has_one'
		// 'Color' => 'has_one'
	];

	public function index () {
		echo 'index category';

		// echo "<pre>".print_r(ClassManager::$_modelKey_per_level, true)."</pre>";
	}

}