<?php
ini_set('display_errors', 1);
ini_set('error_reporting', 1);

if (empty($_REQUEST['type'])) {
    die('Access denied');
}
else {
    $type = $_REQUEST['type'];
}

define('MODX_API_MODE', true);

require_once dirname(dirname(dirname(dirname(dirname(dirname(__FILE__)))))).'/index.php';

$modx->getService('error','error.modError');
$modx->getRequest();
$modx->setLogLevel(modX::LOG_LEVEL_ERROR);
$modx->setLogTarget('FILE');
$modx->error->message = null;

/** @var array $scriptProperties */
/* @var maxPosterix $maxPosterix */
$maxPosterix = $modx->getService('maxposterix','maxPosterix',$modx->getOption('maxposterix_core_path',null,$modx->getOption('core_path').'components/maxposterix/').'model/maxposterix/');
/** @var pdoTools $pdoTools */
$pdoTools = $modx->getService('pdoTools');

if (!($maxPosterix instanceof maxPosterix) || !($pdoTools instanceof pdoTools)) return '';

/* @var mxCars $mxCars */
$mxCars = $modx->getObject('mxCars', 3);

$processorProps = [
    'id' => 3
];
$otherProps = [
    'processors_path' => $modx->getOption('maxposterix_core_path') . 'processors/'
];

$export = $modx->runProcessor('mgr/car/export', $processorProps, $otherProps);
print_r($export->response);
