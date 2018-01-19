<?php



// ------------------------------------------------------------------------------------------------------------------------------------
// - Autloading
// ------------------------------------------------------------------------------------------------------------------------------------
	
// - On commence à écouter les classes à instancier grâce à l'autoloading
require_once "framework/classes/EasyAutoload.php";
EasyAutoloader::register();

// $o = new Observee();
// $o->attach

// die();

// ------------------------------------------------------------------------------------------------------------------------------------
// - Dispatcher
// ------------------------------------------------------------------------------------------------------------------------------------
	
$url_arguments = [];
if (!isset($_GET['ctr'])) {
	die('no controller');
} else {
	$url_arguments['controller'] = $_GET['ctr'];
}
$url_arguments['method'] = isset($_GET['act']) ? $_GET['act'] : 'default';
if (isset($_GET['arg'])) {
	$url_arguments['argument'] = $_GET['arg'];
}



// - Instansiation de la classe
$ctrl_name = ucfirst($url_arguments['controller']);

ClassManager::set([
	'controller' => $ctrl_name,
	'model' => EasyTools::singularize($ctrl_name)]
);

$ctrl = ClassManager::getClassInstance($ctrl_name);

try {
	if (empty($ctrl)) {
		throw new EasyExceptions($ctrl_name);
	}
} catch (Exception $e) {
	echo $e->missingController();
}

// - Définit le nom de la méthode par défaut au besoin
if ($url_arguments['method'] == 'default') {
	$url_arguments['method'] = $ctrl->default_method;
}

// - Contrôle que la méthode existe dans la classe instanciée
try {
	if(!method_exists($ctrl, $url_arguments['method'])) {
		throw new EasyExceptions([$url_arguments['controller'], $url_arguments['method']]);
	}
} catch (Exception $e) {
	echo $e->missingMethod();
}

// - Si tout est valide on appelle la méthode en question
if (array_key_exists('argument', $url_arguments)) {
	call_user_func(array($ctrl, $url_arguments['method']), $url_arguments['argument']);
} else { // - Appele de la méthode sans argument
	call_user_func(array($ctrl, $url_arguments['method']));
}

