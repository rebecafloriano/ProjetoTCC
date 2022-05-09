<?php

$servidor = "localhost";
$usuario = "root";
$senha = "";
$dbname = "tcc-unigran1";

//Criar conexão
$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);


$query = "SELECT * FROM users WHERE admin = 0
ORDER BY name";
$consulta_pacientes = mysqli_query($conn, $query);

$query = "SELECT * FROM users WHERE admin = 1
ORDER BY name";
$consulta_admin = mysqli_query($conn, $query);

$query = "SELECT * FROM services
 ORDER BY name";
$consulta_especialidades = mysqli_query($conn, $query);

$query = "SELECT services.name, serviceavailability.weekday, serviceavailability.hours, serviceavailability.id FROM services, serviceavailability WHERE serviceavailability.id_service = services.id
ORDER BY services.name,serviceavailability.weekday ";
$consulta_horarios = mysqli_query($conn, $query);

// inserir_horario
$query = "SELECT * FROM services
 ORDER BY name";
$consulta_service_horario = mysqli_query($conn, $query);
