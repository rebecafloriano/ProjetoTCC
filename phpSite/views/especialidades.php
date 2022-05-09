<script src="js/jquery.js"></script>
<script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {

        $('#especialidades').DataTable({
            "language": {
            "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json"
        }
        });

    });
</script>
<h1>Especialidades</h1>
<a class="btn btn-primary" href="?pagina=inserir_especialidade">Cadastrar Especialidade</a>

<p><br></p>
<table class="table table-hover table-striped" id="especialidades">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Estrelas</th>
            <th>Preço</th>
            <th>Editar</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($linha = mysqli_fetch_array($consulta_especialidades)) {
            echo '<tr><td>' . $linha['name'] . '</td>';
            echo '<td>' . $linha['stars'] . '</td>';
            echo '<td><span>R$</span>' . $linha['price'] . '</td>';
        ?>
            <td><a class="btn btn-warning" href="?pagina=inserir_especialidade&editar=<?php echo $linha['id']; ?>">Editar</a></td>
        <?php
        }
        ?>
    </tbody>
    <br>

</table>
