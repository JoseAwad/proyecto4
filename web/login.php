<!--codigo ordenado-->
<?php
$flagError=false;
if(isset($_GET['error']) && $_GET['error']==1){
    $flagError=true;
    $msgError="Usuario/Contraseña no coinciden";
}
if(isset($_GET['error']) && $_GET['error']=='NoHaySesion'){
    $flagError=true;
    $msgError="Usuario no ha iniciado sesión";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Proyecto 4</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="css/style.css">
</head>
<style>
    body{
	background:url(../../proyecto4/Vista/img/fondo.jpg) repeat scroll;
	background-position: center center;
	background-attachment: fixed;
	background-size: cover;
}
</style>
<body>
<div class="container">
    <?php
    if($flagError){ ?>
        <div class="alert alert-danger alert-dismissable">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>ERROR!</strong><?php echo $msgError; ?>
        </div>
    <?php    
    }
    ?>
    <div class="row">
	<div class="col-md-4"></div>
	<div class="col-md-4  Login_Form">
            <h1>Login</h1>
                <form action="../Controlador/validar.php" method="POST">
                    <div class="form-group">
                        <input type="text" class=" Login_un" id="nick" name="nombre" placeholder="Ingrese Nick">
                    </div>
                    <div class="form-group">
                        <input type="password" class=" Login_ps" id="pwd" name="pwd"  placeholder="Ingrese Contraseña">
                    </div>
                    <div class="checkbox" style="margin-left: 62px;">
                        <label><input type="checkbox" name="checkRemember"> Remember me</label>
                    </div>
                    <button type="submit" class="btn btn-default Login_btn">Ingresar</button>
                </form>
	</div>
        <div class="col-md-4"></div>
    </div>
</div>
</body>
</html>