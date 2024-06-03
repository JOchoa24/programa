<?php

$servidor="localhost";
$baseDatos="restaurante";
$usuario="root";
$clave="";
try {
    $conexion= new PDO("mysql:host=$servidor;dbname=$baseDatos", $usuario, $clave,);
} catch (Exception $error) {
    echo $error->getMessage();
}
?>