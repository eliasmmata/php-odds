<?php

use BeSoccerSDK\Classes\Show;

$matchId = $_GET['match_id'] ?? 0;
$day = $_GET['day'] ?? 0;
$category = $_GET['category'] ?? 0;
$league = $_GET['league'] ?? 0;
$teamId = $_GET['rf_id'] ?? 0;

// Conditional styles
if (strpos($_SERVER['REQUEST_URI'], "goalserve") === false) {
    $enetpulse  = 'primary';
    $goalserve = 'secondary';
} else {
    $enetpulse  = 'secondary';
    $goalserve = 'primary';
}

// Get Team Name (Can be Home or Away Team)
$getTeamName = array_splice($dataItem['matches'], 0, 2);
foreach ($getTeamName as $localAway) {
    $teamPos[] = $localAway['team1_name'];
    $teamPos[] = $localAway['team2_name'];
}
$teamName = array_unique(array_diff_assoc($teamPos, array_unique($teamPos)));
$teamName = implode(" ", $teamName);

?>

<!-- Buscador y filtro de partidos -->
<div class="my-4 border border-1 border-opacity-50 py-3 mb-3 rounded">
    <div class="d-flex justify-content-center mb-2">
        <h3 class="text-center">Buscador de partidos</h3>
        <?php if (!empty($teamId)) : ?>
            <div class="d-flex align-items-baseline position-absolute" style="right: 2rem;">
                <a class="btn btn btn-warning" href="/data_info/teams">
                    <i class="fa-solid fa-chevron-left"></i>
                    <span class="ml-1">Volver</span>
                </a>
            </div>
        <?php elseif (!empty($league) || !empty($category) || !empty($matchId) || !empty($day)) : ?>
            <div class="d-flex align-items-baseline position-absolute" style="right: 2rem;">
                <a class="btn btn btn-warning" href="/data_info/matches">
                    <i class="fa-solid fa-chevron-left"></i>
                    <span class="ml-1">Volver</span>
                </a>
            </div>
        <?php else : ?>
            <div class="d-flex align-items-baseline position-absolute" style="right: 2rem;">
                <a class="btn btn btn-warning" href="/">
                    <i class="fa-solid fa-chevron-left"></i>
                    <span class="ml-1">Volver</span>
                </a>
            </div>
        <?php endif; ?>
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
        <div>
            <a class="btn btn btn-danger" href="/data_info/matches/unrelated">
                <i class="fa-solid fa-handshake-slash"></i>
                <span class="ml-1">No relacionados</span>
            </a>
        </div>
    </div>
    <!-- FIN Filtro por Fuentes Externas  -->
</div>
<!-- FIN Buscador de partidos card -->
<!-- Título dinámico dependiendo de los filtros -->
<div class="py-3 d-flex justify-content-center">
    <?php if (empty($category) && empty($league) && empty($day) && empty($teamId)) : ?>
        <div class="d-flex align-items-center">
            <form class="form-inline" method="GET" action="/data_info/matches?">
                <button type="submit" name="day" value="yesterday" class="btn border-0 d-flex align-items-center p-0">
                    <span class="btn btn text-dark">
                        <i class="fa-solid fa-calendar-minus fa-xl"></i>
                    </span>
                </button>
            </form>
        </div>
        <h3 class="h1 my-0 px-3 text-center">Partidos del día</h3>
        <div class="d-flex align-items-center">
            <form class="form-inline" method="GET" action="/data_info/matches?">
                <button type="submit" name="day" value="tomorrow" class="btn border-0 d-flex align-items-center p-0">
                    <span class="btn btn text-dark">
                        <i class="fa-solid fa-calendar-plus fa-xl"></i>
                    </span>
                </button>
            </form>
        </div>
    <?php endif; ?>
    <?php if (!empty($day) && $day === "yesterday") : ?>
        <h3 class="h1 my-0 px-3 text-center">Partidos de ayer</h3>
        <div class="d-flex align-items-center">
            <a class="btn btn text-dark" href="/data_info/matches">
                <i class="fa-solid fa-calendar-day fa-xl"></i>
            </a>
        </div>
    <?php endif; ?>
    <?php if (!empty($day) && $day === "tomorrow") : ?>
        <div class="d-flex align-items-center">
            <a class="btn btn text-dark" href="/data_info/matches">
                <i class="fa-solid fa-calendar-day fa-xl"></i>
            </a>
        </div>
        <h3 class="h1 my-0 px-3 text-center">Partidos de mañana</h3>
    <?php endif; ?>
    <?php if (!empty($category)) : ?>
        <div class="d-flex align-items-center">
            <a class="btn btn text-dark" href="/data_info/matches">
                <i class="fa-solid fa-calendar-day fa-xl"></i>
            </a>
        </div>
        <?php $matchesArr = array_values($dataItem['matches']); ?>
        <h3 class="h1 my-0 px-3 text-center">Partidos de <?= $matchesArr[0]['name'] ?>
            <a class="h6 ml-3 text-success" href="https://deep.besoccer.com/categories/<?= $category ?>" target="_blank">#<?= $category ?></a>
        </h3>
    <?php endif; ?>
    <?php if (!empty($league)) : ?>
        <div class="d-flex align-items-center">
            <a class="btn btn text-dark" href="/data_info/matches">
                <i class="fa-solid fa-calendar-day fa-xl"></i>
            </a>
        </div>
        <?php $matchesArr = array_values($dataItem['matches']); ?>
        <h3 class="h1 my-0 px-3 text-center">
            Partidos de <?= $matchesArr[0]['name'] ?><span class="h6 ml-3">(temporada <?= $matchesArr[0]['season'] ?>)</span>
        </h3>
    <?php endif; ?>
    <?php if (!empty($teamId)) : ?>
        <div class="d-flex align-items-center">
            <a class="btn btn text-dark" href="/data_info/matches">
                <i class="fa-solid fa-calendar-day fa-xl"></i>
            </a>
        </div>
        <h3 class="h1 my-0 px-3 text-center">
            Partidos de <?= $teamName ?><a class="h6 ml-3 text-success" href="https://deep.besoccer.com/teams/<?= $teamId ?>" target="_blank">#<?= $teamId ?></a>
        </h3>
    <?php endif; ?>
</div>
<!-- FIN Título dinámico -->
<!-- Tabla con resultados -->
    <table id="table_sort" class="table table-bordered table-sm">
        <thead class="thead-dark">
            <tr class="text-center text-uppercase align-middle">
                <th scope="col" class="py-2 th_sort"><span class="float-left"><i class="fa-solid fa-sort fa-lg"></i></span>Match ID</th>
                <th scope="col" class="th_sort"><span class="float-left"><i class="fa-solid fa-sort fa-lg"></i></span>League</th>
                <th scope="col" colspan="5">Partido</th>
                <th scope="col">1X2</th>
                <th scope="col" class="th_sort"><span class="float-left"><i class="fa-solid fa-sort fa-lg"></i></span>Fecha</th>
                <th scope="col">Apuestas</th>
            </tr>
        </thead>
        <tbody class="text-center">
            <?php foreach ($dataItem['matches'] as $match) : ?>
                <tr class="align-middle border-bottom">
                    <td>
                        <a class="text-success font-weight-bold" target="_blank" href="https://es.besoccer.com/partido/<?= $match['team1_name'] ?>/<?= $match['team2_name'] ?>/<?= $match['season'] ?><?= $match['id'] ?>">
                            #<span class="td_sort"><?= $match['id'] ?></span>
                        </a>
                    </td>
                    <td class="font-weight-bold">
                        <a class="text-success font-weight-bold" target="_blank" href="https://deep.besoccer.com/categories/<?= $match['categoryId'] ?>?leagueId=<?= $match['league_id'] ?>">
                            #<span class="td_sort"><?= $match['league_id'] ?></span>
                        </a>
                    </td>
                    <td class="border-right-0 text-left pr-0">
                        <?= $match['team1_name'] ?>
                    </td>
                    <td class="border-left-0 border-right-0 pl-0">
                        <img class="img-fluid" src="https://cdn.resfu.com/img_data/escudos/medium/<?= $match['datateam1'] ?>.jpg?size=30x&lossy=1" alt="">
                    </td>
                    <td class="border-left-0 border-right-0 font-weight-bold">
                        <?= $match['r1'] ?> - <?= $match['r2'] ?>
                    </td>
                    <td class="border-left-0 border-right-0 pr-0">
                        <img class="img-fluid" src="https://cdn.resfu.com/img_data/escudos/medium/<?= $match['datateam2'] ?>.jpg?size=30x&lossy=1" alt="">
                    </td>
                    <td class="border-left-0 text-right pl-0">
                        <?= $match['team2_name'] ?>
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
                    <td class="td_sort"><?= $match['shedule'] ?></td>
                    <td>
                        <form action="/data_info/match_odds?" method="GET" class="mb-0">
                            <input type="hidden" name="matchId" value="<?= $match['id'] ?>"></input>
                            <input type="hidden" name="season" value="<?= $match['season'] ?>"></input>
                            <?php if (isset($match['matches_bets'])) : ?>
                                <button type="submit" class="btn btn-sm border-0 bg-success px-3">
                                    <i class="fa fa-external-link"></i>
                                </button>
                            <?php else : ?>
                                <button type="submit" class="btn btn-sm border-0 bg-warning px-3">
                                    <i class="fa-solid fa-xmark fa-xl"></i>
                                </button>
                            <?php endif; ?>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>

<script>
    // Filtro para ordenar
    const table_rows = document.querySelectorAll('#table_sort tbody tr');
    const table_headings = document.querySelectorAll('.th_sort');

    table_headings.forEach((head, i) => {
        head.onclick = () => {
            table_rows.forEach(row => {
                // filas de la columna clickada
                // console.log(row.querySelectorAll('.td_sort')[i])
            })
            head.classList.toggle('asc', sort_arc);
            var sort_arc = head.classList.contains('asc') ? false : true;
            sortTable(i, sort_arc);
        }
    })

    function sortTable(column, sort_arc) {
        // column número de la columna clickada
        [...table_rows].sort((a, b) => {

            first_row = a.querySelectorAll('.td_sort')[column].textContent.toLowerCase();
            first_row = parseInt(first_row);
            second_row = b.querySelectorAll('.td_sort')[column].textContent.toLowerCase();
            second_row = parseInt(second_row);

            return sort_arc ? (first_row < second_row ? 1 : -1) : (first_row < second_row ? -1 : 1);

        }).map(sorted_row => {
            document.querySelector('#table_sort tbody').appendChild(sorted_row)
        })
    }
</script>