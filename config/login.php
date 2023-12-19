<?php
	require_once('outh.php')
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Iniciar sesión | BeSoccerOdds</title>

    <link rel="icon" type="image/png" sizes="192x192" href="/media/img/logo_basic.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/media/img/logo_basic.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/media/img/logo_basic.png">    
    <link rel="stylesheet" href="/media/css/login_style.css">
</head>
<body>
    <div class="box">
        <div class="form">			
			<img class="imgLogo" src="/media/img/logo_basic.png" width="50" alt="Logo LNFS">
			<h2>Odds Editor</h2>							
			<form method="POST" action="<?=$_SERVER['REQUEST_URI']?>">
				<div class="inputBox">
					<input type="text" name="user" required>
					<span>Username</span>
					<i></i>
				</div>
				<div class="inputBox">
					<input type="password" name="pass" required>
					<span>Password</span>
					<i></i>
				</div>            
				<button class="button" type="submit"><span>LOGIN</span></button>
			<form>
        </div>		
    </div>	
	<?php
	if (isset($_GET['r']) && !empty($_GET['r'])) {
	?>
		<div class="alert">
			<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
			<strong>Sin Acceso!</strong> <?php if($_GET['r'] == 1){ echo 'No tienes los permisos suficientes'; }elseif ($_GET['r'] == 2){ echo 'Usuario o contraseñas incorrectas';}?>
		</div>
	<?php
	}
	?>	
</body>

</html>