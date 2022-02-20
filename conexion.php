<?php

$host = 'localhost';
$user = 'root';
$password = '';
$baseDatos = 'comedor';

$conexion = mysqli_connect($host, $user, $password, $baseDatos);

mysqli_query($conexion,"SET NAMES 'utf-8'");
?>