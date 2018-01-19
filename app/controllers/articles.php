<?php

Class Articles extends MainController {

	// public $default_method = 'er';§


	public function index() {


		$categories = $this->Article->index();
		// echo $categories = $this->Article->Category->Car->index();

		

		// die();
		// $articles = $this->Article->index();
		// $this->display(
		// 	compact(
		// 		'articles'
		// 	)
		// );

	}

	public function test($id) {
		// echo 'test'.$id;
		$this->display();
				
	}

	public function er() {
		echo "er";
	}

	public function beforeDisplay() {

		echo 'before display article';

	}

}