<div class="my-4 border border-1 border-opacity-50 py-3 mb-3 rounded">
    <h3 class="h1 text-center">Ligas por año relacionadas (Football Data)</h3>
    <div class="d-flex justify-content-center align-items-baseline mt-3">
        <form class="form-inline" method="GET" action="/football_data/leagues">
            <div class="d-flex justify-content-around align-items-center">
                <input type="text" name="categoryId" placeholder="Category ID" class="form-control mx-2" required />
                <button type="submit" class="btn border-0 btn-success d-flex align-items-center px-4">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <span class="mx-2">Buscar</span>
                </button>
            </div>
        </form>
        <form class="form-inline" method="GET" action="/football_data/leagues">
            <div class="d-flex">
                <input type="text" name="leagueId" placeholder="League ID" class="form-control mx-2" required />
                <button type="submit" class="btn border-0 btn-success d-flex align-items-center px-4">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <span class="mx-2">Buscar</span>
                </button>
            </div>
        </form>
    </div>
</div>
<table class="table table-bordered   table-sm">
    <thead class="thead-dark">
        <tr class="text-center align-middle text-uppercase">
            <th scope="col" colspan="3">Nombre</th>
            <th scope="col">League ID</th>
            <th scope="col">Category ID</th>
            <th scope="col">Season</th>
            <th scope="col">Partidos</th>
        </tr>
    </thead>
    <tbody class="text-center">
        <?php foreach ($dataItem['leagues'] as $league) : ?>
            <tr class="align-middle py-0">
                <td class="px-1 border-right-0">
                    <img class="img-fluid" src="https://cdn.resfu.com/media/img/league_logos/<?= $dataItem['categories'][$league['category_id'] . 'logo_img']  ?>.png?size=30x&lossy=1" alt="">
                </td>
                <td class="text-left border-right-0 border-left-0"><?= $dataItem['categories'][$league['category_id']] ?></td>
                <td class="border-left-0">
                    <form action="/football_data/leagues?leagueId=<?= $league['league_id'] ?>&season=<?= $league['season'] ?>&update=" method="GET">
                        <input type="hidden" name="leagueId" value="<?= $league['league_id'] ?>"></input>
                        <input type="hidden" name="season" value="<?= $league['season'] ?>"></input>
                        <input type="hidden" name="update" value="<?= $GET_['update'] = True ?>"></input>
                        <button type="submit" class="btn btn-sm btn-warning px-3">
                            <span>
                                Actualizar
                            </span>
                            <i class="fa-solid fa-database"></i>
                        </button>
                    </form>
                </td>
                <td class="font-weight-bold">
                    <a class="text-success" target="_blank" href="https://deep.besoccer.com/categories/<?= $league['category_id'] ?>?leagueId=<?= $league['league_id'] ?>">
                        #<?= $league['league_id'] ?>
                    </a>
                </td>
                <td><?= $league['category_id'] ?></td>
                <td><?= $league['season'] ?></td>
                <td>
                    <form action="/football_data/matches" method="GET">
                        <input type="hidden" name="leagueId" value="<?= $league['league_id'] ?>"></input>
                        <button type="submit" class="btn btn-sm btn-success px-3">
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
<?php
if ((strpos($_SERVER['REQUEST_URI'], "categoryId") !== false) && (count($dataItem['categories']) === 0)) : ?>
    <div class="text-center mt-4">
        <h3>Introduce una Category ID</h3>
    </div>
<?php endif ?>
<?php if ((strpos($_SERVER['REQUEST_URI'], "leagueId") !== false) && (count($dataItem['leagues']) === 0)) : ?>
    <div class="text-center mt-4">
        <h3>Introduce una League ID</h3>
    </div>
<?php endif ?>