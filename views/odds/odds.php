<?php

$matchId = $_GET['match_id'] ?? 0;

$previous = "javascript:history.go(-1)";
if (isset($_SERVER['HTTP_REFERER'])) {
    $previous = $_SERVER['HTTP_REFERER'];
}

?>
<div class="my-4 px-2 border border-1 border-opacity-50 py-3 rounded">
    <div class="d-flex align-items-center justify-content-center">
        <div class="d-flex justify-content-center align-items-center">
            <h3 class="h1 m-0 text-center">Apuestas Football Data</h3>
        </div>
        <div class="d-flex align-items-center position-absolute" style="right: 2rem;">
            <a class="btn btn btn-warning" href="<?= $previous ?>">
                <i class="fa-solid fa-chevron-left"></i>
                <span class="ml-1">Volver</span>
            </a>
        </div>
    </div>
</div>

<table class="table table-bordered   table-sm mt-4 mb-5">
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
        <?php foreach ($dataItem['odds'] as $match) : ?>
            <tr>
                <td class="font-weight-bold">
                    <a class="text-success font-weight-bold" target="_blank" href="https://es.besoccer.com/partido/<?= $match['home'] ?>/<?= $match['away'] ?>/<?= $match['season'] ?><?= $match['match_id'] ?>">
                        #<?= $match['match_id'] ?>
                    </a>
                </td>
                <td><?= $match['date'] ?></td>
                <td class="font-weight-bold">
                    <a class="text-success" target="_blank" href="https://deep.besoccer.com/categories/<?= $match['category_id'] ?>?leagueId=<?= $match['league_id'] ?>">
                        #<?= $match['league_id'] ?>
                    </a>
                </td>
                <td><?= $match['season'] ?></td>
                <td class="border-right-0">
                    <img src="https://cdn.resfu.com/img_data/escudos/medium/<?= $match['dt1'] ?>.jpg?size=30x&lossy=1" alt="<?= $match['home'] ?>">
                </td>
                <td class="border-right-0 border-left-0">
                    <?= $match['home'] ?>
                </td>
                <td class="border-right-0 border-left-0 font-weight-bold">
                    <?= $match['r1'] ?> - <?= $match['r2'] ?>
                </td>
                <td class="border-right-0 border-left-0">
                    <?= $match['away'] ?>
                </td>
                <td class="border-left-0" class="pr-2">
                    <img src="https://cdn.resfu.com/img_data/escudos/medium/<?= $match['dt2'] ?>.jpg?size=30x&lossy=1" alt="<?= $match['away'] ?>">
                </td>
                <td class="font-weight-bold"><?= ucfirst($match['result']) ?></td>
            </tr>
        <?php break;
        endforeach; ?>
    </tbody>
</table>
<table class="table table-bordered   table-sm">
    <thead class="thead-dark">
        <tr class="text-center">
            <th scope="col">Provider</th>
            <th scope="col" data-toggle="tooltip" title="Precio gana equipo de casa" class="bg-secondary" >odd_1</th>
            <th scope="col" data-toggle="tooltip" title="Precio empate" class="bg-secondary">odd_x</th>
            <th scope="col" data-toggle="tooltip" title="Precio gana equipo de fuera" class="bg-secondary">odd_2</th>
            <th scope="col" data-toggle="tooltip" title="Probabilidad gana equipo de casa">prob1</th>
            <th scope="col" data-toggle="tooltip" title="Probabilidad empate">probx</th>
            <th scope="col" data-toggle="tooltip" title="Probabilidad gana equipo de fuera">prob2</th>
            <th scope="col" data-toggle="tooltip" title="Total probabilidad">prob_total</th>
            <th scope="col" data-toggle="tooltip" title="Probabilidad gana equipo de casa" class="bg-secondary">prob_n1</th>
            <th scope="col" data-toggle="tooltip" title="Probabilidad empate" class="bg-secondary">prob_nx</th>
            <th scope="col" data-toggle="tooltip" title="Probabilidad gana equipo de fuera" class="bg-secondary">prob_n2</th>
            <th scope="col" data-toggle="tooltip" title="Total Probabilidad sobre 100" class="bg-secondary">prob_total_n</th>
            <th scope="col" data-toggle="tooltip" title="Probabilidad resultado correcto">prob_ok</th>
            <th scope="col" data-toggle="tooltip" title="Prob correcta sobre 100">prob_ok_n</th>
        </tr>
    </thead>
    <tbody class="text-center">
        <?php foreach ($dataItem['odds'] as $match) : ?>
            <tr>
                <td class="font-weight-bold">
                    <?= strtoupper($match['provider']) ?>
                </td>
                <td><?= $match['odd_1'] ?></td>
                <td><?= $match['odd_x'] ?></td>
                <td><?= $match['odd_2'] ?></td>
                <td><?= round($match['prob1'] * 100, 2) . '%'; ?></td>
                <td><?= round($match['probx'] * 100, 2) . '%'; ?></td>
                <td><?= round($match['prob2'] * 100, 2) . '%'; ?></td>
                <td class="font-weight-bold"><?= round($match['prob_total'] * 100, 2) . '%'; ?></td>
                <td><?= round($match['prob_n1'] * 100, 2) . '%'; ?></td>
                <td><?= round($match['prob_nx'] * 100, 2) . '%'; ?></td>
                <td><?= round($match['prob_n2'] * 100, 2) . '%'; ?></td>
                <td class="font-weight-bold"><?= round($match['prob_total_n'] * 100, 2) . '%'; ?></td>
                <td><?= round($match['prob_ok'] * 100, 2) . '%'; ?></td>
                <td><?= round($match['prob_ok_n'] * 100, 2) . '%'; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<div class='pt-3 px-4 d-flex flex-wrap justify-content-around rounded-2'>
    <p>B365 = <strong>Bet365</strong></p>
    <p>BW = <strong>Bet&Win</strong></p>
    <p>IW = <strong>Interwetten</strong></p>
    <p>WH = <strong>William Hill</strong></p>
    <p>PS = <strong>Pinnacle</strong></p>
    <p>VC = <strong>VC Bet</strong></p>
</div>
<!-- Script para los tooltip explicativos de las cabeceras de la tabla-->
<script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>