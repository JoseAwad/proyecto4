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
    require('../Modelo/usuario.class.php');
    require('../Modelo/tarea.class.php');
    $proyecto = new proyecto();
    $usuario = new usuario();
    $tarea = new tarea();
    $data=$proyecto->obtenerTodos();
    $data1=$usuario->obtenerTodos();
    $dataAtrasada=$tarea->obtenerAtrasada();
    $dataHoy=$tarea->obtenerHoy();
    $dataMañana=$tarea->obtenerMañana();
   
    include('encab.inc');
?>
<script>
     $(document).ready(function(){
        $('#tablaTareas').DataTable({
        "language": {
            "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        }
        }),
        $( "#fechaVenc" ).datepicker({
                        dateFormat:'yy/mm/dd',
			changeMonth: true,
			changeYear: true,
			minDate: '-10D',
			maxDate: '+10Y'
		});
    });
</script>
<div class="container" style="width: 100%;">
    <?php include('menuAdmin.inc'); ?>
    <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-10">
            <div class="row">
                <div class="col-lg-4">
                    <div class="panel-group">
                    <div class="panel panel-danger">
      <div class="panel-heading">TAREAS ATRASADAS</div>
      <div class="panel-body">
            <table>
        <thead>
            <tr>
                <th></th>
                <th></th>
            </tr>
        </thead>
        
        <tbody>
            <?php
            foreach($dataAtrasada AS $value){
                echo "<tr>";
                echo "<td>".$value['nombreTarea']."</td>";
                 echo "<td><a href='../Controlador/tarea.php?accion=modificarAdmin&idTarea=".$value['idTarea']."' ><img src='img/ticket.png' width='24' height='24' /></a> </td>";
               
                echo "</tr>";
            }
            ?>
        </tbody>
            </table>
    </div>
  </div>
                  </div>  
                </div>
                <div class="col-lg-4">
                    <div class="panel-group">
                    <div class="panel panel-success">
      <div class="panel-heading">TAREAS HOY</div>
      <div class="panel-body">
           <table>
        <thead>
            <tr>
                <th></th>
                <th></th>
            </tr>
        </thead>
        
        <tbody>
            <?php
            foreach($dataHoy AS $value){
                echo "<tr>";
                echo "<td>".$value['nombreTarea']."</td>";
                echo "<td><a href='../Controlador/tarea.php?accion=modificarAdmin&idTarea=".$value['idTarea']."' ><img src='img/ticket.png' width='24' height='24' /></a> </td>";
               
                echo "</tr>";
            }
            ?>
        </tbody>
            </table>
    </div>
  </div>
                  </div>  
                </div>
                <div class="col-lg-4">
                    <div class="panel-group">
                    <div class="panel panel-info">
      <div class="panel-heading">TAREAS DE MAÑANA</div>
      <div class="panel-body">
           <table>
        <thead>
            <tr>
                <th></th>
                <th></th>
            </tr>
        </thead>
        
        <tbody>
            <?php
            foreach($dataMañana AS $value){
                echo "<tr>";
                echo "<td>".$value['nombreTarea']."</td>";
                 echo "<td><a href='../Controlador/tarea.php?accion=modificarAdmin&idTarea=".$value['idTarea']."' ><img src='img/ticket.png' width='24' height='24' /></a> </td>";
               
                echo "</tr>";
            }
            ?>
        </tbody>
            </table>
    </div>
  </div>
                  </div>  
                </div>
             </div> 
         </div> 
        <div class="col-lg-1"></div>
    </div> 
    <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-10 Formulario_Tarea">
            <h1>Nueva Tarea</h1>
            <form action="../Controlador/tarea.php" method="POST">
              <input type="hidden" name="accion" value="agregarAdmin" id="accion">
              <input type="hidden" name="idTarea" value="" id="idTarea">
              <div class="casilla_generica">
                <input type="text" class=" " id="nombreTarea" name="nombreTarea" placeholder="Nombre tarea">
              </div>
              <div class="casilla_generica">
                <input type="text" class="" id="descTarea" name="descTarea" placeholder="Descripción">
              </div>
              <div class="casilla_generica">
                <input type="date" class="" id="fechaVenc" name="fechaVenc" placeholder="Fecha vencimiento">
              </div> 
              <div class="form-group">
                <input type="hidden" class="casilla_generica" id="fechaRealizada" name="fechaRealizada">
              </div>
               <div class="form-group">
              <!--<label for="idProyecto">Proyecto:</label>-->
              <select name="idProyecto" class="selectpicker" data-style="btn-success">
                <?php 
                echo '<option value="" selected="true" disabled>'."Seleccione proyecto".'</option>';
                foreach ($data as $value) {
                    echo '<option value="'.$value['idProyecto'].'">'.$value['nombreProyecto'].'</option>';
                }?>
                </select>
              </div> 
                <div class="form-group">
              <!--<label for="idUsuario">Usuarios:</label>-->
              <select name="idUsuario" class="selectpicker" data-style="btn-success">
                <?php 
                echo '<option value="" selected="true" disabled>'."Seleccione usuario".'</option>';
                foreach ($data1 as $value) {
                    echo '<option value="'.$value['idUsuario'].'">'.$value['nick'].'</option>';
                }?>
                </select>
              </div> 
              <button type="submit" class="tarea_btn"><img class="img_AddTarea" src="img/AddTarea.png">Agregar</button>
            </form>
        </div>  
        <div class="col-lg-1"></div>
    </div>
</div>
<?php
    include('footer.inc');
}
?>