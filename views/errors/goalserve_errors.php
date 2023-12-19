<?php

use BesoccerOdds\Helpers\GoalserveHelper;
?>

<?php
$i = 0;
foreach ($dataItem['errors'] as $error) {
    if ($error['errorcode'] !== '7') {
        $i++;
    }
}

?>
<div class="mt-4 py-3 border border-1 border-opacity-50 rounded">
    <div class="d-flex justify-content-center">
        <h3 class="h1 text-center">Errors to check
            <span class="rounded p-1 px-2 bg-dark ml-2">
                <?= $i ?>
            </span>
        </h3>
        <div class="d-flex align-items-baseline position-absolute" style="right: 2rem;">
            <a class="btn btn btn-warning" href="/">
                <i class="fa-solid fa-home"></i>
            </a>
        </div>
    </div>
</div>
<div>
    <table class="table table-bordered   table-sm mt-4 mb-5">
        <thead class="thead-dark text-uppercase">
            <tr class="text-center">
                <th scope="col">ID</th>
                <th scope="col">Index ID</th>
                <th scope="col">Competición</th>
                <th scope="col" colspan="2">Error</th>
            </tr>
        </thead>
        <tbody class="text-center">
            <?php foreach ($dataItem['errors'] as $error) : ?>
                <?php if ($error['errorcode'] !== '7') : ?>
                    <tr>
                        <td class="align-middle">#<?= $error['id'] ?></td>
                        <td class="align-middle font-weight-bold"><?= $error['indexId'] ?></td>
                        <td class="align-middle text-left pl-2 font-weight-bold"><?= $error['name'] ?></td>
                        <td class="align-middle text-left pl-2 border-right-0"><?= GoalserveHelper::errorCodeConvert($error['errorcode']); ?></td>
                        <td class="align-middle border-left-0"><span class="badge bg-danger p-2 font-weight-light">Code <?= $error['errorcode'] ?></span></td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div>
        <?php if (empty($i)) : ?>
            <p class="h3 text-center pb-4 pr-2">
                <i class="fa-solid fa-face-smile fa-xl text-success fa-rotate-90"></i>
                <i class="fa-solid fa-face-smile fa-xl text-success fa-rotate-180"></i>
                <i class="fa-solid fa-face-smile fa-xl text-success fa-rotate-270"></i>
                <i class="fa-solid fa-face-smile fa-xl text-success fa-flip-horizontal mr-4"></i>
                No hay errores
                <i class="fa-solid fa-face-smile fa-xl text-success fa-flip-horizontal ml-4"></i>
                <i class="fa-solid fa-face-smile fa-xl text-success fa-rotate-90"></i>
                <i class="fa-solid fa-face-smile fa-xl text-success fa-rotate-180"></i>
                <i class="fa-solid fa-face-smile fa-xl text-success fa-rotate-270"></i>
            <?php endif; ?>
    </div>
</div>