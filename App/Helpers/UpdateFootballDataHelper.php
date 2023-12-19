<?php

/**
 * Helper para la actualización de ligas de Football Data UK
 * @author Elías Moreno
 */

namespace BesoccerOdds\Helpers;

use BesoccerOdds\Classes\Helper;


class UpdateFootballDataHelper extends Helper
{

    /**
     * Convierte country code en nombre del país para el lanzamiento de script
     * @param string $countryCode
     * @return string
     */
    public static function countryCodeToCountryName($countryCode): string
    {

        $country = [
            "gb" => "england",
            "ss" => "scotland",
            "de" => "germany",
            "it" => "italy",
            "es" => "spain",
            "fr" => "france",
            "nl" => "netherlands",
            "be" => "belgium",
            "pt" => "portugal",
            "tk" => "turkey",
            "gr" => "greece"
        ];

        $countryWorld = [
            "ar" => "argentina",
            "at" => "austria",
            "br" => "brazil",
            "cn" => "china",
            "dk" => "denmark",
            "fi" => "finland",
            "ie" => "ireland",
            "jp" => "japan",
            "mx" => "mexico",
            "no" => "norway",
            "pl" => "poland",
            "ro" => "romania",
            "ru" => "russia",
            "se" => "sweden",
            "ch" => "switzerland",
            "us" => "usa"
        ];

        if (isset($country[$countryCode])) {

            return $country[$countryCode];
        }

        if (isset($countryWorld[$countryCode])) {

            return $countryWorld[$countryCode];
        }
    }

    /**
     * Dependiendo del countrycode lanza el script update o el updateworld
     * @param string $countryCode
     * @return string
     */
    public static function updateOrUpdateWorld($countryCode): string
    {

        $country = [
            "gb" => "england",
            "ss" => "scotland",
            "de" => "germany",
            "it" => "italy",
            "es" => "spain",
            "fr" => "france",
            "nl" => "netherlands",
            "be" => "belgium",
            "pt" => "portugal",
            "tk" => "turkey",
            "gr" => "greece"
        ];

        $countryWorld = [
            "ar" => "argentina",
            "at" => "austria",
            "br" => "brazil",
            "cn" => "china",
            "dk" => "denmark",
            "fi" => "finland",
            "ie" => "ireland",
            "jp" => "japan",
            "mx" => "mexico",
            "no" => "norway",
            "pl" => "poland",
            "ro" => "romania",
            "ru" => "russia",
            "se" => "sweden",
            "ch" => "switzerland",
            "us" => "usa"
        ];

        if (isset($country[$countryCode])) {
            $update = "update";
            return $update;
        }

        if (isset($countryWorld[$countryCode])) {
            $updateWorld = "updateworld";
            return $updateWorld;
        }
    }

    /**
     * Convierte season en formato 2023 a formato del lanzamiento del script 2223
     * @param string $season
     * @return string
     */
    public static function seasonYearToFileFormat($season): string
    {
        $endSeasonYear = substr($season, -2);
        $startSeasonYear = substr(($season - 1), -2);

        $seasonFormat = $startSeasonYear . $endSeasonYear;

        return $seasonFormat;
    }

    /**
     * Lanza script para relacionar partidos externos de raw con nuestros ids de BD futbol
     * @param string $year
     * @param string $catId
     * @return string
     */
    public static function updateRelateRaw($year, $catId): void
    {
        $ch = curl_init();

        $url = 'http://bigdata02.besoccer.com/scripts/data_sources/odds/main.php?year=' . $year . '&catId=' . $catId;
        
        
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        
        curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Curl Error:' . curl_error($ch);
        }
        
        echo 'Resultado de la ejecución de', $url;

        curl_close($ch);

    }
}
