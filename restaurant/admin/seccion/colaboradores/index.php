<?php 
include("../../bd.php");

if (isset($_GET['txtID'])) {
    
    $txtID=(isset($_GET["txtID"]))?$_GET["txtID"]:"";

    $sentencia=$conexion->prepare("SELECT * FROM `tbl_colaboradores` WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();

    $registro_foto=$sentencia->fetch(PDO::FETCH_LAZY);

    if (isset($registro_foto['foto'])) {
        if(file_exists("../../../images/colaboradores/".$registro_foto['foto'])){
            unlink("../../../images/colaboradores/".$registro_foto['foto']);
        }
    }

    $sentencia=$conexion->prepare("DELETE FROM `tbl_colaboradores` WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    header("location:index.php");
}
$sentencia=$conexion->prepare("SELECT * FROM `tbl_colaboradores` ");
$sentencia->execute();
$lista_colaboradores=$sentencia->fetchAll(PDO::FETCH_ASSOC);

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
        <table
            class="table table-light"
        >
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nombre Chef</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Info Chef</th>
                    <th scope="col">Redes Sociales</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($lista_colaboradores as $key => $value) { ?>
                <tr class="">
                    <td scope="row"><?php echo $value['id']; ?></td>
                    <td><?php echo $value['titulo']; ?></td>
                    <td>
                        <img src="../../../images/colaboradores/<?php echo $value['foto']; ?> " width="50" alt="" srcset="">    
                    </td>
                    <td><?php echo $value['descripcion']; ?></td>
                    <td>
                        <?php echo $value['linkfacebook']; ?><br/>
                        <?php echo $value['linkinstagram']; ?><br/>
                        <?php echo $value['linklinkedin']; ?>
                        </td>
                    <td>                        
                        <a name="" id="" class="btn btn-info" href="editar.php?txtID=<?php echo $value['id']; ?>" role="button">Editar</a>
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