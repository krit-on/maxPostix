<?php

/**
 * Disable an Item
 */
class maxPosterixItemDisableProcessor extends modObjectProcessor {
	public $objectType = 'maxPosterixItem';
	public $classKey = 'maxPosterixItem';
	public $languageTopics = array('maxposterix');
	//public $permission = 'save';


	/**
	 * @return array|string
	 */
	public function process() {
		if (!$this->checkPermissions()) {
			return $this->failure($this->modx->lexicon('access_denied'));
		}

		$ids = $this->modx->fromJSON($this->getProperty('ids'));
		if (empty($ids)) {
			return $this->failure($this->modx->lexicon('maxposterix_item_err_ns'));
		}

		foreach ($ids as $id) {
			/** @var maxPosterixItem $object */
			if (!$object = $this->modx->getObject($this->classKey, $id)) {
				return $this->failure($this->modx->lexicon('maxposterix_item_err_nf'));
			}

			$object->set('active', false);
			$object->save();
		}

		return $this->success();
	}

}

return 'maxPosterixItemDisableProcessor';
