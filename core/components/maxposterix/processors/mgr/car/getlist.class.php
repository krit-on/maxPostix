<?php

/**
 * Get a list of Items
 */
class mxCarsGetListProcessor extends modObjectGetListProcessor {
	public $objectType = 'mxCars';
	public $classKey = 'mxCars';
	public $defaultSortField = 'id';
	public $defaultSortDirection = 'DESC';
	//public $permission = 'list';


	/**
	 * * We doing special check of permission
	 * because of our objects is not an instances of modAccessibleObject
	 *
	 * @return boolean|string
	 */
	public function beforeQuery() {
		if (!$this->checkPermissions()) {
			return $this->modx->lexicon('access_denied');
		}

		return true;
	}


	/**
	 * @param xPDOQuery $c
	 *
	 * @return xPDOQuery
	 */
	public function prepareQueryBeforeCount(xPDOQuery $c) {
		$query = trim($this->getProperty('query'));
		if ($query) {
			$c->where(array(
				'resource_id:LIKE' => "%{$query}%",
				'OR:maxposter_id:LIKE' => "%{$query}%",
			));
		}

		return $c;
	}


	/**
	 * @param xPDOObject $object
	 *
	 * @return array
	 */
	public function prepareRow(xPDOObject $object) {
		$array = $object->toArray();
		$array['actions'] = array();

		// Edit
		$array['actions'][] = array(
			'cls' => '',
			'icon' => 'icon icon-edit',
			'title' => $this->modx->lexicon('maxposterix_car_update'),
			//'multiple' => $this->modx->lexicon('maxposterix_cars_update'),
			'action' => 'updateCar',
			'button' => true,
			'menu' => true,
		);

		if (!$array['active']) {
			$array['actions'][] = array(
				'cls' => '',
				'icon' => 'icon icon-power-off action-green',
				'title' => $this->modx->lexicon('maxposterix_car_enable'),
				'multiple' => $this->modx->lexicon('maxposterix_cars_enable'),
				'action' => 'enableCar',
				'button' => true,
				'menu' => true,
			);
		}
		else {
			$array['actions'][] = array(
				'cls' => '',
				'icon' => 'icon icon-power-off action-gray',
				'title' => $this->modx->lexicon('maxposterix_car_disable'),
				'multiple' => $this->modx->lexicon('maxposterix_cars_disable'),
				'action' => 'disableCar',
				'button' => true,
				'menu' => true,
			);
		}

		// Remove
		$array['actions'][] = array(
			'cls' => '',
			'icon' => 'icon icon-trash-o action-red',
			'title' => $this->modx->lexicon('maxposterix_car_remove'),
			'multiple' => $this->modx->lexicon('maxposterix_cars_remove'),
			'action' => 'removeCar',
			'button' => true,
			'menu' => true,
		);

		return $array;
	}

}

return 'mxCarsGetListProcessor';