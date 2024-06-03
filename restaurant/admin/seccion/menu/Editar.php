<?php 
include("../../bd.php");

if ($_POST) {
    
    $txtID=(isset($_POST["txtID"]))?$_POST["txtID"]:"";
    $nombre=(isset($_POST["nombre"]))?$_POST["nombre"]:"";
    $ingredientes=(isset($_POST["ingredientes"]))?$_POST["ingredientes"]:"";
    $Precio=(isset($_POST["Precio"]))?$_POST["Precio"]:"";

    $sentencia=$conexion->prepare("UPDATE `tbl_menu` 
    SET nombre=:nombre, ingredientes=:ingredientes, Precio=:Precio 
    WHERE id=:id");
    
    $sentencia->bindParam(":id",$txtID);
    $sentencia->bindParam(":nombre",$nombre);
    $sentencia->bindParam(":ingredientes",$ingredientes);
    $sentencia->bindParam(":Precio",$Precio);



    $sentencia->execute();

        //proceso para actualización de foto
        $foto=(isset($_FILES["foto"]["name"]))?$_FILES["foto"]["name"]:"";
        $tmp_foto= $_FILES["foto"]["tmp_name"];
        if ($foto!="") {
            $fecha_foto= new DateTime();
            $nombre_foto=$fecha_foto->getTimestamp()."_".$foto;
    
            move_uploaded_file($tmp_foto,"../../../images/menu/".$nombre_foto);
    
            $sentencia=$conexion->prepare("SELECT * FROM `tbl_menu` WHERE id=:id");
            $sentencia->bindParam(":id", $txtID);
            $sentencia->execute();
        
            $registro_foto=$sentencia->fetch(PDO::FETCH_LAZY);
        
            if (isset($registro_foto['foto'])) {
                if(file_exists("../../../images/menu/".$registro_foto['foto'])){
                    unlink("../../../images/menu/".$registro_foto['foto']);
                }
            }
        }

    $sentencia=$conexion->prepare("UPDATE `tbl_menu` 
    SET foto=:foto 
    WHERE id=:id");
    
    $sentencia->bindParam(":id",$txtID);
    $sentencia->bindParam(":foto",$foto);

    $sentencia->execute();

    header("location:index.php");

}

if(isset($_GET['txtID'])) {
    
    $txtID=(isset($_GET["txtID"]))?$_GET["txtID"]:"";
    $sentencia=$conexion->prepare("SELECT * FROM `tbl_menu` WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);

    //recuperacion de datos que vamos a asignar//
    $nombre=$registro["nombre"];
    $ingredientes=$registro["ingredientes"];
    $foto=$registro["foto"];

    $Precio=$registro["Precio"];

}

include ("../../templates/header.php"); 
?>

<br/>
<div class="card">
    <div class="card-header">Menu</div>
    <div class="card-body">

    <form action="" method="post" enctype="multipart/form-data">
        
    <div class="mb-3">
        <label for="txtID" class="form-label">Id:</label>
        <input
            type="text"
            class="form-control" value="<?php echo $txtID; ?>" 
            name="txtID" id="txtID" 
            aria-describedby="helpId" 
            placeholder="Escriba el ID del chef"/>   

    <div class="mb-3">
        <label for="foto" class="form-label">Foto:</label><br />
        <img width =50 src="../../../images/menu/<?php echo $foto; ?>" />
        <input
            type="file"
            class="form-control"
            name="foto"
            id="foto"
            placeholder=""
            aria-describedby="fileHelpId"/>
    </div>
    

    <div class="mb-3">
        <label for="" class="form-label">Nombre del plato:</label>
        <input
            type="text" value="<?php echo $nombre; ?>"
            class="form-control"
            name="nombre"
            id="nombre"
            aria-describedby="helpId"
            placeholder="Escriba el nombre"/>
    </div>

    <div class="mb-3">
        <label for="ingredientes" class="form-label">Ingredientes:</label>
        <input
            type="text" value="<?php echo $ingredientes; ?>"
            class="form-control"
            name="ingredientes"
            id="ingredientes"
            aria-describedby="helpId"
            placeholder="Escriba los ingredientes"/>
    </div>
    
    <div class="mb-3">
        <label for="Precio" class="form-label">Precio:</label>
        <input
            type="text" value="<?php echo $Precio; ?>"
            class="form-control"
            name="Precio"
            id="Precio"
            aria-describedby="helpId"
            placeholder="Escriba el precio"/>
    </div>
    
    <button type="submit" class="btn btn-success">Editar Menu</button>
    <a  name=""
        id=""
        class="btn btn-primary"
        href="index.php"
        role="button"
        >Cancelar</a>    

    </form>

    </div>
    <div class="card-footer text-muted">

    </div>
</div>

<?php 
include ("../../templates/footer.php"); 
?>