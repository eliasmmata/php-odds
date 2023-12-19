<?php

namespace BesoccerOdds\Controllers;

use BesoccerOdds\Classes\Controller;
use BesoccerOdds\Classes\Mysql_db;
use BesoccerOdds\Models\InfoModel;

class InfoController extends Controller{ 

    private $generalInfo = [
        'name' => 'Info', 
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

    
    function infoEp() : void
    {   
        $miDB = new Mysql_db();
        $dataItem = [];
        
        $dataItem['timestamp'] = InfoModel::getLastUpdateEp($miDB);
        
        $this->doHtml('info/enetpulse_info',$dataItem);
    }

    function infoGs() : void
    {   
        $miDB = new Mysql_db();
        $dataItem = [];
        
        $dataItem['timestamp'] = InfoModel::getLastUpdateGs($miDB);
        
        $this->doHtml('info/goalserve_info',$dataItem);
    }
    
}


?>