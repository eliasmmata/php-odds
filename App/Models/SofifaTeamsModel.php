<?php 
namespace BesoccerOdds\Models;

use BesoccerOdds\Classes\Model;
use BesoccerOdds\Classes\Mysql_db;

    class SofifaTeamsModel extends Model {

        public static function getFormacion($formacion) {
            $data = [];
            $miDB = new Mysql_db();
            $sql ="SELECT id, name, rating, att, mid, def FROM sofifa_teams WHERE formation = '{$formacion}'";

            if($query = $miDB->query($sql)):            
                foreach($query as $row):
                    array_push($data,$row);
                endforeach;
            endif;
            return $data;
        }
    }
?>