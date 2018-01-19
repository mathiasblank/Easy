<?php

// - Il s'agit d'un singleton externe gérant les instances des classes

class ClassManager
{

	private $_instances = [];

    private $_keys = [];

    // public static $controller;

    // public static $model;

    private $_level = 0;

    public $modelKey_per_level = [];

    public static function set($args) {
        // echo "<pre>".print_r($args, true)."</pre>";
        $_this = ClassManager::getInstance();
        foreach ($args as $arg => $value) {
            // echo "<pre>".print_r($arg, true)."</pre>";
            $_this->{$arg} = $value;
        }
        // echo "<pre>Value: $arg -> ".print_r($_this->{$arg}, true)."</pre>";

        $_this = ClassManager::getInstance();
        // echo "<pre>".print_r($_this, true)."</pre>";

    }

    public static function getInstance() {
        static $instance = false;
        if( $instance === false ) {
            $instance = new static();
        }
        return $instance;
    }

    public static function nextLevel() {
        $_this = ClassManager::getInstance();
        $_this->_level++;
    }

    public static function resetLevel() {
        $_this = ClassManager::getInstance();
        $_this->_level = 0;
    }

    public static function get($arg) {
        $_this = ClassManager::getInstance();
        return $_this->{$arg};
    }

    public static function addKeyModel($model) {

        $_this = ClassManager::getInstance();

        if ($model == $_this->model) return;

        $models = $_this->modelKey_per_level;

        $exists = false;
        if (!empty($models)) {
            foreach ($models as $level => $data) {
                if (in_array($model, $data) && $level < $_this->_level) {
                    $exists = true;
                }
            }
        }

        if (!$exists) {
            echo $model;
            $_this->modelKey_per_level[$_this->_level][] = $model;
        }

        // echo "<pre>model keys: ".print_r($_this->modelKey_per_level, true)."</pre>";
    }

    public static function canUseModel($model) {
        $_this = ClassManager::getInstance();
        $models = $_this->modelKey_per_level;

        if ($_this->_level == 0) {
            return true;
        }

        return isset($models[$_this->_level]) && in_array($model, $models[$_this->_level]);
    }

    public static function getClassInstance($class, $options = []) {

        // echo " $class ";

        $_this = ClassManager::getInstance();

        // echo $_this->_level;
        // echo "<pre>controller:".print_r($_this->controller, true)."</pre>";
        // echo "<pre>¨model:".print_r($_this->model, true)."</pre>";
        $instance = null;

        echo "<pre>".print_r(self::hasKey($class), true)."</pre>";

        // if (!self::hasKey($class)) {

            array_push($_this->_keys, $class.' - '.$_this->_level);

            $instance = !empty($options) ? new $class($options) : new $class;

            if (method_exists($instance, 'initController')) {
                $instance->initController($class);
            }

            $_this->_instances[$class] = $instance;

        // }


        // echo "<pre>".print_r($_this->_instances[$class], true)."</pre>";

        return $instance;
    }

    public static function getInstances() {
        $_this = ClassManager::getInstance();
        return $_this->_instances;
    }

    public static function hasInstance($class) {
        // echo $class;
        $_this = ClassManager::getInstance();
        // - S'il existe une instance de contrôleur celle du modèle sera automatiquement créé
        return array_key_exists($class, $_this->_instances) || array_key_exists($class.'s', $_this->_instances);
    }

    public static function getKeys() {
        $_this = ClassManager::getInstance();
        return $_this->_keys;
    }

    public static function hasKey($class) {
        $_this = ClassManager::getInstance();

        echo "<pre>".print_r($_this->_keys, true)."</pre>";
        // echo '<br>';
        // echo in_array($class, $_this->_keys) ? 'YES' : 'NO';
        // echo "<pre>".print_r($class, true)."</pre>";
        return in_array($class, $_this->_keys);
    }

}