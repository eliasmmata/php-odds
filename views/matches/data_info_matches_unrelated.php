<?php

use BeSoccerSDK\Classes\Show;

$matchId = $_GET['match_id'] ?? 0;
$day = $_GET['day'] ?? 0;
$category = $_GET['category'] ?? 0;
$league = $_GET['league'] ?? 0;

// Conditional styles
if (strpos($_SERVER['REQUEST_URI'], "goalserve") === false) {
    $enetpulse  = 'primary';
    $goalserve = 'secondary';
} else {
    $enetpulse  = 'secondary';
    $goalserve = 'primary';
}

// Get Team Name if isset
$matchesArr = array_values($dataItem['matches']);
if (isset($matchesArr[0]['team_name'])) {
    $teamName = $matchesArr[0]['team_name'];
}
?>

<!-- Buscador y filtro de partidos -->
<div class="my-4 border border-1 border-opacity-50 py-3 mb-3 rounded">
    <div class="d-flex justify-content-center mb-3">
        <h3 class="text-center">Buscador de partidos</h3>
        <div class="d-flex align-items-baseline position-absolute" style="right: 2rem;">
            <a class="btn btn btn-warning" href="/data_info/matches">
                <i class="fa-solid fa-chevron-left"></i>
                <span class="ml-1">Volver</span>
            </a>
        </div>
    </div>
    <div class="d-flex justify-content-center flex-wrap flex-md-nowrap">
        <div class="d-flex justify-content-center align-items-center flex-row p-3 border border-1 border-opacity-50 rounded">
            <form class="form-inline" method="GET" action="/data_info/match_odds">
                <input type="text" name="matchId" placeholder="Match ID RF" class="form-control" required />
                <input type="text" name="season" placeholder="Season (<?= date("Y") ?>)" class="form-control mx-2" required />
                <button type="submit" class="btn border-0 btn-success d-flex align-items-center px-4">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <span class="mx-2">Buscar</span>
                </button>
            </form>
        </div>
        <div class="d-flex justify-content-center align-items-center flex-row p-3 mx-2 border border-1 border-opacity-50 rounded">
            <form class="form-inline display-block" method="GET" action="/data_info/matches">
                <input type="text" name="category" placeholder="Category ID RF" class="form-control mr-1" required />
                <input type="text" name="season" placeholder="Season (<?= date("Y") ?>)" class="form-control mr-1" required />
                <button type="submit" class="btn btn-success d-flex align-items-center px-2 py-2">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>
        <div class="d-flex justify-content-center align-items-center flex-row p-3 border border-1 border-opacity-50 rounded">
            <form class="form-inline display block" method="GET" action="/data_info/matches">
                <input type="text" name="league" placeholder="League ID RF" class="form-control mr-1" required />
                <button type="submit" class="btn btn-success d-flex align-items-center px-2 py-2">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>

    </div>
    <!-- Filtro por Fuentes Externas -->
    <div class="mt-4 d-flex justify-content-center">
        <div class="d-flex align-items-baseline">
            <a type="submit" href="/data_info/matches/unrelated" class="btn border-0 btn-<?= $enetpulse ?> d-flex align-items-center px-4 mx-2">
                <span class="mr-2">ENETPULSE</span>
                <i class="fa-solid fa-coins"></i>
            </a>
        </div>
        <div class="d-flex align-items-baseline">
            <a type="submit" href="/data_info/matches/unrelated?goalserve" class="btn border-0 btn-<?= $goalserve ?> d-flex align-items-center px-4 mx-2">
                <span class="mr-2">GOALSERVE</span>
                <i class="fa-solid fa-coins"></i>
            </a>
        </div>
    </div>
    <!-- FIN Filtro por Fuentes Externas  -->
</div>
<!-- FIN Buscador de partidos card -->
<!-- Título  -->
<div class="py-3 d-flex justify-content-center">
    <?php if (empty($category) && empty($league) && empty($day) && isset($teamName)) : ?>
        <h3 class="h1 my-0 px-3 text-center">Partidos sin relacionar de <?= $teamName ?></h3>
    <?php else : ?>
        <h3 class="h1 my-0 px-3 text-center">Partidos sin relacionar</h3>
    <?php endif; ?>
</div>
<!-- FIN Título  -->
<!-- Tabla de resultados ENET PULSE (categorías no relacionadas con RF) -->
<?php if (strpos($_SERVER['REQUEST_URI'], "goalserve") === false) : ?>
    <table class="table table-bordered   table-sm">
        <thead class="thead-dark">
            <tr class="text-center text-uppercase align-middle">
                <th scope="col">EP Match ID</th>
                <th scope="col">Match ID RF</th>
                <th scope="col" colspan="2">Partido</th>
                <th scope="col">Fecha</th>
                <th scope="col">Cat RF</th>
                <th scope="col">EP Cat </th>
                <th scope="col">Status</th>
                <th scope="col">Took Date</th>

            </tr>
        </thead>
        <tbody class="text-center">
            <?php foreach ($dataItem['matches'] as $match) : ?>
                <tr class="align-middle border-bottom">
                    <td>
                        <span class="d-flex justify-content-between">
                            <p class="align-self-end m-0 font-weight-bold"><?= $match['ext_id'] ?></p>
                            <?php if (isset($match['id'])) : ?>
                                <a class="pb-2" target="_blank" href="https://www.google.com/search?q=<?= $match['teams'][1]['team_name'] ?>+<?= $match['teams'][2]['team_name'] ?>+<?= $match['startdate'] ?>+soccer+match">
                                    <i class="fa-brands fa-google-plus-g text-success font-weight-bold"></i>
                                </a>
                            <?php endif; ?>
                        </span>
                    </td>
                    <td>
                        <?php if (isset($match['id'])) : ?>
                            <form action="/data_info/matches/relate?extId=<?= $match['ext_id'] ?>" method="POST" class="d-flex justify-content-center">
                                <input class="form-control pl-1 mr-2 w-50" type="text" name="rf_match_id" value="<?= $match['rf_match_id'] ?>" required></input>
                                <input type="hidden" name="extId" value="<?= $match['ext_id'] ?>"></input>
                                <button type="submit" class="btn btn-sm bg-dark border-rounded px-2 py-1"><i class="fa fa-edit text-warning"></i></button>
                            </form>
                        <?php else : ?>
                            <form action="/data_info/matches/relate?extId=<?= $match['ext_id'] ?>" method="POST" class="d-flex justify-content-center">
                                <input class="form-control pl-1 mr-2 w-50" type="text" name="rf_match_id" value="<?= $match['rf_match_id'] ?>" required></input>
                                <input type="hidden" name="extId" value="<?= $match['ext_id'] ?>"></input>
                                <button type="submit" class="btn btn-sm bg-dark border-rounded px-2 py-1"><i class="fa fa-edit text-warning"></i></button>
                            </form>
                        <?php endif; ?>
                    </td>
                    <!-- PARTIDO RELACIONADO -->
                    <?php if (!isset($match['ext_id'])) : ?>
                        <td class="border-left-0 border-right-0 text-left pl-4 pr-0">
                            <?= $match['teams'][1]['team_name'] ?>
                        </td>
                        <td class="border-left-0 border-right-0 text-left px-0">
                            VS
                        </td>
                        <td class="border-left-0 border-right-0 text-right pr-4 pl-0">
                            <?= $match['teams'][2]['team_name'] ?>
                        </td>
                        <!-- FIN PARTIDO RELACIONADO -->
                        <!-- PARTIDO SIN RELACIONAR -->
                    <?php else : ?>
                        <td class="border-right-0">
                            <span class="d-flex">
                                <p class="align-self-center m-0 font-weight-bold"><?= $match['match_name'] ?></p>
                                <a class="pb-2" target="_blank" href="https://www.google.com/search?q=<?= $match['match_name'] ?>+<?= $match['startdate'] ?>+soccer+match">
                                    <i class="fa-brands fa-google-plus-g text-success font-weight-bold mb-2 ml-2"></i>
                                </a>
                            </span>
                        </td>
                        <?php if (isset($match['ext_team_id'])) : ?>
                            <td class="border-left-1">
                                Ext Id: <?= $match['ext_team_id'] ?>
                            </td>
                        <?php else : ?>
                            <td class="border-left-0"></td>
                        <?php endif; ?>
                    <?php endif; ?>
                    <!-- FIN PARTIDO SIN RELACIONAR -->
                    <td><?= $match['startdate'] ?></td>
                    <td>
                        <a class="text-success font-weight-bold" target="_blank" href="https://deep.besoccer.com/categories/<?= $match['cat_id_rf'] ?>">
                            #<?= $match['cat_id_rf'] ?>
                        </a>
                    </td>
                    <td><?= $match['ext_cat_id'] ?></td>
                    <td>
                        <?php if (isset($match['status'])) : ?>
                            <?= $match['status'] ?>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if (isset($match['took_date'])) : ?>
                            <?= $match['took_date'] ?>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
<?php
if (strpos($_SERVER['REQUEST_URI'], "goalserve") !== false) : ?>
    <table class="table table-bordered   table-sm">
        <thead class="thead-dark">
            <tr class="text-center align-middle text-uppercase">
                <th scope="col">GS Match ID</th>
                <th scope="col">Match ID RF <i class="fa-solid fa-handshake ml-2"></i></th>
                <th scope="col" colspan="5">Partido</th>
                <th scope="col">Fecha</th>
                <th scope="col">Cat RF</th>
                <th scope="col">GS Cat </th>
                <th scope="col">Status</th>
                <th scope="col">Took Date</th>
            </tr>
        </thead>
    </table>
<?php endif ?>
<?php if ((strpos($_SERVER['REQUEST_URI'], "unrelated") !== false) && (empty($dataItem))) : ?>
    <div class="text-center mt-4">
        <h3>No hay resultados para este partido</h3>
    </div>
<?php endif ?>