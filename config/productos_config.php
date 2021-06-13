<?php
$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
$txtDescripcion=(isset($_POST['txtDescripcion']))?$_POST['txtDescripcion']:"";
$txtModelo=(isset($_POST['txtModelo']))?$_POST['txtModelo']:"";
$txtMarca=(isset($_POST['txtMarca']))?$_POST['txtMarca']:"";
$txtCantidad=(isset($_POST['txtCantidad']))?$_POST['txtCantidad']:"";
$txtPrecio=(isset($_POST['txtPrecio']))?$_POST['txtPrecio']:"";
$txtFoto=(isset($_FILES['txtFoto']["name"]))?$_FILES['txtFoto']["name"]:"";

$accion=(isset($_POST['accion']))?$_POST['accion']:"";

$error=array();

$accionAgregar="";
$accionModificar=$accionEliminar=$accionCancelar="disabled";
$mostrarModal=false;
include ("conexion/conexion.php");

    switch($accion){
        case "btnAgregar":

            if($txtNombre==""){
                $error['Nombre']="Escribe el Nombre";
            }
            if(count($error)>0){
                $mostrarModal=true;
                break;
            }

            $sentencia=$pdo->prepare("INSERT INTO productos(Nombre,Descripcion,Modelo,Marca,Cantidad,Precio,Foto) 
            values (:Nombre,:Descripcion,:Modelo,:Marca,:Cantidad,:Precio,:Foto)");

            $sentencia->bindParam(':Nombre',$txtNombre);
            $sentencia->bindParam(':Descripcion',$txtDescripcion);
            $sentencia->bindParam(':Modelo',$txtModelo);
            $sentencia->bindParam(':Marca',$txtMarca);
            $sentencia->bindParam(':Cantidad',$txtCantidad);
            $sentencia->bindParam(':Precio',$txtPrecio);

            $Fecha= new DateTime();
            $nombreArchivo=($txtFoto!="")?$Fecha->getTimestamp()."_".$_FILES["txtFoto"]["name"]:"imagen.jpg";

            $tmpFoto= $_FILES["txtFoto"]["tmp_name"];
            
            if($tmpFoto!=""){
                move_uploaded_file($tmpFoto,"ImgProduc/".$nombreArchivo);
            }
            $sentencia->bindParam(':Foto',$nombreArchivo);
            $sentencia->execute();
            header('Location: productos.php');

        break;
        case "btnModificar":
            $sentencia=$pdo->prepare("UPDATE productos SET 
            Nombre=:Nombre,
            Descripcion=:Descripcion,
            Modelo=:Modelo,
            Marca=:Marca,
            Cantidad=:Cantidad,
            Precio=:Precio WHERE
            id=:id"); 
            

            $sentencia->bindParam(':Nombre',$txtNombre);
            $sentencia->bindParam(':Descripcion',$txtDescripcion);
            $sentencia->bindParam(':Modelo',$txtModelo);
            $sentencia->bindParam(':Marca',$txtMarca);
            $sentencia->bindParam(':Cantidad',$txtCantidad);
            $sentencia->bindParam(':Precio',$txtPrecio);
            
            $sentencia->bindParam(':id',$txtID);
            $sentencia->execute();

            $Fecha= new DateTime();
            $nombreArchivo=($txtFoto!="")?$Fecha->getTimestamp()."_".$_FILES["txtFoto"]["name"]:"imagen.jpg";

            $tmpFoto= $_FILES["txtFoto"]["tmp_name"];
            
            if($tmpFoto!=""){
                move_uploaded_file($tmpFoto,"ImgProduc/".$nombreArchivo);

                $sentencia=$pdo->prepare("SELECT Foto FROM productos WHERE id=:id");  
                $sentencia->bindParam(':id',$txtID);
                $sentencia->execute();
                $productos=$sentencia->fetch(PDO::FETCH_LAZY);
                print_r($productos);

            if(isset($productos["Foto"])){
                if(file_exists("ImgProduc/".$productos["Foto"])){
                    if($productos['Foto']!="imagen.jpg"){
                    unlink("ImgProduc/".$productos["Foto"]);
                    }
                }
            }
                $sentencia=$pdo->prepare("UPDATE productos SET Foto=:Foto WHERE id=:id");

            $sentencia->bindParam(':Foto',$nombreArchivo);                        
            $sentencia->bindParam(':id',$txtID);
            $sentencia->execute();
            }

            


            header('Location: productos.php');
        break;
        case "btnEliminar":

            $sentencia=$pdo->prepare("DELETE FROM productos WHERE id=:id");  
            $sentencia->bindParam(':id',$txtID);
            $sentencia->execute();
            $productos=$sentencia->fetch(PDO::FETCH_LAZY);
            print_r($productos);

            if(isset($productos["Foto"])&&($productos['Foto']!="imagen.jpg")){
                if(file_exists("ImgProduc/".$productos["Foto"])){
                    unlink("ImgProduc/".$productos["Foto"]);
                }
            }

            
            $sentencia=$pdo->prepare("DELETE FROM productos WHERE id=:id");  
            $sentencia->bindParam(':id',$txtID);
            $sentencia->execute();

            header('Location: productos.php');
            
        break;
        case "btnCancelar":
            header('Location: productos.php');
        break;
        case "Seleccionar":
            $accionAgregar="disabled";
            $accionModificar=$accionEliminar=$accionCancelar="";
            $mostrarModal=true;

            $sentencia=$pdo->prepare("SELECT * FROM productos WHERE id=:id");  
            $sentencia->bindParam(':id',$txtID);
            $sentencia->execute();
            $productos=$sentencia->fetch(PDO::FETCH_LAZY);

            $txtNombre=$productos['Nombre'];
            $txtDescripcion=$productos['Descripcion'];
            $txtModelo=$productos['Modelo'];
            $txtMarca=$productos['Marca'];
            $txtCantidad=$productos['Cantidad'];
            $txtPrecio=$productos['Precio'];
            $txtFoto=$productos['Foto'];
        break;
    }

    $sentencia= $pdo->prepare("SELECT * FROM productos WHERE 1");
    $sentencia->execute();
    $listaProductos=$sentencia->fetchAll(PDO::FETCH_ASSOC);

    

?>