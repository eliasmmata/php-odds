<?php

namespace BesoccerOdds\Controllers;

use BesoccerOdds\Classes\Controller;
use BesoccerOdds\Classes\Mysql_db;
use BesoccerOdds\Helpers\UpdateFootballDataHelper;
use BesoccerOdds\Models\LeaguesModel;
use BeSoccerSDK\Classes\Show;

class LeaguesController extends Controller
{

    private $generalInfo = [
        'name' => 'Leagues',
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
     * Listado de ligas Football Data
     */
    function FootballdataLeagues(): void
    {
        $miDB = new Mysql_db();
        $dataItem = [];

        if (isset($_GET['categoryId'])) {
            $dataItem['leagues'] = LeaguesModel::getLeaguesOdds($miDB, $_GET['categoryId']);
            $dataItem['categories'] = LeaguesModel::getCategoriesInfo($miDB, $_GET['categoryId']);
        } else if (isset($_GET['leagueId'])) {
            $dataItem['leagues'] = LeaguesModel::getLeaguesOdds($miDB, NULL, $_GET['leagueId']);
            $dataItem['categories'] = LeaguesModel::getCategoriesInfo($miDB);
        } else {
            $dataItem['leagues'] = LeaguesModel::getLeaguesOdds($miDB);
            $dataItem['categories'] = LeaguesModel::getCategoriesInfo($miDB);
        }

        if (isset($_GET['update'])) {

            // Preparamos el formato de las variables necesarias para lanzar el bash script
            $countryCode = $dataItem['categories'][$dataItem['leagues'][0]['category_id'] . 'cc'];
            $country = UpdateFootballDataHelper::countryCodeToCountryName($countryCode);

            $seasonYear = $dataItem['leagues'][0]['season'];
            $season = UpdateFootballDataHelper::seasonYearToFileFormat($seasonYear);

            $filename =  UpdateFootballDataHelper::updateOrUpdateWorld($countryCode);

            // Pruebas local (descarga csv para actualizar liga)
            // exec("bash /var/www/odds/public/".$filename." ".$country." ".$season, $sqls, $return);

            // Prod (descarga csv para actualizar liga)
            exec("cd /var/www/besoccerodds/public/media/cron && bash /var/www/besoccerodds/public/media/cron/" . $filename . " " . $country . " " . $season, $sqls, $return);

            LeaguesModel::updateLeaguesMatches($miDB, $sqls);

            $catId = $dataItem['leagues'][0]['category_id'];

            UpdateFootballDataHelper::updateRelateRaw($seasonYear, $catId);
        }


        $this->doHtml('leagues/football_data_leagues', $dataItem);
    }

    /**
     * Listado de categories relacionadas con las fuentes (Goalserve, Enetpulse, Footballdata)
     */
    function allLeagues(): void
    {
        $miDB = new Mysql_db();
        $dataItem = [];

        if (isset($_GET['categoryId'])) {
            $dataItem = LeaguesModel::getAllLeaguesFromBigdata($miDB, $_GET['categoryId']);
            $miDB = new Mysql_db(BETS);
            $bets = LeaguesModel::getAllLeaguesFromBets($miDB, $_GET['categoryId']);
        } else {
            // ----------------------  PAGINATION ---------------------------- // 
            $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
            $items_p_page = 150;
            $offset = ($page - 1) * $items_p_page;
            $limit = $items_p_page;
            if(!isset($GET['goalserve'])) {
                $source = BS_INDEX;
            } else {
               $source = INDEX_GS;
            }
            $dataItem['count_leagues'] = LeaguesModel::getLeaguesCount($miDB, $source);
            // ---------------------- END PAGINATION ---------------------------- // 

            $dataItem = LeaguesModel::getAllLeaguesFromBigdata($miDB, NULL, $limit, $offset);
            $miDB = new Mysql_db(BETS);
            $bets = LeaguesModel::getAllLeaguesFromBets($miDB);
        }

        // Mergeamos si ambos arrays de diferentes DB comparten categoría
        $keyToMerge = array_column($bets, NULL, 'ep_unique_id');

        foreach ($dataItem as &$row) {
            if (isset($keyToMerge[$row['ep_unique_id']])) {
                $row += $keyToMerge[$row['ep_unique_id']];
            }
        }

        $this->doHtml('leagues/data_info_leagues', $dataItem);
    }

    /**
     * Edición de relación de categorías de las diferentes fuentes 
     */
    function relateCategories(): void
    {
        $miDB = new Mysql_db(BETS);

        // Setea nombre externo de EP en BD BETS relacionado con id de RF
        if (isset($_POST['nameExtEp'])) {
            LeaguesModel::setNameExtBets($miDB, $_POST['nameExtEp'], $_POST['idRf']);
        }

        // Setea id de Enetpulse en BD BIGDATA
        if (isset($_POST['epId'])) {
            $table = BS_INDEX;
            LeaguesModel::setExtId($miDB, $_POST['idRf'], $_POST['epId'], $table);
        }

        $miDB = new Mysql_db(BIGDATA);
        // Setea id de Goalserve en BD BIGDATA
        if (isset($_POST['gsId'])) {
            $table = INDEX_GS;
            LeaguesModel::setExtId($miDB, $_POST['idRf'], $_POST['gsId'], $table);
        }
        // Setea id de Football Data en BD BIGDATA
        if (isset($_POST['fdId'])) {
            $table = INDEX_FD;
            LeaguesModel::setExtId($miDB, $_POST['idRf'], $_POST['fdId'], $table);
        }

        $dataItem = [];

        if (!isset($_POST['idRf'])) {
            $dataItem = LeaguesModel::getAllLeaguesFromBigdata($miDB);
        } else {
            $dataItem = LeaguesModel::getAllLeaguesFromBigdata($miDB, $_POST['idRf']);
        }

        $miDB = new Mysql_db(BETS);
        $bets = LeaguesModel::getAllLeaguesFromBets($miDB);

        // Mergeamos si ambos arrays de diferentes DB comparten categoría
        $keyToMerge = array_column($bets, NULL, 'ep_unique_id');

        foreach ($dataItem as &$row) {
            if (isset($keyToMerge[$row['ep_unique_id']])) {
                $row += $keyToMerge[$row['ep_unique_id']];
            }
        }

        $this->doHtml('leagues/data_info_leagues', $dataItem);
    }

    /**
     *  Vista editable de categorías Rf no relacionadas con las diferentes fuentes externas
     */
    function unrelatedCategories(): void
    {

        $dataItem = [];

        // SETEOS DE RELACÍON PARA ENETPULSE
        $miDB = new Mysql_db(BETS);
        // Setea nombre externo de EP en BD BETS relacionado con ID externo
        if (isset($_POST['nameExtEp'])) {
            $_POST['rfId'] = NULL;
            LeaguesModel::setNameExtBets($miDB, $_POST['nameExtEp'], $_POST['rfId'], $_POST['epId']);
        }
        // Setea Country Code de EP en BD BETS relacionado con ID externo
        if (isset($_POST['extCC'])) {
            $length = strlen($_POST['extCC']);
            LeaguesModel::setCountryBets($miDB, $_POST['extCC'], $_POST['epId'], $length);
        }
        // Setea Country Name de EP en BD BETS relacionado con ID externo
        if (isset($_POST['extCname'])) {
            $length = strlen($_POST['extCname']);
            LeaguesModel::setCountryBets($miDB, $_POST['extCname'], $_POST['epId'], $length);
        }
        // Seteo Id de Enetpulse
        if (isset($_GET['epId']) || isset($_POST['epId'])) {
                
            $miDB = new Mysql_db(BETS);

            if (isset($_GET['epId'])) {
                $extId = $_GET['epId'];
            }
            // Setea RF ID en BD BETS para relacionarlo con ID externo
            if (isset($_POST['epId']) && isset($_POST['idRf'])) {
                $extId = $_POST['epId'];
                // Sólo acepta números
                $rfHaveDigit = preg_match('/^[0-9]+$/', $_POST['idRf']);
                if ($rfHaveDigit) {
                    $table = BS_INDEX;
                    LeaguesModel::setExtId($miDB, $_POST['idRf'], $_GET['epId'], $table);
                }
                if (!$rfHaveDigit && (!isset($_POST['nameExtEp']) && !isset($_POST['extCC']) && !isset($_POST['extCname']))) {
                    $message = "Id no introducido o no válido";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                }
            }

            $dataItem['ep_cats'] = LeaguesModel::getEpCategoriesUnrelated($miDB, $extId);

        } 

        // SETEOS DE RELACIÓN PARA GOALSERVE
        $miDB = new Mysql_db(BIGDATA);
        // Setea nombre externo de GS en BD BIGDATA relacionado con ID externo
        if (isset($_POST['nameExtGs'])) {
            $_POST['rfId'] = NULL;
            LeaguesModel::setNameExtGs($miDB, $_POST['nameExtGs'], $_POST['rfId'], $_POST['gsId']);
        }
        // Setea Country Code de GS en BD BIGDATA relacionado con ID externo
        if (isset($_POST['gsCC'])) {
            $length = strlen($_POST['gsCC']);
            LeaguesModel::setCountryGs($miDB, $_POST['gsCC'], $_POST['gsId'], $length);
        }
        // Setea Country Name de GS en BD BIGDATA relacionado con ID externo
        if (isset($_POST['gsCname'])) {
            $length = strlen($_POST['gsCname']);
            LeaguesModel::setCountryGs($miDB, $_POST['gsCname'], $_POST['gsId'], $length);
        }

        // Seteo Id de Goalserve
        if (isset($_GET['gsId']) || isset($_POST['gsId'])) {
            
            $miDB = new Mysql_db(BIGDATA);

            if (isset($_GET['gsId'])) {
                $extId = $_GET['gsId'];
            }
            // Setea RF ID en BD BIGDATA para relacionarlo con ID externo
            if (isset($_POST['gsId']) && isset($_POST['idRf'])) {
                $extId = $_POST['gsId'];
                // Sólo acepta números
                $rfHaveDigit = preg_match('/^[0-9]+$/', $_POST['idRf']);
                if ($rfHaveDigit) {
                    $table = INDEX_GS;
                    LeaguesModel::setExtId($miDB, $_POST['idRf'], $_GET['gsId'], $table);
                }
                if (!$rfHaveDigit && (!isset($_POST['nameExtGs']) && !isset($_POST['gsCC']) && !isset($_POST['gsCname']))) {
                    $message = "Id no introducido o no válido";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                }
            }

            $dataItem['gs_cats'] = LeaguesModel::getGsCategoriesUnrelated($miDB, $extId);

        } 
        if (!isset($_GET['epId']) && !isset($_GET['gsId']))  {

            $miDB = new Mysql_db(BETS);
            $dataItem['ep_cats'] = LeaguesModel::getEpCategoriesUnrelated($miDB);
            $miDB = new Mysql_db(BIGDATA);
            $dataItem['gs_cats'] = LeaguesModel::getGsCategoriesUnrelated($miDB);
        }

        // Show::dd($dataItem);

        $this->doHtml('leagues/data_info_leagues_unrelated', $dataItem);
    }
}
