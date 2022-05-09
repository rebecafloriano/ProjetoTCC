<?php
$query = "SELECT * FROM services ORDER BY name ASC";
$consulta_service_horario = mysqli_query($conn, $query);

?>

<h1>Cadastrar Horário</h1>

<?php
if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
?>


<form method="post" action="processa_insert_horario.php">
    <br>

    <select class="form-control" name="id_service">
        <option>Escolha a especialidade</option><?php while ($service = mysqli_fetch_array($consulta_service_horario)) { ?> <option value="<?php echo $service['id'] ?>"><?php echo $service['name'] ?></option> <?php } ?>
    </select>
    <br><br>

    <select class="form-control" name="weekday" aria-label="Default select example">
        <option selected>Escolha o dia da semana</option>
        <option value="0">Domingo</option>
        <option value="1">Segunda-feira</option>
        <option value="2">Terça-feira</option>
        <option value="3">Quarta-feira</option>
        <option value="4">Quinta-feira</option>
        <option value="5">Sexta-feira</option>
        <option value="6">Sábado</option>
    </select>
    <br><br>

    <div class="form-check">
        <label class="badge bg-secondary">Insira os horários:</label><br><br>
        <input class="form-check-input" type="checkbox" value="07:00" name="hours[]" id="flexCheckDefault">
        <label class="form-check-label" for="flexCheckDefault">
            07:00
        </label>
        <input class="form-check-input" type="checkbox" value="14:00" name="hours[]" id="flexCheckChecked">
        <label class="form-check-label" for="flexCheckChecked">
            14:00
        </label>

    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="08:00" name="hours[]" id="flexCheckChecked">
        <label class="form-check-label" for="flexCheckChecked">
            08:00
        </label>
        <input class="form-check-input" type="checkbox" value="15:00" name="hours[]" id="flexCheckChecked">
        <label class="form-check-label" for="flexCheckChecked">
            15:00
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="09:00" name="hours[]" id="flexCheckChecked">
        <label class="form-check-label" for="flexCheckChecked">
            09:00
        </label>
        <input class="form-check-input" type="checkbox" value="16:00" name="hours[]" id="flexCheckChecked">
        <label class="form-check-label" for="flexCheckChecked">
            16:00
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="10:00" name="hours[]" id="flexCheckChecked">
        <label class="form-check-label" for="flexCheckChecked">
            10:00
        </label>
        <input class="form-check-input" type="checkbox" value="17:00" name="hours[]" id="flexCheckChecked">
        <label class="form-check-label" for="flexCheckChecked">
            17:00
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="11:00" name="hours[]" id="flexCheckChecked">
        <label class="form-check-label" for="flexCheckChecked">
            11:00
        </label>
        <input class="form-check-input" type="checkbox" value="18:00" name="hours[]" id="flexCheckChecked">
        <label class="form-check-label" for="flexCheckChecked">
            18:00
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="12:00" name="hours[]" id="flexCheckChecked">
        <label class="form-check-label" for="flexCheckChecked">
            12:00
        </label>
        <input class="form-check-input" type="checkbox" value="19:00" name="hours[]" id="flexCheckChecked">
        <label class="form-check-label" for="flexCheckChecked">
            19:00
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="13:00" name="hours[]" id="flexCheckChecked">
        <label class="form-check-label" for="flexCheckChecked">
            13:00
        </label>
        <input class="form-check-input" type="checkbox" value="20:00" name="hours[]" id="flexCheckChecked">
        <label class="form-check-label" for="flexCheckChecked">
            20:00
        </label>
    </div>


    <br><br>
    <input class="btn btn-success" type="submit" value="Cadastrar">
</form>
