<?php

use BeSoccerSDK\Classes\Show;

$rfId = $_GET['rf_id'] ?? 0;
$gsRfId = $_GET['gs_rf_id'] ?? 0;

// Conditional styles
if (strpos($_SERVER['REQUEST_URI'], "goalserve") === false) {
    $enetpulse  = 'primary';
    $goalserve = 'secondary';
} else {
    $enetpulse  = 'secondary';
    $goalserve = 'primary';
}

if (isset($_POST['gsId'])) {
    $enetpulse  = 'secondary';
    $goalserve = 'primary';
}

// Paginación
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$items_p_page = 150;
// total pages depending on page size items per page convert to Int
if (isset($dataItem['count_equipos'])) {
    $total_pages = intval(ceil($dataItem['count_equipos'] / $items_p_page));
}
?>
<div class="my-4 border border-1 border-opacity-50 py-3 mb-3 rounded">
    <div class="d-flex justify-content-center">
        <?php if (strpos($_SERVER['REQUEST_URI'], "unrelated") === false) : ?>
            <h3 class="h1 text-center my-0">Relación Equipos Fuentes Externas </h3>
        <?php else : ?>
            <h3 class="h1 text-center my-0">Equipos Fuentes Externas no relacionados </h3>
        <? endif; ?>
        <?php if (strpos($_SERVER['REQUEST_URI'], "unrelated") !== false) : ?>
            <div class="d-flex align-items-center position-absolute" style="right: 2rem;">
                <a class="btn btn btn-warning" href="/data_info/teams/">
                    <i class="fa-solid fa-chevron-left"></i>
                    <span class="ml-1">Volver</span>
                </a>
            </div>
        <? endif; ?>
        <?php if ((strpos($_SERVER['REQUEST_URI'], "rf_id") !== false) or (!empty($rf_id))) : ?>
            <div class="d-flex align-items-center position-absolute" style="right: 2rem;">
                <a class="btn btn btn-warning" href="/data_info/teams/">
                    <i class="fa-solid fa-chevron-left"></i>
                    <span class="ml-1">Volver</span>
                </a>
            </div>
        <? endif; ?>
        <?php if ((strpos($_SERVER['REQUEST_URI'], "goalserve") !== false) || (strpos($_SERVER['REQUEST_URI'], "/relate") !== false)) : ?>
            <div class="d-flex align-items-center position-absolute" style="right: 2rem;">
                <a class="btn btn btn-warning" href="/data_info/teams/unrelated">
                    <i class="fa-solid fa-chevron-left"></i>
                    <span class="ml-1">Volver</span>
                </a>
            </div>
        <? endif; ?>
    </div>

    <div class="d-flex justify-content-center flex-wrap flex-md-nowrap py-3">
        <?php if (strpos($_SERVER['REQUEST_URI'], "goalserve") === false) : ?>
            <div class="d-flex justify-content-center align-items-center flex-row p-3 border border-1 border-opacity-50 rounded">
                <form class="form-inline m-0" method="GET" action="/data_info/teams">
                    <input type="text" name="rf_id" placeholder="Team ID RF (EP)" class="form-control mr-2" required />
                    <button type="submit" class="btn border-0 btn-success d-flex align-items-center px-4">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <span class="mx-2">Buscar</span>
                    </button>
                </form>
            </div>
        <? endif; ?>
        <?php if (strpos($_SERVER['REQUEST_URI'], "goalserve") !== false) : ?>
            <div class="d-flex justify-content-center align-items-center flex-row p-3 border border-1 border-opacity-50 rounded">
                <form class="form-inline m-0" method="GET" action="/data_info/teams">
                    <input type="text" name="gs_rf_id" placeholder="Team ID RF (GS)" class="form-control mr-2" required />
                    <input type="hidden" name="goalserve" value="goalserve" class="form-control mr-2" required />
                    <button type="submit" class="btn border-0 btn-success d-flex align-items-center px-4">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <span class="mx-2">Buscar</span>
                    </button>
                </form>
            </div>
        <? endif; ?>
        <?php if (strpos($_SERVER['REQUEST_URI'], "unrelated") === false &&  strpos($_SERVER['REQUEST_URI'], "goalserve") === false) : ?>
            <div class="d-flex align-items-center">
                <a class="btn btn btn-danger ml-4" href="/data_info/teams/unrelated">
                    <i class="fa-solid fa-handshake-slash"></i>
                    <span class="ml-1">No relacionados</span>
                </a>
            </div>
        <? endif; ?>
        <?php if (strpos($_SERVER['REQUEST_URI'], "unrelated") === false &&  strpos($_SERVER['REQUEST_URI'], "goalserve") !== false) : ?>
            <div class="d-flex align-items-center">
                <a class="btn btn btn-danger ml-4" href="/data_info/teams/unrelated?goalserve">
                    <i class="fa-solid fa-handshake-slash"></i>
                    <span class="ml-1">No relacionados</span>
                </a>
            </div>
        <? endif; ?>
    </div>
    <!-- Filtro por Fuentes Externas -->
    <div class="d-flex justify-content-center">
        <?php if ((strpos($_SERVER['REQUEST_URI'], "unrelated") === false)) : ?>
            <div class="d-flex align-items-baseline">
                <a type="submit" href="/data_info/teams" class="btn border-0 btn-<?= $enetpulse ?> d-flex align-items-center px-4 mr-2">
                    <span class="mr-2">ENETPULSE</span>
                    <i class="fa-solid fa-coins"></i>
                </a>
            </div>
            <div class="d-flex align-items-baseline">
                <a type="submit" href="/data_info/teams?goalserve" class="btn border-0 btn-<?= $goalserve ?> d-flex align-items-center px-4 mx-2">
                    <span class="mr-2">GOALSERVE</span>
                    <i class="fa-solid fa-coins"></i>
                </a>
            </div>
        <? endif; ?>
        <?php if ((strpos($_SERVER['REQUEST_URI'], "unrelated") !== false)) : ?>
            <div class="d-flex align-items-baseline">
                <a type="submit" href="/data_info/teams/unrelated" class="btn border-0 btn-<?= $enetpulse ?> d-flex align-items-center px-4 mr-2">
                    <span class="mr-2">ENETPULSE</span>
                    <i class="fa-solid fa-coins"></i>
                </a>
            </div>
            <div class="d-flex align-items-baseline">
                <a type="submit" href="/data_info/teams/unrelated?goalserve" class="btn border-0 btn-<?= $goalserve ?> d-flex align-items-center px-4 mx-2">
                    <span class="mr-2">GOALSERVE</span>
                    <i class="fa-solid fa-coins"></i>
                </a>
            </div>
        <? endif; ?>
    </div>
    <!-- FIN Filtro por Fuentes Externas  -->
</div>
<!-- Tabla de resultados ENET PULSE  -->
<?php if ((strpos($_SERVER['REQUEST_URI'], "goalserve") === false || isset($_POST['rf_id'])) && !isset($_POST['gs_rf_id'])) : ?>
    <section class="section_sort">
        <table class="table table-bordered table-sm border-top-0">
            <thead class="thead-dark">
                <tr class="text-center text-uppercase">
                    <th scope="col" colspan="2" class="th_sort">
                        <span class="float-left pl-2"><i class="fa-solid fa-sort fa-lg"></i></span>
                        <? if (isset($dataItem['relacionados'])) : ?>
                            <i class="fa-solid fa-handshake pr-2"></i>
                            <?= $dataItem['relacionados'] ?>
                        <? endif; ?>
                        <span class="px-4">Nombre Ext EP</span>
                        <? if (isset($dataItem['relacionados'])) : ?>
                            <i class="fa-solid fa-handshake-slash pr-2"></i>
                            <?= $dataItem['no_relacionados'] ?>
                        <? endif; ?>
                    </th>
                    <th scope="col" class="th_sort">
                        <span class="float-left"><i class="fa-solid fa-sort fa-lg"></i></span>Nombre Rf
                    </th>
                    <th scope="col" class="th_sort">
                        <span class="float-left"><i class="fa-solid fa-sort fa-lg"></i></span>Ext EP Id
                    </th>
                    <th scope="col" class="th_sort">
                        <span class="float-left"><i class="fa-solid fa-sort fa-lg"></i></span>Team Id Rf<i class="fa-solid fa-handshake px-2"></i>
                    </th>
                    <th scope="col">Deep</th>
                    <th scope="col" class="th_sort">
                        <span class="float-left"><i class="fa-solid fa-sort fa-lg"></i></span>
                        <? if (isset($dataItem['equipos'][0]['country_name'])) : ?>
                            Country Ext
                        <? else : ?>
                            CC RF
                        <? endif; ?>
                    </th>
                    <th scope="col">Partidos</th>
                </tr>
            </thead>
            <!--  Por si se recarga /relate por error sin datos -->
            <?php if (strpos($_SERVER['REQUEST_URI'], "/relate") !== false && (empty($dataItem['equipos']) && empty($dataItem['equipos_gs']))) : ?>
                <h3 class="text-center text-warning py-4">Vuelve a Pestaña Enetpulse o Goalserve</h3>
                <? die(); ?>
            <? endif; ?>
            <?php if (isset($dataItem['equipos'])) : ?>
                <tbody>
                    <?php foreach ($dataItem['equipos'] as $team) : ?>
                        <tr class="vertical-align">
                            <td class="border-right-0">
                                <? if (!empty($dataItem['rfNames'][$team['rf_id']])) : ?>
                                    <img class="img-fluid" src="https://cdn.resfu.com/img_data/escudos/medium/<?= $team['rf_id'] ?>.jpg?size=30x&lossy=1" alt="">
                                <? endif; ?>
                            </td>
                            <? if (is_numeric($team['name'][0]) || strpos($team['name'], 'Winner') !== false || strpos($team['name'], 'Loser') !== false || strpos($team['name'], '/') !== false) : ?>
                                <td class="text-start text-dark px-4 border-left-0 font-italic td_sort">
                                    <?= $team['name'] . ' (por definir todavía)' ?>
                                </td>
                            <? elseif ($team['rf_id'] === '0' && strpos($_SERVER['REQUEST_URI'], "unrelated") === false) : ?>
                                <td class="text-start text-warning px-4 border-left-0 font-weight-bold td_sort">
                                    <?= $team['name'] ?>
                                </td>
                            <? elseif ($team['rf_id'] === '0' && strpos($_SERVER['REQUEST_URI'], "unrelated") !== false) : ?>
                                <td class="text-start text-dark px-4 border-left-0 font-weight-bold td_sort">
                                    <span class="d-flex">
                                        <p class="align-self-end m-0"><?= $team['name'] ?></p>
                                        <a class="pb-2" target="_blank" href="https://www.google.com/search?q=<?= $team['name'] ?>+soccer+club+<?= $team['country_name'] ?>">
                                            <i class="fa-brands fa-google-plus-g px-2 text-success font-weight-bold"></i>
                                        </a>
                                    </span>
                                </td>
                            <? else : ?>
                                <td class="text-start text-dark px-4 border-left-0 font-weight-bold td_sort">
                                    <?= $team['name'] ?>
                                </td>
                            <? endif; ?>
                            <td class="text-start px-4 td_sort">
                                <? if (isset($dataItem['rfNames'][$team['rf_id']])) : ?>
                                    <?= $dataItem['rfNames'][$team['rf_id']] ?>
                                <? endif; ?>
                                <? if (($team['rf_id'] === '0') && !isset($team['country_name'])) : ?>
                                    <span class="d-flex">
                                        <p class="align-self-center my-0 mr-2 text-center text-muted">Info <i class="fa-solid fa-hand-point-right"></i></p>
                                        <a class="p-1 bg-success rounded" target="_blank" href="https://www.google.com/search?q=<?= $team['name'] ?>+soccer+club">
                                            <i class="fa-brands fa-google-plus-g text-white px-1"></i>
                                        </a>
                                    </span>
                                <? endif; ?>
                            </td>
                            <td class="text-center text-dark px-4 border-left-0 td_sort">
                                <?= $team['id'] ?>
                            </td>
                            <td class="px-0">
                                <form action="/data_info/teams/relate" method="POST" class="d-flex justify-content-center">
                                    <input class="form-control pl-1 mr-2 w-50 td_sort" type="text" name="rf_id" value="<?= $team['rf_id'] ?>" required></input>
                                    <input type="hidden" name="extId" value="<?= $team['id'] ?>"></input>
                                    <button type="submit" class="btn btn-sm bg-dark border-rounded px-2 py-1"><i class="fa fa-edit text-warning"></i></button>
                                </form>
                            </td>
                            <td class="text-center">
                                <a class="btn btn-sm bg-success border-rounded px-2 py-1" target="_blank" href="https://deep.besoccer.com/teams/<?= $team['rf_id'] ?>" role="button">
                                    <i class="fa-solid fa-up-right-from-square"></i>
                                </a>
                            </td>
                            <td class="text-uppercase text-center td_sort">
                                <? if (isset($dataItem['CCs'][$team['rf_id']])) : ?>
                                    <?= $dataItem['CCs'][$team['rf_id']] ?>
                                <? endif; ?>
                                <? if (isset($team['country_name'])) : ?>
                                    <?= $team['country_name'] ?>
                                <? endif; ?>
                            </td>
                            <td class="text-center">
                                <? if (empty($team['rf_id'])) : ?>
                                    <form action="/data_info/matches/unrelated?extId=<?= $team['id'] ?>" method="GET">
                                        <input type="hidden" name="extId" value="<?= $team['id'] ?>"></input>
                                        <button type="submit" class="btn btn-sm btn-warning border-0 px-3">
                                            <span>Partidos</span>
                                            <i class="fa-solid fa-sm fa-handshake-slash"></i>
                                        </button>
                                    </form>
                                <? else : ?>
                                    <form action="/data_info/matches?rf_id=<?= $team['rf_id'] ?>" method="GET">
                                        <input type="hidden" name="rf_id" value="<?= $team['rf_id'] ?>"></input>
                                        <button type="submit" class="btn btn-sm btn-success border-0 px-3">
                                            <span>Partidos</span>
                                            <i class="fa-solid fa-arrow-right-to-bracket"></i>
                                        </button>
                                    </form>
                                <? endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            <? endif; ?>
        </table>
        <?php if (isset($dataItem['count_equipos'])) : ?>
            <div class="d-flex justify-content-center my-3">
                <nav aria-label="Page_navigation">
                    <ul class="pagination">
                        <?php if ($page !== 1) : ?>
                            <li class="page-item"><a class="page-link" href="http://localhost:5441/data_info/teams"><i class="fa-solid fa-backward-fast"></i></a></li>
                            <li class="page-item"><a class="page-link" href="http://localhost:5441/data_info/teams?page=<?= $page - 1 ?>"><i class="fa-solid fa-backward-step"></i></a></li>
                        <? endif; ?>
                        <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                            <?php if ($i == $page) : ?>
                                <li class="page-item"><a class="page-link"><strong><?= $i ?></strong></a></li>
                            <?php elseif ($i % 2 === 0) : ?>
                                <li class="page-item"><a class="page-link" href="http://localhost:5441/data_info/teams?page=<?= $i ?>"><?= $i ?></a></li>
                            <? endif; ?>
                        <? endfor; ?>
                        <?php if ($page !== $total_pages) : ?>
                            <li class="page-item"><a class="page-link" href="http://localhost:5441/data_info/teams?page=<?= $page + 1 ?>"><i class="fa-solid fa-forward-step"></i></a></li>
                            <li class="page-item"><a class="page-link" href="http://localhost:5441/data_info/teams?page=<?= $total_pages ?>"><i class="fa-solid fa-forward-fast"></i></a></li>
                        <? endif; ?>
                    </ul>
                </nav>
            </div>
        <? endif; ?>
    </section>
<? endif; ?>
<!-- Tabla de resultados GOAL SERVE -->
<?php if ((strpos($_SERVER['REQUEST_URI'], "goalserve") !== false) || isset($_POST['gs_rf_id']) && !isset($_POST['rf_id'])) : ?>
    <section class="section_sort">
        <table class="table table-bordered table-sm border-top-0">
            <thead class="thead-dark">
                <tr class="text-center text-uppercase">
                    <th scope="col" colspan="2" class="th_sort">
                        <span class="float-left pl-2"><i class="fa-solid fa-sort fa-lg"></i></span>
                        <? if (isset($dataItem['relacionados_gs'])) : ?>
                            <i class="fa-solid fa-handshake px-2"></i>
                            <?= $dataItem['relacionados_gs'] ?>
                        <? endif; ?>
                        <span class="px-4">Nombre Ext GS</span>
                        <? if (isset($dataItem['no_relacionados_gs'])) : ?>
                            <i class="fa-solid fa-handshake-slash px-2"></i>
                            <?= $dataItem['no_relacionados_gs'] ?>
                        <? endif; ?>
                    </th>
                    <th scope="col" class="th_sort">
                        <span class="float-left pl-2"><i class="fa-solid fa-sort fa-lg"></i></span>Nombre Rf
                    </th>
                    <th scope="col" class="th_sort">
                        <span class="float-left pl-2"><i class="fa-solid fa-sort fa-lg"></i></span>Ext GS Id
                    </th>
                    <th scope="col" class="th_sort">
                        <span class="float-left pl-2"><i class="fa-solid fa-sort fa-lg"></i></span>Team Id Rf<i class="fa-solid fa-handshake px-2"></i>
                    </th>
                    <th scope="col">Deep</th>
                    <th scope="col" class="th_sort">
                        <span class="float-left pl-2"><i class="fa-solid fa-sort fa-lg"></i></span>
                        <? if (isset($dataItem['equipos'][0]['country_name'])) : ?>
                            Country Ext
                        <? else : ?>
                            CC RF
                        <? endif; ?>
                    </th>
                    <th scope="col">Partidos</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dataItem['equipos_gs'] as $team) : ?>
                    <tr class="vertical-align">
                        <td class=" border-right-0">
                            <? if (!empty($dataItem['rfNames'][$team['gs_rf_id']])) : ?>
                                <img class="img-fluid" src="https://cdn.resfu.com/img_data/escudos/medium/<?= $team['gs_rf_id'] ?>.jpg?size=30x&lossy=1" alt="">
                            <? endif; ?>
                        </td>
                        <td class="text-start text-dark px-4 border-left-0 font-weight-bold td_sort">
                            <?= $team['gs_name'] ?>
                        </td>
                        <td class="text-start px-4 td_sort">
                            <? if (isset($dataItem['rfNames'][$team['gs_rf_id']])) : ?>
                                <?= $dataItem['rfNames'][$team['gs_rf_id']] ?>
                            <? endif; ?>
                            <? if (($team['gs_rf_id'] === '0') && !isset($team['gs_country_name'])) : ?>
                                <span class="d-flex">
                                    <p class="align-self-center my-0 mr-2 text-muted">Info <i class="fa-solid fa-hand-point-right"></i></p>
                                    <a class="p-1 bg-success rounded" target="_blank" href="https://www.google.com/search?q=<?= $team['gs_name'] ?>+soccer+club">
                                        <i class="fa-brands fa-google-plus-g text-white px-1"></i>
                                    </a>
                                </span>
                            <? endif; ?>
                        </td>
                        <td class="text-center text-dark px-4 border-left-0 td_sort">
                            <?= $team['gs_unique_Id'] ?>
                        </td>
                        <td class="px-0">
                            <form action="/data_info/teams/relate" method="POST" class="d-flex justify-content-center">
                                <input class="form-control pl-1 mr-2 w-50 td_sort" type="text" name="gs_rf_id" value="<?= $team['gs_rf_id'] ?>" required></input>
                                <input type="hidden" name="gsId" value="<?= $team['gs_unique_Id'] ?>"></input>
                                <button type="submit" class="btn btn-sm bg-dark border-rounded px-2 py-1"><i class="fa fa-edit text-warning"></i></button>
                            </form>
                        </td>
                        <td class="text-center">
                            <a class="btn btn-sm bg-success border-rounded px-2 py-1" target="_blank" href="https://deep.besoccer.com/teams/<?= $team['gs_rf_id'] ?>" role="button">
                                <i class="fa-solid fa-up-right-from-square"></i>
                            </a>
                        </td>
                        <td class="text-uppercase text-center td_sort">
                            <? if (isset($dataItem['CCs'][$team['gs_rf_id']])) : ?>
                                <?= $dataItem['CCs'][$team['gs_rf_id']] ?>
                            <? endif; ?>
                            <? if (isset($team['gs_country_name'])) : ?>
                                <?= $team['gs_country_name'] ?>
                            <? endif; ?>
                        </td>
                        <td class="text-center td_sort">
                            <? if (!empty($team['gs_rf_id'])) : ?>
                                <form action="/data_info/matches?rf_id=<?= $team['gs_rf_id'] ?>" method="GET">
                                    <input type="hidden" name="rf_id" value="<?= $team['gs_rf_id'] ?>"></input>
                                    <button type="submit" class="btn btn-sm btn-success border-0 px-3">
                                        <span>Partidos</span>
                                        <i class="fa-solid fa-arrow-right-to-bracket"></i>
                                    </button>
                                </form>
                            <? endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php if (isset($dataItem['count_equipos'])) : ?>
            <div class="d-flex justify-content-center my-3">
                <nav aria-label="Page_navigation">
                    <ul class="pagination">
                        <?php if ($page !== 1) : ?>
                            <li class="page-item"><a class="page-link" href="http://localhost:5441/data_info/teams?goalserve"><i class="fa-solid fa-backward-fast"></i></a></li>
                            <li class="page-item"><a class="page-link" href="http://localhost:5441/data_info/teams?goalserve&page=<?= $page - 1 ?>"><i class="fa-solid fa-backward-step"></i></a></li>
                        <? endif; ?>
                        <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                            <?php if ($i == $page) : ?>
                                <li class="page-item"><a class="page-link"><strong><?= $i ?></strong></a></li>
                            <?php elseif ($i % 2 === 0) : ?>
                                <li class="page-item"><a class="page-link" href="http://localhost:5441/data_info/teams?goalserve&page=<?= $i ?>"><?= $i ?></a></li>
                            <? endif; ?>
                        <? endfor; ?>
                        <?php if ($page !== $total_pages) : ?>
                            <li class="page-item"><a class="page-link" href="http://localhost:5441/data_info/teams?goalserve&page=<?= $page + 1 ?>"><i class="fa-solid fa-forward-step"></i></a></li>
                            <li class="page-item"><a class="page-link" href="http://localhost:5441/data_info/teams?goalserve&page=<?= $total_pages ?>"><i class="fa-solid fa-forward-fast"></i></a></li>
                        <? endif; ?>
                    </ul>
                </nav>
            </div>
        <? endif; ?>
    </section>
<?php endif ?>
<?php if (strpos($_SERVER['REQUEST_URI'], "unrelated") !== false && strpos($_SERVER['REQUEST_URI'], "goalserve") === false && empty($dataItem['equipos'])) : ?>
    <div class="text-center mt-4">
        <h3>Todos los equipos de Enetpulse están relacionados</h3>
    </div>
<?php endif ?>
<?php if (strpos($_SERVER['REQUEST_URI'], "unrelated") !== false && strpos($_SERVER['REQUEST_URI'], "goalserve") !== false && empty($dataItem['equipos'])) : ?>
    <div class="text-center mt-4">
        <h3>Todos los equipos de Enetpulse están relacionados</h3>
    </div>
<?php endif ?>
<?php if (!empty($rfId) && empty($dataItem['equipos'])) : ?>
    <div class="text-center mt-4">
        <h3>El equipo no existe o no está relacionado en Enetpulse</h3>
    </div>
<?php endif ?>
<?php if (!empty($gsRfId) && empty($dataItem['equipos_gs'])) : ?>
    <div class="text-center mt-4">
        <h3>El equipo no existe o no está relacionado en Goalserve</h3>
    </div>
<?php endif ?>


<script>
    const table_rows = document.querySelectorAll('.section_sort table tbody tr');
    const table_headings = document.querySelectorAll('.th_sort');

    console.log(table_rows);

    function searchTable() {
        // i número de la columna clickada
        table_rows.forEach((row, i) => {
            let table_data = row.textContent.toLowerCase();
        })
    }
    table_headings.forEach((head, i) => {

        head.onclick = () => {
            table_rows.forEach(row => {
                // filas de la columna clickada
                console.log(row.querySelectorAll('.td_sort')[i]);
            })
            head.classList.toggle('asc', sort_arc);
            var sort_arc = head.classList.contains('asc') ? false : true;
            sortTable(i, sort_arc);
        }
    })

    function sortTable(column, sort_arc) {
        // column número de la columna clickada
        [...table_rows].sort((a, b) => {

            let first_row = a.querySelectorAll('.td_sort')[column].textContent.toLowerCase();
            let second_row = b.querySelectorAll('.td_sort')[column].textContent.toLowerCase();

            // si es Ext Ep hay que convertirlo a Int
            if (column === 2) {
                first_row = parseInt(first_row);
                second_row = parseInt(second_row);
            }
            // Si es input tenemos que coger el value no el textContent, y convertirlo a Int
            if (typeof a.querySelectorAll('.td_sort')[column].value !== 'undefined') {
                first_row = a.querySelectorAll('.td_sort')[column].value
                first_row = parseInt(first_row);
                second_row = b.querySelectorAll('.td_sort')[column].value
                second_row = parseInt(second_row);
            }
            return sort_arc ? (first_row < second_row ? 1 : -1) : (first_row < second_row ? -1 : 1);

        }).map(sorted_row => {
            document.querySelector('.section_sort table tbody').appendChild(sorted_row)
        })
    }
</script>