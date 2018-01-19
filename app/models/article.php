<?php

class Article extends MainModel
{

		// 
	// function __construct() {
	// 	parent::initRelations();
	// }

	public $relations = [
		'Cat' => 'has_one',
		'Category' => 'has_one'
	];

	public function index() {
// 
		// echo isset($this->Category) ? 'YES' : 'NO';
		// echo isset($this->Cat) ? 'YES' : 'NO';
		
		echo 'index article';

		// Singleton::get();

		// if (Singleton::hasInstance('Article')) {
		// 	echo 'instanciate';
		// }

		// echo $this->Category->index();

		// echo 'index model';
		// $data = ['data', 'data2'];
		// return $data;

	}
}