<?php

namespace BesoccerOdds\Models;

use BesoccerOdds\Classes\Model;
use BeSoccerSDK\Classes\Show;

class OddsModel extends Model
{

    /* CONST db = 'bigdata';
        CONST table = 'calendars_odds'; */

    /**
     * Función para buscar la lista de partidos de Football Data con apuestas, o un partido en concreto si hay matchId y season.
     * @param $miDB: Conexión con la base de datos 
     * @param $matchId: Id del partido de rf relacionado con big data odds
     * @param $season: Año de calendars
     * 
     * @return array
     */
    public static function getOdds(object $miDB, string $matchId = NULL, string $season = NULL): array
    {
        $data = [];

        $sql = "SELECT * FROM " . ODDS;

        if (isset($matchId) && isset($season)) {
            $sql = $sql . " WHERE match_id = " . $matchId . " AND season = " . $season;
        } else {
            $sql = $sql . " LIMIT 100";
        }

        if ($query = $miDB->query($sql)) :
            foreach ($query as $row) :
                array_push($data, $row);
            endforeach;
        endif;

        return $data;
    }

    /**
     * Función para ver a cuánto pagan las casas el ganador del partido (1X2)
     * @param $miDB: Conexión con la base de datos 
     * @param $matchId: Id del partido de rf relacionado con BD Elo
     * @param $season: Año del calendars de rf relacionado en tabla Elo como year
     * @param $order: Flag para para ordenar de mayor a menor o viceversa
     * 
     * @return array
     */
    public static function matchWinnerOdds (object $miDB, string $matchId = NULL, string $season = NULL): array
    {
        $data = [];

        $sql = "SELECT * FROM " . ODDS_MATCH_WINNER;

        if (isset($matchId) && isset($season)) {
            $sql = $sql . " WHERE match_id = " . $matchId . " AND year = " . $season;
        } else {
            $sql = $sql . " LIMIT 100";
        }

        if ($query = $miDB->query($sql)) :
            foreach ($query as $index => $row) :

                array_push($data, $row);
            endforeach;
        endif;

        return $data;
    }

    /**
     * Función para ver a cuánto pagan las casas el ganador de la segunda parte
     * @param $miDB: Conexión con la base de datos 
     * @param $matchId: Id del partido de rf relacionado con BD Elo
     * @param $season: Año del calendars de rf relacionado en tabla Elo como year
     * 
     * @return array
     */
    public static function secondHalfWinner(object $miDB, string $matchId = NULL, string $season = NULL): array
    {
        $data = [];

        $sql = "SELECT * FROM " . ODDS_MATCH_2NDHALF;

        if (isset($matchId) && isset($season)) {
            $sql = $sql . " WHERE match_id = " . $matchId . " AND year = " . $season;
        } else {
            $sql = $sql . " LIMIT 100";
        }

        if ($query = $miDB->query($sql)) :
            foreach ($query as $index => $row) :

                array_push($data, $row);
            endforeach;
        endif;
        
        return $data;
    }

    /**
     * Función para ver a cuánto pagan las casas el ganador sin posibilidad de empate
     * @param $miDB: Conexión con la base de datos 
     * @param $matchId: Id del partido de rf relacionado con BD Elo
     * @param $season: Año del calendars de rf relacionado en tabla Elo como year
     * 
     * @return array
     */
    public static function homeAwayOdds(object $miDB, string $matchId = NULL, string $season = NULL): array
    {
        $data = [];

        $sql = "SELECT * FROM " . ODDS_HOME_AWAY;

        if (isset($matchId) && isset($season)) {
            $sql = $sql . " WHERE match_id = " . $matchId . " AND year = " . $season;
        } else {
            $sql = $sql . " LIMIT 100";
        }

        if ($query = $miDB->query($sql)) :
            foreach ($query as $index => $row) :

                array_push($data, $row);
            endforeach;
        endif;

        return $data;
    }

    /**
     * Función para ver a cuánto pagan las casas el ganador del partido con handicap asiático
     * @param $miDB: Conexión con la base de datos 
     * @param $matchId: Id del partido de rf relacionado con BD Elo
     * @param $season: Año del calendars de rf relacionado en tabla Elo como year
     * 
     * @return array
     */
    public static function asianHandicapOdds(object $miDB, string $matchId = NULL, string $season = NULL): array
    {
        $data = [];

        $sql = "SELECT * FROM " . ASIAN_HANDICAP;

        if (isset($matchId) && isset($season)) {
            $sql = $sql . " WHERE match_id = " . $matchId . " AND year = " . $season;
        } else {
            $sql = $sql . " LIMIT 100";
        }

        if ($query = $miDB->query($sql)) :
            foreach ($query as $index => $row) :

                array_push($data, $row);
            endforeach;
        endif;

        return $data;
    }

    /**
     * Función para ver a cuánto pagan las casas el ganador del partido con double chanche
     * @param $miDB: Conexión con la base de datos 
     * @param $matchId: Id del partido de rf relacionado con BD Elo
     * @param $season: Año del calendars de rf relacionado en tabla Elo como year
     * 
     * @return array
     */
    public static function doubleChanceOdds(object $miDB, string $matchId = NULL, string $season = NULL): array
    {
        $data = [];

        $sql = "SELECT * FROM "  . DOUBLE_CHANCE;

        if (isset($matchId) && isset($season)) {
            $sql = $sql . " WHERE match_id = " . $matchId . " AND year = " . $season;
        } else {
            $sql = $sql . " LIMIT 100";
        }

        if ($query = $miDB->query($sql)) :
            foreach ($query as $index => $row) :

                array_push($data, $row);
            endforeach;
        endif;

        return $data;
    }

    /**
     * Función para ver a cuánto pagan las casas los goles Over Under X
     * @param $miDB: Conexión con la base de datos 
     * @param $matchId: Id del partido de rf relacionado con BD Elo
     * @param $season: Año del calendars de rf relacionado en tabla Elo como year
     * 
     * @return array
     */
    public static function overUnderOdds(object $miDB, string $matchId = NULL, string $season = NULL): array
    {
        $data = [];

        $sql = "SELECT * FROM  " . GOALS_OVER_UNDER;

        if (isset($matchId) && isset($season)) {
            $sql = $sql . " WHERE match_id = " . $matchId . " AND year = " . $season;
        } else {
            $sql = $sql . " LIMIT 100";
        }

        if ($query = $miDB->query($sql)) :
            foreach ($query as $index => $row) :

                array_push($data, $row);
            endforeach;
        endif;

        return $data;
    }

    /**
     * Función para ver a cuánto pagan las casas los goles Over Under X en la primera parte
     * @param $miDB: Conexión con la base de datos 
     * @param $matchId: Id del partido de rf relacionado con BD Elo
     * @param $season: Año del calendars de rf relacionado en tabla Elo como year
     * 
     * @return array
     */
    public static function overUnderFirstOdds(object $miDB, string $matchId = NULL, string $season = NULL): array
    {
        $data = [];

        $sql = "SELECT * FROM " . OVER_UNDER_FIRST;

        if (isset($matchId) && isset($season)) {
            $sql = $sql . " WHERE match_id = " . $matchId . " AND year = " . $season;
        } else {
            $sql = $sql . " LIMIT 100";
        }

        if ($query = $miDB->query($sql)) :
            foreach ($query as $index => $row) :

                array_push($data, $row);
            endforeach;
        endif;

        return $data;
    }

    /**
     * Función para ver a cuánto pagan las casas los goles Over Under X en la segunda parte
     * @param $miDB: Conexión con la base de datos 
     * @param $matchId: Id del partido de rf relacionado con BD Elo
     * @param $season: Año del calendars de rf relacionado en tabla Elo como year
     * 
     * @return array
     */
    public static function overUnderSecondOdds(object $miDB, string $matchId = NULL, string $season = NULL): array
    {
        $data = [];

        $sql = "SELECT * FROM " . OVER_UNDER_SECOND;

        if (isset($matchId) && isset($season)) {
            $sql = $sql . " WHERE match_id = " . $matchId . " AND year = " . $season;
        } else {
            $sql = $sql . " LIMIT 100";
        }

        if ($query = $miDB->query($sql)) :
            foreach ($query as $index => $row) :

                array_push($data, $row);
            endforeach;
        endif;

        return $data;
    }

    /**
     * Función para ver a cuánto pagan las casas la portería vacía del equipo de casa
     * @param $miDB: Conexión con la base de datos 
     * @param $matchId: Id del partido de rf relacionado con BD Elo
     * @param $season: Año del calendars de rf relacionado en tabla Elo como year
     * 
     * @return array
     */
    public static function cleanSheetHomeOdds(object $miDB, string $matchId = NULL, string $season = NULL): array
    {
        $data = [];

        $sql = "SELECT * FROM " . CLEAN_SHEET_HOME;

        if (isset($matchId) && isset($season)) {
            $sql = $sql . " WHERE match_id = " . $matchId . " AND year = " . $season;
        } else {
            $sql = $sql . " LIMIT 100";
        }

        if ($query = $miDB->query($sql)) :
            foreach ($query as $index => $row) :

                array_push($data, $row);
            endforeach;
        endif;

        return $data;
    }

    /**
     * Función para ver a cuánto pagan las casas la portería vacía del equipo de fuera
     * @param $miDB: Conexión con la base de datos 
     * @param $matchId: Id del partido de rf relacionado con BD Elo
     * @param $season: Año del calendars de rf relacionado en tabla Elo como year
     * 
     * @return array
     */
    public static function cleanSheetAwayOdds(object $miDB, string $matchId = NULL, string $season = NULL): array
    {
        $data = [];

        $sql = "SELECT * FROM " . CLEAN_SHEET_AWAY;

        if (isset($matchId) && isset($season)) {
            $sql = $sql . " WHERE match_id = " . $matchId . " AND year = " . $season;
        } else {
            $sql = $sql . " LIMIT 100";
        }

        if ($query = $miDB->query($sql)) :
            foreach ($query as $index => $row) :

                array_push($data, $row);
            endforeach;
        endif;

        return $data;
    }

    /**
     * Función para ver a cuánto pagan las casas el resultado correcto a partido completo
     * @param $miDB: Conexión con la base de datos 
     * @param $matchId: Id del partido de rf relacionado con BD Elo
     * @param $season: Año del calendars de rf relacionado en tabla Elo como year
     * 
     * @return array
     */
    public static function correctScoreOdds(object $miDB, string $matchId = NULL, string $season = NULL): array
    {
        $data = [];

        $sql = "SELECT * FROM " . CORRECT_SCORE;

        if (isset($matchId) && isset($season)) {
            $sql = $sql . " WHERE match_id = " . $matchId . " AND year = " . $season;
        } else {
            $sql = $sql . " LIMIT 100";
        }

        if ($query = $miDB->query($sql)) :
            foreach ($query as $index => $row) :

                array_push($data, $row);
            endforeach;
        endif;

        return $data;
    }

    /**
     * Función para ver a cuánto pagan las casas el resultado correcto de la primera parte
     */

    public static function correctScoreFirstOdds(object $miDB, string $matchId = NULL, string $season = NULL)
    {
        $data = [];

        $sql = "SELECT * FROM " . CORRECT_SCORE_FIRST;

        if (isset($matchId) && isset($season)) {
            $sql = $sql . " WHERE match_id = " . $matchId . " AND year = " . $season;
        } else {
            $sql = $sql . " LIMIT 100";
        }

        if ($query = $miDB->query($sql)) :
            foreach ($query as $index => $row) :

                array_push($data, $row);
            endforeach;
        endif;

        return $data;
    }

    /**
     * Función para ver a cuánto pagan las casas el resultado correcto de la segunda parte
     * @param $miDB: Conexión con la base de datos 
     * @param $matchId: Id del partido de rf relacionado con BD Elo
     * @param $season: Año del calendars de rf relacionado en tabla Elo como year
     * 
     * @return array
     */
    public static function correctScoreSecondOdds(object $miDB, string $matchId = NULL, string $season = NULL): array
    {
        $data = [];

        $sql = "SELECT * FROM " . CORRECT_SCORE_SECOND;

        if (isset($matchId) && isset($season)) {
            $sql = $sql . " WHERE match_id = " . $matchId . " AND year = " . $season;
        } else {
            $sql = $sql . " LIMIT 100";
        }

        if ($query = $miDB->query($sql)) :
            foreach ($query as $index => $row) :

                array_push($data, $row);
            endforeach;
        endif;

        return $data;
    }


    /**
     * Partidos de Goalserve
     * @param $miDB: Conexión con la base de datos 
     * @param $match_id: Id del partido 
     * @param $season: Año del calendars
     * 
     * @return array
     */
    public static function getOddsGoalserve(object $miDB, string $matchId = NULL, string $season = NULL): array
    {
        $data = [];

        $sql = "SELECT * FROM odds";

        if (isset($matchId) && isset($season)) {
            $sql = $sql . " WHERE match_id = " . $matchId . " AND season = " . $season;
        } else {
            $sql = $sql . " LIMIT 100";
        }

        if ($query = $miDB->query($sql)) :
            foreach ($query as $row) :
                array_push($data, $row);
            endforeach;
        endif;

        return $data;
    }
}
