<div class="mt-4 py-3 border border-1 border-opacity-50 rounded">
    <div class="d-flex justify-content-center">
        <h3 class="h1 text-center">Enetpulse Info</h3>
        <div class="d-flex align-items-baseline position-absolute" style="right: 2rem;">
            <a class="btn btn btn-warning" href="/">
                <i class="fa-solid fa-home"></i>
            </a>
        </div>
    </div>
</div>
<div class="d-flex justify-content-around">
    <table class="table table-bordered table-sm mt-4 mb-5 w-25">
        <thead class="thead-dark text-uppercase">
            <tr class="text-center">
                <th scope="col">Última actualización</th>
            </tr>
        </thead>
        <tbody class="text-center">
            <?php foreach ($dataItem['timestamp'] as $update) :
                $lastUpdate = $update['ut'];
                $now = date('Y-m-d H:i:s');
                $lastUpdateTs = strtotime($lastUpdate);
                $nowTs = strtotime($now) + 3600;
                $dif = $nowTs - $lastUpdateTs;
            ?>
                <tr>
                    <td class="align-middle">
                        <?= $lastUpdate ?><span class="text-xs text-muted ml-2"><small>(Hace <?= gmdate("H:i:s", $dif) ?>)</small></span>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <table class="table table-bordered table-sm mt-4 mb-5 w-25">
        <thead class="thead-dark text-uppercase">
            <tr class="text-center">
                <th scope="col">
                    <i class="fa-solid fa-download pr-2"></i>Nº XML en Cola <i class="fa-solid fa-square-plus px-3"></i>Dif penúltimo<i class="fa-solid fa-stopwatch px-2"></i>último
                </th>
            </tr>

        </thead>
        <tbody class="text-center">
            <tr class="text-center ">
                <td class="align-middle py-2">
                    <a href="https://bigdata02.besoccer.com/scripts/data_sources/odds/ep_saved_xml.php" target="_blank">
                        <i class="fa-solid fa-file-code fa-2xl py-2 text-success"></i>
                        <i class="fa-solid fa-arrow-pointer text-dark align-bottom pl-1" style="transform: rotate(-15deg);"></i>
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
    <table class="table table-bordered table-sm mt-4 mb-5 w-25 border-0">
        <thead class="thead-dark text-uppercase border-0">
            <tr class="text-center border-0">
                <th scope="col" class="bg-white"></th>
                <th scope="col">1 día</th>
                <th scope="col">2 días</th>
                <th scope="col">3 días</th>
            </tr>
        </thead>
        <tbody class="text-center">
            <tr>
                <td class="align-middle bg-dark text-white text-uppercase">
                    Partidos insertados en
                </td>
                <td class="align-middle">
                    <a href="https://bigdata02.besoccer.com/scripts/data_sources/odds/script_count_check.php" target="_blank">
                        <i class="fa-solid fa-file-code fa-2xl py-2 text-success"></i>
                        <i class="fa-solid fa-arrow-pointer text-dark align-bottom pl-1" style="transform: rotate(-15deg);"></i>
                    </a>
                </td>
                <td class="align-middle">
                    <a href="https://bigdata02.besoccer.com/scripts/data_sources/odds/script_count_check.php?dias=2" target="_blank">
                        <i class="fa-solid fa-file-code fa-2xl py-2 text-success"></i>
                        <i class="fa-solid fa-arrow-pointer text-dark align-bottom pl-1" style="transform: rotate(-15deg);"></i>
                    </a>
                </td>
                <td class="align-middle">
                    <a href="https://bigdata02.besoccer.com/scripts/data_sources/odds/script_count_check.php?dias=3" target="_blank">
                        <i class="fa-solid fa-file-code fa-2xl py-2 text-success"></i>
                        <i class="fa-solid fa-arrow-pointer text-dark align-bottom pl-1" style="transform: rotate(-15deg);"></i>
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
</div>