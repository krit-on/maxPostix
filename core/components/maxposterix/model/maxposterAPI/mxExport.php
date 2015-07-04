<?php
class mxExport extends maxXmlClient
{
    static private
        // Параметры класса
        $initOptions = array();
    private $responseHeaders;

    /**
     * Установка параметров класса
     *
     * @param array $_initOptions
     */
    static public function setInitOptions(array $_initOptions)
    {
        self::$initOptions = $_initOptions;
    }


    /**
     * Создание нового экземпляра класса с установленными параметрами инициализации
     *
     * @return mxExport
     */
    static public function createInstance()
    {
        return new mxExport(self::$initOptions);
    }

    /**
     * Метод перекрыт для возврата xml
     */
    public function getXml()
    {

        if (!($this->xml instanceof DOMDocument))
        {
            try
            {

          $this->loadXml();


            }
            catch (maxException $e)
            {
                $this->setErrorXml($e);
            }
        }
            return $this->xml;
    }


    protected function loadXmlFromMirror($_path)
    {
        // Сброс заголовков о времени генерации данных и сроке годности
        $this->responseHeaders = array(0, 0);

        try
        {
            $ch = $this->initCurl($_path, $this->getRequestParams());
            $xml = curl_exec($ch);

            curl_close($ch);
        }

        catch (maxException $e)
        {
            $xml = false;
        }

        if(false != $xml)
        {

            $ret = $xml;
//            $ret = new DOMDocument();
//            $ret->loadXML($xml);

        }
        else
        {
            $ret = false;
        }

        return $ret;
    }
}
