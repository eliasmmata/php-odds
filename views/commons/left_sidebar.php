<?php

use BesoccerOdds\Helpers\LeftSidebarHelper;
$sideBar = LeftSidebarHelper::getSidebar();

?>

</head>

<body id="bodyScrap" class="dark">                         
    
    <!-- Main navbar -->
	<div class="navbar navbar-expand-xl fixed-top d-print-none">
		<div class="navbar-brand d-flex align-items-center">
			<a href="/" class="d-inline-block">
				<img src="<?=MEDIA_ROOT?>logo_basic.png" alt="Logo BeSoccer">
			</a>
			<p class="ml-2 mb-0 fs20">Editor Odds</p>
		</div>

		<div class="d-xl-none">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
				<i class="icon-tree5"></i>
			</button>
			<button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
				<i class="icon-paragraph-justify3"></i>
			</button>


				<button class="navbar-toggler sidebar-mobile-secondary-toggle" type="button">
					<i class="icon-more"></i>
				</button>

		</div>

		<div class="collapse navbar-collapse" id="navbar-mobile">
			<ul class="navbar-nav">				
                <li class="nav-item">
                    <a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-xl-block" onclick="sidebarCollapse()">
                        <i class="icon-paragraph-justify3"></i>
                    </a>
                </li>			
			</ul>

			

			<ul class="navbar-nav ml-auto align-items-center">
				<li>
					<span class="mr-2" data-toggle="modal" data-target="#infoModal"><i class="fa fa-info-circle" aria-hidden="true"></i></span>					
				</li>
				<li class="form-check form-check-switchery form-check-inline form-check-right">
					<label class="form-check-label">
						<input id="darkMode" type="checkbox" class="form-check-input-switchery" onclick="changeDark()" checked data-fouc>
						Modo Oscuro
					</label>
				</li>
				<li class="nav-item dropdown dropdown-user">
					<a href="#" class="navbar-nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown">						                        
						<?php if (isset($_COOKIE['oauthScrap'])) { ?>         
							<img src="https://cdn8.resfu.com/img_data/editor/users/<?=json_decode($_COOKIE['oauthScrap'])->id ?>.jpg" class="rounded-circle small mr-2" height="34">                   
                            <spam><?php if (!empty(json_decode($_COOKIE['oauthScrap'])->nick)) { echo json_decode($_COOKIE['oauthScrap'])->nick; }else { $user = explode('@',json_decode($_COOKIE['oauthScrap'])->email); echo $user[0];}?></spam>                            
                        <?php }else { ?>  
							<img src="<?=MEDIA_ROOT?>user/image.png" class="rounded-circle small mr-2" height="34">                                             
                        <?php } ?>                        
					</a>

					<div class="dropdown-menu dropdown-menu-right">
						<a href="https://deep.besoccer.com/users/<?=json_decode($_COOKIE['oauthScrap'])->id ?>" class="dropdown-item"><i class="icon-user-plus"></i>Mi perfil</a>
                        <?php if (isset($_COOKIE['oauthScrap'])) { ?><a class="dropdown-item fst-italic small"><?= json_decode($_COOKIE['oauthScrap'])->role?> </br> (<?=json_decode($_COOKIE['oauthScrap'])->sub_role?>) </a> <?php } ?>
						<a href="/logout" class="dropdown-item"><i class="icon-switch2"></i>Cerrar sesión</a>
					</div>
				</li>
			</ul>
		</div>
	</div>
	<!-- /main navbar -->
    <div class="page-content">

    <div class="sidebar sidebar-dark sidebar-main sidebar-expand-xl sidebar-fixed">

	<!-- Sidebar mobile toggler -->
	<div class="sidebar-mobile-toggler text-center">
		<a href="#" class="sidebar-mobile-main-toggle">
			<i class="icon-arrow-left8"></i>
		</a>
		Menú
		<a href="#" class="sidebar-mobile-expand">
			<i class="icon-screen-full"></i>
			<i class="icon-screen-normal"></i>
		</a>
	</div>
	<!-- /sidebar mobile toggler -->


	<!-- Sidebar content -->
	<div class="sidebar-content">

		<!-- Main navigation -->
		<div class="card card-sidebar-mobile">
			<ul class="nav nav-sidebar" data-nav-type="accordion">

				<!-- Main -->
                <?php if(isset($sideBar) AND !empty($sideBar)):?>
                    <?php foreach ($sideBar as $keySideBar => $section):?>				
                        <li class="nav-item <?= !empty($section['subsections']) ? 'nav-item-submenu nav-item-expanded' : '' ?>">
                            <a href="<?php if(empty($section['subsections'])){echo $section['url'];} ?>" class="nav-link" title="<?= $section['name'] ?>">
                                <i class="<?= $section['icon'] ?>"></i>
                                <span><?= $section['name'] ?></span>
                            </a>
                            <?php if (!empty($section['subsections'])) : ?>
                                <ul class="nav nav-group-sub" data-submenu-title="<?= $section['name'] ?>" style="display: none;">
                                    <?php foreach ($section['subsections'] as $subSection) : ?>
                                        <li class="nav-item <?= !empty($subSection['submenu_two']) ? 'nav-item-submenu nav-item-expanded' : '' ?>">
                                            <a href="<?=$section['url']?><?=$subSection['url']?>" class="nav-link">
                                                <i class="<?= $subSection['icon'] ?>"></i>
                                                <span><?= $subSection['name'] ?></span>
                                            </a>
                                            <?php if (!empty($subSection['submenu_two'])) : ?>
                                                <ul class="nav nav-group-sub" data-submenu-title="<?= $subSection['name'] ?>" style="display: none;">
                                                    <?php foreach ($subSection['submenu_two'] as $sub_navItem2) : ?>
                                                        <li class="nav-item">
                                                            <a href="<?= $subSection['url'] ?>" class="nav-link">
                                                                <i class="<?= $subSection['icon'] ?>"></i>
                                                                <span><?= $subSection['name'] ?></span>
                                                            </a>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            <?php endif; ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </li>
				    <?php endforeach; ?>
                <?php endif; ?>    
				<!-- /main -->

			</ul>
		</div>
		<!-- /main navigation -->

	</div>
	<!-- /sidebar content -->                                                
</div>
<div class="content-wrapper p-3 mt-4">       
	   
