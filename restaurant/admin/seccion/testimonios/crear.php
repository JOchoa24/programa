<?php 
include("../../bd.php");

if ($_POST) {
    
    $opinion=(isset($_POST["opinion"]))?$_POST["opinion"]:"";
    $nombre=(isset($_POST["nombre"]))?$_POST["nombre"]:"";

    $sentencia=$conexion->prepare("INSERT INTO `tbl_testimonios` (`id`, `opinion`, `nombre`) VALUES (NULL, :opinion, :nombre); ");

    $sentencia->bindParam(":opinion",$opinion);
    $sentencia->bindParam(":nombre",$nombre);

    $sentencia->execute();
    header("location:index.php");

}

include ("../../templates/header.php"); ?>
<br/>
<div class="card">
    <div class="card-header">Testimonios</div>
    <div class="card-body">
    
    <form action="" method="post">

    <div class="mb-3">
        <label for="" class="form-label">Opinión:</label>
        <input
            type="text"
            class="form-control"
            name="opinion"
            id="opinion"
            aria-describedby="helpId"
            placeholder="Escriba su opinión"/>
    </div>

    <div class="mb-3">
        <label for="descripcion" class="form-label">Nombre:</label>
        <input
            type="text"
            class="form-control"
            name="Nombre"
            id="Nombre"
            aria-describedby="helpId"
            placeholder="Escriba su nombre"/>
    </div>
        
    <button type="submit" class="btn btn-success">Crear Testimonio</button>
    <a
        name=""
        id=""
        class="btn btn-primary"
        href="index.php"
        role="button"
        >Cancelar</a
    >
    
    

    </form>

    </div>
    <div class="card-footer text-muted">

    </div>
</div>

<?php include ("../../templates/footer.php"); ?>