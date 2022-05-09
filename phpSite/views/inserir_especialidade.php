<?php if (!isset($_GET['editar'])) { ?>

    <?php
    if (!isset($_SESSION)) {
        session_start();
    }
    ?>

    <h1>Cadastrar Especialidade</h1>
    <?php
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    ?>

    <form method="post" action="processa_insert_especialidade.php">
        <br>

        <label class="badge bg-secondary">Nome Especialidade</label><br>
        <input class="form-control" type="text" name="name" placeholder="nome da Especialidade">
        <br><br>
        <label class="badge bg-secondary">Preço</label><br>
        <input class="form-control" type="text" name="price" placeholder="preço da consulta">
        <br><br>
        <input class="btn btn-success" type="submit" value="Cadastrar">
    </form>

<?php } else { ?>
    <?php while ($linha = mysqli_fetch_array($consulta_especialidades)) { ?>
        <?php if ($linha['id'] == $_GET['editar']) { ?>

            <h1>Editar Especialidade</h1>

            <?php
            if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
            ?>

            <form method="post" action="edita_especialidade.php">
                <br>
                <input type="hidden" name="id" value="<?php echo $linha['id']; ?>">
                <label class="badge bg-secondary">Nome Especialidade</label><br>
                <input class="form-control" type="text" name="name" value="<?php echo $linha['name']; ?>" placeholder="nome da Especialidade">
                <br><br>
                <label class="badge bg-secondary">Preço</label><br>
                <input class="form-control" type="text" name="price" value="<?php echo $linha['price']; ?>" placeholder="preço da consulta">
                <br><br>
                <input class="btn btn-success" type="submit" value="Cadastrar">
            </form>

        <?php } ?>
    <?php } ?>
<?php } ?>
