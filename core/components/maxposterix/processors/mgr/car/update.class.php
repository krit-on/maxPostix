<?php

/**
 * Update an Item
 */
class mxCarsUpdateProcessor extends modObjectUpdateProcessor {
	public $objectType = 'mxCars';
	public $classKey = 'mxCars';
	public $languageTopics = array('maxposterix');
	//public $permission = 'save';


	/**
	 * We doing special check of permission
	 * because of our objects is not an instances of modAccessibleObject
	 *
	 * @return bool|string
	 */
	public function beforeSave() {
		if (!$this->checkPermissions()) {
			return $this->modx->lexicon('access_denied');
		}

		return true;
	}


	/**
	 * @return bool
	 */
	public function beforeSet() {
		$id = (int)$this->getProperty('id');
		$resource_id = trim($this->getProperty('resource_id'));
		if (empty($id)) {
			return $this->modx->lexicon('maxposterix_car_err_ns');
		}

		if (empty($resource_id)) {
			$this->modx->error->addField('resource_id', $this->modx->lexicon('maxposterix_car_err_resource_id'));
		}
		elseif ($this->modx->getCount($this->classKey, array('resource_id' => $resource_id, 'id:!=' => $id))) {
			$this->modx->error->addField('resource_id', $this->modx->lexicon('maxposterix_car_err_ae'));
		}

		return parent::beforeSet();
	}
}

return 'mxCarsUpdateProcessor';
