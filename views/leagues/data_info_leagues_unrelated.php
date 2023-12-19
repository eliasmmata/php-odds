<?php

use BeSoccerSDK\Classes\Show;

// Conditional styles
if (strpos($_SERVER['REQUEST_URI'], "goalserve") === false) {
    $enetpulse  = 'primary';
    $goalserve = 'secondary';
} else {
    $enetpulse  = 'secondary';
    $goalserve = 'primary';
}

if(isset($_GET['gsId'])) {
    $enetpulse  = 'secondary';
    $goalserve = 'primary';
}

?>
<!-- Buscador de categorias -->
<div class="my-4 border border-1 border-opacity-50 py-3 rounded">
    <div class="d-flex justify-content-center mb-2">
        <h3 class="h1 text-center">Competiciones No Relacionadas</h3>
        <?php if (strpos($_SERVER['REQUEST_URI'], "unrelated") !== false) : ?>
            <div class="d-flex align-items-baseline position-absolute" style="right: 2rem;">
                <a class="btn btn btn-warning" href="/data_info/leagues">
                    <i class="fa-solid fa-chevron-left"></i>
                    <span class="ml-1">Volver</span>
                </a>
            </div>
        <?php endif ?>
        <?php if (strpos($_SERVER['REQUEST_URI'], "epId") !== false) : ?>
            <div class="d-flex align-items-baseline position-absolute" style="right: 2rem;">
                <a class="btn btn btn-warning" href="/data_info/leagues/unrelated">
                    <i class="fa-solid fa-chevron-left"></i>
                    <span class="ml-1">Volver</span>
                </a>
            </div>
        <?php endif ?>
    </div>
    <div class="d-flex justify-content-center flex-wrap flex-md-nowrap">
        <div class="d-flex justify-content-center align-items-center flex-row p-3 border border-1 border-opacity-50 rounded">
            <form class="form-inline m-0" method="GET" action="/data_info/leagues/unrelated">
                <input type="text" name="epId" placeholder="EP External ID (category)" class="form-control mx-2" required />
                <button type="submit" class="btn border-0 btn-success d-flex align-items-center px-4 mr-2">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <span class="mx-2">Buscar</span>
                </button>
            </form>
        </div>
        <div class="d-flex justify-content-center align-items-center flex-row p-3 mx-2 border border-1 border-opacity-50 rounded"> 
            <form class="form-inline m-0" method="GET" action="/data_info/leagues/unrelated">
                <input type="text" name="gsId" placeholder="GS External ID (category)" class="form-control mx-2" required />
                <button type="submit" class="btn border-0 btn-success d-flex align-items-center px-4 mr-2">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <span class="mx-2">Buscar</span>
                </button>
            </form>
        </div>
    </div>
    <!-- Filtro por Fuentes Externas -->
    <div class="mt-4 d-flex justify-content-center">
        <div class="d-flex align-items-baseline">
            <a type="submit" href="/data_info/leagues/unrelated" class="btn border-0 btn-<?= $enetpulse ?> d-flex align-items-center px-4 mx-2">
                <span class="mr-2">ENETPULSE</span>
                <i class="fa-solid fa-coins"></i>
            </a>
        </div>
        <div class="d-flex align-items-baseline">
            <a type="submit" href="/data_info/leagues/unrelated?goalserve" class="btn border-0 btn-<?= $goalserve ?> d-flex align-items-center px-4 mx-2">
                <span class="mr-2">GOALSERVE</span>
                <i class="fa-solid fa-coins"></i>
            </a>
        </div>
    </div>
    <!-- FIN Filtro por Fuentes Externas  -->
</div>
<!-- FIN Buscador de categorias -->
<!-- Tabla de resultados ENET PULSE (categorías no relacionadas con RF) -->
<?php if (strpos($_SERVER['REQUEST_URI'], "goalserve") === false && !isset($_GET['gsId'])) : ?>
    <table class="table table-bordered   table-sm">
        <thead class="thead-dark">
            <tr class="text-center align-middle text-uppercase">
                <th scope="col">EP ID</th>
                <th scope="col" colspan="2">Nombre EP</th>
                <th scope="col">RF ID <i class="fa-solid fa-handshake ml-2"></i></th>
                <th scope="col">Ext Name EP <i class="fa-solid fa-square-plus ml-2"></i></th>
                <th scope="col">Country Code EP <i class="fa-solid fa-square-plus ml-2"></i></th>
                <th scope="col">Country Name EP <i class="fa-solid fa-square-plus ml-2"></i></th>
            </tr>
        </thead>
        <tbody class="text-center">
            <?php foreach ($dataItem['ep_cats'] as $league) : ?>
                <tr class="align-middle">
                    <td class="font-weight-bold text-success">
                        <?php if (isset($league['ep_unique_id'])) : ?>
                                #<?= $league['ep_unique_id'] ?>
                            <?php endif; ?>
                    </td>
                    <td class="border-left-0 border-right-0 px-1">
                        <img src="https://cdn.resfu.com/media/img/flags/round/<?= $league['ep_countryCode'] ?>.png?size=30" alt="<?= $league['ep_countryCode'] ?>">
                    </td>
                    <td class="text-left px-1 border-left-0 font-weight-bold">
                        <?= $league['ep_name'] ?>
                    </td>
                    <td class="px-0">
                        <?php if (isset($league['ep_unique_id'])) : ?>
                            <form action="/data_info/leagues/unrelated?epId=<?= $league['ep_unique_id'] ?>" method="POST" class="d-flex justify-content-center">
                                <input class="form-control pl-2 mr-2 w-50" type="text" name="idRf" value="<?= $league['ep_id_rf'] ?>" required></input>
                                <input type="hidden" name="epId" value="<?= $league['ep_unique_id'] ?>"></input>
                                <button type="submit" class="btn btn-sm bg-dark border-rounded px-2"><i class="fa fa-edit text-warning"></i></button>
                            </form>
                        <?php endif; ?>
                    </td>
                    <td style="min-width: 400px !important;">
                        <?php if (isset($league['ep_unique_id'])) : ?>
                            <form action="/data_info/leagues/unrelated?epId=<?= $league['ep_unique_id'] ?>" method="POST" class="d-flex justify-content-center">
                                <input class="form-control pl-2 mr-2 w-100" type="text" name="nameExtEp" value="<?= $league['ep_name_ext'] ?>" required></input>
                                <input type="hidden" name="epId" value="<?= $league['ep_unique_id'] ?>"></input>
                                <button type="submit" class="btn btn-sm bg-dark border-rounded px-2"><i class="fa fa-edit text-warning"></i></button>
                            </form>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if (isset($league['ep_countryCode']) || empty($league['ep_countryCode'])) : ?>
                            <form action="/data_info/leagues/unrelated?epId=<?= $league['ep_unique_id'] ?>" method="POST" class="d-flex justify-content-center">
                                <input class="form-control pl-2 mr-2 w-50" placeholder="Isocode 2 (ej: ES)" type="text" name="extCC" value="<?= strtoupper($league['ep_countryCode']) ?>" required></input>
                                <input type="hidden" name="epId" value="<?= $league['ep_unique_id'] ?>"></input>
                                <button type="submit" class="btn btn-sm bg-dark border-rounded px-2"><i class="fa fa-edit text-warning"></i></button>
                            </form>
                        <?php endif; ?>
                    </td>
                    <td class="border-right-0 px-1">
                        <?php if (isset($league['ep_countryName']) || empty($league['ep_countryName'])) : ?>
                            <form action="/data_info/leagues/unrelated?epId=<?= $league['ep_unique_id'] ?>" method="POST" class="d-flex justify-content-center">
                                <input class="form-control pl-2 mr-2 w-50" type="text" name="extCname" value="<?= ucwords($league['ep_countryName']) ?>" required></input>
                                <input type="hidden" name="epId" value="<?= $league['ep_unique_id'] ?>"></input>
                                <button type="submit" class="btn btn-sm bg-dark border-rounded px-2"><i class="fa fa-edit text-warning"></i></button>
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif ?>
<!-- FIN tabla EP-->
<!-- Tabla de resultados GOAL SERVE(categorías no relacionadas con RF) -->
<?php if (strpos($_SERVER['REQUEST_URI'], "goalserve") !== false || isset($_GET['gsId'])) : ?>
    <table class="table table-bordered   table-sm">
        <thead class="thead-dark">
            <tr class="text-center align-middle text-uppercase">
                <th scope="col">GS ID</th>
                <th scope="col" colspan="2">Nombre GS</th>
                <th scope="col">RF ID <i class="fa-solid fa-handshake ml-2"></i></th>
                <th scope="col">Ext Name GS <i class="fa-solid fa-square-plus ml-2"></i></th>
                <th scope="col">Country Code GS <i class="fa-solid fa-square-plus ml-2"></i></th>
                <th scope="col">Country Name GS <i class="fa-solid fa-square-plus ml-2"></i></th>
            </tr>
        </thead>
        <tbody class="text-center">
            <?php foreach ($dataItem['gs_cats'] as $league) : ?>
                <tr class="align-middle">
                    <td class="font-weight-bold text-success">
                        <?php if (isset($league['gs_unique_id'])) : ?>
                            #<?= $league['gs_unique_id'] ?>
                        <?php endif; ?>
                    </td>
                    <td class="border-left-0 border-right-0 px-1">
                        <img src="https://cdn.resfu.com/media/img/flags/round/<?= $league['gs_countryCode'] ?>.png?size=30" alt="<?= $league['gs_countryCode'] ?>">
                    </td>
                    <td class="text-left px-1 border-left-0 font-weight-bold">
                        <?= $league['gs_name'] ?>
                    </td>
                    <td class="px-0">
                        <?php if (isset($league['gs_unique_id'])) : ?>
                            <form action="/data_info/leagues/unrelated?gsId=<?= $league['gs_unique_id'] ?>" method="POST" class="d-flex justify-content-center">
                                <input class="form-control pl-2 mr-2 w-50" type="text" name="idRf" value="<?= $league['gs_id_rf'] ?>" required></input>
                                <input type="hidden" name="gsId" value="<?= $league['gs_unique_id'] ?>"></input>
                                <button type="submit" class="btn btn-sm bg-dark border-rounded px-2"><i class="fa fa-edit text-warning"></i></button>
                            </form>
                        <?php endif; ?>
                    </td>
                    <td style="min-width: 400px !important;">
                        <?php if (isset($league['gs_unique_id'])) : ?>
                            <form action="/data_info/leagues/unrelated?gsId=<?= $league['gs_unique_id'] ?>" method="POST" class="d-flex justify-content-center">
                                <input class="form-control pl-2 mr-2 w-100" type="text" name="nameExtGs" value="<?= $league['gs_name_ext'] ?>" required></input>
                                <input type="hidden" name="gsId" value="<?= $league['gs_unique_id'] ?>"></input>
                                <button type="submit" class="btn btn-sm bg-dark border-rounded px-2"><i class="fa fa-edit text-warning"></i></button>
                            </form>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if (isset($league['gs_countryCode']) || empty($league['gs_countryCode'])) : ?>
                            <form action="/data_info/leagues/unrelated?gsId=<?= $league['gs_unique_id'] ?>" method="POST" class="d-flex justify-content-center">
                                <input class="form-control pl-2 mr-2 w-50" placeholder="Isocode 2 (ej: ES)" type="text" name="gsCC" value="<?= strtoupper($league['gs_countryCode']) ?>" required></input>
                                <input type="hidden" name="gsId" value="<?= $league['gs_unique_id'] ?>"></input>
                                <button type="submit" class="btn btn-sm bg-dark border-rounded px-2"><i class="fa fa-edit text-warning"></i></button>
                            </form>
                        <?php endif; ?>
                    </td>
                    <td class="border-right-0 px-1">
                        <?php if (isset($league['gs_countryName']) || empty($league['gs_countryName'])) : ?>
                            <form action="/data_info/leagues/unrelated?gsId=<?= $league['gs_unique_id'] ?>" method="POST" class="d-flex justify-content-center">
                                <input class="form-control pl-2 mr-2 w-50" type="text" name="gsCname" value="<?= ucwords($league['gs_countryName']) ?>" required></input>
                                <input type="hidden" name="gsId" value="<?= $league['gs_unique_id'] ?>"></input>
                                <button type="submit" class="btn btn-sm bg-dark border-rounded px-2"><i class="fa fa-edit text-warning"></i></button>
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif ?>
<!-- FIN tabla GS -->
<?php if ((strpos($_SERVER['REQUEST_URI'], "unrelated") !== false) && empty($dataItem['ep_cats']) && isset($_GET['epId'])) : ?>
    <div class="text-center mt-4">
        <h3>La competición de EP no existe en la fuente externa</h3>
    </div>
<?php endif ?>
<?php if ((strpos($_SERVER['REQUEST_URI'], "unrelated") !== false) && empty($dataItem['gs_cats']) && isset($_GET['gsId'])) : ?>
    <div class="text-center mt-4">
        <h3>La competición de GS no existe en la fuente externa</h3>
    </div>
<?php endif ?>