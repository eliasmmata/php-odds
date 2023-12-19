<?php

/**
 * Clase padre para gestionar los controladores
 * @author Yisus Gómez
 */

namespace BesoccerOdds\Classes;

use BesoccerOdds\Helpers\InfoHelper;
use BesoccerOdds\Helpers\UrlHelper;

class Controller
{
    /**
     * Variables para guardar la configuración de los parámetros
     */
    var $postParams = [];
    var $getParams = [];
    var $urlParams = [];
    var $infoPage;

    /**
     * Constructor del controlador general. Inicializa el benchmark
     * 
     * @param bool $enableErrors (Activa o desactiva los errores)
     * @param bool $cache (Activa o desactiva la cache)
     */
   function __construct($enableErrors = TRUE, $cache = FALSE)
   {

        if($enableErrors){

            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);

        }        

        $this->postParams = UrlHelper::getPostParams();
        $this->getParams = UrlHelper::getGetParams();
        $this->urlParams = UrlHelper::getUrlParams();

        Benchmark::getInstance();

    }

    /**
     * Devuelve los parámetros POST en función a un array de valores,
     * si no se pasa, se devolverá todo el POST
     * 
     * @param array $postKeys (Claves a filtrar)
     * 
     * @return array
     */
    protected function getPostParams(array $postKeys = []): array
    {
        $params = [];

        foreach ($this->postParams as $key => $value) {
            
            if(!empty($postKeys)){
                if(in_array($key, $postKeys)){

                    $params[$key] = $value;
    
                }
            }else{

                $params[$key] = $value;

            }
        }

        return $params;
    }

    /**
     * Devuelve los parámetros GET en función a un array de valores,
     * si no se pasa, se devolverá todo el GET
     * 
     * @param array $getKeys (Claves a filtrar)
     * 
     * @return array
     */
    protected function getGetParams(array $getKeys = []): array
    {
        $params = [];

        foreach ($this->getParams as $key => $value) {
            
            if(!empty($getKeys)){
                if(in_array($key, $getKeys)){

                    $params[$key] = $value;
    
                }
            }else{

                $params[$key] = $value;

            }
        }

        return $params;
    }

    /**
     * Devuelve los parámetros referentes a la URL
     * @return array
     */
    protected function getUrlParams():array
    {
        return $this->urlParams;
    }

    /**
     * Devuelve la url actual
     */
    protected function getCurrentUrl() : string
    {
        $urlParams = $this->getUrlParams();
        return $urlParams["HTTP_HOST"] . $urlParams["REQUEST_URI"];
    }

    /**
     * Carga las distintas vistas para montar el HTML
     * @param string $mainView (Nombre del archivo de la vista)
     * @param mixed $dataItem (Array con los valores pasados a la vista)
     * @param array $dataJs (Array con los archivos js necesarios)
     */
    protected function doHtml(string $mainView, $dataItem, array $dataJs=array()): void
    {

        $requestParams = [
            'POST' => $this->getPostParams(),
            'GET' => $this->getGetParams(),
            'URL' => $this->getUrlParams(),
        ];

        $benchmark = Benchmark::getInstance();

        $benchmark->setUrlBenchmarkData($requestParams['POST'], 'POST');
        $benchmark->setUrlBenchmarkData($requestParams['GET'], 'GET');
        $benchmark->setUrlBenchmarkData($requestParams['URL'], 'URL');

        // InfoPage         
        $infoPage = $this->infoPage->getInfo();

        // Incluir JS y CSS si fuera necesario (TODO)

        include_once(VIEWS_FOLDER.'/commons/main_title.php');
        include_once(VIEWS_FOLDER.'/commons/left_sidebar.php');
        include_once(VIEWS_FOLDER.'/commons/info.php');
        include_once(VIEWS_FOLDER.'/'.$mainView.'.php');
        include_once(VIEWS_FOLDER.'/commons/footer.php');

        if(BENCHMARK){
            include_once(VIEWS_FOLDER.'/commons/benchmark.php');
        }

    }

    /**
     * @author Pablo Muñoz
     * @param string host
     * @param string $section
     * @param array $get
     * @return array
     */
    function setInfo(array $generalInfo, string $extraInfoHelper):void
    {                    
        $allInfoData = InfoHelper::$extraInfoHelper();        
        $this->infoPage = new Info();
        //Show::dd($allInfoData);
        $this->infoPage->setInfo($generalInfo,$allInfoData);        
    }

    /**
     * A revisar
     * @author Pablo Gutiérrez
     * @param string host
     * @param string $section
     * @param array $get
     * @return array
     */
    function getUrl(string $host, string $section, array $get): array
    {

        $currentUrl = array();
    
        if(!empty($host)):
            $currentUrl['host'] = $host;
        endif;
    
        if(!empty($section)):
            $currentUrl['section'] = $section;
        endif;
    
        if(!empty($get)):
            foreach ($get as $keyGet => $valueGet):
                $currentUrl['params'][$keyGet] = $valueGet;
            endforeach;
        endif;
    
        return $currentUrl;
    }
    
    /**
     * A revisar
     * @author Pablo Gutiérrez
     * @lastupdate 
     * @param array $currentUrl (Url actual)
     * @return string
     */
    function setUrl($currentUrl):string
    {
    
        $currentLink = $currentUrl['host'].$currentUrl['section'];
        $currentParams = array();
    
        if(isset($currentUrl['params'])):
            foreach ($currentUrl['params'] as $keyGet => $valueGet):
                $currentParams[] = $keyGet.'='.$valueGet;
            endforeach;
            if(!empty($currentParams)):
                $currentLink = $currentLink.'?'.implode('&',$currentParams);
            endif;
        endif;
    
        return $currentLink;
    }

}

?>