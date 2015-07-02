<?php

/**
 * Create an Item
 */
class maxPosterixItemCreateProcessor extends modObjectCreateProcessor {
	public $objectType = 'maxPosterixItem';
	public $classKey = 'maxPosterixItem';
	public $languageTopics = array('maxposterix');
	//public $permission = 'create';


	/**
	 * @return bool
	 */
	public function beforeSet() {
		$name = trim($this->getProperty('name'));
		if (empty($name)) {
			$this->modx->error->addField('name', $this->modx->lexicon('maxposterix_item_err_name'));
		}
		elseif ($this->modx->getCount($this->classKey, array('name' => $name))) {
			$this->modx->error->addField('name', $this->modx->lexicon('maxposterix_item_err_ae'));
		}

		return parent::beforeSet();
	}

}

return 'maxPosterixItemCreateProcessor';