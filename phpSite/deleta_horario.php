<?php

include 'conexao.php';

$id =  $_GET['id'];

$query = "DELETE FROM serviceavailability WHERE id = $id";

mysqli_query($conn, $query);

header('location:index.php?pagina=horarios');
