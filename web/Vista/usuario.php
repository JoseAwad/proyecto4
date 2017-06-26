<?php
require('../Modelo/sesion.class.php');
$sesion = new sesion();
if(!$sesion->validar()){
    header('Location: http://localhost/proyecto4/Vista/login.php?error=NoHaySesion');
    exit;
}else{
    require('../Modelo/conexion.class.php');
    $db=new conexion();
    $db->conn();
    require('../Modelo/usuario.class.php');
    $usuario = new usuario();
    $data=$usuario->obtenerTodos();
    include('encab.inc');
?>
<script>
     $(document).ready(function(){
        $('#tablaUsuarios').DataTable({
        "language": {
            "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        }
        }),
        $(".editar").click(function(){
            $.ajax({
                url: "../Controlador/ajax/datosUsuario.php?idUsuario="+this.id,
                type:"GET",
                success: function(data){
                    //alert(data);
                    var result = $.parseJSON(data);
                    $("#idUsuario").val(result.idUsuario);
                    $("#nick").val(result.nick);
                    $("#nombre").val(result.nombre);
                    $("#perfil").val(result.perfil);
                    $("#accion").val("editar");
                }
            });
        });
    });
</script>
<div class="container"style="width: 100%;">
    <?php include('menuAdmin.inc'); ?>
    <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-10 Formulario_AddUser">
            <h1>Nuevo Usuario</h1>
            <form action="../Controlador/usuario.php" method="POST">
              <input type="hidden" name="accion" value="agregar" id="accion">
              <input type="hidden" name="idUsuario" value="" id="idUsuario">
              <div class="casilla_addUser">
<!--                <label for="nick">Nick:</label>-->
                <input type="text" class="" id="nick" name="nick" placeholder="Ingrese nick">
              </div>
              <div class="casilla_addUser">
                <!--<label for="pwd">Password:</label>-->
                <input type="password" class="" id="pwd" name="pwd" placeholder="Ingrese contraseña">
              </div>
              <div class="casilla_addUser">
                <!--<label for="nombre">Nombre:</label>-->
                <input type="text" class="" id="nombre" name="nombre" placeholder="Ingrese nombre completo">
              </div>  
              <div class="casilla_addUser">
                  <!--<label for="perfil">Perfil:</label><br>-->
                  <input type="radio" name="perfil" value="admin"> Administrador
                  <input type="radio" name="perfil" value="usuario"> Usuario<br>
              </div><br>
              <div>
                  <button  type="submit" class="addUsuario_btn"><img class="img_AddUser" src="img/addUser2.png">Agregar</button>
              </div>
            </form>
        </div>  
        <div class="col-lg-1"></div>
    </div>
    <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-10 Formulario_TablaUsuarios">
             <h1>Lista usuarios</h1>
             <br>
            <table id="tablaUsuarios" class="display" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nick</th>
                <th>Contraseña</th>
                <th>Nombre completo</th>
                <th>perfil</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($data AS $value){
                echo "<tr>";
                echo "<td>".$value['idUsuario']."</td>";
                echo "<td>".$value['nick']."</td>";
                echo "<td>".$value['pwd']."</td>";
                echo "<td>".$value['nombre']."</td>";
                echo "<td>".$value['perfil']."</td>";
                echo "<td><a href='#' class='editar editUsuario_btn' id='".$value['idUsuario']."'><img src='img/editar.jpg' width='24' height='24' /></a></td>";
                echo "<td class=''><a class='deleteUsuario_btn' href='../Controlador/usuario.php?accion=eliminar&idUsuario=".$value['idUsuario']."' ><img src='img/eliminar.png' width='24' height='24' /></a> </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
            </table>
        </div>  
        <div class="col-lg-1"></div>
    </div> 
</div>

<?php
    include('footer.inc');
    header('Location: ./Proyecto4/login.php?error=accesoRestringido');
}
?>