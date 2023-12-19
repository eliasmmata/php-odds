<?php
// Conditional styles

use BeSoccerSDK\Classes\Show;

if (strpos($_SERVER['REQUEST_URI'], "goalserve") === false && strpos($_SERVER['REQUEST_URI'], "football_data") === false) {
    $enetpulse  = 'primary';
    $goalserve = 'secondary';
    $footballdata = 'secondary';
} else if (strpos($_SERVER['REQUEST_URI'], "football_data") === false) {
    $enetpulse  = 'secondary';
    $goalserve = 'primary';
    $footballdata = 'secondary';
} else if (strpos($_SERVER['REQUEST_URI'], "goalserve") === false) {
    $enetpulse  = 'secondary';
    $goalserve = 'secondary';
    $footballdata = 'primary';
}

$relEp = "0";
$relGs = "0";
$relFd = "0";

if (isset($dataItem[1]['ep_rfId']) || isset($dataItem[1]['gs_rfId']) || isset($dataItem[1]['fd_rfId'])) {
    foreach ($dataItem as $rfId => $provider) {
        if ($rfId !== $provider['ep_rfId'] || $provider['ep_rfId'] === "0") {
            $relEp++;
        }
        if ($rfId !== $provider['gs_rfId'] || $provider['gs_rfId'] === "0") {
            $relGs++;
        }
        if ($rfId !== $provider['fd_rfId'] || $provider['fd_rfId'] === "0") {
            $relFd++;
        }
    }
}
?>
<!-- Entrada Providers -->
<div class="mt-4 py-3 border border-1 border-opacity-50 rounded">
    <div class="d-flex justify-content-center">
        <h3 class="h1 text-center">Casas de apuestas</h3>
        <div class="d-flex align-items-baseline position-absolute" style="right: 2rem;">
            <a class="btn btn btn-warning" href="/">
                <i class="fa-solid fa-home"></i>
            </a>
        </div>
    </div>
    <!-- Filtro por Fuentes Externas -->
    <div class="mt-2 d-flex justify-content-center">
        <div class="d-flex align-items-baseline">
            <a type="submit" href="/data_info/providers" class="btn border-0 btn-<?= $enetpulse ?> d-flex align-items-center px-4 mx-2">
                <span class="mr-2">ENETPULSE</span>
                <i class="fa-solid fa-coins"></i>
            </a>
        </div>
        <div class="d-flex align-items-baseline">
            <a type="submit" href="/data_info/providers?goalserve" class="btn border-0 btn-<?= $goalserve ?> d-flex align-items-center px-4 mx-2">
                <span class="mr-2">GOALSERVE</span>
                <i class="fa-solid fa-coins"></i>
            </a>
        </div>
        <div class="d-flex align-items-baseline">
            <a type="submit" href="/data_info/providers?football_data" class="btn border-0 btn-<?= $footballdata ?> d-flex align-items-center px-4 mx-2">
                <span class="mr-2">FOOTBALL DATA</span>
                <i class="fa-solid fa-coins"></i>
            </a>
        </div>
        <?php if (strpos($_SERVER['REQUEST_URI'], "relate") !== false) : ?>
            <div class="d-flex align-items-baseline position-absolute" style="right: 2rem;">
                <a class="btn btn btn-warning" href="/data_info/providers">
                    <i class="fa-solid fa-backward-step fa-lg"></i>
                </a>
            </div>
        <?php endif ?>
    </div>
    <!-- FIN Filtro por Fuentes Externas  -->
</div>
<!-- FIN Entrada  Providers-->
<div class="d-flex justify-content-between">
    <table class="table table-bordered   table-sm mt-4 mb-4 w-75">
        <thead class="thead-dark text-uppercase">
            <tr class="text-center">
                <th scope="col">ID RF</th>
                <th scope="col">Nombre RF</th>
                <?php if (strpos($_SERVER['REQUEST_URI'], "goalserve") === false && strpos($_SERVER['REQUEST_URI'], "football_data") === false) : ?>
                    <th scope="col">ID RF <i class="fa-solid fa-handshake px-2"></i> ENETPULSE</th>
                    <th scope="col">Casas de apuestas de EP</th>
                <?php elseif (strpos($_SERVER['REQUEST_URI'], "football_data") === false) : ?>
                    <th scope="col">ID RF <i class="fa-solid fa-handshake px-2"></i> GOALSERVE</th>
                    <th scope="col">Casas de apuestas GS</th>
                <?php elseif (strpos($_SERVER['REQUEST_URI'], "goalserve") === false) : ?>
                    <th scope="col">ID RF <i class="fa-solid fa-handshake px-2"></i> FOOTBALL DATA</th>
                    <th scope="col">Casas de apuestas FD</th>
                <?php endif ?>
            </tr>
        </thead>
        <tbody class="text-center">
            <?php foreach ($dataItem as $provider) : ?>
                <tr>
                    <td class="align-middle">
                        <?php if (isset($provider['rf_id'])) : ?>
                            #<?= $provider['rf_id'] ?>
                        <? endif ?>
                    </td>
                    <td class="align-middle text-left pl-4 font-weight-bold">
                        <?php if (isset($provider['rf_name'])) : ?>
                            <?= $provider['rf_name'] ?>
                        <? else : ?>
                            <?= $provider['name'] ?>
                        <? endif ?>
                    </td>
                    <?php if (strpos($_SERVER['REQUEST_URI'], "goalserve") === false && strpos($_SERVER['REQUEST_URI'], "football_data") === false) : ?>
                        <td class="align-middle">
                            <form action="/data_info/providers/relate" method="POST" class="d-flex justify-content-center">
                                <?php if (isset($provider['id'])) : ?>
                                    <input class="form-control pl-2 mr-2 w-50" type="text" name="ep_rfId" value="<?= $provider['rf_id'] ?>" required></input>
                                    <input type="hidden" name="ep_id" value="<?= $provider['id'] ?>"></input>
                                <? else : ?>
                                    <input class="form-control pl-2 mr-2 w-50" type="text" name="ep_rfId" value="<?= $provider['ep_rfId'] ?>" required></input>
                                    <input type="hidden" name="ep_id" value="<?= $provider['ep_id'] ?>"></input>
                                <? endif ?>
                                <button type="submit" class="btn btn-sm bg-dark border-rounded px-2"><i class="fa fa-edit text-warning"></i></button>
                            </form>
                        </td>
                        <td class="align-middle text-left pl-4 font-weight-bold">
                            <?php if (isset($provider['name'])) : ?>
                                <?= $provider['name'] ?>
                            <? else : ?>
                                <?= $provider['ep_name'] ?>
                            <? endif ?>
                        </td>
                    <?php elseif (strpos($_SERVER['REQUEST_URI'], "football_data") === false) : ?>
                        <td class="align-middle">
                            <form action="/data_info/providers/relate" method="POST" class="d-flex justify-content-center">
                                <?php if (isset($provider['id'])) : ?>
                                    <input class="form-control pl-2 mr-2 w-50" type="text" name="gs_rfId" value="<?= $provider['rf_id'] ?>" required></input>
                                    <input type="hidden" name="gs_id" value="<?= $provider['id'] ?>"></input>
                                <? else : ?>
                                    <input class="form-control pl-2 mr-2 w-50" type="text" name="gs_rfId" value="<?= $provider['gs_rfId'] ?>" required></input>
                                    <input type="hidden" name="gs_id" value="<?= $provider['gs_id'] ?>"></input>
                                <? endif ?>
                                <button type="submit" class="btn btn-sm bg-dark border-rounded px-2"><i class="fa fa-edit text-warning"></i></button>
                            </form>
                        </td>
                        <td class="align-middle text-left pl-4 font-weight-bold">
                            <?php if (isset($provider['name'])) : ?>
                                <?= $provider['name'] ?>
                            <? else : ?>
                                <?= $provider['gs_name'] ?>
                            <? endif ?>
                        </td>
                    <?php elseif (strpos($_SERVER['REQUEST_URI'], "goalserve") === false) : ?>
                        <td class="align-middle">
                            <form action="/data_info/providers/relate" method="POST" class="d-flex justify-content-center">
                                <?php if (isset($provider['id'])) : ?>
                                    <input class="form-control pl-2 mr-2 w-50" type="text" name="fd_rfId" value="<?= $provider['rf_id'] ?>" required></input>
                                    <input type="hidden" name="fd_id" value="<?= $provider['id'] ?>"></input>
                                <? else : ?>
                                    <input class="form-control pl-2 mr-2 w-50" type="text" name="fd_rfId" value="<?= $provider['fd_rfId'] ?>" required></input>
                                    <input type="hidden" name="fd_id" value="<?= $provider['fd_id'] ?>"></input>
                                <? endif ?>
                                <button type="submit" class="btn btn-sm bg-dark border-rounded px-2"><i class="fa fa-edit text-warning"></i></button>
                            </form>
                        </td>
                        <td class="align-middle text-left pl-4 font-weight-bold">
                            <?php if (isset($provider['name'])) : ?>
                                <?= $provider['name'] ?>
                            <? else : ?>
                                <?= $provider['fd_name'] ?>
                            <? endif ?>
                        </td>
                    <?php endif ?>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <?php if (strpos($_SERVER['REQUEST_URI'], "relate") === false) : ?>
        <div class="d-flex justify-content-center align-self-start p-2 mt-4 mr-2 bg-dark rounded">
            <?php if (strpos($_SERVER['REQUEST_URI'], "goalserve") === false && strpos($_SERVER['REQUEST_URI'], "football_data") === false) : ?>
                <?php if ($relEp === '0') : ?>
                    <p class="my-0 mx-2 text-white">
                        <i class="fa-solid fa-circle-exclamation fa-xl text-danger"></i>
                        <span class="px-2"><?= $relEp ?></span>
                        <i class="fa-solid fa-handshake-slash text-danger"></i>
                    </p>
                <?php else : ?>
                    <span class="m-0 bg-white rounded-circle">
                        <i class="fa-solid fa-circle-check fa-2xl text-success rounded-circle"></i>
                    </span>
                <?php endif ?>
            <?php endif ?>
            <?php if (strpos($_SERVER['REQUEST_URI'], "goalserve") !== false) : ?>
                <?php if ($relGs === '0') : ?>
                    <p class="my-0 mx-2 text-white">
                        <i class="fa-solid fa-circle-exclamation fa-xl text-danger"></i>
                        <span class="px-2"><?= $relGs ?></span>
                        <i class="fa-solid fa-handshake-slash text-danger"></i>
                    </p>
                <?php else : ?>
                    <span class="m-0 bg-white rounded-circle">
                        <i class="fa-solid fa-circle-check fa-2xl text-success rounded-circle"></i>
                    </span>
                <?php endif ?>
            <?php endif ?>
            <?php if (strpos($_SERVER['REQUEST_URI'], "football_data") !== false) : ?>
                <?php if ($relFd === '0') : ?>
                    <p class="my-0 mx-2 text-white">
                        <i class="fa-solid fa-circle-exclamation fa-xl text-danger"></i>
                        <span class="px-2"><?= $relFd ?></span>
                        <i class="fa-solid fa-handshake-slash text-danger"></i>
                    </p>
                <?php else : ?>
                    <span class="m-0 bg-white rounded-circle">
                        <i class="fa-solid fa-circle-check fa-2xl text-success rounded-circle"></i>
                    </span>
                <?php endif ?>
            <?php endif ?>
        </div>
    <?php endif ?>
</div>
<?php if (empty($dataItem)) : ?>
    <h3 class="h3 text-center w-75 mb-4">No existe esa casa de apuestas en esa tabla todavía. Hay que crearla antes de relacionarla</h3>
<?php endif ?>