<?php
if (!isset($_SESSION)) {
    session_start();
}
?>


<h1>Cadastrar Admin</h1>
<?php
if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
?>
<form method="post" action="processa_insert_admin.php">
    <br>
    <label class="badge bg-secondary">Nome:</label><br>
    <input class="form-control" type="text" name="name" placeholder="Digite aqui o nome ">
    <br>
    <label class="badge bg-secondary">E-mail:</label><br>
    <input class="form-control" type="text" name="email" placeholder="Digite aqui o e-mail">
    <br>
    <label class="badge bg-secondary">Senha:</label><br>
    <input class="form-control" type="password" name="password" placeholder="Digite aqui a senha">

    <br><br>
    <input class="btn btn-success" type="submit" value="Cadastrar">
</form>
