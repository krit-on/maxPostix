<?php

/**
 * Create an Item
 */
class mxCarsCreateProcessor extends modObjectCreateProcessor {
	public $objectType = 'mxCars';
	public $classKey = 'mxCars';
	public $languageTopics = array('maxposterix');
	//public $permission = 'create';


	/**
	 * @return bool
	 */
	public function beforeSet() {
		$name = trim($this->getProperty('resource_id'));
		if (empty($name)) {
			$this->modx->error->addField('resource_id', $this->modx->lexicon('maxposterix_car_err_name'));
		}
		elseif ($this->modx->getCount($this->classKey, array('name' => $name))) {
			$this->modx->error->addField('resource_id', $this->modx->lexicon('maxposterix_car_err_ae'));
		}

		return parent::beforeSet();
	}

}

return 'mxCarsCreateProcessor';