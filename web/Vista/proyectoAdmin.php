<?php
require('../Modelo/sesion.class.php');
$sesion = new sesion();
if(!$sesion->validar()){
    header('Location: http://localhost/dashboard/proyecto4/Vista/login.php?error=NoHaySesion');
    exit;
}else{
    require('../Modelo/conexion.class.php');
    $db=new conexion();
    $db->conn();
    require('../Modelo/proyecto.class.php');
    require('../Modelo/tarea.class.php');
    $proyecto = new proyecto();
    $tarea = new tarea();
    $data=$proyecto->obtenerTodos();
    $data5= $tarea->obtenerTodos();
    include('encab.inc');
?>
<script>
     $(document).ready(function(){
        $('#tablaProyectos').DataTable({
        "language": {
            "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        }
        }),
        $('#tablaTareas').DataTable({
        "language": {
            "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        }
        }),
        $("#boton").on( "click", function() {
            $('#target').toggle();
        }),
        $(".oculto").hide();              
        $(".inf").click(function(){
          var nodo = $(this).attr("href");  
          if ($(nodo).is(":visible")){
               $(nodo).hide();
               return false;
          }else{
            $(".oculto").hide("slow");                             
            $(nodo).fadeToggle("fast");
            return false;
          }
    }),
        $(".editar").click(function(){
            $.ajax({
                url: "../Controlador/ajax/datosProyecto.php?idProyecto="+this.id,
                type:"GET",
                success: function(data){
                    //alert(data);
                    var result = $.parseJSON(data);
                    $("#idProyecto").val(result.idProyecto);
                    $("#nombreProyecto").val(result.nombreProyecto);
                    $("#accion").val("editar");
                }
            });
        });
    });
</script>
<div class="container-fluid" style="width: 100%;">
    <?php include('menuAdmin.inc'); ?>
    <div class="row">
        <div class="col-lg-3"></div>
<!--    <div class="col-lg-2 well">
        <a href="#info1" class="inf"> <button ><img src="../Vista/img/proyecto.png">Agregar Proyectos</button></a>
    </div>-->
<!--    <div class="col-lg-2 well">
        <a href="#info2" class="inf"> <button ><img src="../Vista/img/lista.png">Proyectos Y listar</button></a>
    </div>-->
        <div class="col-lg-3"></div>
  </div>
    <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-10 Formulario_ProyectoAdmin">
            <h1>Nuevo proyecto</h1>
           <form action="../Controlador/proyecto.php" method="POST">
           <input type="hidden" name="accion" value="agregar" id="accion">
           <input type="hidden" name="idProyecto" value="" id="idProyecto">
          <div class="casilla_addProyectoAdmin">
            <!--<label for="nombreProyecto">Nombre proyecto:</label>-->
            <input type="text" id="nombreProyecto" name="nombreProyecto" placeholder="Ingrese nombre proyecto">
          </div>
          <button type="submit" class="addProyectoAdmin_btn">Agregar proyecto</button>
        </form>
        </div>  
        <div class="col-lg-1"></div>
    </div>   
    <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-10 Formulario_TablaProyectoAdmin">
           <h1>Lista proyectos</h1>
             <br>
            <table id="tablaProyectos" class="display" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre proyecto</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($data AS $value){
                echo "<tr>";
                echo "<td>".$value['idProyecto']."</td>";
                echo "<td>".$value['nombreProyecto']."</td>";
                echo "<td><a href='#' class='editar editUsuario_btn' id='".$value['idProyecto']."'><img src='img/editar.jpg' width='24' height='24' /></a></td>";
                echo "<td><a class='editUsuario_btn' href='../Controlador/proyecto.php?accion=eliminar&idProyecto=".$value['idProyecto']."' ><img src='img/eliminar.png' width='24' height='24' /></a> </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
            </table>
        </div>  
        <div class="col-lg-1"></div>
    </div>
        <div class="row">
            <div class="col-lg-1 btn-xs  btn-danger">
        <a href="#info3" class="inf "> <button ><img src="../Vista/img/tareas.png">Proyectos y tareas</button></a>
            </div>
            <!--<div class="col-lg-1"></div>-->
        <div class="col-lg-10 well oculto Formulario_TablaTareasProyectoAdmin" id="info3">
           <h1>Proyectos y tareas</h1>
             <br>
            <table id="tablaTareas" class="display" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Proyecto</th>
                <th>Nombre Tarea</th>
                <th>Descripción tarea</th>
                <th>Fecha Vencimiento</th>
                <th>Usuario</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($data5 AS $value){
                echo "<tr>";
                echo '<td value="">'.$value['nombreProyecto'].'</td>';
                echo '<td value="">'.$value['nombreTarea'].'</td>';
                echo '<td value="">'.$value['descTarea'].'</td>';
                echo '<td value="">'.$value['fechaVenc'].'</td>';
                echo '<td value="">'.$value['nick'].'</td>';
                echo "<td></td>";
                echo "<td></td>";
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
//    header('Location: /dashboard/Proyecto4/login.php?error=accesoRestringido');
}
?>