<?php 
session_start();
session_destroy();
header("Location: http://localhost/restaurant/");
echo "Salir...cerrar sesión";
?>