<?php 
require 'config/empleados.php';
include "navs/navbar.php";
?>

    <!--Ejemplo tabla con DataTables-->
    <div class="container">

    
        
        <form action="" method="post" enctype="multipart/form-data">
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby=exampleModal>
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Nuevos Empleados</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                                <div class="modal-body">
                                <div class="form-row">
                                    <input type="hidden" required name="txtID" value="<?php echo $txtID ?>" placeholder="" id="txtID" require="">
                                    <br>
                                    <div class="form-group col-md-4">
                                    <label for="">Nombre(s):</label>
                                    <input type="text" class="form-control" <?php echo (isset($error['Nombre']))?"is-invalid":""; ?> name="txtNombre" required value="<?php echo $txtNombre ?>" placeholder="" id="txtNombre" require="">
                                    <div class="invalid-feedback">
                                    <?php echo (isset($error['Nombre']))?"is-invalid":""; ?>
                                    </div>
                                    <br>
                                    </div>
                                    <div class="form-group col-md-4">
                                    <label for="">Apellido Paterno:</label>
                                    <input type="text" class="form-control" <?php echo (isset($error['ApellidoP']))?"is-invalid":""; ?> name="txtApellidoP" required value="<?php echo $txtApellidoP ?>" placeholder="" id="txtApellidoP" require="">
                                    <div class="invalid-feedback">
                                    <?php echo (isset($error['ApellidoP']))?"is-invalid":""; ?>
                                    </div>
                                    <br>
                                    </div>
                                    <div class="form-group col-md-4">
                                    <label for="">Apellido Materno:</label>
                                    <input type="text" class="form-control" <?php echo (isset($error['ApellidoM']))?"is-invalid":""; ?> name="txtApellidoM" required value="<?php echo $txtApellidoM ?>" placeholder="" id="txtApellidoM" require="">
                                    <div class="invalid-feedback">
                                    <?php echo (isset($error['ApellidoM']))?"is-invalid":""; ?>
                                    </div>
                                    <br>
                                    </div>
                                    <div class="form-group col-md-12">
                                    <label for="">Correo:</label>
                                    <input type="email" class="form-control" name="txtCorreo" required value="<?php echo $txtCorreo ?>" placeholder="" id="txtCorreo" require="">
                                    <br>
                                    </div>
                                    <div class="form-group col-md-12">
                                    <label for="">Foto:</label>
                                    <?php if($txtFoto!=""){?>
                                    <br/>
                                    <img src="Imagenes/<?php echo $txtFoto?>" width="100px" class="img-thumbnail rounded mx-auto d-block">
                                    <?php } ?>

                                    <input type="file" class="form-control" accept="image/*" name="txtFoto"  value="<?php echo $txtFoto ?>" placeholder="" id="txtFoto" require="">
                                    <br>
                                    </div>
                                </div>    
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-success" value="btnAgregar" <?php echo $accionAgregar; ?> type="submit" name="accion">Agregar</button>
                                    <button class="btn btn-warning" value="btnModificar" <?php echo $accionModificar; ?> type="submit" name="accion">Modificar</button>
                                    <button class="btn btn-danger" value="btnEliminar" onclick="return Confirmar('¿Realmente deseas borrar?');" <?php echo $accionEliminar; ?> type="submit" name="accion">Eliminar</button>
                                    <button class="btn btn-primary" value="btnCancelar" <?php echo $accionCancelar; ?> type="submit" name="accion">Cancelar</button>
                                </div>
                        </div>
                    </div>           
                </div>
        <br>
   
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Agregar Nuevo
        </button>        <!-- Modal -->
        
                      
        </form>
        <br>
        
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>Nombre Completo</th>
                                <th>Correo</th>
                                <th>Acciones</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($listaEmpleados as $empleado){ ?>
                            <tr>
                                <td><img class="img-thumbnail" width="100px" src="Imagenes/<?php echo $empleado['Foto']; ?>" alt=""> </td>
                                <td><?php echo $empleado['Nombre']; ?><?php echo $empleado['ApellidoP']; ?><?php echo $empleado['ApellidoM']; ?></td>
                                <td><?php echo $empleado['Correo']; ?></td>
                                <td>
                                    <form action="" method="post">
                        
                                        <input type="hidden" name="txtID" value="<?php echo $empleado['ID']; ?>">
                                        
                                        <input type="submit" value="Seleccionar" class="btn btn-info" name="accion">
                                        <button value="btnEliminar" onclick="return Confirmar('¿Realmente deseas borrar?');" type="submit" class="btn btn-danger" name="accion">Eliminar</button>
                                    </form>
                                </td>
                                
                            </tr>
                            
                        </tbody>  
                        <?php }?>      
                       </table>                  
                    </div>
                    
                </div>
        </div>  
        
<script>
    function Confirmar(Mensaje){
        return (confirm(Mensaje))?true:false;
    }
</script>
    </div>    
    
<?php
include 'navs/footer.php';
?>  