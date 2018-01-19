<?php

class Car extends MainModel
{

		// 
	// function __construct() {
	// 	parent::initRelations();
	// }

	public $relations = [
		'Category' => 'has_one',
		'Cat' => 'has_many'
	];

	public function index() {

		echo "index car";
// 
		// echo "<pre>".print_r(ClassManager::getInstances(), true)."</pre>";
		// echo "<pre>".print_r(ClassManager::$controller, true)."</pre>";
		// echo "<pre>".print_r(ClassManager::$model, true)."</pre>";

		// $instances = ClassManager::getInstances();
		// $calling_controller = ClassManager::$controller;
		// $calling_model = ClassManager::$model;
// 
		// $caller = $instances[$calling_controller]->{$calling_model};

		// echo "<pre>".print_r($caller, true)."</pre>";

		// $callingMethod = debug_backtrace();
		// $class = strtolower(get_called_class());

		// echo "<pre>".print_r($callingMethod, true)."</pre>";


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