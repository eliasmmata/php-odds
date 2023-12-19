<?php

use BeSoccerSDK\Classes\Show;

$matchId = $_GET['match_id'] ?? 0;

?>
<div class="my-4 border border-1 border-opacity-50 pt-3 mb-3 rounded">
    <div class="d-flex justify-content-center">
        <?php if (isset($dataItem['matches']) && !empty($dataItem['matches'][0]['match_id'])) : /* print_r($dataItem['matches']); */ ?>
            <h3 class="h1 text-center my-0">Partidos relacionados (Football Data)</h3>
            <div class="d-flex align-items-center position-absolute" style="right: 2rem;">
                <a class="btn btn btn-warning" href="/football_data/leagues/">
                    <i class="fa-solid fa-chevron-left"></i>
                    <span class="ml-1">Volver</span>
                </a>
            </div>
            <?php if ((strpos($_SERVER['REQUEST_URI'], "unrelated") === false && (strpos($_SERVER['REQUEST_URI'], "teamId")))) : ?>
                <div class="d-flex align-items-center position-absolute" style="right: 2rem;">
                    <a class="btn btn btn-warning" href="/football_data/teams/">
                        <i class="fa-solid fa-chevron-left"></i>
                        <span class="ml-1">Volver</span>
                    </a>
                </div>
            <? endif; ?>
        <? else : ?>
            <h3 class="h1 text-center">Partidos por relacionar</h3>
            <?php if (strpos($_SERVER['REQUEST_URI'], "unrelated") !== false) : ?>
                <div class="d-flex align-items-center position-absolute" style="right: 2rem;">
                    <a class="btn btn btn-warning" href="/football_data/matches/">
                        <i class="fa-solid fa-chevron-left"></i>
                        <span class="ml-1">Volver</span>
                    </a>
                </div>
            <? endif; ?>
        <? endif; ?>
    </div>
    <div class="d-flex justify-content-center align-items-center py-3 mx-3 mb-3 border-bottom border-opacity-50">
        <form class="form-inline" method="GET" action="/football_data/matches?matchId=<?= $matchId ?>">
            <div class="d-flex justify-content-around align-items-cente mr-4">
                <input type="text" name="matchId" placeholder="Match ID" class="form-control mr-2" required />
                <button type="submit" class="btn border-0 btn-success d-flex align-items-center px-4">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <span class="mx-2">Buscar</span>
                </button>
            </div>
        </form>
        <?php if ((strpos($_SERVER['REQUEST_URI'], "unrelated") === false && (strpos($_SERVER['REQUEST_URI'], "leagueId")))) : ?>
            <div>
                <a class="btn btn btn-danger" href="/football_data/matches/unrelated">
                    <i class="fa-solid fa-handshake-slash"></i>
                    <span class="ml-1">No relacionados</span>
                </a>
            </div>
        <? endif; ?>
        <?php if ((strpos($_SERVER['REQUEST_URI'], "unrelated") === false && (strpos($_SERVER['REQUEST_URI'], "teamId")))) : ?>
            <div>
                <a class="btn btn btn-danger" href="/football_data/matches/unrelated">
                    <i class="fa-solid fa-handshake-slash"></i>
                    <span class="ml-1">No relacionados</span>
                </a>
            </div>
        <? endif; ?>
    </div>
    <? if (strpos($_SERVER['REQUEST_URI'], "leagueId") !== false) : ?>
        <div class="d-flex justyfy-content-start mt-2 ml-3">
            <div class="bg-dark p-2 font-weight-light mr-1">
                Relacionados
                <i class="fa-solid fa-handshake px-2"></i>
                <?= count($dataItem['matches']) ?>
            </div>
            <div class="bg-dark p-2 font-weight-light mr-1">
                Partidos por jugar
                <i class="fa-solid fa-shield px-2"></i>
                <?= $dataItem['roundsrf']['futures_matches'] ?>
            </div>
            <div class="p-2 bg-dark font-weight-light mr-4">
                BD Rf
                <i class="fa-solid fa-database px-2"></i>
                <?= count($dataItem['roundsrf']) - 1 ?>
            </div>
            <div class="bg-dark p-2 font-weight-light mr-1">
                Equipos Ext
                <i class="fa-solid fa-shield px-2"></i>
                <?= count($dataItem['teamsext']) ?>
            </div>
            <div class="p-2 bg-dark font-weight-light">
                Equipos Rf
                <i class="fa-solid fa-shield px-2"></i>
                <?= count($dataItem['teamsrf']) ?>
            </div>
        </div>
    <? endif; ?>
</div>
<table class="table table-bordered   table-sm">
    <thead class="thead-dark">
        <tr class="text-center align-middle text-uppercase">
            <th scope="col" class="py-2">Match ID</th>
            <th scope="col">League</th>
            <th scope="col">Fecha</th>
            <th scope="col">Season</th>
            <th scope="col" colspan="5">Partido</th>
            <th scope="col">1X2</th>
            <th scope="col">Probabilidades</th>
        </tr>
    </thead>
    <tbody class="text-center">
        <?php foreach ($dataItem['matches'] as $match) : ?>
            <tr class="align-middle">
                <?php if (empty($match['match_id'])) : ?>
                    <form action="/football_data/matches/relate" method="POST">
                        <td>
                            <input class="pl-2 py-1 w-75" type="text" name="matchId" placeholder="Match ID" required></input>
                        </td>
                        <td>
                            <input class="pl-2 py-1 w-50" type="text" name="leagueId" placeholder="League ID" required></input>
                            <input type="hidden" name="extId" value="<?= $match['id'] ?>"></input>
                            <input type="hidden" name="season" value="<?= $match['season'] ?>"></input>
                            <button type="submit" class="btn btn-sm d-sm-inline-flex text-warning bg-dark p-2 rounded ml-2"><i class="fa fa-edit"></i></button>
                        </td>
                    </form>
                <? else : ?>
                    <td class="font-weight-bold">
                        <a class="text-success font-weight-bold" target="_blank" href="https://es.besoccer.com/partido/<?= $match['home'] ?>/<?= $match['away'] ?>/<?= $match['season'] ?><?= $match['match_id'] ?>">
                            #<?= $match['match_id'] ?>
                        </a>
                    </td>
                    <td class="font-weight-bold">
                        <a class="text-success" target="_blank" href="https://deep.besoccer.com/categories/<?= $match['category_id'] ?>?leagueId=<?= $match['league_id'] ?>">
                            #<?= $match['league_id'] ?>
                        </a>
                    </td>
                <? endif; ?>
                <td><?= $match['date'] ?></td>
                <td><?= $match['season'] ?></td>
                <td class="border-right-0 px-1">
                    <img class="img-fluid" src="https://cdn.resfu.com/img_data/escudos/medium/<?= $match['dt1'] ?>.jpg?size=30x&lossy=1" alt="">
                </td>
                <td class="text-left border-right-0 border-left-0 pr-0">
                    <?= $match['home'] ?>
                </td>
                <td class="font-weight-bold border-left-0 border-right-0 px-0">
                    <?= $match['r1'] ?> - <?= $match['r2'] ?>
                </td>
                <td class="text-right border-left-0 border-right-0 pl-0">
                    <?= $match['away'] ?>
                </td>
                <td class="font-weight-bold border-left-0 px-1">
                    <img class="img-fluid" src="https://cdn.resfu.com/img_data/escudos/medium/<?= $match['dt2'] ?>.jpg?size=30x&lossy=1" alt="">
                </td>
                <td class="font-weight-bold"><?= ucfirst($match['result']) ?></td>
                <td>
                    <form action="/football_data/match_odds?" method="GET" class="mb-0">
                        <input type="hidden" name="matchId" value="<?= $match['match_id'] ?>"></input>
                        <input type="hidden" name="season" value="<?= $match['season'] ?>"></input>
                        <button type="submit" class="btn btn-sm border-0 bg-success px-3">
                            <i class="fa-solid fa-arrow-right-to-bracket"></i>
                        </button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php if ((strpos($_SERVER['REQUEST_URI'], "unrelated") !== false) && (count($dataItem['matches']) === 0)) : ?>
    <div class="text-center mt-4">
        <h3>Todos los partidos están relacionados</h3>
        <?php

        ?>
    </div>
<?php endif ?>