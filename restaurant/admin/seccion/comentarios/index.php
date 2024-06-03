<?php 
include("../../bd.php");

if (isset($_GET['txtID'])) {
    
    $txtID=(isset($_GET["txtID"]))?$_GET["txtID"]:"";

    $sentencia=$conexion->prepare("DELETE FROM `tbl_comentarios` WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    header("location:index.php");
}

$sentencia=$conexion->prepare("SELECT * FROM `tbl_comentarios`");
$sentencia->execute();
$lista_comentarios=$sentencia->fetchAll(PDO::FETCH_ASSOC);

include ("../../templates/header.php");
?>
<br/>
<div class="card">
    <div class="card-header">Comentarios</div>

    <div class="card-body">

    <div
        class="table-responsive-sm"
    >
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Mensaje</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>                
                    <?php foreach ($lista_comentarios as $comentarios) { ?>
                        <tr class="">
                        <td><?php echo $comentarios['id']; ?></td>
                        <td><?php echo $comentarios['nombre']; ?></td>
                        <td><?php echo $comentarios['correo']; ?></td>
                        <td><?php echo $comentarios['mensaje']; ?></td>
                        <td>
                            <a name="" id="" class="btn btn-info" href="editar.php?txtID=<?php echo $comentarios['id']; ?>" role="button">Editar</a>
                            <a name="" id="" class="btn btn-danger" href="Index.php?txtID=<?php echo $comentarios['id']; ?>" role="button">Borrar</a>                        
                        </td>
                        </tr>
                    <?php } ?>
                
            </tbody>
        </table>
    </div>
    
    
    </div>
    <div class="card-footer text-muted"></div>
</div>


<?php include ("../../templates/footer.php"); ?>