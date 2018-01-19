<?php

Class EasyController
{

	// - La méthode par défaut à exécuter
	public $default_method = 'index';

	// - Le nom du layout à utiliser par défaut
	public $default_layout = 'main';

	// - Chargement d'un modèle
	public function loadModel($modelName) {
		try {
			$model = ClassManager::getClassInstance($modelName, ['instance']);
			if (empty($model)) {
				throw new EasyExceptions($modelName);
			}
			return $model;
		} catch (Exception $e) {
			echo $e->missingModel();
		}
		return null;
	}

	// - Appel de l'affichage de la page
	public function display($data = [], $layout = null) {

		// - Définit la classe et la méthode appelante
		$callingMethod = debug_backtrace()[1]['function'];
		$class = strtolower(get_called_class());

		// - Définit le layout à utiliser
		if (empty($layout)) {
			$layout = $this->default_layout;
		}

		// - On test que le layout existe
		$layout_path = EasyPaths::get('Layout', "{$layout}.php");
		try {
			if (!file_exists($layout_path)) {
				throw new EasyExceptions([EasyPaths::get('Layout'), "{$layout}.php"]);
			}
		} catch (Exception $e) {
			$e->missingLayout();
		}

		// - On test que la vue existe
		$view_path = EasyPaths::get('View', "{$class}/{$callingMethod}.php");
		try {
			if (!file_exists($view_path)) {
				throw new EasyExceptions([EasyPaths::get('View', "{$class}/"), $callingMethod]);
			}
		} catch (Exception $e) {
			$e->missingView();
		}

		// - Callback beforeDisplay
		if (method_exists(get_class($this), 'beforeDisplay')) {
			$this->beforeDisplay();
		}

		// - Appel du layout
	    $stream = NULL;
	    extract($data);
        ob_start();
	    include $layout_path;
	    echo ob_get_clean();

		// - Appel de la vue
	    $stream = NULL;
	    extract($data);
        ob_start();
	    include $view_path;
	    echo ob_get_clean();

		// - Callback afterDisplay
		if (method_exists(get_class($this), 'afterDisplay')) {
			$this->afterDisplay();
		}
	}

	public function initController($child) {
		// - Le modèle prend le nom au singulier de l'élément
		$modelClass = EasyTools::singularize($child);
		$this->{$modelClass} = $this->loadModel($modelClass);
		$lower_child = strtolower($child);

		// - On test si le dossier des vues relatives existe
		try {
			if (!file_exists(EasyPaths::get('View', $lower_child))) {
				throw new EasyExceptions($lower_child);
			}
		} catch (Exception $e) {
			$e->missingViewFolder();
		}
	}

}