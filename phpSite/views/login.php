<h1 style="text-align:center">Login</h1>

<form method="post" action="processa_login.php">

    <label class="badge badge-secondary">E-mail</label>
    <input type="email" name="email" placeholder="E-mail do admin" class="form-control">
    <br>
    <label class="badge badge-secondary">Senha</label>
    <input type="password" name="password" placeholder="Digite sua senha" class="form-control">

    <br>
    <input type="submit" value="Entrar" class="btn btn-success">


</form>
<br>
<?php if (isset($_GET['erro'])) { ?>

    <div class="alert alert-danger" role="alert">
        Usuário e/ou senha inválidos.
    </div>
<?php } ?>
