<?php

namespace BesoccerOdds\Controllers;

use BesoccerOdds\Classes\Controller;
use BesoccerOdds\Classes\DbPDO;
use BesoccerOdds\Classes\mysql_db;
use BesoccerOdds\Models\SofifaTeamsModel;
use PDO;

class DashboardController extends Controller{ 

    private $generalInfo = [
        'name' => 'DashBoard', 
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

    /**
     * Comentario
     */
    function renderHtml():void
    {
        $dataItem = [
            'test' => 'hola mundo',
        ];

        $this->doHtml('dashboard/dashboard_img',$dataItem);
    }

    /**
     * Controlador para hacer pruebas pdo
     */
    function pdoTest() : void
    {        
        $dataItem = [];        
        $pdo = new DbPDO();
        $pdo->bind("formation","4-4-1-1");
        $dataItem = $pdo->query("SELECT id, name, rating, att, mid, def FROM sofifa_teams WHERE formation = :formation");        

        $this->doHtml('dashboard/dashboard',$dataItem);

    }

    /**
     * Controlador para hacer pruebas sql
     */
    function test() : void
    {        
        $dataItem = [];        
        $sofifaFormacion = new SofifaTeamsModel();
        $dataItem['equipos'] = $sofifaFormacion::getFormacion('4-3-3');
        $this->doHtml('dashboard/dashboard',$dataItem);

    }

    function logout():void
    {  
        if (isset($_COOKIE['oauthScrap'])) {
            unset($_COOKIE['oauthScrap']); 
            setcookie('oauthScrap', null, -1, '/');             
        }            
        header('location: /');
    }    

    function noacces():void
    {  
        $this->doHtml('other/noacces', $dataItem = []);
    }  

}


?>