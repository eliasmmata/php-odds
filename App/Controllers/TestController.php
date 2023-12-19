<?php

namespace BesoccerOdds\Controllers;

use BesoccerOdds\Classes\Controller;
use BesoccerOdds\Classes\DbPDO;
use BesoccerOdds\Models\OddsModel;
use BesoccerOdds\Classes\Mysql_db;
use BesoccerOdds\Models\TestModel;
use BesoccerOdds\Models\UserEditorModel;
use PDO;

class TestController extends Controller{ 

    private $generalInfo = [
        'name' => 'Test', 
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
     * Funcion en la que probamos que la sesion de conexión a bbdd se mantenga aunque llamemos a otra bbdd distinta.
     */
    function test() : void
    {   
        $dataItem = [];
        //modelo donde inicializamos las dos base de datos 
        $bd = new TestModel();
        //creamos las conexiones
        $bd->setDeep();
        $bd->setBigdata();
        //mandamos las conexiones a los distintos modelos utilizando los ids de sesison de cada una de las bbdd sin que la conexion se cierre                                         
        $dataItem['test'] = UserEditorModel::getUser($bd->getDeep());       
        $dataItem['test2'] = OddsModel::getOdds($bd->getBigdata());        
        $dataItem['test3'] = UserEditorModel::getUser($bd->getDeep());
        $this->doHtml('dashboard/dashboard',$dataItem);
    }


}


?>