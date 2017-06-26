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
    require('../Modelo/proyecto.class.php');
    require('../Modelo/tarea.class.php');
    $proyecto = new proyecto();
    $tarea = new tarea();
    $data=$proyecto->obtenerTodos();
    $data5= $tarea->obtenerPorUsuario();
    $data6=$tarea->buscar();
    include('encab.inc');
?>
<script>
     $(document).ready(function(){
        $('#tablaProyectos').DataTable({
        "language": {
            "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        }
        });
    });
</script>
<div class="container" style="width: 100%;">
    <?php include('./menuUsuario.inc'); ?> 
            <div class="row">
            <div class="col-lg-1"></div>
        <div class="col-lg-10 well oculto Formulario_TablaTareasProyectoAdmin" id="info3">
           <h1>Lista proyectos</h1>
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
}
?>