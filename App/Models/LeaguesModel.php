<?php

namespace BesoccerOdds\Models;

use BesoccerOdds\Classes\Model;
use BeSoccerSDK\Classes\Show;

class LeaguesModel extends Model
{
    /* CONST db = 'bigdata'; CONST table = 'calendars_odds'; */

    /**
     * Ligas de Football Data (BD Big Data)
     * @param $miDB: Conexión con la base de datos 
     * @param $categoryId: Id de la categoría de la liga 
     * @param $leagueId: Id de la liga 
     * 
     * @return array
     */
    public static function getLeaguesOdds(object $miDB, string $categoryId = NULL, string $leagueId = NULL): array
    {
        $data = [];

        $sql = "SELECT DISTINCT 
                        league_id, season , category_id 
                   FROM " 
                        . ODDS;

        if (isset($categoryId)) {
            $sql = $sql . " WHERE category_id = " . $categoryId;
        }
        if (isset($leagueId)) {
            $sql = $sql . " WHERE league_id = " . $leagueId;
        }

        if ($query = $miDB->query($sql)) :
            foreach ($query as $row) :
                array_push($data, $row);
            endforeach;
        endif;

        return $data;
    }

    /**
     *  Información relevante sobre categories de BD Futbol
     * @param $miDB: Conexión con la base de datos 
     * @param $categoryId: Id de la categoría de la liga 
     * 
     * @return array
     */
    public static function getCategoriesInfo(object $miDB, string $categoryId = NULL)
    {
        $data = [];

        $sql = "SELECT id, `name`, logo, CountryCode FROM " . CATEGORIES;

        if (isset($categoryId)) {
            $sql = $sql . " WHERE id = " . $categoryId;
        }

        if ($query = $miDB->query($sql)) :
            foreach ($query as $row) :
                $data[$row['id']] = $row['name'];
                $data[$row['id'] . 'logo_img'] = $row['logo'];
                $data[$row['id'] . 'cc'] = $row['CountryCode'];
            endforeach;
        endif;

        return $data;
    }

    /**
     * Ejecuta las queries SQL dadas para actualizar los partidos de la liga señalada (Football Data)
     * @param $miDB: Conexión con la base de datos 
     * @param $sqls: Lista de consultas
     * 
     * @return void
     */
    public static function updateLeaguesMatches(object $miDB, array $sqls): void
    {
        foreach ($sqls as $sql) :
            $miDB->query($sql);
        endforeach;
    }

    /**
     * Categorías de las que se están relacionando partidos y apuestas de Bigdata (Goalserve y Football Data). 
     * Aquí tabla Enetpulse index_ep no actualizada
     * @param $miDB: Conexión con la base de datos 
     * @param $categoryId: Id de categoria rf relacionada con GS
     * 
     * @return array
     */
    public static function getAllLeaguesFromBigdata(object $miDB, string $categoryId = NULL, $limit = NULL, $offset = NULL): array
    {
        $data = [];

        $sql = "SELECT 
                gs.id_rf as gs_id_rf, gs.name as gs_name, gs.unique_id as gs_unique_id, gs.countryName as gs_countryName, gs.countryCode as gs_countryCode,
                ep.id_rf as ep_id_rf, ep.name as ep_name, ep.unique_id as ep_unique_id,
                fd.id_rf as fd_id_rf, fd.id as fd_unique_id, fd.name as fd_name, fd.countryCode as fd_countryCode
                    FROM " . INDEX_GS . " as gs
                LEFT JOIN index_ep as ep
                    ON gs.id_rf = ep.id_rf
                LEFT JOIN index_fd as fd
                    ON gs.id_rf = fd.id_rf";

        if (isset($categoryId)) {
            $sql = $sql . " WHERE gs.id_rf = " . $categoryId;
        } else {
            $sql = $sql . " WHERE NOT (gs.id_rf IS NULL AND ep.id_rf IS NULL AND fd.id_rf IS NULL) ORDER BY gs_id_rf ASC LIMIT $limit OFFSET $offset";
        }

        if ($query = $miDB->query($sql)) :
            foreach ($query as $row) :
                array_push($data, $row);
            endforeach;
        endif;

        return $data;
    }

    /**
     * Categorías de las que se están relacionando partidos y apuestas de BD Bets (Enetpulse)
     * @param $miDB: Conexión con la base de datos 
     * @param $categoryId: Id de categoria rf relacionadas con bets ids
     * 
     * @return array
     */
    public static function getAllLeaguesFromBets(object $miDB, string $categoryId = NULL): array
    {

        $data = [];

        $sql = "SELECT id_rf as bets_ep_id_rf, unique_id as ep_unique_id, 
                    `name` as bets_ep_name, name_ext as bets_ep_name_ext,
                    countryCode as bets_countryCode, countryName as bets_ep_countryName
                FROM " . BS_INDEX;

        if (isset($categoryId)) {
            $sql = $sql . " WHERE id_rf = " . $categoryId;
        } else {
            $sql = $sql . " WHERE id_rf IS NOT NULL ORDER BY id_rf ASC";
        }

        if ($query = $miDB->query($sql)) :
            foreach ($query as $row) :
                array_push($data, $row);
            endforeach;
        endif;

        return $data;
    }

      /**
     * Conteo todas competiciones para paginación
     * @param $miDB: Conexión con la base de datos 
     * @param $source: tabla de la fuente externa donde vamos a seleccionar los equipos
     * @return integer
     */
    public static function getLeaguesCount(object $miDB, $source) {
        $data = [];

        $sql = "SELECT * FROM $source" ;

        if ($query = $miDB->query($sql)) :
            foreach ($query as $row) :
                array_push($data, $row);
            endforeach;
        endif;

        $teamsCount = count($data);

        Show::dd($sql);
        Show::dd($teamsCount);

        return $teamsCount;
    }

    /**
     * Añadir Nombre externo de EP a BD Bets
     * @param $miDB: Conexión con la base de datos 
     * @param $nameExtEp: Nombre de la liga de Enetpulse
     * @param $idRf: Id de la categoría relacionada con fuente externa
     * @param $extId: Id Fuente Externa
     * 
     * @return bool
     */
    public static function setNameExtBets(object $miDB, string $nameExtEp, string $idRf = NULL, string $extId = NULL): bool
    {
        $sql = "UPDATE
                    " . BS_INDEX . "
                SET
                    name_ext = " . '"' .  $nameExtEp . '"' .  " 
                ";

        if (empty($extId)) {
            $sql = $sql . "  WHERE id_rf = " . $idRf;
        } else {
            $sql = $sql . " WHERE unique_id = " . $extId;
        }

        if ($miDB->query($sql)) :
            return true;
        endif;
        return false;
    }

    /**
     * Añadir CountryCode o Country Name de EP a BD Bets
     * @param $miDB: Conexión con la base de datos 
     * @param $country: Info del país
     * @param $extId: Id Fuente Externa
     * @param $length: Longitud para filtrar entre Country Code o Country Name
     * 
     * @return bool
     */
    public static function setCountryBets(object $miDB, string $country, string $extId = NULL, string $length = NULL): bool
    {
        $length = intval($length);

        if($length === 2) {
            $country = strtolower($country);
            $table = "countryCode";
        } else {
            $country = ucwords($country);
            $table = 'countryName';
            
        }
        $sql = "UPDATE 
                    " . BS_INDEX . "
                SET "
                    . $table . "=" . '"' .  $country . '"' .  " 
                WHERE unique_id = " . $extId;
        
        if ($miDB->query($sql)) :
            return true;
        endif;
        return false;
    }

    /**
     * Relacionar Id de Rf con Id Externa dependiento de la variable table
     * @param $miDB: Conexión con la base de datos 
     * @param $rfId: Id de la categoría relacionada con fuente externa
     * @param $extId: Id externo 
     * @param $table: Nombre de la tabla
     * 
     * @return bool
     */
    public static function setExtId(object $miDB, string $idRf = NULL, string $extId, string $table = NULL): bool
    {
        $sql = "UPDATE 
                        " .  $table . "
                    SET
                        id_rf = " . $idRf .  " 
                    WHERE
                        id = " . $extId;
        
        if ($miDB->query($sql)) :
            return true;
        endif;
        return false;
    }

    /** 
     * Listado de Categorias (competiciones) de Enetpulse que no están relacionadas con RF
     * @param $miDB: Conexión con la base de datos 
     * @param $extId: Id Externo de categoría para filtrar
     * 
     * @return array
     */
    public static function getEpCategoriesUnrelated(object $miDB, string $extId = NULL) : array
    {
        $data = [];

        $sql = "SELECT id as ep_id, id_rf as ep_id_rf, unique_id as ep_unique_id,
                name as ep_name, name_ext as ep_name_ext, countryName as ep_countryName, countryCode as ep_countryCode
                FROM " . BS_INDEX;

        if (empty($extId)) {
            $sql = $sql . " WHERE id_rf IS NULL";
        } else {
            $sql = $sql . " WHERE unique_id = " . $extId;
        }

        if ($query = $miDB->query($sql)) :
            foreach ($query as $row) :
                array_push($data, $row);
            endforeach;
        endif;

        return $data;
    }

    /** 
     * Listado de Categorias (competiciones) de Goalserve que no están relacionadas con RF
     * @param $miDB: Conexión con la base de datos 
     * @param $extId: Id Externo de categoría para filtrar
     * 
     * @return array
     */
    public static function getGsCategoriesUnrelated(object $miDB, string $extId = NULL) : array
    {
        $data = [];

        $sql = "SELECT id as gs_id, id_rf as gs_id_rf, unique_id as gs_unique_id, name as gs_name, name_ext as gs_name_ext,
                countryName as gs_countryName, countryName as gs_countryName, countryCode as gs_countryCode
                FROM " . INDEX_GS;

        if (empty($extId)) {
            $sql = $sql . " WHERE id_rf IS NULL";
        } else {
            $sql = $sql . " WHERE unique_id = " . $extId;
        }

        if ($query = $miDB->query($sql)) :
            foreach ($query as $row) :
                array_push($data, $row);
            endforeach;
        endif;
        
        return $data;
    }

     /**
     * Añadir Nombre externo de GS a BD Bigdata
     * @param $miDB: Conexión con la base de datos 
     * @param $nameExtGs: Nombre de la liga de Goalserve
     * @param $idRf: Id de la categoría relacionada con fuente externa
     * @param $extId: Id Fuente Externa
     * 
     * @return bool
     */
    public static function setNameExtGs(object $miDB, string $nameExtGs, string $idRf = NULL, string $extId = NULL): bool
    {
        $sql = "UPDATE
                    " . INDEX_GS . "
                SET
                    name_ext = " . '"' .  $nameExtGs . '"' .  " 
                ";

        if (empty($extId)) {
            $sql = $sql . "  WHERE id_rf = " . $idRf;
        } else {
            $sql = $sql . " WHERE unique_id = " . $extId;
        }

        if ($miDB->query($sql)) :
            return true;
        endif;
        return false;
    }

      /**
     * Añadir CountryCode o Country Name de Gs a BD Bigdata
     * @param $miDB: Conexión con la base de datos 
     * @param $country: Info del país
     * @param $extId: Id Fuente Externa
     * @param $length: Longitud para filtrar entre Country Code o Country Name
     * 
     * @return bool
     */
    public static function setCountryGs(object $miDB, string $country, string $extId = NULL, string $length = NULL): bool
    {
        $length = intval($length);

        if($length === 2) {
            $country = strtolower($country);
            $table = "countryCode";
        } else {
            $country = ucwords($country);
            $table = 'countryName';
            
        }
        $sql = "UPDATE 
                    " . INDEX_GS . "
                SET "
                    . $table . "=" . '"' .  $country . '"' .  " 
                WHERE unique_id = " . $extId;
        
        if ($miDB->query($sql)) :
            return true;
        endif;
        
        return false;
    }

}
