<?php

namespace BesoccerOdds\Controllers;

use BesoccerOdds\Classes\Controller;
use BesoccerOdds\Classes\Mysql_db;
use BesoccerOdds\Models\ErrorsModel;

class ErrorsController extends Controller{ 

    private $generalInfo = [
        'name' => 'Errors', 
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

    
    function listErrors() : void
    {   
        $miDB = new Mysql_db();
        $dataItem = [];
        
        $dataItem['errors'] = ErrorsModel::getErrorsGoalserve($miDB);
        
        $this->doHtml('errors/goalserve_errors',$dataItem);
    }
    
}


?>