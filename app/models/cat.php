<?php

class Cat extends MainModel
{

	public $relations = [
		'Article' => 'has_one',
		'Car' => 'has_one'
	];

	public function index () {
		echo 'index cat';


	}

}