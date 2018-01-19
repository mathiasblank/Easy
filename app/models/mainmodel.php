<?php

abstract class MainModel extends EasyModel
{

	// public $singleton;
	
	public $relations = [];

	public $name;

	public $level;

	// public $relation1;
	// public $relation_2;
	// public $relation_3;

	private $_db_relations = [];

	public function __construct($options = []) {

		// global $singleton;
		// $this->singleton = $singleton;

		// if (empty($options)) return;
// 
		// - Définit le type de relations
			// echo "<pre>".print_r(ClassManager::getKeys(), true)."</pre>";

		$this->name = get_called_class();
		$low_name = strtolower($this->name);

		$i = 1;

		if (!empty($options)) {
			ClassManager::resetLevel();
		}

		// ClassManager::nextLevel();

		// foreach ($this->relations as $model => $type) {
		// 	// echo "{$level}){$this->name} -> $model<br>";
		// 	ClassManager::addKeyModel($model);
		// }

		echo "<pre>".print_r(get_declared_classes(), true)."</pre>";

		// return;

		echo "<pre>".print_r(ClassManager::get('_keys'), true)."</pre>";

		foreach ($this->relations as $model => $type) {

			$low_model = strtolower($model);

			if (!ClassManager::canUseModel($model) || ClassManager::hasKey($model) || isset($this->{$model})) continue;

			// echo "here $model";

			// ClassManager::$model_per_level[$level][] = $model;

			// if ($this->name === $this->{$model}->name) continue;

			// echo "<pre>".print_r(ClassManager::getInstances($model), true)."</pre>";

			// $relation = $model;
			$this->{$model} = ClassManager::getClassInstance($model);


			switch ($type) {
				case 'has_many':
					$this->_db_relations[$model] = "`$low_model`.`id` = `$low_name`.`{$low_model}_id`";
					break;
				case 'has_one':
					$this->_db_relations[$model] = "`$low_model`.`{$low_name}_id` = `$low_name`.`id`";
					break;
			}
			$i++;
		}

		// ClassManager::nextLevel();

		// echo "<pre>".print_r(ClassManager::getInstances(), true)."</pre>";

		// echo "<pre>".print_r($this->relations, true)."</pre>";
		// echo "<pre>".print_r($this->_db_relations, true)."</pre>";

	}


}