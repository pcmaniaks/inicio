<?php 

require 'config/productos_config.php';
include "navs/navbar.php";

?>


<!--Ejemplo tabla con DataTables-->
<div class="container">

    
        
<form action="" method="post" enctype="multipart/form-data">
                <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby=exampleModal>
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Nuevos Productos</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                                <div class="modal-body">
                                <div class="form-row">
                                    <input type="hidden" required name="txtID" value="<?php echo $txtID ?>" placeholder="" id="txtID" require="">
                                    <br>
                                    <div class="form-group col-md-4">
                                    <label for="">Nombre:</label>
                                    <input type="text" class="form-control" <?php echo (isset($error['Nombre']))?"is-invalid":""; ?> name="txtNombre" required value="<?php echo $txtNombre ?>" placeholder="" id="txtNombre" require="">
                                    <div class="invalid-feedback">
                                    <?php echo (isset($error['Nombre']))?"is-invalid":""; ?>
                                    </div>
                                    <br>
                                    </div>
                                    <div class="form-group col-md-4">
                                    <label for="">Marca:</label>
                                    <input type="text" class="form-control" <?php echo (isset($error['Marca']))?"is-invalid":""; ?> name="txtMarca" required value="<?php echo $txtMarca ?>" placeholder="" id="txtMarca" require="">
                                    <div class="invalid-feedback">
                                    <?php echo (isset($error['Marca']))?"is-invalid":""; ?>
                                    </div>
                                    <br>
                                    </div>
                                    <div class="form-group col-md-4">
                                    <label for="">Modelo:</label>
                                    <input type="text" class="form-control" <?php echo (isset($error['Modelo']))?"is-invalid":""; ?> name="txtModelo" required value="<?php echo $txtModelo ?>" placeholder="" id="txtModelo" require="">
                                    <div class="invalid-feedback">
                                    <?php echo (isset($error['Modelo']))?"is-invalid":""; ?>
                                    </div>
                                    <br>
                                    </div>
                                    <div class="form-group col-md-12">
                                    <label for="">Descripcion:</label>
                                    <input type="text" class="form-control" name="txtDescripcion" required value="<?php echo $txtDescripcion ?>" placeholder="" id="txtDescripcion" require="">
                                    <br>
                                    </div>
                                    <div class="form-group col-md-12">
                                    <label for="">Cantidad:</label>
                                    <input type="text" class="form-control" name="txtCantidad" required value="<?php echo $txtCantidad ?>" placeholder="" id="txtCantidad" require="">
                                    <br>
                                    </div>
                                    <div class="form-group col-md-12">
                                    <label for="">Precio:</label>
                                    <input type="text" class="form-control" name="txtPrecio" required value="<?php echo $txtPrecio ?>" placeholder="" id="txtPrecio" require="">
                                    <br>
                                    </div>
                                    <div class="form-group col-md-12">
                                    <label for="">Foto:</label>
                                    <?php if($txtFoto!=""){?>
                                    <br/>
                                    <img src="ImgProduc/<?php echo $txtFoto?>" width="100px" class="img-thumbnail rounded mx-auto d-block">
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
   
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal1">
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
                        <th>Nombres</th>
                        <th>Descipcion</th>
                        <th>Modelo</th>
                        <th>Marca</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Acciones</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($listaProductos as $productos){ ?>
                    <tr>
                        <td><img class="img" height="150px" width="150x" src="ImgProduc/<?php echo $productos['Foto']; ?>" alt=""> </td>
                        <td><?php echo $productos['Nombre']; ?></td>
                        <td><?php echo $productos['Descripcion']; ?></td>
                        <td><?php echo $productos['Modelo']; ?></td>
                        <td><?php echo $productos['Marca']; ?></td>
                        <td><?php echo $productos['Cantidad']; ?></td>
                        <td>$<?php echo $productos['Precio']; ?> MXN</td> 
                        <td>
                            <form action="" method="post">
                
                                <input type="hidden" name="txtID" value="<?php echo $productos['ID']; ?>">
                                
                                <input type="submit" value="Seleccionar" class="btn btn-info" name="accion">
                                
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
include "navs/footer.php";
?>