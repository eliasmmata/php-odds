<?php

namespace BesoccerOdds\Models;

use BesoccerOdds\Classes\Model;

class ErrorsModel extends Model
{

    /**
     * Recolección de errores del Cron que trae los datos de la API de Goalserve
     * @param $miDB: Conexión con la base de datos 
     * 
     * @return array
     */
    public static function getErrorsGoalserve(object $miDB): array
    {
        $data = [];

        $sql = "SELECT errors_gs.id, errors_gs.indexId, errors_gs.errorcode, errors_gs.took_date, index_gs.name
                FROM " 
                    . ERRORS . "
                INNER JOIN index_gs
                ON index_gs.id = errors_gs.indexId
                ORDER BY errors_gs.id DESC
                LIMIT 100";

        if ($query = $miDB->query($sql)) :
            foreach ($query as $row) :
                array_push($data, $row);
            endforeach;
        endif;

        return $data;
    }
}
