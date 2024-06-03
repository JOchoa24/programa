<?php 
include("../../bd.php");

if (isset($_GET['txtID'])) {
    
    $txtID=(isset($_GET["txtID"]))?$_GET["txtID"]:"";

    $sentencia=$conexion->prepare("DELETE FROM `tbl_usuarios` WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    header("location:index.php");
}
$sentencia=$conexion->prepare("SELECT * FROM `tbl_usuarios` ");
$sentencia->execute();
$lista_usuarios=$sentencia->fetchAll(PDO::FETCH_ASSOC);


include ("../../templates/header.php");
?>
<br>
<div class="card">
    <div class="card-header">
    <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar Registros</a>
    </div>
    <div class="card-body">
    
<div
    class="table-responsive-sm"
>
    <table
        class="table "
    >
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Usuario</th>
                <th scope="col">Password</th>
                <th scope="col">Correo</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <?php foreach ($lista_usuarios as $key => $value) { ?>
                <tr class="">
                    <td scope="row"><?php echo $value['id']; ?></td>
                    <td><?php echo $value['nombre']; ?></td>
                    <td>******</td>
                    <td><?php echo $value['correo']; ?></td>
                    <td>                        
                        <a name="" id="" class="btn btn-danger" href="Index.php?txtID=<?php echo $value['id']; ?>" role="button">Borrar</a>                        
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