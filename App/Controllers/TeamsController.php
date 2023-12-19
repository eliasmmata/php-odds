<?php

namespace BesoccerOdds\Controllers;
use BesoccerOdds\Classes\Controller;
use BesoccerOdds\Classes\Mysql_db;
use BesoccerOdds\Models\TeamsModel;
use BeSoccerSDK\Classes\Show;
use PDO;

class TeamsController extends Controller
{

    private $generalInfo = [
        'name' => 'Teams', 
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
     * Listado de equipos de Football data
     */
    function FootballdataTeams(): void
    {
        $miDB = new Mysql_db();
        $dataItem = [];
        if (isset($_GET["rfId"])) {
            $dataItem['equipos'] = TeamsModel::getDatateamsRel($miDB, $_GET["rfId"]);
            $miDB = new Mysql_db(FUTBOL);
            $dataItem['rfNames'] = TeamsModel::getDatateamsName($miDB, $_GET["rfId"]);
        } else {
            $dataItem['equipos'] = TeamsModel::getDatateamsRel($miDB);
            $miDB = new Mysql_db(FUTBOL);
            $dataItem['rfNames'] = TeamsModel::getDatateamsName($miDB);
            // Estadísticas relacionados vs no_relacionados
            $noRel = 0;
            $rel = 0;
            foreach ($dataItem['equipos'] as $team) {
                if ($team['rfId'] == '0') {
                    $noRel++;
                } else {
                    $rel++;
                }
            }
            $dataItem['relacionados'] = $rel;
            $dataItem['no_relacionados'] = $noRel;
        }
  
        $this->doHtml('teams/football_data_teams', $dataItem);
    }

    /**
     * Edición de relación de equipos de BD Futbol con Fuente externa Football Data
     */
    function relateFdTeam(): void
    {
        $miDB = new Mysql_db();
        TeamsModel::setDatateams($miDB, $_POST["teamId"], $_POST["rfId"]);
        $dataItem = [];
        $dataItem['equipos'] = TeamsModel::getDatateamsRel($miDB, $_POST["rfId"]);
        $miDB = new Mysql_db(FUTBOL);
        $dataItem['rfNames'] = TeamsModel::getDatateamsName($miDB, $_POST["rfId"]);
        
        $this->doHtml('teams/football_data_teams', $dataItem);
    }

    /**
     * Listado de equipos de Football data que no están relacionados
     */
    function unrelatedFdTeams(): void
    {
        $miDB = new Mysql_db();
        $dataItem = [];
        $dataItem['equipos'] = TeamsModel::getDatateamsRel($miDB, 0);
        $this->doHtml('teams/football_data_teams', $dataItem);
    }

    /**
     * Listado de equipos de fuentes externas
     */
    function listExtTeams(): void
    {
        $miDB = new Mysql_db(BETS);
        $table = BS_REL_TEAMS;
        $rowName = "rf_id";

        $dataItem = [];

        if (isset($_GET["rf_id"])) {
            $dataItem['equipos'] = TeamsModel::getDatateamsRel($miDB, $_GET["rf_id"], $table, $rowName);
            $miDB = new Mysql_db(FUTBOL);
            $dataItem['rfNames'] = TeamsModel::getDatateamsName($miDB, $_GET["rf_id"]);
            $dataItem['CCs'] = TeamsModel::getDatateamsCountryCode($miDB, $_GET["rf_id"]);
        }
        if (isset($_GET["gs_rf_id"])) {
            $miDB = new Mysql_db(BIGDATA);
            $dataItem['equipos_gs'] = TeamsModel::getDatateamsGs($miDB, $_GET["gs_rf_id"]);
            $miDB = new Mysql_db(FUTBOL);
            $dataItem['rfNames'] = TeamsModel::getDatateamsName($miDB, $_GET["gs_rf_id"]);
            $dataItem['CCs'] = TeamsModel::getDatateamsCountryCode($miDB, $_GET["gs_rf_id"]);
        }
        if(!isset($_GET["rf_id"]) && !isset($_GET["gs_rf_id"])) {
           
            // ----------------------  PAGINATION ---------------------------- // 
            $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
            $items_p_page = 150;
            $offset = ($page - 1) * $items_p_page;
            $limit = $items_p_page;
            if(!isset($GET['goalserve'])) {
                $source = BS_REL_TEAMS;
            } else {
               $source = DATATEAMS_GS;
            }
            $dataItem['count_equipos'] = TeamsModel::getDtRelCount($miDB, $source);
            // ---------------------- END PAGINATION ---------------------------- // 

            $_GET["rf_id"] = NULL;
            $rowData = "Set";
            $dataItem['equipos'] = TeamsModel::getDatateamsRel($miDB, $_GET["rf_id"], $table, $rowName, $rowData, $limit, $offset);
            $miDB = new Mysql_db(FUTBOL);
            $dataItem['rfNames'] = TeamsModel::getDatateamsName($miDB, $_GET["rf_id"]);
            $dataItem['CCs'] = TeamsModel::getDatateamsCountryCode($miDB, $_GET["rf_id"]);
            
            $miDB = new Mysql_db(BIGDATA);
            $_GET["gs_rf_id"] = NULL;
            $dataItem['equipos_gs'] = TeamsModel::getDatateamsGs($miDB, $_GET["gs_rf_id"], $limit, $offset);
            
            // Estadísticas relacionados vs no_relacionado
            $noRel = 0;
            $rel = 0;
            foreach ($dataItem['equipos'] as $team) {
                if ($team['rf_id'] === '0') {
                    $noRel++;
                } else {
                    $rel++;
                }
            }
            $dataItem['relacionados'] = $rel;
            $dataItem['no_relacionados'] = $noRel;

            $noRelGs = 0;
            $relGs = 0;
            foreach ($dataItem['equipos_gs'] as $team) {
                if ($team['gs_rf_id'] === '0') {
                    $noRelGs++;
                } else {
                    $relGs++;
                }
            }
            $dataItem['relacionados_gs'] = $relGs;
            $dataItem['no_relacionados_gs'] = $noRelGs;
            
        }
        
        $this->doHtml('teams/data_info_teams', $dataItem);
    }

    /**
     * Edición de relación de equipos de BD Futbol con Fuentes externa (Enetpulse y Goalserve)
     */
    function relateExtTeam(): void
    {
        $miDB = new Mysql_db(BETS);
        $table = BS_REL_TEAMS;
        $rowName = "rf_id";

        $dataItem = [];
        
        if(isset($_POST["rf_id"])) {
            TeamsModel::setDatateams($miDB, $_POST["extId"], $_POST["rf_id"], $table, $rowName);
        }

          
        if(isset($_POST["gs_rf_id"])) {
            $miDB = new Mysql_db(BIGDATA);
            $table = DATATEAMS_GS;
            $rowName = "rfId";
            $rowNameId = "unique_Id";
            TeamsModel::setDatateams($miDB, $_POST["gsId"], $_POST["gs_rf_id"], $table, $rowName, $rowNameId);
        }
        
        if(isset($_POST["gs_rf_id"]) && !isset($_POST["rf_id"])) {
            $dataItem['equipos_gs'] = TeamsModel::getDatateamsGs($miDB, $_POST["gs_rf_id"]);
            $dataItem['equipos'] = [];
            $miDB = new Mysql_db(FUTBOL);
            $dataItem['rfNames'] = TeamsModel::getDatateamsName($miDB, $_POST["gs_rf_id"]);
        }
        
        if(isset($_POST["rf_id"]) && !isset($_POST["gs_rf_id"])) {
            $miDB = new Mysql_db(BETS);
            $dataItem['equipos'] = TeamsModel::getDatateamsRel($miDB, $_POST["rf_id"],$table, $rowName);
            $miDB = new Mysql_db(FUTBOL);
            $dataItem['rfNames'] = TeamsModel::getDatateamsName($miDB, $_POST["rf_id"]);
        }
        
        

        $this->doHtml('teams/data_info_teams', $dataItem);
    }

    /**
     * Listado de equipos de Fuentes externas que no están relacionados
     */
    function unrelatedExtTeams(): void
    {
        $miDB = new Mysql_db(BETS);
        $table = BS_REL_TEAMS;
        $rowName = "rf_id";
        $dataItem = [];
        
        $rowData = "Set";
        $dataItem['equipos'] = TeamsModel::getDatateamsRel($miDB, 0, $table, $rowName, $rowData);

        $miDB = new Mysql_db(BIGDATA);
        $dataItem['equipos_gs'] = TeamsModel::getDatateamsGs($miDB, 0);

        // Show::dd($dataItem['equipos_gs']);

        $this->doHtml('teams/data_info_teams', $dataItem);
    }

}
