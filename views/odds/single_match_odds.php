<?php

use BeSoccerSDK\Classes\Show;

$matchId = $_GET['match_id'] ?? 0;

$previous = "javascript:history.go(-1)";
if (isset($_SERVER['HTTP_REFERER'])) {
    $previous = $_SERVER['HTTP_REFERER'];
}

?>
<div class="my-4 px-2 border border-1 border-opacity-50 py-3 rounded">
    <div class="d-flex align-items-center justify-content-center">
        <div class="d-flex justify-content-center align-items-center">
            <h3 class="h1 text-center">Single Match Odds</h3>
        </div>
        <div class="d-flex align-items-center position-absolute" style="right: 2rem;">
            <a class="btn btn btn-warning" href="/data_info/matches">
                <i class="fa-solid fa-chevron-left"></i>
                <span class="ml-1">Volver</span>
            </a>
        </div>
    </div>
    <table class="table table-bordered table-sm mt-4 mb-4">
        <thead class="thead-dark">
            <tr class="text-center text-uppercase">
                <th scope="col">Match ID</th>
                <th scope="col">Fecha</th>
                <th scope="col">League</th>
                <th scope="col">Season</th>
                <th scope="col" colspan="5">Partido</th>
                <th scope="col">1X2</th>
            </tr>
        </thead>
        <tbody class="text-center">
            <?php foreach ($dataItem['match'] as $match) : ?>
                <tr>
                    <td class="font-weight-bold">
                        <a class="text-success" target="_blank" href="https://es.besoccer.com/partido/<?= $match['team1_name'] ?>/<?= $match['team2_name'] ?>/<?= $match['season'] ?><?= $match['id'] ?>">
                            #<?= $match['id'] ?>
                        </a>
                    </td>
                    <td><?= $match['shedule'] ?></td>
                    <td class="font-weight-bold">
                        <a class="text-success font-weight-bold" target="_blank" href="https://deep.besoccer.com/categories/<?= $match['categoryId'] ?>?leagueId=<?= $match['league_id'] ?>">
                            #<?= $match['league_id'] ?>
                        </a>
                    </td>
                    <td><?= $match['season'] ?></td>
                    <td class="pl-2 border-0 px-1">
                        <img class="img-fluid" src="https://cdn.resfu.com/img_data/escudos/medium/<?= $match['datateam1'] ?>.jpg?size=30x&lossy=1" alt="">
                    </td>
                    <td class="border-0">
                        <?= $match['team1_name'] ?>
                    </td>
                    <td class="border-0 font-weight-bold">
                        <?= $match['r1'] ?> - <?= $match['r2'] ?>
                    </td>
                    <td class="border-0">
                        <?= $match['team2_name'] ?>
                    </td>
                    <td class="border-0">
                        <img class="img-fluid" src="https://cdn.resfu.com/img_data/escudos/medium/<?= $match['datateam2'] ?>.jpg?size=30x&lossy=1" alt="">
                    </td>
                    <?php if (($match['r1'] === '99') or ($match['r2'] === '99')) : ?>
                        <td class="font-weight-bold">-</td>
                    <?php elseif (($match['r1'] === '98') or ($match['r2'] === '98')) : ?>
                        <td class="font-weight-bold">-</td>
                    <?php elseif ($match['r1'] > $match['r2']) : ?>
                        <td class="font-weight-bold"><span class="bg-success px-2 py-1 rounded">1</span></td>
                    <?php elseif ($match['r1'] == $match['r2']) : ?>
                        <td class="font-weight-bold"><span class="bg-secondary px-2 py-1 rounded">X</span></td>
                    <?php elseif ($match['r1'] < $match['r2']) : ?>
                        <td class="font-weight-bold"><span class="bg-danger px-2 py-1 rounded">2</span></td>
                    <?php endif; ?>
                </tr>
            <?php break;
            endforeach; ?>
        </tbody>
    </table>
</div>
<?php if (empty($dataItem['match'])) : ?>
    <div class="text-center mb-4">
        <div class="my-4 border border-1 border-opacity-50 py-3 mb-3 rounded">
            <h3 class="text-center">Este partido no existe en nuestra BD, prueba otro matchId o Season</h3>
            <div class="py-3 d-flex justify-content-center">
                <div class="d-flex justify-content-center align-items-center flex-row">
                    <form class="form-inline" method="GET" action="/data_info/match_odds">
                        <input type="text" name="matchId" placeholder="Match ID" class="form-control mx-2" required />
                        <input type="text" name="season" placeholder="Season" class="form-control mx-2" required />
                        <button type="submit" class="btn border-0 btn-success d-flex align-items-center px-4">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            <span class="mx-2">Buscar</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php die(); ?>
<?php endif; ?>
<div class="mb-4 px-4 d-flex flex-wrap justify-content-center position-relative">
    <div class="mb-2 mr-3">
        <?php if (empty($dataItem['odds_match_winner'])) : ?>
            <a class="btn btn btn-warning" href="/data_info/match_odds?matchId=<?= $match['id'] ?>&season=<?= $match['season'] ?>">
                <span>Match Winner</span>
                <i class="fa-solid fa-xmark"></i>
            </a>
        <?php else : ?>
            <a class="btn btn btn-success" href="/data_info/match_odds?matchId=<?= $match['id'] ?>&season=<?= $match['season'] ?>">
                <span>Match Winner</span>
                <i class="fa-solid fa-dice fa-bounce"></i>
            </a>
        <?php endif; ?>
    </div>
    <div class="mb-2 mr-3">
        <?php if (empty($dataItem['odds_half_winner'])) : ?>
            <a class="btn btn btn-warning" href="/data_info/match_odds?matchId=<?= $match['id'] ?>&season=<?= $match['season'] ?>&second_half">
                <span>2nd Half Winner</span>
                <i class="fa-solid fa-xmark"></i>
            </a>
        <?php else : ?>
            <a class="btn btn btn-success" href="/data_info/match_odds?matchId=<?= $match['id'] ?>&season=<?= $match['season'] ?>&second_half">
                <span>2nd Half Winner</span>
                <i class="fa-solid fa-dice fa-bounce"></i>
            </a>
        <?php endif; ?>
    </div>
    <div class="mb-2 mr-3">
        <?php if (empty($dataItem['odds_home_away'])) : ?>
            <a class="btn btn btn-warning" href="/data_info/match_odds?matchId=<?= $match['id'] ?>&season=<?= $match['season'] ?>&home_away">
                <span>Home Away</span>
                <i class="fa-solid fa-xmark"></i>
            </a>
        <?php else : ?>
            <a class="btn btn btn-success" href="/data_info/match_odds?matchId=<?= $match['id'] ?>&season=<?= $match['season'] ?>&home_away">
                <span>Home Away</span>
                <i class="fa-solid fa-dice fa-bounce"></i>
            </a>
        <?php endif; ?>
    </div>
    <div class="mb-2 mr-3">
        <?php if (empty($dataItem['odds_asian_handicap'])) : ?>
            <a class="btn btn btn-warning" href="/data_info/match_odds?matchId=<?= $match['id'] ?>&season=<?= $match['season'] ?>&asian_handicap">
                <span>Asian Handicap</span>
                <i class="fa-solid fa-xmark"></i>
            </a>
        <?php else : ?>
            <a class="btn btn btn-success" href="/data_info/match_odds?matchId=<?= $match['id'] ?>&season=<?= $match['season'] ?>&asian_handicap">
                <span>Asian Handicap</span>
                <i class="fa-solid fa-dice fa-bounce"></i>
            </a>
        <?php endif; ?>
    </div>
    <div class="mb-2 mr-3">
        <?php if (empty($dataItem['odds_double_chance'])) : ?>
            <a class="btn btn btn-warning" href="/data_info/match_odds?matchId=<?= $match['id'] ?>&season=<?= $match['season'] ?>&double_chance">
                <span>Double Chance</span>
                <i class="fa-solid fa-xmark"></i>
            </a>
        <?php else : ?>
            <a class="btn btn btn-success" href="/data_info/match_odds?matchId=<?= $match['id'] ?>&season=<?= $match['season'] ?>&double_chance">
                <span>Double Chance</span>
                <i class="fa-solid fa-dice fa-bounce"></i>
            </a>
        <?php endif; ?>
    </div>
    <div class="mb-2 mr-3">
        <?php if (empty($dataItem['odds_over_under'])) : ?>
            <a class="btn btn btn-warning" href="/data_info/match_odds?matchId=<?= $match['id'] ?>&season=<?= $match['season'] ?>&over_under">
                <span>Goals Over Under</span>
                <i class="fa-solid fa-xmark"></i>
            </a>
        <?php else : ?>
            <a class="btn btn btn-success" href="/data_info/match_odds?matchId=<?= $match['id'] ?>&season=<?= $match['season'] ?>&over_under">
                <span>Goals Over Under</span>
                <i class="fa-solid fa-dice fa-bounce"></i>
            </a>
        <?php endif; ?>
    </div>
    <div class="mb-2 mr-3">
        <?php if (empty($dataItem['odds_over_under_first'])) : ?>
            <a class="btn btn btn-warning" href="/data_info/match_odds?matchId=<?= $match['id'] ?>&season=<?= $match['season'] ?>&ov_und_first">
                <span>Goals Over Under 1stH</span>
                <i class="fa-solid fa-xmark"></i>
            </a>
        <?php else : ?>
            <a class="btn btn btn-success" href="/data_info/match_odds?matchId=<?= $match['id'] ?>&season=<?= $match['season'] ?>&ov_und_first">
                <span>Goals Over Under 1stH</span>
                <i class="fa-solid fa-dice fa-bounce"></i>
            </a>
        <?php endif; ?>
    </div>
    <div class="mb-2 mr-3">
        <?php if (empty($dataItem['odds_over_under_second'])) : ?>
            <a class="btn btn btn-warning" href="/data_info/match_odds?matchId=<?= $match['id'] ?>&season=<?= $match['season'] ?>&ov_und_second">
                <span>Goals Over Under 2ndH</span>
                <i class="fa-solid fa-xmark"></i>
            </a>
        <?php else : ?>
            <a class="btn btn btn-success" href="/data_info/match_odds?matchId=<?= $match['id'] ?>&season=<?= $match['season'] ?>&ov_und_second">
                <span>Goals Over Under 2ndH</span>
                <i class="fa-solid fa-dice fa-bounce"></i>
            </a>
        <?php endif; ?>
    </div>
    <div class="mb-2 mr-3">
        <?php if (empty($dataItem['odds_clean_sheet_home'])) : ?>
            <a class="btn btn btn-warning" href="/data_info/match_odds?matchId=<?= $match['id'] ?>&season=<?= $match['season'] ?>&clean_sheet_home">
                <span>Clean Sheet Home</span>
                <i class="fa-solid fa-xmark"></i>
            </a>
        <?php else : ?>
            <a class="btn btn btn-success" href="/data_info/match_odds?matchId=<?= $match['id'] ?>&season=<?= $match['season'] ?>&clean_sheet_home">
                <span>Clean Sheet Home</span>
                <i class="fa-solid fa-dice fa-bounce"></i>
            </a>
        <?php endif; ?>
    </div>
    <div class="mb-2 mr-3">
        <?php if (empty($dataItem['odds_clean_sheet_away'])) : ?>
            <a class="btn btn btn-warning" href="/data_info/match_odds?matchId=<?= $match['id'] ?>&season=<?= $match['season'] ?>&clean_sheet_away">
                <span>Clean Sheet Away</span>
                <i class="fa-solid fa-xmark"></i>
            </a>
        <?php else : ?>
            <a class="btn btn btn-success" href="/data_info/match_odds?matchId=<?= $match['id'] ?>&season=<?= $match['season'] ?>&clean_sheet_away">
                <span>Clean Sheet Away</span>
                <i class="fa-solid fa-dice fa-bounce"></i>
            </a>
        <?php endif; ?>
    </div>
    <div class="mb-2 mr-3">
        <?php if (empty($dataItem['odds_correct_score'])) : ?>
            <a class="btn btn btn-warning" href="/data_info/match_odds?matchId=<?= $match['id'] ?>&season=<?= $match['season'] ?>&correct_score">
                <span>Correct Score</span>
                <i class="fa-solid fa-xmark"></i>
            </a>
        <?php else : ?>
            <a class="btn btn btn-success" href="/data_info/match_odds?matchId=<?= $match['id'] ?>&season=<?= $match['season'] ?>&correct_score">
                <span>Correct Score</span>
                <i class="fa-solid fa-dice fa-bounce"></i>
            </a>
        <?php endif; ?>
    </div>
    <div class="mb-2 mr-3">
        <?php if (empty($dataItem['odds_correct_score_1st_half'])) : ?>
            <a class="btn btn btn-warning" href="/data_info/match_odds?matchId=<?= $match['id'] ?>&season=<?= $match['season'] ?>&correct_first_half">
                <span>Correct Score 1st Half</span>
                <i class="fa-solid fa-xmark"></i>
            </a>
        <?php else : ?>
            <a class="btn btn btn-success" href="/data_info/match_odds?matchId=<?= $match['id'] ?>&season=<?= $match['season'] ?>&correct_first_half">
                <span>Correct Score 1st Half</span>
                <i class="fa-solid fa-dice fa-bounce"></i>
            </a>
        <?php endif; ?>
    </div>
    <div class="mb-2 mr-3">
        <?php if (empty($dataItem['odds_correct_score_2nd_half'])) : ?>
            <a class="btn btn btn-warning" href="/data_info/match_odds?matchId=<?= $match['id'] ?>&season=<?= $match['season'] ?>&correct_second_h">
                <span>Correct Score 2nd Half</span>
                <i class="fa-solid fa-xmark"></i>
            </a>
        <?php else : ?>
            <a class="btn btn btn-success" href="/data_info/match_odds?matchId=<?= $match['id'] ?>&season=<?= $match['season'] ?>&correct_second_h">
                <span>Correct Score 2nd Half</span>
                <i class="fa-solid fa-dice fa-bounce"></i>
            </a>
        <?php endif; ?>
    </div>
    <div class="mb-2 position-absolute" style="bottom:0;right:1rem;">
        <a class="btn btn btn-warning" href="<?= $previous ?>">
            <i class="fa-solid fa-backward-step"></i>
        </a>
    </div>
</div>
<!-- TABLA comparten cabecera Match Winner y 2nd Half Winner) -->
<section id="section_id" class="section_sort">
    <?php if (is_numeric(strrev($_SERVER['REQUEST_URI'])[0]) or (strpos($_SERVER['REQUEST_URI'], "second_half"))) : ?>
        <table class="table table-bordered table-sm">
            <thead class="thead-dark">
                <tr class="text-center text-uppercase">
                    <th scope="col">
                        <span class="float-left"><i class="fa-solid fa-sort fa-lg"></i></span>Provider
                    </th>
                    <th scope="col" class="bg-secondary">
                        <span class="float-left"><i class="fa-solid fa-sort fa-lg"></i></span>Home<i class="fa-solid fa-1 fa-xs p-2 bg-white text-secondary rounded ml-2"></i>
                    </th>
                    <th scope="col">
                        <span class="float-left"><i class="fa-solid fa-sort fa-lg"></i></span>Draw<i class="fa-solid fa-x fa-xs p-2 bg-white text-dark rounded ml-2"></i></i>
                    </th>
                    <th scope="col" class="bg-secondary">
                        <span class="float-left"><i class="fa-solid fa-sort fa-lg"></i></span>Away<i class="fa-solid fa-2 fa-xs p-2 bg-white text-secondary rounded ml-2"></i></i>
                    </th>
                </tr>
            </thead>
            <!-- 1- Para apuestas de Match Winner -->
            <?php if (is_numeric(strrev($_SERVER['REQUEST_URI'])[0])) : ?>
                <h4 class="text-center">Match Winner</h4>
                <tbody>
                    <?php
                    // Recogemos las apuestas para cada casa
                    $arrayOdds = [];
                    foreach ($dataItem['odds_match_winner'] as $index => $odds) :
                        $arrayOdds[$odds['provider']][$odds['type']] = $odds['value'];
                    endforeach;
                    ?>
                    <?php foreach ($arrayOdds as $provider => $oddsType) : ?>
                        <tr>
                            <td class="text-left ml-4 font-weight-bold">
                                <?= strtoupper($provider) ?>
                            </td>
                            <td class="text-center">
                                <?php if (isset($oddsType['Home'])) : ?>
                                    <?= $oddsType['Home'] ?>
                                <?php endif ?>
                            <td class="text-center">
                                <?php if (isset($oddsType['Draw'])) : ?>
                                    <?= $oddsType['Draw'] ?>
                                <?php endif ?>
                            </td>
                            <td class="text-center">
                                <?php if (isset($oddsType['Away'])) : ?>
                                    <?= $oddsType['Away'] ?>
                                <?php endif ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            <?php endif; ?>
            <!-- 2- Para apuestas de 2nd Half Winner -->
            <?php if (isset($_GET["second_half"])) : ?>
                <h4 class="text-center">2nd Half Winner</h4>
                <tbody>
                    <?php
                    // Recogemos las apuestas para cada casa
                    $arrayOdds = [];
                    foreach ($dataItem['odds_half_winner'] as $index => $odds) :
                        $arrayOdds[$odds['provider']][$odds['type']] = $odds['value'];
                    endforeach;
                    ?>
                    <?php foreach ($arrayOdds as $provider => $oddsType) : ?>
                        <tr>
                            <td class="text-left ml-4 font-weight-bold">
                                <?= strtoupper($provider) ?>
                            </td>
                            <td class="text-center">
                                <?php if (isset($oddsType['Home'])) : ?>
                                    <?= $oddsType['Home'] ?>
                                <?php endif ?>
                            <td class="text-center">
                                <?php if (isset($oddsType['Draw'])) : ?>
                                    <?= $oddsType['Draw'] ?>
                                <?php endif ?>
                            </td>
                            <td class="text-center">
                                <?php if (isset($oddsType['Away'])) : ?>
                                    <?= $oddsType['Away'] ?>
                                <?php endif ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            <?php endif; ?>
        </table>
    <?php endif; ?>
    <!-- TABLA  Home Away  -->
    <?php if (strpos($_SERVER['REQUEST_URI'], "home_away")) : ?>
        <table class="table table-bordered   table-sm">
            <thead class="thead-dark">
                <tr class="text-center text-uppercase">
                    <th scope="col">
                        <span class="float-left"><i class="fa-solid fa-sort fa-lg"></i></span>Provider
                    </th>
                    <th scope="col" class="bg-secondary">
                        <span class="float-left"><i class="fa-solid fa-sort fa-lg"></i></span>Home
                        <i class="fa-solid fa-1 fa-xs p-2 bg-white text-secondary rounded ml-2"></i></i>
                    </th>
                    <th scope="col"><span class="float-left"><i class="fa-solid fa-sort fa-lg"></i></span>Away
                        <i class="fa-solid fa-2 fa-xs p-2 bg-white text-dark rounded ml-2"></i></i>
                    </th>
                </tr>
            </thead>
            <!-- 1- Para apuestas de Home Away sin posibilidad empate -->
            <?php if (isset($_GET["home_away"])) : ?>
                <h4 class="text-center">Home Away</h4>
                <tbody>
                    <?php
                    // Recogemos las apuestas para cada casa
                    $arrayOdds = [];
                    foreach ($dataItem['odds_home_away'] as $index => $odds) :
                        $arrayOdds[$odds['provider']][$odds['type']] = $odds['value'];
                    endforeach;
                    ?>
                    <?php foreach ($arrayOdds as $provider => $oddsType) : ?>
                        <tr>
                            <td class="text-left ml-4 font-weight-bold">
                                <?= strtoupper($provider) ?>
                            </td>
                            <td class="text-center">
                                <?= $oddsType['Home'] ?>
                            <td class="text-center">
                                <?= $oddsType['Away'] ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            <?php endif; ?>
        </table>
    <?php endif; ?>
    <!-- TABLA Asian Handicap) -->
    <?php if (strpos($_SERVER['REQUEST_URI'], "asian_handicap")) : ?>
        <table class="table table-bordered table-sm">
            <thead class="thead-dark">
                <tr class="text-center text-uppercase">
                    <!-- Tabla Handicap HOME -->
                    <?php if (!strpos($_SERVER['REQUEST_URI'], "asian_handicap=away")) : ?>
                        <th scope="col"><span class="float-left"><i class="fa-solid fa-sort fa-lg"></i></span>
                            Provider
                        </th>
                        <th scope="col" class="bg-secondary">Home -1</th>
                        <th scope="col">Home -0.25</th>
                        <th scope="col" class="bg-secondary">Home 0</th>
                        <th scope="col">Home 0.25</th>
                        <th scope="col" class="bg-secondary">Home 0.75</th>
                        <th scope="col">Home 1</th>
                        <th scope="col" class="bg-secondary">Home 1.25</th>
                        <th scope="col">Home 1.5</th>
                        <th scope="col" class="bg-secondary">Home 1.75</th>
                        <th scope="col">Home 2</th>
                        <th scope="col" class="bg-secondary">Home 2.25</th>
                        <th scope="col">Home 2.5</th>
                    <?php endif; ?>
                    <!-- Tabla Handicap AWAY -->
                    <?php if (strpos($_SERVER['REQUEST_URI'], "asian_handicap=away")) : ?>
                        <th scope="col"><span class="float-left"><i class="fa-solid fa-sort fa-lg"></i></span>Provider
                        </th>
                        <th scope="col" class="bg-secondary">Away -1</th>
                        <th scope="col">Away -0.25</th>
                        <th scope="col" class="bg-secondary">Away 0</th>
                        <th scope="col">Away 0.25</th>
                        <th scope="col" class="bg-secondary">Away 0.75</th>
                        <th scope="col">Away 1</th>
                        <th scope="col" class="bg-secondary">Away 1.25</th>
                        <th scope="col">Away 1.5</th>
                        <th scope="col" class="bg-secondary">Away 1.75</th>
                        <th scope="col">Away 2</th>
                        <th scope="col" class="bg-secondary">Away 2.25</th>
                        <th scope="col">Away 2.5</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <!-- 2- Para apuestas de Asian Handicap -->
            <?php if (isset($_GET["asian_handicap"])) : ?>
                <h4 class="text-center">Asian Handicap</h4>
                <div class="mb-4 px-4 d-flex flex-wrap justify-content-center">
                    <div class="mb-2 rounded-circle">
                        <a class="btn btn btn-success border-0 rounded" href="/data_info/match_odds?matchId=<?= $match['id'] ?>&season=<?= $match['season'] ?>&asian_handicap=home">
                            <span>Home</span>
                        </a>
                    </div>
                    <div class="mb-2 border-0 rounded-circle ml-2">
                        <a class="btn btn btn-danger border-0 rounded" href="/data_info/match_odds?matchId=<?= $match['id'] ?>&season=<?= $match['season'] ?>&asian_handicap=away">
                            <span>Away</span>
                        </a>
                    </div>
                </div>
                <tbody>
                    <?php
                    // Recogemos las apuestas para cada casa
                    $arrayOdds = [];
                    foreach ($dataItem['odds_asian_handicap'] as $index => $odds) :
                        $arrayOdds[$odds['provider']][$odds['type'] . '_' . $odds['handicap']] = $odds['value'];
                    endforeach;
                    ?>
                    <?php foreach ($arrayOdds as $provider => $oddsType) : ?>
                        <tr>
                            <td class="text-left ml-4 font-weight-bold">
                                <?= strtoupper($provider) ?>
                            </td>
                            <!-- Solo Resultados Handicap HOME -->
                            <?php if (!strpos($_SERVER['REQUEST_URI'], "asian_handicap=away")) : ?>
                                <td class="text-center">
                                    <?php if (isset($oddsType['Home_-1'])) : ?>
                                        <?= $oddsType['Home_-1'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['Home_-0.25'])) : ?>
                                        <?= $oddsType['Home_-0.25'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['Home_0'])) : ?>
                                        <?= $oddsType['Home_0'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['Home_0.25'])) : ?>
                                        <?= $oddsType['Home_0.25'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['Home_0.75'])) : ?>
                                        <?= $oddsType['Home_0.75'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['Home_1'])) : ?>
                                        <?= $oddsType['Home_1'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['Home_1.25'])) : ?>
                                        <?= $oddsType['Home_1.25'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['Home_1.5'])) : ?>
                                        <?= $oddsType['Home_1.5'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['Home_1.75'])) : ?>
                                        <?= $oddsType['Home_1.75'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['Home_2'])) : ?>
                                        <?= $oddsType['Home_2'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['Home_2.25'])) : ?>
                                        <?= $oddsType['Home_2.25'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['Home_2.5'])) : ?>
                                        <?= $oddsType['Home_2.5'] ?>
                                    <?php endif; ?>
                                </td>
                            <?php endif; ?>
                            <!-- Solo Resultados Handicap AWAY -->
                            <?php if (strpos($_SERVER['REQUEST_URI'], "asian_handicap=away")) : ?>
                                <td class="text-center">
                                    <?php if (isset($oddsType['Away_-1'])) : ?>
                                        <?= $oddsType['Away_-1'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['Away_-0.25'])) : ?>
                                        <?= $oddsType['Away_-0.25'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['Away_0'])) : ?>
                                        <?= $oddsType['Away_0'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['Away_0.25'])) : ?>
                                        <?= $oddsType['Away_0.25'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['Away_0.75'])) : ?>
                                        <?= $oddsType['Away_0.75'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['Away_1'])) : ?>
                                        <?= $oddsType['Away_1'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['Away_1.25'])) : ?>
                                        <?= $oddsType['Away_1.25'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['Away_1.5'])) : ?>
                                        <?= $oddsType['Away_1.5'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['Away_1.75'])) : ?>
                                        <?= $oddsType['Away_1.75'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['Away_2'])) : ?>
                                        <?= $oddsType['Away_2'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['Away_2.25'])) : ?>
                                        <?= $oddsType['Away_2.25'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['Away_2.5'])) : ?>
                                        <?= $oddsType['Away_2.5'] ?>
                                    <?php endif; ?>
                                </td>
                            <?php endif; ?>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            <?php endif; ?>
        </table>
    <?php endif; ?>

    <?php if (strpos($_SERVER['REQUEST_URI'], "double_chance")) : ?>
        <table class="table table-bordered   table-sm">
            <thead class="thead-dark">
                <tr class="text-center text-uppercase">
                    <th scope="col"><span class="float-left"><i class="fa-solid fa-sort fa-lg"></i></span>Provider
                    </th>
                    <th scope="col" class="bg-secondary">
                        <span class="float-left"><i class="fa-solid fa-sort fa-lg"></i></span>Home / Draw
                    </th>
                    <th scope="col"><span class="float-left"><i class="fa-solid fa-sort fa-lg"></i></span>Home / Away
                    </th>
                    <th scope="col" class="bg-secondary"><span class="float-left"><i class="fa-solid fa-sort fa-lg"></i></span>Draw / Away
                    </th>
                </tr>
            </thead>
            <!-- 1- Para apuestas de Double Chance -->
            <?php if (isset($_GET["double_chance"])) : ?>
                <h4 class="text-center">Double Chance</h4>
                <tbody>
                    <?php
                    // Recogemos las apuestas para cada casa
                    $arrayOdds = [];
                    foreach ($dataItem['odds_double_chance'] as $index => $odds) :
                        $arrayOdds[$odds['provider']][$odds['type']] = $odds['value'];
                    endforeach;
                    ?>
                    <?php foreach ($arrayOdds as $provider => $oddsType) : ?>
                        <tr>
                            <td class="text-left ml-4 font-weight-bold">
                                <?= strtoupper($provider) ?>
                            </td>
                            <td class="text-center">
                                <?php if (isset($oddsType['Home/Draw'])) : ?>
                                    <?= $oddsType['Home/Draw'] ?>
                                <?php endif ?>
                            </td>
                            <td class="text-center">
                                <?php if (isset($oddsType['Home/Away'])) : ?>
                                    <?= $oddsType['Home/Away'] ?>
                                <?php endif ?>
                            </td>
                            <td class="text-center">
                                <?php if (isset($oddsType['Draw/Away'])) : ?>
                                    <?= $oddsType['Draw/Away'] ?>
                                <?php endif ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            <?php endif; ?>
        </table>
    <?php endif; ?>

    <?php if (strpos($_SERVER['REQUEST_URI'], "over_under") or strpos($_SERVER['REQUEST_URI'], "ov_und")) : ?>
        <table class="table table-bordered table-sm">
            <thead class="thead-dark">
                <tr class="text-center text-uppercase">
                    <th scope="col"><span class="float-left"><i class="fa-solid fa-sort fa-lg"></i></span>Provider
                    </th>
                    <th scope="col" class="bg-secondary">Ov 0.5</th>
                    <th scope="col">Ov 1</th>
                    <th scope="col" class="bg-secondary">Ov 1.5</th>
                    <th scope="col">Ov 2</th>
                    <th scope="col" class="bg-secondary">Ov 2.5</th>
                    <th scope="col">Ov 3.5</th>
                    <th scope="col" class="bg-secondary">Ov 4.5</th>
                    <th scope="col">Ov 5.5</th>
                    <th scope="col" class="bg-secondary">Un 0.5</th>
                    <th scope="col">Un 1</th>
                    <th scope="col" class="bg-secondary">Un 1.5</th>
                    <th scope="col">Un 2</th>
                    <th scope="col" class="bg-secondary">Un 2.5</th>
                    <th scope="col">Un 3.5</th>
                    <th scope="col" class="bg-secondary">Un 4.5</th>
                    <th scope="col">Un 5.5</th>
                </tr>
            </thead>
            <!-- 1- Para apuestas de Over Under -->
            <?php if (isset($_GET["over_under"])) : ?>
                <h4 class="text-center">Goals Over Under</h4>
                <tbody>
                    <?php
                    // Recogemos las apuestas para cada casa
                    $arrayOdds = [];
                    foreach ($dataItem['odds_over_under'] as $index => $odds) :
                        $arrayOdds[$odds['provider']][$odds['type'] . '_' . $odds['total']] = $odds['value'];
                    endforeach;
                    ?>
                    <?php foreach ($arrayOdds as $provider => $oddsType) : ?>
                        <tr>
                            <td class="text-left ml-4 font-weight-bold">
                                <?= strtoupper($provider) ?>
                            </td>
                            <td class="text-center">
                                <?php if (isset($oddsType['Over_0.5'])) : ?>
                                    <?= $oddsType['Over_0.5'] ?>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if (isset($oddsType['Over_1'])) : ?>
                                    <?= $oddsType['Over_1'] ?>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if (isset($oddsType['Over_1.5'])) : ?>
                                    <?= $oddsType['Over_1.5'] ?>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if (isset($oddsType['Over_2'])) : ?>
                                    <?= $oddsType['Over_2'] ?>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if (isset($oddsType['Over_2.5'])) : ?>
                                    <?= $oddsType['Over_2.5'] ?>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if (isset($oddsType['Over_3.5'])) : ?>
                                    <?= $oddsType['Over_3.5'] ?>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if (isset($oddsType['Over_4.5'])) : ?>
                                    <?= $oddsType['Over_4.5'] ?>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if (isset($oddsType['Over_5.5'])) : ?>
                                    <?= $oddsType['Over_5.5'] ?>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if (isset($oddsType['Under_0.5'])) : ?>
                                    <?= $oddsType['Under_0.5'] ?>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if (isset($oddsType['Under_1'])) : ?>
                                    <?= $oddsType['Under_1'] ?>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if (isset($oddsType['Under_1.5'])) : ?>
                                    <?= $oddsType['Under_1.5'] ?>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if (isset($oddsType['Under_2'])) : ?>
                                    <?= $oddsType['Under_2'] ?>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if (isset($oddsType['Under_2.5'])) : ?>
                                    <?= $oddsType['Under_2.5'] ?>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if (isset($oddsType['Under_3.5'])) : ?>
                                    <?= $oddsType['Under_3.5'] ?>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if (isset($oddsType['Under_4.5'])) : ?>
                                    <?= $oddsType['Under_4.5'] ?>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if (isset($oddsType['Under_5.5'])) : ?>
                                    <?= $oddsType['Under_5.5'] ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            <?php endif; ?>
            <!-- 2- Para apuestas de Over Under Primera parte-->
            <?php if (isset($_GET["ov_und_first"])) : ?>
                <h4 class="text-center">Goals Over Under 1st Half</h4>
                <tbody>
                    <?php
                    // Recogemos las apuestas para cada casa
                    $arrayOdds = [];
                    foreach ($dataItem['odds_over_under_first'] as $index => $odds) :
                        $arrayOdds[$odds['provider']][$odds['type'] . '_' . $odds['total']] = $odds['value'];
                    endforeach;
                    ?>
                    <?php foreach ($arrayOdds as $provider => $oddsType) : ?>
                        <tr>
                            <td class="text-left ml-4 font-weight-bold">
                                <?= strtoupper($provider) ?>
                            </td>
                            <td class="text-center">
                                <?php if (isset($oddsType['Over_0.5'])) : ?>
                                    <?= $oddsType['Over_0.5'] ?>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if (isset($oddsType['Over_1'])) : ?>
                                    <?= $oddsType['Over_1'] ?>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if (isset($oddsType['Over_1.5'])) : ?>
                                    <?= $oddsType['Over_1.5'] ?>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if (isset($oddsType['Over_2'])) : ?>
                                    <?= $oddsType['Over_2'] ?>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if (isset($oddsType['Over_2.5'])) : ?>
                                    <?= $oddsType['Over_2.5'] ?>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if (isset($oddsType['Over_3.5'])) : ?>
                                    <?= $oddsType['Over_3.5'] ?>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if (isset($oddsType['Over_4.5'])) : ?>
                                    <?= $oddsType['Over_4.5'] ?>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if (isset($oddsType['Over_5.5'])) : ?>
                                    <?= $oddsType['Over_5.5'] ?>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if (isset($oddsType['Under_0.5'])) : ?>
                                    <?= $oddsType['Under_0.5'] ?>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if (isset($oddsType['Under_1'])) : ?>
                                    <?= $oddsType['Under_1'] ?>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if (isset($oddsType['Under_1.5'])) : ?>
                                    <?= $oddsType['Under_1.5'] ?>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if (isset($oddsType['Under_2'])) : ?>
                                    <?= $oddsType['Under_2'] ?>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if (isset($oddsType['Under_2.5'])) : ?>
                                    <?= $oddsType['Under_2.5'] ?>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if (isset($oddsType['Under_3.5'])) : ?>
                                    <?= $oddsType['Under_3.5'] ?>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if (isset($oddsType['Under_4.5'])) : ?>
                                    <?= $oddsType['Under_4.5'] ?>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if (isset($oddsType['Under_5.5'])) : ?>
                                    <?= $oddsType['Under_5.5'] ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            <?php endif; ?>
            <!-- 3- Para apuestas de Over Under Segunda parte-->
            <?php if (isset($_GET["ov_und_second"])) : ?>
                <h4 class="text-center">Goals Over Under 2nd Half</h4>
                <tbody>
                    <?php
                    // Recogemos las apuestas para cada casa
                    $arrayOdds = [];
                    foreach ($dataItem['odds_over_under_second'] as $index => $odds) :
                        $arrayOdds[$odds['provider']][$odds['type'] . '_' . $odds['total']] = $odds['value'];
                    endforeach;
                    ?>
                    <?php foreach ($arrayOdds as $provider => $oddsType) : ?>
                        <tr>
                            <td class="text-left ml-4 font-weight-bold">
                                <?= strtoupper($provider) ?>
                            </td>
                            <td class="text-center">
                                <?php if (isset($oddsType['Over_0.5'])) : ?>
                                    <?= $oddsType['Over_0.5'] ?>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if (isset($oddsType['Over_1'])) : ?>
                                    <?= $oddsType['Over_1'] ?>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if (isset($oddsType['Over_1.5'])) : ?>
                                    <?= $oddsType['Over_1.5'] ?>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if (isset($oddsType['Over_2'])) : ?>
                                    <?= $oddsType['Over_2'] ?>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if (isset($oddsType['Over_2.5'])) : ?>
                                    <?= $oddsType['Over_2.5'] ?>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if (isset($oddsType['Over_3.5'])) : ?>
                                    <?= $oddsType['Over_3.5'] ?>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if (isset($oddsType['Over_4.5'])) : ?>
                                    <?= $oddsType['Over_4.5'] ?>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if (isset($oddsType['Over_5.5'])) : ?>
                                    <?= $oddsType['Over_5.5'] ?>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if (isset($oddsType['Under_0.5'])) : ?>
                                    <?= $oddsType['Under_0.5'] ?>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if (isset($oddsType['Under_1'])) : ?>
                                    <?= $oddsType['Under_1'] ?>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if (isset($oddsType['Under_1.5'])) : ?>
                                    <?= $oddsType['Under_1.5'] ?>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if (isset($oddsType['Under_2'])) : ?>
                                    <?= $oddsType['Under_2'] ?>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if (isset($oddsType['Under_2.5'])) : ?>
                                    <?= $oddsType['Under_2.5'] ?>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if (isset($oddsType['Under_3.5'])) : ?>
                                    <?= $oddsType['Under_3.5'] ?>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if (isset($oddsType['Under_4.5'])) : ?>
                                    <?= $oddsType['Under_4.5'] ?>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if (isset($oddsType['Under_5.5'])) : ?>
                                    <?= $oddsType['Under_5.5'] ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            <?php endif; ?>
        </table>
    <?php endif; ?>

    <?php if (strpos($_SERVER['REQUEST_URI'], "clean_sheet")) : ?>
        <table class="table table-bordered table-sm">
            <thead class="thead-dark">
                <tr class="text-center text-uppercase">
                    <th scope="col"><span class="float-left"><i class="fa-solid fa-sort fa-lg"></i></span>Provider
                    </th>
                    <th scope="col" class="bg-secondary"><span class="float-left"><i class="fa-solid fa-sort fa-lg"></i></span>Yes
                    </th>
                    <th scope="col"><span class="float-left"><i class="fa-solid fa-sort fa-lg"></i></span>No
                    </th>
                </tr>
            </thead>
            <!-- 1- Para apuestas de Clean Sheet Home -->
            <?php if (isset($_GET["clean_sheet_home"])) : ?>
                <h4 class="text-center">Clean Sheet Home</h4>
                <tbody>
                    <?php
                    // Recogemos las apuestas para cada casa
                    $arrayOdds = [];
                    foreach ($dataItem['odds_clean_sheet_home'] as $index => $odds) :
                        $arrayOdds[$odds['provider']][$odds['type']] = $odds['value'];
                    endforeach;
                    ?>
                    <?php foreach ($arrayOdds as $provider => $oddsType) : ?>
                        <tr>
                            <td class="text-left ml-4 font-weight-bold">
                                <?= strtoupper($provider) ?>
                            </td>
                            <td class="text-center">
                                <?= $oddsType['Yes'] ?>
                            </td>
                            <td class="text-center">
                                <?= $oddsType['No'] ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            <?php endif; ?>
            <!-- 1- Para apuestas de Clean Sheet Away -->
            <?php if (isset($_GET["clean_sheet_away"])) : ?>
                <h4 class="text-center">Clean Sheet Away</h4>
                <tbody>
                    <?php
                    // Recogemos las apuestas para cada casa
                    $arrayOdds = [];
                    foreach ($dataItem['odds_clean_sheet_away'] as $index => $odds) :
                        $arrayOdds[$odds['provider']][$odds['type']] = $odds['value'];
                    endforeach;
                    ?>
                    <?php foreach ($arrayOdds as $provider => $oddsType) : ?>
                        <tr>
                            <td class="text-left ml-4 font-weight-bold">
                                <?= strtoupper($provider) ?>
                            </td>
                            <td class="text-center">
                                <?= $oddsType['Yes'] ?>
                            </td>
                            <td class="text-center">
                                <?= $oddsType['No'] ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            <?php endif; ?>
        </table>
    <?php endif; ?>

    <?php if (strpos($_SERVER['REQUEST_URI'], "correct_score")) : ?>
        <table class="table table-bordered table-sm">
            <thead class="thead-dark">
                <tr class="text-center text-uppercase">
                    <!-- Tabla Solo Resultados donde GANA EQUIPO CASA -->
                    <?php if (!strpos($_SERVER['REQUEST_URI'], "draw_score") and !strpos($_SERVER['REQUEST_URI'], "away_win_score")) : ?>
                        <th scope="col"><span class="float-left"><i class="fa-solid fa-sort fa-lg"></i></span>
                            Provider
                        </th>
                        <th scope="col" class="bg-secondary">1-0</th>
                        <th scope="col">2-0</th>
                        <th scope="col" class="bg-secondary">3-0</th>
                        <th scope="col">4-0</th>
                        <th scope="col" class="bg-secondary">5-0</th>
                        <th scope="col">2-1</th>
                        <th scope="col" class="bg-secondary">3-1</th>
                        <th scope="col">4-1</th>
                        <th scope="col" class="bg-secondary">5-1</th>
                        <th scope="col">3-2</th>
                        <th scope="col" class="bg-secondary">4-2</th>
                        <th scope="col">4-3</th>
                    <?php endif; ?>
                    <!-- Tabla Solo Resultados donde EMPATE -->
                    <?php if (strpos($_SERVER['REQUEST_URI'], "draw_score")) : ?>
                        <th scope="col"><span class="float-left"><i class="fa-solid fa-sort fa-lg"></i></span>
                            Provider</th>
                        <th scope="col" class="bg-secondary">0-0</th>
                        <th scope="col">1-1</th>
                        <th scope="col" class="bg-secondary">2-2</th>
                        <th scope="col">3-3</th>
                        <th scope="col" class="bg-secondary">4-4</th>
                    <?php endif; ?>
                    <!-- Tabla Solo Resultados donde GANA EQUIPO DE FUERA -->
                    <?php if (strpos($_SERVER['REQUEST_URI'], "away_win_score")) : ?>
                        <th scope="col"><span class="float-left"><i class="fa-solid fa-sort fa-lg"></i></span>Provider
                        </th>
                        <th scope="col" class="bg-secondary">0-1</th>
                        <th scope="col">0-2</th>
                        <th scope="col" class="bg-secondary">0-3</th>
                        <th scope="col">0-4</th>
                        <th scope="col" class="bg-secondary">0-5</th>
                        <th scope="col">1-2</th>
                        <th scope="col" class="bg-secondary">1-3</th>
                        <th scope="col">1-4</th>
                        <th scope="col" class="bg-secondary">1-5</th>
                        <th scope="col">2-3</th>
                        <th scope="col" class="bg-secondary">2-4</th>
                        <th scope="col">3-4</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <!-- 1- Para apuestas de Correct Score -->
            <?php if (isset($_GET["correct_score"])) : ?>
                <h4 class="text-center">Correct Score</h4>
                <div class="mb-4 px-4 d-flex flex-wrap justify-content-center">
                    <div class="mb-2 rounded-circle">
                        <a class="btn btn btn-success border-0 rounded-circle" href="/data_info/match_odds?matchId=<?= $match['id'] ?>&season=<?= $match['season'] ?>&correct_score=home_win_score">
                            <span>1</span>
                        </a>
                    </div>
                    <div class="mb-2 border-0 rounded-circle mx-2">
                        <a class="btn btn btn-dark border-0 rounded-circle" href="/data_info/match_odds?matchId=<?= $match['id'] ?>&season=<?= $match['season'] ?>&correct_score=draw_score">
                            <span>X</span>
                        </a>
                    </div>
                    <div class="mb-2 border-0 rounded-circle">
                        <a class="btn btn btn-danger border-0 rounded-circle" href="/data_info/match_odds?matchId=<?= $match['id'] ?>&season=<?= $match['season'] ?>&correct_score=away_win_score">
                            <span>2</span>
                        </a>
                    </div>
                </div>
                <tbody>
                    <?php
                    // Recogemos las apuestas para cada casa
                    $arrayOdds = [];
                    foreach ($dataItem['odds_correct_score'] as $index => $odds) :
                        $arrayOdds[$odds['provider']][$odds['type']] = $odds['value'];
                    endforeach;
                    ?>
                    <?php foreach ($arrayOdds as $provider => $oddsType) : ?>
                        <tr>
                            <td class="text-left ml-4 font-weight-bold">
                                <?= strtoupper($provider) ?>
                            </td>
                            <!-- Solo Resultados donde GANA EQUIPO CASA -->
                            <?php if (!strpos($_SERVER['REQUEST_URI'], "draw_score") and !strpos($_SERVER['REQUEST_URI'], "away_win_score")) : ?>
                                <td class="text-center">
                                    <?php if (isset($oddsType['1:0'])) : ?>
                                        <?= $oddsType['1:0'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['2:0'])) : ?>
                                        <?= $oddsType['2:0'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['3:0'])) : ?>
                                        <?= $oddsType['3:0'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['4:0'])) : ?>
                                        <?= $oddsType['4:0'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['5:0'])) : ?>
                                        <?= $oddsType['5:0'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['2:1'])) : ?>
                                        <?= $oddsType['2:1'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['3:1'])) : ?>
                                        <?= $oddsType['3:1'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['4:1'])) : ?>
                                        <?= $oddsType['4:1'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['5:1'])) : ?>
                                        <?= $oddsType['5:1'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['3:2'])) : ?>
                                        <?= $oddsType['3:2'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['4:2'])) : ?>
                                        <?= $oddsType['4:2'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['4:3'])) : ?>
                                        <?= $oddsType['4:3'] ?>
                                    <?php endif; ?>
                                </td>
                            <?php endif; ?>
                            <!-- Solo Resultados donde EMPATE -->
                            <?php if (strpos($_SERVER['REQUEST_URI'], "draw_score")) : ?>
                                <td class="text-center">
                                    <?php if (isset($oddsType['0:0'])) : ?>
                                        <?= $oddsType['0:0'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['1:1'])) : ?>
                                        <?= $oddsType['1:1'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['2:2'])) : ?>
                                        <?= $oddsType['2:2'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['3:3'])) : ?>
                                        <?= $oddsType['3:3'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['4:4'])) : ?>
                                        <?= $oddsType['4:4'] ?>
                                    <?php endif; ?>
                                </td>
                            <?php endif; ?>
                            <!-- Solo Resultados donde GANA EQUIPO DE FUERA -->
                            <?php if (strpos($_SERVER['REQUEST_URI'], "away_win_score")) : ?>
                                <td class="text-center">
                                    <?php if (isset($oddsType['0:1'])) : ?>
                                        <?= $oddsType['0:1'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['0:2'])) : ?>
                                        <?= $oddsType['0:2'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['0:3'])) : ?>
                                        <?= $oddsType['0:3'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['0:4'])) : ?>
                                        <?= $oddsType['0:4'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['0:5'])) : ?>
                                        <?= $oddsType['0:5'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['1:2'])) : ?>
                                        <?= $oddsType['1:2'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['1:3'])) : ?>
                                        <?= $oddsType['1:3'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['1:4'])) : ?>
                                        <?= $oddsType['1:4'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['1:5'])) : ?>
                                        <?= $oddsType['1:5'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['2-3'])) : ?>
                                        <?= $oddsType['2-3'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['2-4'])) : ?>
                                        <?= $oddsType['2-4'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['3:4'])) : ?>
                                        <?= $oddsType['3:4'] ?>
                                    <?php endif; ?>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            <?php endif; ?>
        </table>
    <?php endif; ?>

    <?php if (strpos($_SERVER['REQUEST_URI'], "correct_first_half")) : ?>
        <table class="table table-bordered table-sm">
            <thead class="thead-dark">
                <tr class="text-center text-uppercase">
                    <!-- Tabla Solo Resultados donde GANA EQUIPO CASA -->
                    <?php if (!strpos($_SERVER['REQUEST_URI'], "draw_score") and !strpos($_SERVER['REQUEST_URI'], "away_win_score")) : ?>
                        <th scope="col"><span class="float-left"><i class="fa-solid fa-sort fa-lg"></i></span>Provider
                        </th>
                        <th scope="col" class="bg-secondary">1-0</th>
                        <th scope="col">2-0</th>
                        <th scope="col" class="bg-secondary">3-0</th>
                        <th scope="col">4-0</th>
                        <th scope="col" class="bg-secondary">5-0</th>
                        <th scope="col">2-1</th>
                        <th scope="col" class="bg-secondary">3-1</th>
                        <th scope="col">4-1</th>
                        <th scope="col" class="bg-secondary">5-1</th>
                        <th scope="col">3-2</th>
                        <th scope="col" class="bg-secondary">4-2</th>
                        <th scope="col">4-3</th>
                    <?php endif; ?>
                    <!-- Tabla Solo Resultados donde EMPATE -->
                    <?php if (strpos($_SERVER['REQUEST_URI'], "draw_score")) : ?>
                        <th scope="col"><span class="float-left"><i class="fa-solid fa-sort fa-lg"></i></span>Provider
                        </th>
                        <th scope="col" class="bg-secondary">0-0</th>
                        <th scope="col">1-1</th>
                        <th scope="col" class="bg-secondary">2-2</th>
                        <th scope="col">3-3</th>
                        <th scope="col" class="bg-secondary">4-4</th>
                    <?php endif; ?>
                    <!-- Tabla Solo Resultados donde GANA EQUIPO DE FUERA -->
                    <?php if (strpos($_SERVER['REQUEST_URI'], "away_win_score")) : ?>
                        <th scope="col"><span class="float-left"><i class="fa-solid fa-sort fa-lg"></i></span>Provider
                        </th>
                        <th scope="col" class="bg-secondary">0-1</th>
                        <th scope="col">0-2</th>
                        <th scope="col" class="bg-secondary">0-3</th>
                        <th scope="col">0-4</th>
                        <th scope="col" class="bg-secondary">0-5</th>
                        <th scope="col">1-2</th>
                        <th scope="col" class="bg-secondary">1-3</th>
                        <th scope="col">1-4</th>
                        <th scope="col" class="bg-secondary">1-5</th>
                        <th scope="col">2-3</th>
                        <th scope="col" class="bg-secondary">2-4</th>
                        <th scope="col">3-4</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <!-- 1- Para apuestas de Correct Score First Half -->
            <?php if (isset($_GET["correct_first_half"])) : ?>
                <h4 class="text-center">Correct Score 1st Half</h4>
                <div class="mb-4 px-4 d-flex flex-wrap justify-content-center">
                    <div class="mb-2 rounded-circle">
                        <a class="btn btn btn-success border-0 rounded-circle" href="/data_info/match_odds?matchId=<?= $match['id'] ?>&season=<?= $match['season'] ?>&correct_first_half=home_win_score">
                            <span>1</span>
                        </a>
                    </div>
                    <div class="mb-2 border-0 rounded-circle mx-2">
                        <a class="btn btn btn-dark border-0 rounded-circle" href="/data_info/match_odds?matchId=<?= $match['id'] ?>&season=<?= $match['season'] ?>&correct_first_half=draw_score">
                            <span>X</span>
                        </a>
                    </div>
                    <div class="mb-2 border-0 rounded-circle">
                        <a class="btn btn btn-danger border-0 rounded-circle" href="/data_info/match_odds?matchId=<?= $match['id'] ?>&season=<?= $match['season'] ?>&correct_first_half=away_win_score">
                            <span>2</span>
                        </a>
                    </div>
                </div>
                <tbody>
                    <?php
                    // Recogemos las apuestas para cada casa
                    $arrayOdds = [];
                    foreach ($dataItem['odds_correct_score_1st_half'] as $index => $odds) :
                        $arrayOdds[$odds['provider']][$odds['type']] = $odds['value'];
                    endforeach;
                    ?>
                    <?php foreach ($arrayOdds as $provider => $oddsType) : ?>
                        <tr>
                            <td class="text-left ml-4 font-weight-bold">
                                <?= strtoupper($provider) ?>
                            </td>
                            <!-- Solo Resultados donde GANA EQUIPO CASA -->
                            <?php if (!strpos($_SERVER['REQUEST_URI'], "draw_score") and !strpos($_SERVER['REQUEST_URI'], "away_win_score")) : ?>
                                <td class="text-center">
                                    <?php if (isset($oddsType['1:0'])) : ?>
                                        <?= $oddsType['1:0'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['2:0'])) : ?>
                                        <?= $oddsType['2:0'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['3:0'])) : ?>
                                        <?= $oddsType['3:0'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['4:0'])) : ?>
                                        <?= $oddsType['4:0'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['5:0'])) : ?>
                                        <?= $oddsType['5:0'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['2:1'])) : ?>
                                        <?= $oddsType['2:1'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['3:1'])) : ?>
                                        <?= $oddsType['3:1'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['4:1'])) : ?>
                                        <?= $oddsType['4:1'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['5:1'])) : ?>
                                        <?= $oddsType['5:1'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['3:2'])) : ?>
                                        <?= $oddsType['3:2'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['4:2'])) : ?>
                                        <?= $oddsType['4:2'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['4:3'])) : ?>
                                        <?= $oddsType['4:3'] ?>
                                    <?php endif; ?>
                                </td>
                            <?php endif; ?>
                            <!-- Solo Resultados donde EMPATE -->
                            <?php if (strpos($_SERVER['REQUEST_URI'], "draw_score")) : ?>
                                <td class="text-center">
                                    <?php if (isset($oddsType['0:0'])) : ?>
                                        <?= $oddsType['0:0'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['1:1'])) : ?>
                                        <?= $oddsType['1:1'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['2:2'])) : ?>
                                        <?= $oddsType['2:2'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['3:3'])) : ?>
                                        <?= $oddsType['3:3'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['4:4'])) : ?>
                                        <?= $oddsType['4:4'] ?>
                                    <?php endif; ?>
                                </td>
                            <?php endif; ?>
                            <!-- Solo Resultados donde GANA EQUIPO DE FUERA -->
                            <?php if (strpos($_SERVER['REQUEST_URI'], "away_win_score")) : ?>
                                <td class="text-center">
                                    <?php if (isset($oddsType['0:1'])) : ?>
                                        <?= $oddsType['0:1'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['0:2'])) : ?>
                                        <?= $oddsType['0:2'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['0:3'])) : ?>
                                        <?= $oddsType['0:3'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['0:4'])) : ?>
                                        <?= $oddsType['0:4'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['0:5'])) : ?>
                                        <?= $oddsType['0:5'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['1:2'])) : ?>
                                        <?= $oddsType['1:2'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['1:3'])) : ?>
                                        <?= $oddsType['1:3'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['1:4'])) : ?>
                                        <?= $oddsType['1:4'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['1:5'])) : ?>
                                        <?= $oddsType['1:5'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['2-3'])) : ?>
                                        <?= $oddsType['2-3'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['2-4'])) : ?>
                                        <?= $oddsType['2-4'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['3:4'])) : ?>
                                        <?= $oddsType['3:4'] ?>
                                    <?php endif; ?>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            <?php endif; ?>
        </table>
    <?php endif; ?>

    <?php if (strpos($_SERVER['REQUEST_URI'], "correct_second_h")) : ?>
        <table class="table table-bordered table-sm">
            <thead class="thead-dark">
                <tr class="text-center text-uppercase">
                    <!-- Tabla Solo Resultados donde GANA EQUIPO CASA -->
                    <?php if (!strpos($_SERVER['REQUEST_URI'], "draw_score") and !strpos($_SERVER['REQUEST_URI'], "away_win_score")) : ?>
                        <th scope="col"><span class="float-left"><i class="fa-solid fa-sort fa-lg"></i></span>Provider
                        </th>
                        <th scope="col" class="bg-secondary">1-0</th>
                        <th scope="col">2-0</th>
                        <th scope="col" class="bg-secondary">3-0</th>
                        <th scope="col">4-0</th>
                        <th scope="col" class="bg-secondary">5-0</th>
                        <th scope="col">2-1</th>
                        <th scope="col" class="bg-secondary">3-1</th>
                        <th scope="col">4-1</th>
                        <th scope="col" class="bg-secondary">5-1</th>
                        <th scope="col">3-2</th>
                        <th scope="col" class="bg-secondary">4-2</th>
                        <th scope="col">4-3</th>
                    <?php endif; ?>
                    <!-- Tabla Solo Resultados donde EMPATE -->
                    <?php if (strpos($_SERVER['REQUEST_URI'], "draw_score")) : ?>
                        <th scope="col"><span class="float-left"><i class="fa-solid fa-sort fa-lg"></i></span>Provider
                        </th>
                        <th scope="col" class="bg-secondary">0-0</th>
                        <th scope="col">1-1</th>
                        <th scope="col" class="bg-secondary">2-2</th>
                        <th scope="col">3-3</th>
                        <th scope="col" class="bg-secondary">4-4</th>
                    <?php endif; ?>
                    <!-- Tabla Solo Resultados donde GANA EQUIPO DE FUERA -->
                    <?php if (strpos($_SERVER['REQUEST_URI'], "away_win_score")) : ?>
                        <th scope="col"><span class="float-left"><i class="fa-solid fa-sort fa-lg"></i></span>Provider
                        </th>
                        <th scope="col" class="bg-secondary">0-1</th>
                        <th scope="col">0-2</th>
                        <th scope="col" class="bg-secondary">0-3</th>
                        <th scope="col">0-4</th>
                        <th scope="col" class="bg-secondary">0-5</th>
                        <th scope="col">1-2</th>
                        <th scope="col" class="bg-secondary">1-3</th>
                        <th scope="col">1-4</th>
                        <th scope="col" class="bg-secondary">1-5</th>
                        <th scope="col">2-3</th>
                        <th scope="col" class="bg-secondary">2-4</th>
                        <th scope="col">3-4</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <!-- 1- Para apuestas de Correct Score Second Half -->
            <?php if (isset($_GET["correct_second_h"])) : ?>
                <h4 class="text-center">Correct Score 2nd Half</h4>
                <div class="mb-4 px-4 d-flex flex-wrap justify-content-center">
                    <div class="mb-2 rounded-circle">
                        <a class="btn btn btn-success border-0 rounded-circle" href="/data_info/match_odds?matchId=<?= $match['id'] ?>&season=<?= $match['season'] ?>&correct_second_h=home_win_score">
                            <span>1</span>
                        </a>
                    </div>
                    <div class="mb-2 border-0 rounded-circle mx-2">
                        <a class="btn btn btn-dark border-0 rounded-circle" href="/data_info/match_odds?matchId=<?= $match['id'] ?>&season=<?= $match['season'] ?>&correct_second_h=draw_score">
                            <span>X</span>
                        </a>
                    </div>
                    <div class="mb-2 border-0 rounded-circle">
                        <a class="btn btn btn-danger border-0 rounded-circle" href="/data_info/match_odds?matchId=<?= $match['id'] ?>&season=<?= $match['season'] ?>&correct_second_h=away_win_score">
                            <span>2</span>
                        </a>
                    </div>
                </div>
                <tbody>
                    <?php
                    // Recogemos las apuestas para cada casa
                    $arrayOdds = [];
                    foreach ($dataItem['odds_correct_score_2nd_half'] as $index => $odds) :
                        $arrayOdds[$odds['provider']][$odds['type']] = $odds['value'];
                    endforeach;
                    ?>
                    <?php foreach ($arrayOdds as $provider => $oddsType) : ?>
                        <tr>
                            <td class="text-left ml-4 font-weight-bold">
                                <?= strtoupper($provider) ?>
                            </td>
                            <!-- Solo Resultados donde GANA EQUIPO CASA -->
                            <?php if (!strpos($_SERVER['REQUEST_URI'], "draw_score") and !strpos($_SERVER['REQUEST_URI'], "away_win_score")) : ?>
                                <td class="text-center">
                                    <?php if (isset($oddsType['1:0'])) : ?>
                                        <?= $oddsType['1:0'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['2:0'])) : ?>
                                        <?= $oddsType['2:0'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['3:0'])) : ?>
                                        <?= $oddsType['3:0'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['4:0'])) : ?>
                                        <?= $oddsType['4:0'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['5:0'])) : ?>
                                        <?= $oddsType['5:0'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['2:1'])) : ?>
                                        <?= $oddsType['2:1'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['3:1'])) : ?>
                                        <?= $oddsType['3:1'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['4:1'])) : ?>
                                        <?= $oddsType['4:1'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['5:1'])) : ?>
                                        <?= $oddsType['5:1'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['3:2'])) : ?>
                                        <?= $oddsType['3:2'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['4:2'])) : ?>
                                        <?= $oddsType['4:2'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['4:3'])) : ?>
                                        <?= $oddsType['4:3'] ?>
                                    <?php endif; ?>
                                </td>
                            <?php endif; ?>
                            <!-- Solo Resultados donde EMPATE -->
                            <?php if (strpos($_SERVER['REQUEST_URI'], "draw_score")) : ?>
                                <td class="text-center">
                                    <?php if (isset($oddsType['0:0'])) : ?>
                                        <?= $oddsType['0:0'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['1:1'])) : ?>
                                        <?= $oddsType['1:1'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['2:2'])) : ?>
                                        <?= $oddsType['2:2'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['3:3'])) : ?>
                                        <?= $oddsType['3:3'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['4:4'])) : ?>
                                        <?= $oddsType['4:4'] ?>
                                    <?php endif; ?>
                                </td>
                            <?php endif; ?>
                            <!-- Solo Resultados donde GANA EQUIPO DE FUERA -->
                            <?php if (strpos($_SERVER['REQUEST_URI'], "away_win_score")) : ?>
                                <td class="text-center">
                                    <?php if (isset($oddsType['0:1'])) : ?>
                                        <?= $oddsType['0:1'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['0:2'])) : ?>
                                        <?= $oddsType['0:2'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['0:3'])) : ?>
                                        <?= $oddsType['0:3'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['0:4'])) : ?>
                                        <?= $oddsType['0:4'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['0:5'])) : ?>
                                        <?= $oddsType['0:5'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['1:2'])) : ?>
                                        <?= $oddsType['1:2'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['1:3'])) : ?>
                                        <?= $oddsType['1:3'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['1:4'])) : ?>
                                        <?= $oddsType['1:4'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['1:5'])) : ?>
                                        <?= $oddsType['1:5'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['2-3'])) : ?>
                                        <?= $oddsType['2-3'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['2-4'])) : ?>
                                        <?= $oddsType['2-4'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($oddsType['3:4'])) : ?>
                                        <?= $oddsType['3:4'] ?>
                                    <?php endif; ?>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            <?php endif; ?>
        </table>
    <?php endif; ?>
</section>
<!-- Avisos de que no hay cierto tipo de apuestas o apuestas en general -->
<?php
if (is_numeric(strrev($_SERVER['REQUEST_URI'])[0])) :
    $allOdds = array_merge(
        $dataItem['odds_match_winner'],
        $dataItem['odds_half_winner'],
        $dataItem['odds_home_away'],
        $dataItem['odds_asian_handicap'],
        $dataItem['odds_double_chance'],
        $dataItem['odds_over_under'],
        $dataItem['odds_over_under_first'],
        $dataItem['odds_over_under_second'],
        $dataItem['odds_clean_sheet_home'],
        $dataItem['odds_clean_sheet_away'],
        $dataItem['odds_correct_score'],
        $dataItem['odds_correct_score_1st_half'],
        $dataItem['odds_correct_score_2nd_half']
    )
?>
    <? if (empty($allOdds)) : ?>
        <div class="text-center mt-4">
            <h3>Este partido no tiene todavía ningún tipo de apuesta</h3>
        </div>
    <?php endif; ?>
<?php endif; ?>
<?php
if (is_numeric(strrev($_SERVER['REQUEST_URI'])[0]) && count($dataItem['odds_match_winner']) === 0 && !empty($allOdds)) : ?>
    <div class="text-center mt-4">
        <h3>Este partido todavía no contiene este tipo de apuesta</h3>
        <p class="text-warning font-weight-bold h4">Match Winner</p>
    </div>
<?php endif ?>
<?php
if ((strpos($_SERVER['REQUEST_URI'], "second_half") !== false) && count($dataItem['odds_half_winner']) === 0) : ?>
    <div class="text-center mt-4">
        <h3>Este partido no tiene este tipo de apuestas</h3>
        <p class="text-warning font-weight-bold h4">2nd Half Winner</p>
    </div>
<?php endif ?>
<?php
if ((strpos($_SERVER['REQUEST_URI'], "home_away") !== false) && count($dataItem['odds_home_away']) === 0) : ?>
    <div class="text-center mt-4">
        <h3>Este partido no tiene este tipo de apuestas</h3>
        <p class="text-warning font-weight-bold h4">Home Away</p>
    </div>
<?php endif ?>
<?php
if ((strpos($_SERVER['REQUEST_URI'], "asian_handicap") !== false) && count($dataItem['odds_asian_handicap']) === 0) : ?>
    <div class="text-center mt-4">
        <h3>Este partido no tiene este tipo de apuestas</h3>
        <p class="text-warning font-weight-bold h4">Asian Handicap</p>
    </div>
<?php endif ?>
<?php
if ((strpos($_SERVER['REQUEST_URI'], "double_chance") !== false) && count($dataItem['odds_double_chance']) === 0) : ?>
    <div class="text-center mt-4">
        <h3>Este partido no tiene este tipo de apuestas</h3>
        <p class="text-warning font-weight-bold h4">Double Chance</p>
    </div>
<?php endif ?>
<?php
if ((strpos($_SERVER['REQUEST_URI'], "ov_und_first") !== false) && count($dataItem['odds_over_under_first']) === 0) : ?>
    <div class="text-center mt-4">
        <h3>Este partido no tiene este tipo de apuestas</h3>
        <p class="text-warning font-weight-bold h4">Goals Over Under First Half</p>
    </div>
<?php endif ?>
<?php
if ((strpos($_SERVER['REQUEST_URI'], "ov_und_second") !== false) && count($dataItem['odds_over_under_second']) === 0) : ?>
    <div class="text-center mt-4">
        <h3>Este partido no tiene este tipo de apuestas</h3>
        <p class="text-warning font-weight-bold h4">Goals Over Under Second Half</p>
    </div>
<?php endif ?>
<?php
if ((strpos($_SERVER['REQUEST_URI'], "over_under") !== false) && count($dataItem['odds_over_under']) === 0) : ?>
    <div class="text-center mt-4">
        <p class="text-warning font-weight-bold h4">Goals Over Under</p>
    </div>
<?php endif ?>
<?php
if ((strpos($_SERVER['REQUEST_URI'], "clean_sheet_away") !== false) && count($dataItem['odds_clean_sheet_away']) === 0) : ?>
    <div class="text-center mt-4">
        <h3>Este partido no tiene este tipo de apuestas</h3>
        <p class="text-warning font-weight-bold h4">Cleen Sheet Away</p>
    </div>
<?php endif ?>
<?php
if ((strpos($_SERVER['REQUEST_URI'], "clean_sheet_home") !== false) && count($dataItem['odds_clean_sheet_home']) === 0) : ?>
    <div class="text-center mt-4">
        <h3>Este partido no tiene este tipo de apuestas</h3>
        <p class="text-warning font-weight-bold h4">Cleen Sheet Home</p>
    </div>
<?php endif ?>
<?php
if ((strpos($_SERVER['REQUEST_URI'], "correct_score") !== false) && count($dataItem['odds_correct_score']) === 0) : ?>
    <div class="text-center mt-4">
        <h3>Este partido no tiene este tipo de apuestas</h3>
        <p class="text-warning font-weight-bold h4">Correct Score</p>
    </div>
<?php endif ?>
<?php
if ((strpos($_SERVER['REQUEST_URI'], "correct_first_half") !== false) && count($dataItem['odds_correct_score_1st_half']) === 0) : ?>
    <div class="text-center mt-4">
        <h3>Este partido no tiene este tipo de apuestas</h3>
        <p class="text-warning font-weight-bold h4">Correct Score First Half</p>
    </div>
<?php endif ?>
<?php
if ((strpos($_SERVER['REQUEST_URI'], "correct_second_h") !== false) && count($dataItem['odds_correct_score_2nd_half']) === 0) : ?>
    <div class="text-center mt-4">
        <h3>Este partido no tiene este tipo de apuestas</h3>
        <p class="text-warning font-weight-bold h4">Correct Score Second Half</p>
    </div>
<?php endif ?>

<script>
    /* Filtro para ordenar apuestas */
    const table_rows = document.querySelectorAll('.section_sort table tbody tr');
    const table_headings = document.querySelectorAll('.section_sort thead th');

    table_headings.forEach((head, i) => {
        head.onclick = () => {
            table_rows.forEach(row => {
                // console.log(row.querySelectorAll('td')[i]);
            })

            head.classList.toggle('asc', sort_arc);
            var sort_arc = head.classList.contains('asc') ? false : true;
            sortTable(i, sort_arc);
        }
    })

    function sortTable(column, sort_arc) {
        [...table_rows].sort((a, b) => {
            let first_row = a.querySelectorAll('td')[column].textContent.toLowerCase();
            let second_row = b.querySelectorAll('td')[column].textContent.toLowerCase();
            // La primera columna es el nombre no queremos convertir en float number
            if (column !== 0) {
                first_row = parseFloat(first_row);
                second_row = parseFloat(second_row);
            }
            if (isNaN(first_row) && isNaN(second_row)) {
                first_row = -1
                second_row = -1

            }
            if (isNaN(first_row) || isNaN(second_row)) {
                if (first_row !== second_row && isNaN(first_row)) {
                    first_row = -1
                }
                if (first_row !== second_row && isNaN(second_row)) {
                    second_row = -1
                }
            }

            return sort_arc ? (first_row < second_row ? 1 : -1) : (first_row < second_row ? -1 : 1);

        }).map((sorted_row) => {
            document.querySelector('.section_sort table tbody').appendChild(sorted_row)
        })
    }

    /* Filtro para Highlight apuestas mayores y menores */
    function compareData() {
        const rows = document.querySelector(".section_sort tbody").rows;
        const cols = document.querySelectorAll(".section_sort table thead tr th");
        for (let col = 1; col < cols.length; col++) {
            var cells = Array.from(rows, row => row.cells[col])

            var data = cells.map((cell) => {
                if (cell.innerText !== '') {
                    return +cell.textContent
                } else {
                    return undefined
                }
            });

            // -- 1 Tomamos el menor valor y desechamos los vacíos
            var lowest = Math.min.apply(null, data.filter(function(n) {
                return !isNaN(n);
            }));
            // Creamos un array para los indices de menor valor repetidos
            var lowestDup = [];
            for (var i = 0; i < data.length; i++) {
                if (data[i] == lowest) {
                    lowestDup.push(i);
                }
            }
            const j = data.indexOf(lowest);
            if (typeof cells[j] !== 'undefined') {
                for (var k = 0; k < lowestDup.length; k++) {
                    cells[lowestDup[k]].style.background = "#F55C47";
                    cells[lowestDup[k]].style.background = "linear-gradient(to right, white 0%, white 33.33%, #F55C47 33.33%, #F55C47 66.66%, white 66.66%, white 100%)";
                    cells[lowestDup[k]].style.color = "#FFF";
                    cells[lowestDup[k]].style.fontWeight = "bold";
                }
            }

            // -- 2 Tomamos el mayor valor de cada columna (la apuesta más pagada de cada tipo) y desechamos los vacíos
            var highest = Math.max.apply(null, data.filter(function(n) {
                return !isNaN(n);
            }));
            // Creamos un array para los indices de mayor valor repetidos
            var highestDup = [];
            for (var l = 0; l < data.length; l++) {
                if (data[l] == highest) {
                    highestDup.push(l);
                }
            }
            const m = data.indexOf(highest);
            if (typeof cells[m] !== 'undefined') {
                for (var n = 0; n < highestDup.length; n++) {
                    cells[highestDup[n]].style.background = "#4AA96C";
                    cells[highestDup[n]].style.background = "linear-gradient(to right, white 0%, white 33.33%, #4AA96C 33.33%, #4AA96C 66.66%, white 66.66%, white 100%)";
                    cells[highestDup[n]].style.color = "#FFF";
                    cells[highestDup[n]].style.fontWeight = "bold";
                }
            }

        }

        // -- Highlight de apuesta mejor pagada (independientemente del tipo de apuesta)
        let table = document.getElementById("section_id");
        const numCols = rows[0].querySelectorAll("td, th").length;
        const tds = Array.from(table.querySelectorAll("td")).filter((td, index) => {
            return (index + 1) % numCols !== 1;
        });
        const tdsValue = tds.map(td => parseFloat(td.innerText));

        let maxValue = Math.max.apply(null, tdsValue.filter(function(n) {
            return !isNaN(n);
        }));

        let maxIndices = [];

        for (let o = 0; o < tdsValue.length; o++) {
            if (tdsValue[o] === maxValue) {
                maxIndices.push(o);
            }
        }

        for (var q = 0; q < maxIndices.length; q++) {
            tds[maxIndices[q]].style.background = "#9FE6A0";
            tds[maxIndices[q]].style.background = "linear-gradient(to right, white 0%, white 33.33%, #9FE6A0 33.33%, #9FE6A0 66.66%, white 66.66%, white 100%)";
            tds[maxIndices[q]].style.color = "#003400";
            tds[maxIndices[q]].style.fontWeight = "bold";
        }

    }
    compareData();
</script>