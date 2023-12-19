<?php

$rfId = $_GET['rfId'] ?? 0;

?>

<div class="my-4 border border-1 border-opacity-50 pt-3 mb-3 rounded">
    <div class="d-flex justify-content-center">
        <h3 class="h1 text-center">Relación Equipos Football Data</h3>
        <?php if (strpos($_SERVER['REQUEST_URI'], "unrelated") !== false) : ?>
            <div class="d-flex align-items-center position-absolute" style="right: 2rem;">
                <a class="btn btn btn-warning" href="/football_data/teams/">
                    <i class="fa-solid fa-chevron-left"></i>
                    <span class="ml-1">Volver</span>
                </a>
            </div>
        <? endif; ?>

        <?php if ((strpos($_SERVER['REQUEST_URI'], "rfId") !== false) or (!empty($rfId))) : ?>
            <div class="d-flex align-items-center position-absolute" style="right: 2rem;">
                <a class="btn btn btn-warning" href="/football_data/teams/">
                    <i class="fa-solid fa-chevron-left"></i>
                    <span class="ml-1">Volver</span>
                </a>
            </div>
        <? endif; ?>
    </div>
    <form class="form-inline d-flex justify-content-center pt-3" method="GET" action="/football_data/teams">
        <div class="d-flex justify-content-around mb-3">
            <div class="d-flex mr-4">
                <input type="text" name="rfId" placeholder="Team ID RF" class="form-control mx-2" required />
                <button type="submit" class="btn border-0 btn-success d-flex align-items-center px-4">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <span class="mx-2">Buscar</span>
                </button>
            </div>
            <?php if (strpos($_SERVER['REQUEST_URI'], "unrelated") === false) : ?>
                <div>
                    <a class="btn btn btn-danger" href="/football_data/teams/unrelated">
                        <i class="fa-solid fa-handshake-slash"></i>
                        <span class="ml-1">No relacionados</span>
                    </a>
                </div>
            <? endif; ?>
        </div>
    </form>
    <? if (isset($dataItem['relacionados'])) : ?>
        <div class="d-flex justyfy-content-start">
            <div class="text-center bg-dark p-2 font-weight-light mr-2">
                Relacionados
                <i class="fa-solid fa-handshake px-2"></i>
                <?= $dataItem['relacionados'] ?>
            </div>
            <div class="text-center bg-dark p-2 font-weight-light">
                No Relacionados
                <i class="fa-solid fa-handshake-slash px-2"></i>
                <?= $dataItem['no_relacionados'] ?>
            </div>
        </div>
    <? endif; ?>
</div>
<table class="table table-bordered   table-sm">
    <thead class="thead-dark">
        <tr class="text-center text-uppercase">
            <th scope="col" colspan="2">Nombre Ext</th>
            <th scope="col">Nombre Rf</th>
            <th scope="col">Team Id RF <i class="fa-solid fa-handshake px-2"></i></th>
            <th scope="col">Deep</th>
            <th scope="col">CC FD</th>
            <th scope="col">Partidos</th>
        </tr>
    </thead>
    <tbody>
        <?php //filtro por nombre, por rfid, por los no relacionados.  resumen o contaje de items relacionados
        foreach ($dataItem['equipos'] as $team) : ?>
            <tr class="vertical-align">
                <td class=" border-right-0">
                    <img class="img-fluid" src="https://cdn.resfu.com/img_data/escudos/medium/<?= $team['rfId'] ?>.jpg?size=30x&lossy=1" alt="">
                </td>
                <td class="text-start text-dark text-opacity-75 px-4 border-left-0 font-weight-bold">
                    <?= $team['nombre'] ?>
                </td>
                <td class="text-start px-4">
                    <? if (isset($dataItem['rfNames'][$team['rfId']])) : ?>
                        <?= $dataItem['rfNames'][$team['rfId']] ?>
                    <? endif; ?>
                </td>
                <td class="px-0">
                    <form action="/football_data/teams/relate" method="POST" class="d-flex justify-content-center">
                        <input class="form-control pl-1 mr-2 w-50" type="text" name="rfId" value="<?= $team['rfId'] ?>" required></input>
                        <input type="hidden" name="teamId" value="<?= $team['id'] ?>"></input>
                        <button type="submit" class="btn btn-sm bg-dark border-rounded px-2 py-1"><i class="fa fa-edit text-warning"></i></button>
                    </form>
                </td>
                <td class="text-center">
                    <a class="btn btn-sm bg-success border-rounded px-2 py-1" target="_blank" href="https://deep.besoccer.com/teams/<?= $team['rfId'] ?>" role="button">
                        <i class="fa-solid fa-up-right-from-square"></i>
                    </a>
                </td>
                <td class="text-uppercase text-center"><?= $team['CountryCode'] ?></td>
                <td class="text-center">
                    <form action="/football_data/matches?teamId=<?= $team['rfId'] ?>" method="GET">
                        <input type="hidden" name="teamId" value="<?= $team['rfId'] ?>"></input>
                        <button type="submit" class="btn btn-sm btn-success border-0 px-3">
                            <span>
                                Partidos
                            </span>
                            <i class="fa-solid fa-arrow-right-to-bracket"></i>
                        </button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php if ((strpos($_SERVER['REQUEST_URI'], "unrelated") !== false) && (count($dataItem['equipos']) === 0)) : ?>
    <div class="text-center mt-4">
        <h3>Todos los equipos están relacionados</h3>
        <?php

        ?>
    </div>
<?php endif ?>
<?php if (!empty($rfId) && (count($dataItem['equipos']) === 0)) : ?>
    <div class="text-center mt-4">
        <h3>El equipo no existe o no está relacionado</h3>
        <?php

        ?>
    </div>
<?php endif ?>