<?php

namespace BesoccerOdds\Models;

use BesoccerOdds\Classes\Model;
use BeSoccerSDK\Classes\Show;

class TeamsModel extends Model
{

    /**
     * Obtener equipo externo de Football Data relacionado con BD futbol 
     * @param $miDB: Conexión con la base de datos 
     * @param $rfId: Id del equipo de rf relacionado con equipo Football Data
     * @param $table: Nombre tabla BD
     * @param $rowName: Nombre fila BD
     * @param $rowData: Flag para cambiar consulta
     * 
     * @return array
     */
    public static function getDatateamsRel(object $miDB, string $rfId = NULL, string $table = NULL, string $rowName = NULL, $rowData = NULL,$limit = NULL, $offset = NULL): array
    {
        $innerJ = " ";

        if(isset($rowData) && $rfId === '0') {
            $innerJ = "INNER JOIN participant ON participant.id = bs_rel_teams.id 
                       INNER JOIN country ON country.id = participant.countryFK";
            $rows = " country.name as country_name, participant.name, participant.id, bs_rel_teams.rf_id ";
        } else {
            $rows = '*';
        }

        if (empty($table)) {
            $table = DATATEAMS_FD;
            $rowName = "rfId";
            $rows = '*';
        }

        $data = [];

        $sql = "SELECT $rows FROM " . " $table ";

        if (isset($rfId)) {
            $sql = $sql . $innerJ .  " WHERE " . $rowName . " = " . $rfId . " LIMIT 150";
        } else {
                /*  $sql = $sql . " ORDER BY RAND() LIMIT 100"; */
                $sql = $sql . " LIMIT $limit OFFSET $offset";
        }

        if ($query = $miDB->query($sql)) :
            foreach ($query as $row) :
                array_push($data, $row);
            endforeach;
        endif;

        return $data;
    }

    /**
     * Conteo todos equipos para paginación
     * @param $miDB: Conexión con la base de datos 
     * @param $source: tabla de la fuente externa donde vamos a seleccionar los equipos
     * @return integer
     */
    public static function getDtRelCount(object $miDB, $source) {
        $data = [];

        $sql = "SELECT * FROM $source" ;

        if ($query = $miDB->query($sql)) :
            foreach ($query as $row) :
                array_push($data, $row);
            endforeach;
        endif;

        $teamsCount = count($data);

        return $teamsCount;
    }

    /**
     * Relaciona equipos de Football Data a través de su id y nuestro rf Id
     * @param $miDB: Conexión con la base de datos 
     * @param $rfId: Id del equipo de rf relacionado con equipo Football Data
     * @param $table: Nombre tabla BD dependiendo de la fuente externa
     * @param $rowName: Nombre fila BD dependiendo de la fuente externa
     * @param $rowNameId: Nombre fila de relación de id ext o unique_ID dependiendo de la fuente externa
     * 
     * @return bool
     */
    public static function setDatateams(object $miDB, string $id, string $rfId, string $table = NULL, string $rowName = NULL, string $rowNameId = NULL): bool
    {
        if (empty($table)) {
            $table = DATATEAMS_FD;
            $rowName = "rfId";
        }

        if(!empty($rowNameId)) {
            $rowNameId = 'unique_Id';
        } else {
            $rowNameId = 'id';
        }

        $sql = "UPDATE 
                    $table
                SET
                    $rowName = " . $rfId . " 
                WHERE "
                   . $rowNameId . " = " . $id;

        if ($miDB->query($sql)) :
            return true;
        endif;
        return false;
    }

    /**
     * Obtiene nombres de equipo a través de nuestro rf Id
     * @param $miDB: Conexión con la base de datos 
     * @param $rfId: Id del equipo de rf
     * @return array
     */
    public static function getDatateamsName(object $miDB, string $rfId = NULL): array
    {

        $data = [];

        $sql = "SELECT id, `nameShow`  FROM " . DATATEAMS;

        if (isset($rfId)) {
            $sql = $sql . " WHERE id = " . $rfId;
        }

        if ($query = $miDB->query($sql)) :
            foreach ($query as $row) :
                $data[$row['id']] = $row['nameShow'];
            endforeach;
        endif;

        return $data;
    }

    /**
     * Obtiene Country Code de equipo a través de nuestro rf Id
     * @param $miDB: Conexión con la base de datos 
     * @param $rfId: Id del equipo de rf
     * @return array
     */
    public static function getDatateamsCountryCode(object $miDB, string $rfId = NULL): array
    {

        $data = [];

        $sql = "SELECT id, countryCode  FROM " . DATATEAMS;

        if (isset($rfId)) {
            $sql = $sql . " WHERE id = " . $rfId;
        }

        if ($query = $miDB->query($sql)) :
            foreach ($query as $row) :
                $data[$row['id']] = $row['countryCode'];
            endforeach;
        endif;

        return $data;
    }


     /**
     * Obtener equipo externo de Football Data relacionado con BD futbol 
     * @param $miDB: Conexión con la base de datos 
     * @param $rfId: Id del equipo de rf relacionado con equipo Football Data
     * @param $table: Nombre tabla BD
     * @param $rowName: Nombre fila BD
     * @param $rowData: Flag para cambiar consulta
     * 
     * @return array
     */
    public static function getDatateamsGs(object $miDB, string $rfId = NULL, $limit = NULL, $offset = NULL): array
    {


        $data = [];

        $sql = "SELECT id as gs_id, unique_Id as gs_unique_Id, nombre as gs_name, rfId as gs_rf_id, nacion as gs_country_name
                FROM " . DATATEAMS_GS;

        if (isset($rfId)) {
            $sql = $sql . " WHERE rfId = " . $rfId . " LIMIT 150";
        }  else {
            // $sql = $sql . " ORDER BY RAND() LIMIT 100";
            $sql = $sql . " LIMIT $limit OFFSET $offset";
        }

        if ($query = $miDB->query($sql)) :
            foreach ($query as $row) :
                array_push($data, $row);
            endforeach;
        endif;

        return $data;
    }

}
