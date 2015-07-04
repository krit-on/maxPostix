<?php

/**
 * The home manager controller for maxPosterix.
 *
 */
class maxPosterixHomeManagerController extends maxPosterixMainController {
	/* @var maxPosterix $maxPosterix */
	public $maxPosterix;


	/**
	 * @param array $scriptProperties
	 */
	public function process(array $scriptProperties = array()) {
	}


	/**
	 * @return null|string
	 */
	public function getPageTitle() {
		return $this->modx->lexicon('maxposterix');
	}


	/**
	 * @return void
	 */
	public function loadCustomCssJs() {
		$this->addCss($this->maxPosterix->config['cssUrl'] . 'mgr/main.css');
		$this->addCss($this->maxPosterix->config['cssUrl'] . 'mgr/bootstrap.buttons.css');
		$this->addJavascript($this->maxPosterix->config['jsUrl'] . 'mgr/misc/utils.js');
		$this->addJavascript($this->maxPosterix->config['jsUrl'] . 'mgr/widgets/cars.grid.js');
		$this->addJavascript($this->maxPosterix->config['jsUrl'] . 'mgr/widgets/items.windows.js');
		$this->addJavascript($this->maxPosterix->config['jsUrl'] . 'mgr/widgets/home.panel.js');
		$this->addJavascript($this->maxPosterix->config['jsUrl'] . 'mgr/sections/home.js');
		$this->addHtml('<script type="text/javascript">
		Ext.onReady(function() {
			MODx.load({ xtype: "maxposterix-page-home"});
		});
		</script>');
	}


	/**
	 * @return string
	 */
	public function getTemplateFile() {
		return $this->maxPosterix->config['templatesPath'] . 'home.tpl';
	}
}