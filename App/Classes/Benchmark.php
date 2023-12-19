<?php

/**
 * Clase padre para gestionar el benchmark
 * @author Yisus Gómez
 */

namespace BesoccerOdds\Classes;

class Benchmark{

    /**
     * Variable que guardara la instancia actual del Benchmark
     * @var Benchmark
     */
    private static $instance = NULL;

    /**
     * Variable con los datos de las consultas a la base de datos
     * @var array
     */
    private static $mysqlBenchmarkData = array();

    /**
     * Variable con los datos de los archivos de php
     * @var array
     */
    private static $phpBenchmarkData = array();

    /**
     * Variable con los datos de los archivos de php
     * @var array
     */
    private static $urlBenchmarkData = array();

    /**
     * Tiempo en milisegundos del momento en el que se pide la pantalla actual
     * @var int
     */
    private static $timeIni = 0;

    /**
     * Tiempo en milisegundos del momento en el que termina la ejecución de la pantalla actual
     * @var int
     */
    private static $timeEnd = 0;

    /**
     * Constructor vacío
     */
    protected function __construct()
    {
        
    }

    /**
     * Función que crea la instancia de Benchmark, en caso de que ya existe, te devuelve la actual.
     * 
     * @return Benchmark
     */
    static public function getInstance(): Benchmark
    {

        if(self::$instance === NULL){
            self::$instance = new Benchmark();
            self::$instance->setTimeIni();
        }

        return self::$instance;

    }

    /**
     * Función que guarda en el Benchmark (PHP) un array de datos con una clave dada.
     * 
     * @param $data (Array de datos)
     * @param $key (Clave para el array anterior)
     */
    public function setPhpBenchmarkData($data, $key): void
    {
        Benchmark::$phpBenchmarkData[$key] = $data;
    }

    /**
     * Función que guarda en el Benchmark (Url) un array de datos con una clave dada.
     * 
     * @param $data (Array de datos)
     * @param $key (Clave para el array anterior)
     */
    public function setUrlBenchmarkData($data, $key): void
    {
        Benchmark::$urlBenchmarkData[$key] = $data;
    }

    /**
     * Función que guarda en el Benchmark (MYSQL) un array de datos asociado al repositorio que llama a la SDK.
     * 
     * @param $data (Array de datos)
     * @param $repositoryName (Nombre del repositorio)
     */
    public function setMysqlBenchmarkData($data, $repositoryName = 'Undefined'): void
    {
        Benchmark::$mysqlBenchmarkData[] = [
            'repositoryName' => $repositoryName,
            'sdkResume' => $data
        ];
    }

    /**
     * Función que guarda el tiempo actual. Únicamente se llama la primera vez que inicializas la clase.
     */
    public function setTimeIni(): void
    {
        Benchmark::$timeIni = floor(microtime(true) * 1000);
    }

    /**
     * Función que guarda el tiempo actual en milisegundos. Únicamente se llama justo antes de devolver todos los datos almacenados.
     */
    public function setTimeEnd(): void
    {
        Benchmark::$timeEnd = floor(microtime(true) * 1000);
    }

    /**
     * Función que guarda en el benchmark las siguientes ejecuciones en las siguientes claves:
     * included_files => get_included_files()
     * declared_classes => get_declared_classes()
     * memory_get_usage => usage_memory()
     */
    private function setPhpData(): void
    {

        $benchmark = Benchmark::getInstance();
        $benchmark -> setPhpBenchmarkData(get_included_files(), 'included_files');
        $benchmark -> setPhpBenchmarkData(get_declared_classes(), 'declared_classes');
        $benchmark -> setPhpBenchmarkData(memory_get_usage(), 'usage_memory');

    }

    /**
     * Función que devuelve todos los datos almacenados.
     * 
     * @return array
     */
    public function getBenchmark(): array
    {

        $benchmark = Benchmark::getInstance();
        $benchmark -> setPhpData();
        $benchmark -> setTimeEnd();

        $benchmarkData = [
            'url' => Benchmark::$urlBenchmarkData,
            'mysql' => Benchmark::$mysqlBenchmarkData,
            'php' => Benchmark::$phpBenchmarkData,
            'global' => [
                'initTime' => Benchmark::$timeIni,
                'endTime' => Benchmark::$timeEnd,
            ],
        ];

        return $benchmarkData;

    }

}

?>