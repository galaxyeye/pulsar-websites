<?php

class AppModel extends Model {

 	public $actsAs = array('Containable');

	public function &getModel($name = null) {
		$model = null;
		if (!$name) {
			$name = $this->name;
		}

		if (PHP5) {
			$model = ClassRegistry::init($name);
		} else {
			$model =& ClassRegistry::init($name);
		}

		if (empty($model)) {
			trigger_error(__('Auth::getModel() - Model is not set or could not be found', true), E_USER_WARNING);
			return null;
		}

		return $model;
	}
}
