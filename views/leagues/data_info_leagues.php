<?php
// Paginación

use BeSoccerSDK\Classes\Show;

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$items_p_page = 150;
// total pages depending on page size items per page convert to Int

Show::dd($dataItem['count_leagues']);
if (isset($dataItem['count_leagues'])) {
    $total_pages = intval(ceil($dataItem['count_leagues'] / $items_p_page));
}
?>
<!-- Buscador de categorias -->
<div class="my-4 border border-1 border-opacity-50 py-3 rounded">
    <div class="d-flex justify-content-center">
        <h3 class="h1 text-center">Competiciones Relacionadas</h3>
        <?php if (strpos($_SERVER['REQUEST_URI'], "categoryId") === false && strpos($_SERVER['REQUEST_URI'], "relate") === false) : ?>
            <div class="d-flex align-items-baseline position-absolute" style="right: 2rem;">
                <a class="btn btn btn-warning" href="/">
                    <i class="fa-solid fa-home"></i>
                </a>
            </div>
        <?php endif ?>
        <?php if (strpos($_SERVER['REQUEST_URI'], "categoryId") !== false) : ?>
            <div class="d-flex align-items-baseline position-absolute" style="right: 2rem;">
                <a class="btn btn btn-warning" href="/data_info/leagues">
                    <i class="fa-solid fa-chevron-left"></i>
                    <span class="ml-1">Volver</span>
                </a>
            </div>
        <?php endif ?>
        <?php
        if (strpos($_SERVER['REQUEST_URI'], "relate") !== false) : ?>
            <div class="d-flex align-items-baseline position-absolute" style="right: 2rem;">
                <a class="btn btn btn-warning" href="/data_info/leagues">
                    <i class="fa-solid fa-chevron-left"></i>
                    <span class="ml-1">Volver</span>
                </a>
            </div>
        <?php endif ?>
    </div>
    <div class="mt-2 d-flex justify-content-center align-items-center">
        <form class="form-inline m-0" method="GET" action="/data_info/leagues">
            <input type="text" name="categoryId" placeholder="RF ID (category)" class="form-control mx-2" required />
            <button type="submit" class="btn border-0 btn-success d-flex align-items-center px-4 mr-2">
                <i class="fa-solid fa-magnifying-glass"></i>
                <span class="mx-2">Buscar</span>
            </button>
        </form>
        <div>
            <a class="btn btn btn-danger" href="/data_info/leagues/unrelated">
                <i class="fa-solid fa-handshake-slash"></i>
                <span class="ml-1">No relacionadas</span>
            </a>
        </div>
    </div>
</div>
<!-- FIN Buscador de categorias -->
<!-- Tabla de resultados (categorías Rf relacionadas con fuentes externas) -->
<table id="table_sort" class="table table-bordered table-sm">
    <thead class="thead-dark">
        <tr class="text-center align-middle text-uppercase">
            <th scope="col"><span class="float-left pr-2"><i class="fa-solid fa-sort fa-lg"></i></span>RF ID
            </th>
            <th scope="col" colspan="3"><span class="float-left"><i class="fa-solid fa-sort fa-lg"></i></span>Nombre GS
            </th>
            <th scope="col"><span class="float-left"><i class="fa-solid fa-sort fa-lg"></i></span>Name EP
            </th>
            <th scope="col"><span class="float-left"><i class="fa-solid fa-sort fa-lg"></i></span>Ext Name EP
                <i class="fa-solid fa-screwdriver-wrench"></i>
            </th>
            <th scope="col"><span class="float-left"><i class="fa-solid fa-sort fa-lg"></i></span>EP ID
                <i class="fa-solid fa-screwdriver-wrench"></i>
            </th>
            <th scope="col"><span class="float-left"><i class="fa-solid fa-sort fa-lg"></i></span>GS ID
                <i class="fa-solid fa-screwdriver-wrench"></i>
            </th>
            <th scope="col"><span class="float-left"><i class="fa-solid fa-sort fa-lg"></i></span>FD ID
                <i class="fa-solid fa-screwdriver-wrench"></i>
            </th>
        </tr>
    </thead>
    <tbody class="text-center">
        <?php foreach ($dataItem as $league) : ?>
            <tr class="align-middle">
                <td class="font-weight-bold">
                    <?php if (isset($league['gs_id_rf'])) : ?>
                        <a class="text-success font-weight-bold" target="_blank" href="https://deep.besoccer.com/categories/<?= $league['gs_id_rf'] ?>">
                            #<span class="td_sort"><?= $league['gs_id_rf'] ?></span>
                        <?php endif; ?>
                </td>
                <td class="border-right-0 px-1">
                    <?php if (isset($league['gs_countryCode'])) : ?>
                        <?= strtoupper($league['gs_countryCode']) ?>
                    <?php endif; ?>
                </td>
                <td class="border-left-0 border-right-0 px-1">
                    <img src="https://cdn.resfu.com/media/img/flags/round/<?= $league['gs_countryCode'] ?>.png?size=30" alt="">
                </td>
                <td class="text-left pl-2 pr-0 border-left-0 font-weight-bold td_sort">
                    <?= $league['gs_name'] ?>
                </td>
                <td class="text-left pl-2 pr-0 td_sort">
                    <?php if (isset($league['bets_ep_name'])) : ?>
                        <?= $league['bets_ep_name'] ?>
                    <?php endif; ?>
                </td>
                <td class="td_sort" style="min-width: 400px !important;">
                    <?php if (isset($league['ep_unique_id'])) : ?>
                        <form action="/data_info/leagues/relate" method="POST" class="d-flex justify-content-center">
                            <input class="form-control pl-2 mr-2 w-100" type="text" name="nameExtEp" value="<?= $league['bets_ep_name_ext'] ?>"></input>
                            <input type="hidden" name="idRf" value="<?= $league['gs_id_rf'] ?>"></input>
                            <button type="submit" class="btn btn-sm bg-dark border-rounded px-2"><i class="fa fa-edit text-warning"></i></button>
                        </form>
                    <?php endif; ?>
                </td>
                <td class="px-0 td_sort">
                    <?php if (isset($league['ep_unique_id'])) : ?>
                        <form action="/data_info/leagues/relate" method="POST" class="d-flex justify-content-center">
                            <input class="form-control pl-2 mr-2 w-50" type="text" name="epId" value="<?= $league['ep_unique_id'] ?>"></input>
                            <input type="hidden" name="idRf" value="<?= $league['ep_id_rf'] ?>"></input>
                            <button type="submit" class="btn btn-sm bg-dark border-rounded px-2"><i class="fa fa-edit text-warning"></i></button>
                        </form>
                    <?php endif; ?>
                </td>
                <td class="px-0 td_sort">
                    <?php if (isset($league['gs_unique_id'])) : ?>
                        <form action="/data_info/leagues/relate" method="POST" class="d-flex justify-content-center">
                            <input class="form-control pl-2 mr-2 w-50" type="text" name="gsId" value="<?= $league['gs_unique_id'] ?>"></input>
                            <input type="hidden" name="idRf" value="<?= $league['gs_id_rf'] ?>"></input>
                            <button type="submit" class="btn btn-sm bg-dark border-rounded px-2"><i class="fa fa-edit text-warning"></i></button>
                        </form>
                    <?php endif; ?>
                </td>
                <td class="px-0 td_sort">
                    <?php if (isset($league['fd_unique_id'])) : ?>
                        <form action="/data_info/leagues/relate" method="POST" class="d-flex justify-content-center td_sort">
                            <input class="form-control pl-2 mr-2 w-50" type="text" name="fdId" value="<?= $league['fd_unique_id'] ?>"></input>
                            <input type="hidden" name="idRf" value="<?= $league['fd_id_rf'] ?>"></input>
                            <button type="submit" class="btn btn-sm bg-dark border-rounded px-2"><i class="fa fa-edit text-warning"></i></button>
                        </form>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php if (isset($dataItem['count_leagues'])) : ?>
    <div class="d-flex justify-content-center my-3">
        <nav aria-label="Page_navigation">
            <ul class="pagination">
                <?php if ($page !== 1) : ?>
                    <li class="page-item"><a class="page-link" href="http://localhost:5441/data_info/leagues"><i class="fa-solid fa-backward-fast"></i></a></li>
                    <li class="page-item"><a class="page-link" href="http://localhost:5441/data_info/leagues?page=<?= $page - 1 ?>"><i class="fa-solid fa-backward-step"></i></a></li>
                <? endif; ?>
                <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                    <?php if ($i == $page) : ?>
                        <li class="page-item"><a class="page-link"><strong><?= $i ?></strong></a></li>
                    <?php elseif ($i % 2 === 0) : ?>
                        <li class="page-item"><a class="page-link" href="http://localhost:5441/data_info/leagues?page=<?= $i ?>"><?= $i ?></a></li>
                    <? endif; ?>
                <? endfor; ?>
                <?php if ($page !== $total_pages) : ?>
                    <li class="page-item"><a class="page-link" href="http://localhost:5441/data_info/leagues?page=<?= $page + 1 ?>"><i class="fa-solid fa-forward-step"></i></a></li>
                    <li class="page-item"><a class="page-link" href="http://localhost:5441/data_info/leagues?page=<?= $total_pages ?>"><i class="fa-solid fa-forward-fast"></i></a></li>
                <? endif; ?>
            </ul>
        </nav>
    </div>
<? endif; ?>
<?php
if ((strpos($_SERVER['REQUEST_URI'], "categoryId") !== false) && (empty($_GET['categoryId']))) : ?>
    <div class="text-center mt-4">
        <h3>Introduce una RF ID</h3>
    </div>
<?php endif ?>
<?php
if ((strpos($_SERVER['REQUEST_URI'], "categoryId") !== false) && (count($dataItem) === 0) && (!empty($_GET['categoryId']))) : ?>
    <div class="text-center mt-4">
        <h3>La categoría no está relacionada o no existe en BD Fútbol</h3>
    </div>
<?php endif ?>

<script>
    // Filtro para ordenar
    const table_rows = document.querySelectorAll('#table_sort tbody tr');
    const table_headings = document.querySelectorAll('th');

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

            var first_row = a.querySelectorAll('.td_sort')[column];
            var second_row = b.querySelectorAll('.td_sort')[column];

            // si es Id hay que convertirlo a Int
            if (column === 0) {
                first_row = a.querySelectorAll('.td_sort')[column].value;
                first_row = parseInt(first_row);
                second_row = b.querySelectorAll('.td_sort')[column].value;
                second_row = parseInt(second_row);
            }
            if (column === 1 || column === 2) {
                first_row = a.querySelectorAll('.td_sort')[column].textContent.toLowerCase();
                second_row = b.querySelectorAll('.td_sort')[column].textContent.toLowerCase();

            }
            if (column === 3 || column === 4 || column === 5 || column === 6) {
                if (typeof a.querySelectorAll('.td_sort')[column].getElementsByTagName('input')[0] === 'undefined') {
                    var p = a.querySelectorAll('.td_sort')[column];
                    p = document.createElement('input');
                    p.value = 0
                    first_row = p.value;
                } else {
                    first_row = a.querySelectorAll('.td_sort')[column].getElementsByTagName('input')[0].value;
                }
                if (typeof b.querySelectorAll('.td_sort')[column].getElementsByTagName('input')[0] === 'undefined') {
                    var p = b.querySelectorAll('.td_sort')[column];
                    p = document.createElement('input');
                    p.value = 0
                    second_row = p.value;
                } else {
                    second_row = b.querySelectorAll('.td_sort')[column].getElementsByTagName('input')[0].value;
                }
                if (column !== 3) {
                    first_row = parseInt(first_row);
                    second_row = parseInt(second_row);
                }
            }
            if (first_row === second_row) {
                return -1;
            }

            return sort_arc ? (first_row < second_row ? 1 : -1) : (first_row < second_row ? -1 : 1);

        }).map(sorted_row => {
            document.querySelector('#table_sort tbody').appendChild(sorted_row)
        })
    }
</script>