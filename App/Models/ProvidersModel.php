<?php

namespace BesoccerOdds\Models;

use BesoccerOdds\Classes\Model;
use BeSoccerSDK\Classes\Show;

class ProvidersModel extends Model
{

    /**
     * Recolección de providers (casas de apuestas) de Fuentes Externas (Bigdata).
     * @param $miDB: Conexión con la base de datos 
     * @param $extId:Id autoincremental del provider
     * @param $table: tabla de la BD
     * 
     * @return array
     */
    public static function getProviders(object $miDB, string $extId = NULL, string $table = NULL): array
    {
        $data = [];

        if (empty($extId)) {
            $sql = "SELECT rf.id as rf_id, rf.name as rf_name, 
                        ep.id as ep_id, ep.rfId as ep_rfId, ep.name as ep_name,
                        gs.id as gs_id, gs.rfId as gs_rfId, gs.name as gs_name,
                        fd.id as fd_id, fd.rfId as fd_rfId, fd.name as fd_name
                    FROM " . PROVIDERS_RF . " as rf
                    LEFT JOIN providers_ep as ep
                        ON ep.rfId = rf.id
                    LEFT JOIN providers_gs as gs
                        ON gs.rfId = rf.id
                    LEFT JOIN providers_odds as fd
                        ON fd.rfId = rf.id
                    ORDER BY rf.id ASC";
        } else {
            $sql = "SELECT id, name, rfId as rf_id FROM " . $table . " WHERE rfId = " . $extId;
        }

        if ($query = $miDB->query($sql)) :
            foreach ($query as $row) :
                $data[$row['rf_id']] = $row;
            endforeach;
        endif;
                
        return $data;
    }
    /**
     * Relación de rfId de providers (casas de apuestas)
     * @param $miDB: Conexión con la base de datos 
     * @param $extId:Id autoincremental del provider
     * @param $rfId: Id de RF para setear y relacionar con provider externo
     * @param $table: tabla de la BD
     * 
     * @return array
     */
    public static function setProviderRel(object $miDB, string $extId,  string $rfId, string $table): bool
    {

        $sql = "UPDATE
                     $table
                SET 
                    rfId = " . $rfId . "
                WHERE 
                    extId = " . $extId;

        if ($miDB->query($sql)) :
            return true;
        endif;

        return false;
    }
}
