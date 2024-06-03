<?php 
include("../../bd.php");

if (isset($_GET['txtID'])) {
    
    $txtID=(isset($_GET["txtID"]))?$_GET["txtID"]:"";

    $sentencia=$conexion->prepare("DELETE FROM `tbl_banners` WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    header("location:index.php");
}

$sentencia=$conexion->prepare("SELECT * FROM `tbl_banners`");
$sentencia->execute();
$lista_banners=$sentencia->fetchAll(PDO::FETCH_ASSOC);

include ("../../templates/header.php");
?>
<br/>
<div class="card">
    <div class="card-header">    
    <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar Registros</a>
    
    </div>
    <div class="card-body">

    <div
        class="table-responsive-sm"
    >
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Título</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Enlace</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>                
                    <?php foreach ($lista_banners as $banner) { ?>
                        <tr class="">
                        <td><?php echo $banner['id']; ?></td>
                        <td><?php echo $banner['titulo']; ?></td>
                        <td><?php echo $banner['descripcion']; ?></td>
                        <td><?php echo $banner['link']; ?></td>
                        <td>
                            <a name="" id="" class="btn btn-info" href="editar.php?txtID=<?php echo $banner['id']; ?>" role="button">Editar</a>
                            <a name="" id="" class="btn btn-danger" href="Index.php?txtID=<?php echo $banner['id']; ?>" role="button">Borrar</a>                        
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