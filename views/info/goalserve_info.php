<div class="mt-4 py-3 border border-1 border-opacity-50 rounded">
    <div class="d-flex justify-content-center">
        <h3 class="h1 text-center">Goalserve Info</h3>
        <div class="d-flex align-items-baseline position-absolute" style="right: 2rem;">
            <a class="btn btn btn-warning" href="/">
                <i class="fa-solid fa-home"></i>
            </a>
        </div>
    </div>
</div>
<div>
    <table class="table table-bordered table-sm mt-4 mb-5 w-25">
        <thead class="thead-dark text-uppercase">
            <tr class="text-center">
                <th scope="col">Última Actualización</th>
            </tr>
        </thead>
        <tbody class="text-center">
            <?php foreach ($dataItem['timestamp'] as $update) :
                $lastUpdate = gmdate("Y-m-d H:i:s",  $update['ts']);
                $now = date('Y-m-d H:i:s');
                $lastUpdateTs = strtotime($lastUpdate) + 3600;
                $nowTs = strtotime($now) + 3600;
                $dif = $nowTs - $lastUpdateTs;
                $lastUpdate = gmdate("Y-m-d H:i:s",  $lastUpdateTs)
            ?>
                <tr>
                    <td class="align-middle">
                        <?= $lastUpdate ?><span class="text-xs text-muted ml-2"><small>(Hace <?= gmdate("H:i:s", $dif) ?>)</small></span>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>