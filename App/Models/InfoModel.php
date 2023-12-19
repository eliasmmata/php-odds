<?php

namespace BesoccerOdds\Models;

use BesoccerOdds\Classes\Model;

class InfoModel extends Model
{

    /**
     * Info sobre última actualización de Enetpulse
     * @param $miDB: Conexión con la base de datos 
     * 
     * @return array
     */
    public static function getLastUpdateEp(object $miDB): array
    {
        $data = [];

        $sql = "SELECT * FROM " . TIMESTAMP_EP;

        if ($query = $miDB->query($sql)) :
            foreach ($query as $row) :
                array_push($data, $row);
            endforeach;
        endif;

        return $data;
    }

    /**
     * Info sobre última actualización de Enetpulse
     * @param $miDB: Conexión con la base de datos 
     * 
     * @return array
     */
    public static function getLastUpdateGs(object $miDB): array
    {
        $data = [];

        $sql = "SELECT * FROM " . TIMESTAMP_GS;

        if ($query = $miDB->query($sql)) :
            foreach ($query as $row) :
                array_push($data, $row);
            endforeach;
        endif;

        return $data;
    }
}
