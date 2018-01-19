<?php

class Color extends MainModel
{

	public $relations = [
		'Category' => 'has_many'
	];

	public function index () {
		echo 'index category';
	}

}