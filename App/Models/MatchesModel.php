<?php

namespace BesoccerOdds\Models;

use BesoccerOdds\Classes\Model;
use BeSoccerSDK\Classes\Show;

class MatchesModel extends Model
{
    /* CONST db = 'bigdata';
        CONST table = 'calendars_odds'; */

    /**
     * Partidos de Football Data
     * @param $miDB: Conexión con la base de datos 
     * @param $match_id: Id del partido 
     * 
     * @return array
     */
    public static function getMatchesOdds(object $miDB, string $matchId = NULL): array
    {
        $data = [];

        $sql = "SELECT * FROM " . CALENDARS_ODDS;

        if (isset($matchId)) {
            $sql = $sql . " WHERE match_id = " . $matchId;
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
     * Partidos de Football Data por teamId
     * @param $miDB: conexión con la base de datos 
     * @param $teamId: id del equipo 
     * 
     * @return array
     */
    public static function getMatchesByTeam(object $miDB, string $teamId = NULL): array
    {
        $data = [];

        $sql = "SELECT * FROM " . CALENDARS_ODDS;

        if (isset($teamId)) {
            $sql = $sql . " WHERE dt1 = " . $teamId . " OR dt2 = " . $teamId;
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
     * Partidos de Football Data por leagueId
     * @param $miDB: conexión con la base de datos 
     * @param $leagueId: id de la liga 
     * 
     * @return array
     */
    public static function getMatchesByLeague(object $miDB, string $leagueId = NULL): array
    {
        $data = [];

        $sql = "SELECT * FROM " . CALENDARS_ODDS;

        if (isset($leagueId)) {
            $sql = $sql . " WHERE league_id = " . $leagueId;
        } else {
            $sql = $sql . " LIMIT 380";
        }

        if ($query = $miDB->query($sql)) :
            foreach ($query as $row) :
                array_push($data, $row);
            endforeach;
        endif;

        return $data;
    }

    /** 
     * Listado de Partidos de Football Data que no están relacionados
     * @param $miDB: Conexión con la base de datos 
     * 
     * @return array
     */
    public static function getFdMatchesUnrelated(object $miDB): array
    {
        $data = [];
        $sql = "SELECT * 
                FROM " . CALENDARS_ODDS . "
                WHERE 
                    match_id IS NULL
                ORDER BY 
                    season 
                DESC";

        if ($query = $miDB->query($sql)) :
            foreach ($query as $row) :
                array_push($data, $row);
            endforeach;
        endif;

        return $data;
    }

    /**
     * Relacionador de partidos de Football Data que estén sin relacionar
     * @param $miDB: Conexión con la base de datos 
     * @param $extId: Id de la fuente externa
     * @param $matchId: Id del partido 
     * @param $leagueId: Id de la liga 
     * @param $season: Año del CalendarsXXXX 
     * 
     * @return array
     */
    public static function relMatch(object $miDB, string $extId, string $matchId, string $leagueId, string $season = NULL): void
    {
        $category = 'NULL';

        $sql = "SELECT categoryId, year
                FROM " . LEAGUES . "
                WHERE 
                    id = " . $leagueId;

        if ($query = $miDB->query($sql)) :
            foreach ($query as $row) :
                $category = $row['categoryId'];
                $season = $row['year'];
            endforeach;
        endif;

        $dt1 = 'NULL';
        $dt2 = 'NULL';
        $r1 = 99;
        $r2 = 99;
        $sql = "SELECT datateam1, datateam2, r1, r2
                FROM "
            . CALENDARS . $season . "
                WHERE 
                    id = " . $matchId;

        if ($query = $miDB->query($sql)) :
            foreach ($query as $row) :
                $dt1 = $row['datateam1'];
                $dt2 = $row['datateam2'];
                $r1 = $row['r1'];
                $r1 = $row['r2'];
            endforeach;
        endif;

        $result = '-';
        if ($r1 < 90 && $r2 < 90) {
            if ($r1 > $r2) {
                $result = '1';
            }
            if ($r1 < $r2) {
                $result = '2';
            }
            if ($r1 == $r2) {
                $result = 'x';
            }
        }

        $sql = "UPDATE " . CALENDARS_ODDS . "
                SET
                    match_id = " . $matchId . ", category_id = " . $category . ", league_id = " . $leagueId . ", season = " . $season . ", dt1 = " . $dt1 . ", dt2 = " . $dt2 . ", r1 = " . $r1 . ", r2 = " . $r2 . ", result = " . $result . "
                WHERE
                    id = " . $extId;

        if ($query = $miDB->query($sql)) :
            foreach ($query as $row) :
                $category = $row['categoryId'];
                $season = $row['year'];
            endforeach;
        endif;
    }

    /**
     * Obtener número de equipos que están en una liga (Football Data)
     * @param $miDB: Conexión con la base de datos 
     * @param $leagueId: Id de la liga 
     * 
     * @return array
     */
    public static function getTeamsNumberByLeague(object $miDB, string $leagueId = NULL): array
    {

        $data = [];

        $sql = " SELECT DISTINCT home
                FROM " . CALENDARS_ODDS . "
                WHERE 
                    league_id =" . $leagueId;

        if ($query = $miDB->query($sql)) :
            foreach ($query as $row) :
                array_push($data, $row);
            endforeach;
        endif;

        return $data;
    }

    /**
     * Obtener número de equipos que están en una liga (BD Futbol)
     * @param $miDB: Conexión con la base de datos 
     * @param $leagueId: Id de la liga 
     * @param $season: Año del calendars
     * 
     * @return array
     */
    public static function getRfTeamsNumberByLeague(object $miDB, string $leagueId = NULL, string $season): array
    {

        $data = [];

        $sql = "SELECT DISTINCT datateam1
                FROM " . CALENDARS . $season . " 
                WHERE 
                    league_id = " . $leagueId;

        if ($query = $miDB->query($sql)) :
            foreach ($query as $row) :
                array_push($data, $row);
            endforeach;
        endif;

        return $data;
    }

    /**
     * Obtener número de partidos de una liga (BD Futbol)
     * @param $miDB: Conexión con la base de datos 
     * @param $leagueId: Id de la liga 
     * @param $season: Año del calendars
     * 
     * @return array
     */
    public static function getRfMatchesByLeague(object $miDB, string $leagueId = NULL, string $season): array
    {

        $data = [];

        $sql = "SELECT id, shedule
                FROM " . CALENDARS . $season . " 
                WHERE 
                    league_id =" . $leagueId;

        if ($query = $miDB->query($sql)) :
            foreach ($query as $row) :
                array_push($data, $row);
            endforeach;
        endif;

        // Partidos con fecha posterior a hoy
        $futureMatches = '0';
        foreach($data as $match) {
            if(strtotime(date("Y-m-d-s")) < strtotime($match['shedule'])) {
                $futureMatches++;
            }
        }
        $data['futures_matches'] = $futureMatches;

        return $data;
    }

    /**
     * Partidos del día (BD futbol)
     * @param $miDB: Conexión con la base de datos 
     * @param $season: Año del calendars
     * @param $day: filtro para un día + -
     * 
     * @return array
     */
    public static function  getRfMatches(object $miDB, string $season, string $day = NULL): array
    {
        $data = [];

        if (isset($day)) {
            if ($day === 'yesterday') {
                $day = ' - INTERVAL 1 DAY ';
            } else if ($day === 'tomorrow') {
                $day = ' + INTERVAL 1 DAY ';
            } else {
                $day = ' ';
            }
        }

        $sql = "SELECT c.id, c.r1,c.r2, c.shedule, c.league_id, c.team1_name, c.team2_name, c.datateam1, c.datateam2, l.categoryId
                FROM " . CALENDARS . $season . " as c
                INNER JOIN leagues as l
                ON l.id= c.league_id
                WHERE
                    DATE(shedule) = CURDATE()" . $day . "
                ORDER BY shedule ASC";


        if ($query = $miDB->query($sql)) :
            foreach ($query as $row) :
                $row['season'] = $season;
                $data[$season . $row['id']] = $row;
            endforeach;
        endif;

        return $data;
    }

    /**
     * Partidos de BD futbol por Categoría
     * @param $miDB: Conexión con la base de datos 
     * @param $season: Año de calendars
     * @param $categoryId: Id de la categoría de RF
     * 
     * @return array
     */
    public static function  getMatchesFilterByCategory(object $miDB, $season = NULL, string $categoryId): array
    {
        $data = [];

        $sql = "SELECT c.id, c.r1,c.r2, c.shedule, c.league_id, c.team1_name, c.team2_name, c.datateam1, c.datateam2, l.categoryId, cat.name
                FROM " . CALENDARS . $season . " as c
                INNER JOIN leagues as l
                ON l.id= c.league_id
                INNER JOIN categories as cat
                ON cat.id = l.categoryId
                WHERE l.categoryId = " . $categoryId . " 
                ORDER BY shedule ASC LIMIT 150";

        if ($query = $miDB->query($sql)) :
            foreach ($query as $row) :
                $row['season'] = $season;
                $data[$season . $row['id']] = $row;
            endforeach;
        endif;

        return $data;
    }

    /**
     * Partidos de BD futbol por League Id
     * @param $miDB: Conexión con la base de datos 
     * @param $season: Año de calendars
     * @param $leagueId: Id de la liga de RF
     * 
     * @return array
     */
    public static function  getMatchesFilterByLeague(object $miDB, $season = NULL, string $leagueId): array
    {
        $data = [];

        $sql = "SELECT c.id, c.r1,c.r2, c.shedule, c.league_id, c.team1_name, c.team2_name, c.datateam1, c.datateam2, l.categoryId, cat.name
                FROM " . CALENDARS . $season . " as c
                INNER JOIN leagues as l
                ON l.id= c.league_id
                INNER JOIN categories as cat
                ON cat.id = l.categoryId
                WHERE l.id = " . $leagueId . " 
                ORDER BY shedule ASC LIMIT 150";

        if ($query = $miDB->query($sql)) :
            foreach ($query as $row) :
                $row['season'] = $season;
                $data[$season . $row['id']] = $row;
            endforeach;
        endif;

        return $data;
    }

    /**
     * Partidos de BD futbol por Datateam Id
     * @param $miDB: Conexión con la base de datos 
     * @param $season: Año de calendars
     * @param $teamId: Id de datateams de RF
     * 
     * @return array
     */
    public static function  getMatchesFilterByTeamId(object $miDB, $season = NULL, string $teamId): array
    {
        $data = [];

        $sql = "SELECT c.id, c.r1,c.r2, c.shedule, c.league_id, c.team1_name, c.team2_name, c.datateam1, c.datateam2, l.categoryId, cat.name
                FROM " . CALENDARS . $season . " as c
                INNER JOIN leagues as l
                ON l.id= c.league_id
                INNER JOIN categories as cat
                ON cat.id = l.categoryId
                WHERE c.datateam1 = " . $teamId . " OR c.datateam2 = " . $teamId .
            " ORDER BY shedule DESC LIMIT 150";

        if ($query = $miDB->query($sql)) :
            foreach ($query as $row) :
                $row['season'] = $season;
                $data[$season . $row['id']] = $row;
            endforeach;
        endif;

        return $data;
    }

    /**
     * Partidos de BD futbol por Datateam Id
     * @param $miDB: Conexión con la base de datos 
     * @param $season: Año de calendars
     * @param $teamId: Id de la fuente externa
     * 
     * @return array
     */
    public static function  getMatchesFilterByExtTeam(object $miDB, $season = NULL, string $teamId): array
    {
        $matches = [];

        $sql = "SELECT event.id as ext_id, event.name as match_name, event.startdate, 
                    participant.id as ext_team_id, participant.name as team_name,
                    event_participants.number,
                    tournament_stage.name as ext_cat_name, 
                    bs_index.id_rf as cat_id_rf, bs_index.unique_id as ext_cat_id
                FROM " . EVENT . "
                INNER JOIN tournament_stage
                    ON tournament_stage.id = event.tournament_stageFK
                INNER JOIN tournament
                    ON tournament.id = tournament_stage.tournamentFK
                INNER JOIN tournament_template
                    ON tournament_template.id = tournament.tournament_templateFK
                INNER JOIN bs_index
                    ON bs_index.unique_id = tournament_template.id
                INNER JOIN event_participants
                    ON event_participants.eventFK = event.id
                INNER JOIN participant
                    ON event_participants.participantFK = participant.id
                WHERE participant.id = " . $teamId;

        if ($query = $miDB->query($sql)) :
            foreach ($query as $row) :
                $matches[$row['ext_id']] = [
                    'ext_id' => $row['ext_id'],
                    'match_name' => $row['match_name'],
                    'startdate' => $row['startdate'],
                    'ext_cat_name' => $row['ext_cat_name'],
                    'ext_cat_id' => $row['ext_cat_id'],
                    'cat_id_rf' => $row['cat_id_rf'],
                    'ext_team_id' => $row['ext_team_id'],
                    'team_name' => $row['team_name'],
                    'rf_match_id' => 0
                ];
            endforeach;
        endif;

        return $matches;
    }

    /**
     * Partidos con apuestas del día (BD Elo)
     * @param $miDB: Conexión con la base de datos 
     * @param $extMatchIds: Match ids de rf para ver si continenen apuestas de BD Elo
     * 
     * @return array
     */
    public static function  getMatchesWithBets(object $miDB, array $extMatchIds): array
    {
        $extMatchIds = (implode(",", $extMatchIds));

        $data = [];

        $sql = "SELECT uniqueId
                FROM " . ODDS_MATCH_WINNER . "
                WHERE uniqueId IN ($extMatchIds) GROUP BY uniqueId";

        if ($query = $miDB->query($sql)) :
            foreach ($query as $row) :
                $data[$row['uniqueId']] = $row;
            endforeach;
        endif;

        return $data;
    }

    /**
     * Partido (BD futbol)
     * 
     * @param $miDB: Conexión con la base de datos 
     * @param $matchId: Id del partido de rf
     * @param $season: Año de calendars
     * 
     * @return array
     */
    public static function getMatchById(object $miDB, string $matchId = NULL, string $season = NULL): array
    {
        $data = [];

        $sql = "SELECT c.id, c.r1,c.r2, c.shedule, c.league_id, c.team1_name, c.team2_name, c.datateam1, c.datateam2, l.categoryId
                FROM " . CALENDARS . $season . " as c
                INNER JOIN leagues as l
                ON l.id= c.league_id
                WHERE
                    c.id = " . $matchId;

        if ($query = $miDB->query($sql)) :
            foreach ($query as $row) :
                $row['season'] = $season;
                array_push($data, $row);
            endforeach;
        endif;

        return $data;
    }

    /** 
     * Listado de Partidos de Fuentes externas (Enetpulse) que no están relacionados
     * @param $miDB: Conexión con la base de datos 
     * @param $extId: Match Id externo
     * 
     * @return array
     */
    public static function getExtMatchesUnrelated(object $miDB, $extId = NULL): array
    {
        $matches = [];

        if (!empty($extId)) {
            $extId = "= " . $extId;
        } else {
            $extId = 'IS NOT NULL';
        }

        $sql = "SELECT 
        nr.id as ext_id, nr.matchId, nr.took_date, nr.status,
        e.name as match_name, e.tournament_stageFK, e.startdate,
        ep.participantFK as ext_team_id, ep.number,
        bst.name as team_name, bst.rf_id as team_rf_id,
        bsi.id as ext_cat_id, bsi.id_rf as cat_id_rf
        FROM " . BS_NO_REL_CALENDARS . " as nr
        INNER JOIN event as e
            ON nr.id = e.id
        INNER JOIN event_participants as ep
            ON ep.eventFK = e.id
        INNER JOIN bs_rel_teams as bst
            ON bst.id = ep.participantFK	
        INNER JOIN tournament_stage as ts
            ON ts.id = e.tournament_stageFK
        INNER JOIN tournament as t
            ON t.id = ts.tournamentFK
        INNER JOIN bs_index as bsi
            ON t.tournament_templateFK = bsi.id " . "WHERE nr.id " . $extId . "
        ORDER BY
            nr.took_date ASC";

        if ($query = $miDB->query($sql)) :
            foreach ($query as $row) :
                $tempTeam[$row['number']] = [
                    'team_name' => $row['team_name'],
                    'rf_id' => $row['team_rf_id'],
                    'ext_team_id' => $row['ext_team_id'],
                ];

                $matches[$row['ext_id']] = [
                    'ext_id' => $row['ext_id'],
                    'rf_match_id' => $row['matchId'],
                    'match_name' => $row['match_name'],
                    'startdate' => $row['startdate'],
                    'cat_id_rf' => $row['cat_id_rf'],
                    'ext_cat_id' => $row['ext_cat_id'],
                    'took_date' => $row['took_date'],
                    'status' => $row['status'],
                    'teams' => $tempTeam,

                ];

            endforeach;
        endif;

        return $matches;
    }

    /**
     * Relaciona partidos de Fuentes externas (Enetpulse y Goalserve) con nuestro rf matchId
     * @param $miDB: Conexión con la base de datos 
     * @param $extId: Id del partido Fuentes externas (Enetpulse y Goalserve)
     * @param $rfId:  Id del partido de RF que vamos a relacionar
     * 
     * @return bool
     */
    public static function setRfMatchId(object $miDB, string $extId, string $rfId): bool
    {
        $sql = "UPDATE 
                    " . BS_NO_REL_CALENDARS . "
                SET
                matchId = " . $rfId . " 
                WHERE
                    id = " . $extId;

        if ($miDB->query($sql)) :
            return true;
        endif;

        return false;
    }
}
