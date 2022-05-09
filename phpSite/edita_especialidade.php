<?php
include 'conexao.php';
$id = $_POST['id'];
$name = $_POST['name'];
$price = $_POST['price'];

$query = "UPDATE services SET name='$name', price=$price WHERE id = $id";

echo "$query";
mysqli_query($conn, $query);
