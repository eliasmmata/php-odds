<!-- <h2>Estoy en el Benchmark</h2> -->

<?php

use BesoccerOdds\Classes\Benchmark;

$benchmark = Benchmark::getInstance();

$benchmarkData = $benchmark->getBenchmark();

// echo '<pre>';
// echo 'POST';
// print_r($benchmarkData['url']['POST']);
// echo '</pre><pre>';
// echo 'GET';
// print_r($benchmarkData['url']['GET']);
// echo '</pre><pre>';
// echo 'Mysql';
// print_r($benchmarkData['mysql']);
// echo '</pre><pre>';
// echo 'Memory </br>';
// print_r($benchmarkData['php']['usage_memory']);
// echo '</pre><pre>';
// echo 'Global';
// print_r($benchmarkData['global']);
// echo '</pre>';

?>