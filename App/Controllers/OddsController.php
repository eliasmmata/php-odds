<?php

namespace BesoccerOdds\Controllers;

use BesoccerOdds\Classes\Controller;
use BesoccerOdds\Classes\Mysql_db;
use BesoccerOdds\Models\MatchesModel;
use BesoccerOdds\Models\OddsModel;
use BeSoccerSDK\Classes\Show;

class OddsController extends Controller{ 

    private $generalInfo = [
        'name' => 'Odds', 
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
     * Función para ver los partidos de la fuente Football Data con apuestas, o un partido en concreto si disponemos de matchId y season
     */
    function listOdds() : void
    {   
        $miDB = new Mysql_db();
        $dataItem = [];
        if (isset ($_GET["matchId"]) && isset($_GET["season"])){
            $dataItem['odds'] = OddsModel::getOdds($miDB,$_GET["matchId"],$_GET["season"]);
        } else {
            $dataItem['odds'] = OddsModel::getOdds($miDB);
        }
        $this->doHtml('odds/odds',$dataItem);
    }

    /**
     * Función para ver las apuestas de los partidos
     */
    function singleMatchOdds() : void
    {   
        $dataItem = [];
        if (isset ($_GET["matchId"]) && isset($_GET["season"])){
            // Partido de RF
            $miDB = new Mysql_db('futbol');
            $dataItem['match'] = MatchesModel::getMatchById($miDB,$_GET["matchId"],$_GET["season"]);
            // Apuestas de ese partido de elo
            $miDB = new Mysql_db('elo');

            $dataItem['odds_match_winner'] = OddsModel::matchWinnerOdds($miDB,$_GET["matchId"],$_GET["season"]);
            $dataItem['odds_half_winner'] = OddsModel::secondHalfWinner($miDB,$_GET["matchId"],$_GET["season"]);
            $dataItem['odds_home_away'] = OddsModel::homeAwayOdds($miDB,$_GET["matchId"],$_GET["season"]);
            $dataItem['odds_asian_handicap'] = OddsModel::asianHandicapOdds($miDB,$_GET["matchId"],$_GET["season"]);
            $dataItem['odds_double_chance'] = OddsModel::doubleChanceOdds($miDB,$_GET["matchId"],$_GET["season"]);
            $dataItem['odds_over_under'] = OddsModel::overUnderOdds($miDB,$_GET["matchId"],$_GET["season"]);
            $dataItem['odds_over_under_first'] = OddsModel::overUnderFirstOdds($miDB,$_GET["matchId"],$_GET["season"]);
            $dataItem['odds_over_under_second'] = OddsModel::overUnderSecondOdds($miDB,$_GET["matchId"],$_GET["season"]);
            $dataItem['odds_clean_sheet_home'] = OddsModel::cleanSheetHomeOdds($miDB,$_GET["matchId"],$_GET["season"]);
            $dataItem['odds_clean_sheet_away'] = OddsModel::cleanSheetAwayOdds($miDB,$_GET["matchId"],$_GET["season"]);
            $dataItem['odds_correct_score'] = OddsModel::correctScoreOdds($miDB,$_GET["matchId"],$_GET["season"]);
            $dataItem['odds_correct_score_1st_half'] = OddsModel::correctScoreFirstOdds($miDB,$_GET["matchId"],$_GET["season"]);
            $dataItem['odds_correct_score_2nd_half'] = OddsModel::correctScoreSecondOdds($miDB,$_GET["matchId"],$_GET["season"]);
        } else {
            $miDB = new Mysql_db('futbol');
            $dataItem['match'] = MatchesModel::getMatchById($miDB);
        }

        // Show::dd($dataItem['odds_match_winner']);

        $this->doHtml('odds/single_match_odds',$dataItem);
    }

    
}


?>