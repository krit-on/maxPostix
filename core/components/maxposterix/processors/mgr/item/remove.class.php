<?php

/**
 * Remove an Items
 */
class maxPosterixItemRemoveProcessor extends modObjectProcessor {
	public $objectType = 'maxPosterixItem';
	public $classKey = 'maxPosterixItem';
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
			return $this->failure($this->modx->lexicon('maxposterix_item_err_ns'));
		}

		foreach ($ids as $id) {
			/** @var maxPosterixItem $object */
			if (!$object = $this->modx->getObject($this->classKey, $id)) {
				return $this->failure($this->modx->lexicon('maxposterix_item_err_nf'));
			}

			$object->remove();
		}

		return $this->success();
	}

}

return 'maxPosterixItemRemoveProcessor';