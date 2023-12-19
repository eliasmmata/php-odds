<?php

namespace BesoccerOdds\Controllers;

use BesoccerOdds\Classes\Controller;
use BesoccerOdds\Classes\Mysql_db;
use BesoccerOdds\Models\MatchesModel;
use BesoccerOdds\Models\TeamsModel;
use BeSoccerSDK\Classes\Show;

class MatchesController extends Controller
{

    private $generalInfo = [
        'name' => 'Matchs',
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
     * Partidos de Football Data relacionados
     */
    function relatedFdMatches(): void
    {
        $miDB = new Mysql_db();

        $dataItem = [];
        if (isset($_GET["matchId"])) {
            $dataItem['matches'] = MatchesModel::getMatchesOdds($miDB, $_GET["matchId"]);
        } elseif (isset($_GET["teamId"])) {
            $dataItem['matches'] = MatchesModel::getMatchesByTeam($miDB, $_GET["teamId"]);
        } elseif (isset($_GET["leagueId"])) {
            $dataItem['matches'] = MatchesModel::getMatchesByLeague($miDB, $_GET["leagueId"]);
            $dataItem['teamsext'] = MatchesModel::getTeamsNumberByLeague($miDB, $_GET["leagueId"]);

            $season = $dataItem['matches'][0]['season'];
            $dataItem['teamsrf'] = MatchesModel::getRfTeamsNumberByLeague($miDB, $_GET["leagueId"], $season);
            $dataItem['roundsrf'] = MatchesModel::getRfMatchesByLeague($miDB, $_GET["leagueId"], $season);
        } else {
            $dataItem['matches'] = MatchesModel::getMatchesOdds($miDB);
        }

        $this->doHtml('matches/football_data_matches', $dataItem);
    }

    /**
     * Relacionador de partidos de Football Data
     */
    function relateFdExtMatch(): void
    {
        $miDB = new Mysql_db();
        $dataItem = [];
        if (!empty($_POST["matchId"]) && !empty($_POST["leagueId"])) {
            MatchesModel::relMatch($miDB, $_POST["extId"], $_POST["matchId"], $_POST["leagueId"], $_POST["season"]);
        }
        $dataItem['matches'] = MatchesModel::getFdMatchesUnrelated($miDB);
        $this->doHtml('matches/football_data_matches', $dataItem);
    }

    /**
     * Partidos de Football Data no relacionados todavía
     */
    function unrelatedFdMatches(): void
    {
        $miDB = new Mysql_db();
        $dataItem = [];
        $dataItem['matches'] = MatchesModel::getFdMatchesUnrelated($miDB);
        $this->doHtml('matches/football_data_matches', $dataItem);
    }

    /**
     * Partidos de BD Futbol (por día predefinido, pero pueden filtrarse por más fechas)
     */
    function dataInfoMatches(): void
    {
        $miDB = new Mysql_db(FUTBOL);
        $dataItem = [];
        
        if (!empty($_GET["season"])) {
            $season = $_GET["season"];
        } else {
            $season = date("Y");
        }

        // Filtros varios dependiendo de día, categoría o league.
        if(empty($_GET['day'])) {
            $dataItem['matches'] = MatchesModel::getRfMatches($miDB, $season);
        } else {
            $day = $_GET["day"];
            $dataItem['matches'] = MatchesModel::getRfMatches($miDB, $season, $day);
        }

        if (isset($_GET["category"])) {
            $dataItem['matches'] = MatchesModel::getMatchesFilterByCategory($miDB, $season, $_GET["category"]);
        } else if (isset($_GET["league"])) {
            $dataItem['matches'] = MatchesModel::getMatchesFilterByLeague($miDB, $season, $_GET["league"]);
        }

        // Filtro por equipo (desde vista de Equipos)
        if (isset($_GET["rf_id"])) {
            $dataItem['matches'] = MatchesModel::getMatchesFilterByTeamId($miDB, $season, $_GET["rf_id"]);
        } 

        // Array con match ids de Rf para compararlos con los de Elo
        foreach ($dataItem['matches'] as $index => $match) {
            $dataItem['match_ids'][$index] = $index;
        }
        // Para diferenciar los partidos que tengan apuestas y los que no,
        // comparamos los índices de matches y bets (uniqueId formado por season + matchId). 
        $miDB = new Mysql_db(ELO);
        $dataItem['bets'] = MatchesModel::getMatchesWithBets($miDB, $dataItem['match_ids']);
        
        $array_de_colecta = [];
        foreach ($dataItem['matches'] as $index => $match) {
            if (isset($dataItem['bets'][$index])) {
                $match['matches_bets'] = $index;
            }
            $array_de_colecta[$index] = $match;
        }
        
        $dataItem['matches'] = $array_de_colecta;
        
        $this->doHtml('matches/data_info_matches', $dataItem);
    }

    /**
     * Partidos de Fuentes externas no relacionados todavía
     */
    function unrelatedExtMatches(): void
    {
        $miDB = new Mysql_db(BETS);
        $dataItem = [];
        
        if (!empty($_GET["season"])) {
            $season = $_GET["season"];
        } else {
            $season = date("Y");
        }

        if (isset($_GET["extId"])) {
            // Filtro por equipo Externo (desde vista de Equipos)
            $dataItem['matches'] = MatchesModel::getMatchesFilterByExtTeam($miDB, $season, $_GET["extId"]);
        } else {
            $dataItem['matches'] = MatchesModel::getExtMatchesUnrelated($miDB);
        }
        
        $this->doHtml('matches/data_info_matches_unrelated', $dataItem);
    }
    
    /**
     * Edición de relación de partidos de Fuentes externas (Enetpulse y Goalserve) con BD Futbol
     */
    function relateExtMatch(): void
    {
        $miDB = new Mysql_db(BETS);
        MatchesModel::setRfMatchId($miDB, $_POST["extId"], $_POST["rf_match_id"]);
        
        $dataItem = [];

        if (isset($_GET["extId"])) {
            $dataItem['matches'] = MatchesModel::getExtMatchesUnrelated($miDB, $_GET["extId"]);
        } else {
            $dataItem['matches'] = MatchesModel::getExtMatchesUnrelated($miDB);
        }
        
        $this->doHtml('matches/data_info_matches_unrelated', $dataItem);
    }


}
