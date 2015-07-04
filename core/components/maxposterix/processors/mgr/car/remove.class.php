<?php

/**
 * Remove an Items
 */
class mxCarsRemoveProcessor extends modObjectProcessor {
	public $objectType = 'mxCars';
	public $classKey = 'mxCars';
	public $languageTopics = array('maxposterix');
	//public $permission = 'remove';


	/**
	 * @return array|string
	 */
	public function process() {
		if (!$this->checkPermissions()) {
			return $this->failure($this->modx->lexicon('access_denied'));
		}

		$ids = $this->modx->fromJSON($this->getProperty('ids'));
		if (empty($ids)) {
			return $this->failure($this->modx->lexicon('maxposterix_car_err_ns'));
		}

		foreach ($ids as $id) {
			/** @var mxCars $object */
			if (!$object = $this->modx->getObject($this->classKey, $id)) {
				return $this->failure($this->modx->lexicon('maxposterix_car_err_nf'));
			}

			$object->remove();
		}

		return $this->success();
	}

}

return 'mxCarsRemoveProcessor';