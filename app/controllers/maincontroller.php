<?php

class MainController extends EasyController
{

	
	public function beforeDisplay() {

		echo 'before display';

	}

	public function afterDisplay() {

		echo 'after display';

	}

}