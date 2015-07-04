<?php
require_once __DIR__ . '/../../../model/maxposterAPI/autoload.php';
/**
 * Create an Item
 */
class mxCarsExportProcessor extends modObjectProcessor {
    public $objectType = 'mxCars';
    public $classKey = 'mxCars';
    public $languageTopics = array('maxposterix');
    //public $permission = 'create';


    public function process() {
        return self::mxGetAds();

    }

    public static function mxGetAds() {
        mxExport::setInitOptions(array(
            // Код автосалона
            'dealer_id' => 754,

            // Пароль для доступа к данным
            'password' => 'autodon754',

            // Номер используемой версии API
            'api_version' => 1
        ));

        $client = mxExport::createInstance();
        $client->setRequestThemeName('full_vehicles');

        $xmlads = new SimpleXMLElement($client->getXml());

        foreach ($xmlads->vehicles->vehicle as $vehicle) {
            $vehicle_id = (string)$vehicle['vehicle_id'];
            $all_vehicles[$vehicle_id] = $vehicle;
        }

        return $all_vehicles;
    }

}

return 'mxCarsExportProcessor';