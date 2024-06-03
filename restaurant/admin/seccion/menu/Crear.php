<?php 
include("../../bd.php");

if ($_POST) {
    
    $nombre=(isset($_POST["nombre"]))?$_POST["nombre"]:"";
    $ingredientes=(isset($_POST["ingredientes"]))?$_POST["ingredientes"]:"";
    $precio=(isset($_POST["Precio"]))?$_POST["Precio"]:"";
    

    $sentencia=$conexion->prepare("INSERT INTO `tbl_menu` (`id`, `nombre`, `ingredientes`, `foto`, `Precio`) VALUES (NULL, :nombre, :ingredientes, :foto, :Precio); ");
    
    $foto=(isset($_FILES["foto"]["name"]))?$_FILES["foto"]["name"]:"";
    $fecha_foto= new DateTime();
    $nombre_foto=$fecha_foto->getTimestamp()."_".$foto;
    $tmp_foto= $_FILES["foto"]["tmp_name"];
    
    if($tmp_foto!=""){
        move_uploaded_file($tmp_foto,"../../../images/menu/".$nombre_foto);
    }

    $sentencia->bindParam(":foto",$nombre_foto);
    $sentencia->bindParam(":nombre",$nombre);
    $sentencia->bindParam(":ingredientes",$ingredientes);
    $sentencia->bindParam(":Precio",$precio);
    

    $sentencia->execute();
    header("location:index.php");

}

include ("../../templates/header.php"); ?>
<br/>
<div class="card">
    <div class="card-header">Menu</div>
    <div class="card-body">

    <form action="" method="post" enctype="multipart/form-data">

    <div class="mb-3">
        <label for="foto" class="form-label">Foto:</label>
        <input
            type="file"
            class="form-control"
            name="foto"
            id="foto"
            placeholder=""
            aria-describedby="fileHelpId"/>
    </div>
    

    <div class="mb-3">
        <label for="" class="form-label">Plato:</label>
        <input
            type="text"
            class="form-control"
            name="nombre"
            id="nombre"
            aria-describedby="helpId"
            placeholder="Escriba el nombre del plato"/>
    </div>

    <div class="mb-3">
        <label for="ingredientes" class="form-label">Ingredientes:</label>
        <input
            type="text"
            class="form-control"
            name="ingredientes"
            id="ingredientes"
            aria-describedby="helpId"
            placeholder="Escriba los ingredientes del plato"/>
    </div>
    
    <div class="mb-3">
        <label for="Precio" class="form-label">Precio:</label>
        <input
            type="text"
            class="form-control"
            name="Precio"
            id="Precio"
            aria-describedby="helpId"
            placeholder="Escriba el precio "/>
    </div>

    
    <button type="submit" class="btn btn-success">Crear Plato Menu</button>
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

<?php include ("../../templates/footer.php"); ?>