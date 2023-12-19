<?php

/**
 * Helper con diversas funciones interesantes
 * @author Pablo Gutiérrez
 */

namespace BesoccerOdds\Helpers;

use BesoccerOdds\Classes\Helper;
use BeSoccerSDK\Classes\Cleaner;
use BeSoccerSDK\Classes\File;

class Functions extends Helper{

    /**
     * Sin descripción
     * @param array $dataArray
     * @param array $sortingParams
     * @return array
     */
    public static function sortArray($dataArray,$sortParams):array
    {
        $auxSortArray = array(
            'ASC' => SORT_ASC,
            'DESC' => SORT_DESC,
        );

        $sortingParams = array();
        foreach ($sortParams as $sp_key => $sp_value):
            $sortingParams[] = array_column($dataArray, $sp_key);
            $sortingParams[] = $auxSortArray[$sp_value];
        endforeach;

        $sortingParams[] = &$dataArray;

        array_multisort(...$sortingParams);

        return $dataArray;
    }

    /**
     * Devuelve el trozo de un string y una longitud dada
     * @param string $string
     * @param int $lenght
     * @return array
     */
    public static function cutString(string $string, int $lenght): string
    {
        if(strlen($string) > $lenght):

            $amount = $lenght - 6;

            $stringSmall = substr($string,0,$amount)."...";
            return $stringSmall;

        else:
            return $string;
        endif;
    }

    /**
     * Limpia el código fuente de una web de espacios en blanco de mas y saltos de linea, útil para las expresiones regulares
     * @param string $sourceCode (Texto a tratar, normalmente será un código fuente de una web)
     * @return array
     */
    public static function htmlCleaner(string $sourceCode): string
    {
        $sourceCode = preg_replace("/	/i", "", $sourceCode);
        $sourceCode = preg_replace("/[ ]+/i", " ", $sourceCode);
        $sourceCode = preg_replace("//i", "", $sourceCode);
        $sourceCode =  preg_replace(['/\s+/','/^\s|\s$/'],[' ',''], $sourceCode);

        return $sourceCode;
    }

    /**
     * Devuelve un array con lo necesario para añadir logs en los array params
     * * @param string $url direccion web donde se ha producido dicha consulta
     * @return array
     */
    public static function getLogParams(string $url): array
    {
        $logArray= [
            File::LOG_KEY_USER => 1000,
            File::LOG_KEY_URL => Cleaner::skipCleaner($url),
            
        ];

        return $logArray;
    }

}

?>