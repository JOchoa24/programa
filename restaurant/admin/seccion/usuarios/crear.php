<?php 
include("../../bd.php");

if ($_POST) {
    
    $nombre=(isset($_POST["nombre"]))?$_POST["nombre"]:"";
    $password=(isset($_POST["password"]))?$_POST["password"]:"";
    $password= md5($password);
    $correo=(isset($_POST["correo"]))?$_POST["correo"]:"";

    $sentencia=$conexion->prepare("INSERT INTO `tbl_usuarios` (`id`, `nombre`, `password`, `correo`) VALUES (NULL, :nombre, :password, :correo); ");

    $sentencia->bindParam(":nombre",$nombre);
    $sentencia->bindParam(":password",$password);
    $sentencia->bindParam(":correo",$correo);

    $sentencia->execute();
    header("location:index.php");

}

include ("../../templates/header.php"); ?>
<br/>
<div class="card">
    <div class="card-header">Crear Usuarios</div>
    <div class="card-body">
    
    <form action="" method="post">

    <div class="mb-3">
        <label for="" class="form-label">Usuarios:</label>
        <input
            type="text"
            class="form-control"
            name="nombre"
            id="nombre"
            aria-describedby="helpId"
            placeholder="Escriba su usuario"/>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Password:</label>
        <input
            type="password"
            class="form-control"
            name="password"
            id="password"
            placeholder="Escriba la contraseña"/>
    </div>
    
    <div class="mb-3">
        <label for="correo" class="form-label">Correo</label>
        <input
            type="text"
            class="form-control"
            name="correo"
            id="correo"
            aria-describedby="helpId"
            placeholder="Escriba su correo"/>
        
    </div>
    
    <button type="submit" class="btn btn-success">Crear Usuario</button>
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