<div class="page-header page-header-light"></div>
<div class="content "></div>

<div class="navbar navbar-expand-lg navbar-light d-print-none">
    <div class="text-center d-lg-none w-100">
        <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">
            <i class="icon-unfold mr-2"></i>
            Footer
        </button>
    </div>
    <div class="navbar-collapse collapse" id="navbar-footer">
        <span class="navbar-text">
            Copyrights © 2019 <a href="https://es.besoccer.com" target="_blank">BeSoccer </a>Todos los derechos reservados.
        </span>
        <?php
        $endtime = microtime(true); // Bottom of page
        $timeLoad = ($endtime - $starttime);
        $timeLoad = round($timeLoad, 3);
        ?>
        <span class="ml-2 text-muted">Página cargada en <?= $timeLoad  ?> segundos</span>
    </div>
</div>
</div>
</body>
<script src="<?= MEDIA_JS ?>footer.js"></script>

</html>