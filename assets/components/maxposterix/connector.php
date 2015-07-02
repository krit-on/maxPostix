<?php
/** @noinspection PhpIncludeInspection */
require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/config.core.php';
/** @noinspection PhpIncludeInspection */
require_once MODX_CORE_PATH . 'config/' . MODX_CONFIG_KEY . '.inc.php';
/** @noinspection PhpIncludeInspection */
require_once MODX_CONNECTORS_PATH . 'index.php';
/** @var maxPosterix $maxPosterix */
$maxPosterix = $modx->getService('maxposterix', 'maxPosterix', $modx->getOption('maxposterix_core_path', null, $modx->getOption('core_path') . 'components/maxposterix/') . 'model/maxposterix/');
$modx->lexicon->load('maxposterix:default');

// handle request
$corePath = $modx->getOption('maxposterix_core_path', null, $modx->getOption('core_path') . 'components/maxposterix/');
$path = $modx->getOption('processorsPath', $maxPosterix->config, $corePath . 'processors/');
$modx->request->handleRequest(array(
	'processors_path' => $path,
	'location' => '',
));