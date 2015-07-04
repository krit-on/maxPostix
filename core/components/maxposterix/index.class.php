<?php

/**
 * Class maxPosterixMainController
 */
abstract class maxPosterixMainController extends modExtraManagerController {
	/** @var maxPosterix $maxPosterix */
	public $maxPosterix;


	/**
	 * @return void
	 */
	public function initialize() {
		$corePath = $this->modx->getOption('maxposterix_core_path', null, $this->modx->getOption('core_path') . 'components/maxposterix/');
		require_once $corePath . 'model/maxposterix/maxposterix.class.php';

		$this->maxPosterix = new maxPosterix($this->modx);

		$this->addCss($this->maxPosterix->config['cssUrl'] . 'mgr/main.css');
		$this->addJavascript($this->maxPosterix->config['jsUrl'] . 'mgr/maxposterix.js');
		$this->addHtml('<script type="text/javascript">
		Ext.onReady(function() {
			maxPosterix.config = ' . $this->modx->toJSON($this->maxPosterix->config) . ';
			maxPosterix.config.connector_url = "' . $this->maxPosterix->config['connectorUrl'] . '";
		});
		</script>');

		parent::initialize();
	}


	/**
	 * @return array
	 */
	public function getLanguageTopics() {
		return array('maxposterix:default');
	}


	/**
	 * @return bool
	 */
	public function checkPermissions() {
		return true;
	}
}


/**
 * Class IndexManagerController
 */
class IndexManagerController extends maxPosterixMainController {

	/**
	 * @return string
	 */
	public static function getDefaultController() {
		return 'home';
	}
}