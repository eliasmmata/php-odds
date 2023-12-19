<?php

namespace BesoccerOdds\Controllers;

use BesoccerOdds\Classes\Controller;
use BesoccerOdds\Classes\Mysql_db;
use BesoccerOdds\Models\ProvidersModel;
use BeSoccerSDK\Classes\Show;

class ProvidersController extends Controller{ 

    private $generalInfo = [
        'name' => 'Providers', 
        'description' => '', 
        'permissions_level' => '1'
    ];
    private $helperInfo = 'dashboarInfo';

    function __construct(string $controllerFunction, array $controllerParams = [], bool $enableErrors = FALSE)
    {
        parent::__construct($enableErrors);
        parent::setInfo($this->generalInfo, $this->helperInfo);
        $this->$controllerFunction($controllerParams);
    }

    
    function listProviders() : void
    {   
        $miDB = new Mysql_db();
        $dataItem = [];
        
        $dataItem = ProvidersModel::getProviders($miDB);

        $this->doHtml('providers/providers',$dataItem);
    }


    /**
     * Edición de relación de categorías de las diferentes fuentes 
     */
    function relateProviders(): void
    {
        $miDB = new Mysql_db(BIGDATA);

        // Setea rfId de Enetpulse para su relación 
        if (isset($_POST['ep_rfId'])) {
            $table = PROVIDERS_EP;
            ProvidersModel::setProviderRel($miDB, $_POST['ep_id'], $_POST['ep_rfId'], $table);
        }

        // Setea rfId de Goalserve para su relación 
        if (isset($_POST['gs_rfId'])) {
            $table = PROVIDERS_GS;
            ProvidersModel::setProviderRel($miDB, $_POST['gs_id'], $_POST['gs_rfId'], $table);
        }

        // Setea rfId de Football Data para su relación 
        if (isset($_POST['fd_rfId'])) {
            $table = PROVIDERS_ODDS;
            ProvidersModel::setProviderRel($miDB, $_POST['fd_id'], $_POST['fd_rfId'], $table);
        }

        $dataItem = [];

       if (!isset($_POST['ep_rfId']) && !isset($_POST['gs_rfId']) && !isset($_POST['fd_rfId'])) {
            $dataItem = ProvidersModel::getProviders($miDB);
        } else {
            if (isset($_POST['ep_rfId'])) {
                $dataItem = ProvidersModel::getProviders($miDB, $_POST['ep_rfId'], $table);
            }
            if (isset($_POST['gs_rfId'])) {
                $dataItem = ProvidersModel::getProviders($miDB, $_POST['gs_rfId'], $table);
            }
            if (isset($_POST['fd_rfId'])) {
                $dataItem = ProvidersModel::getProviders($miDB, $_POST['fd_rfId'], $table);
            }

        }

        $this->doHtml('providers/providers', $dataItem);
    }
    
}


?>