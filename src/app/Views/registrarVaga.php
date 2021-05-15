<!DOCTYPE html>
<html>
<head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>

<?php if (isset($validation)): ?>
    <div class="card-panel red lighten-2" id="erro" style="">
        <?= $validation->listErrors() ?>
    </div>
<?php endif; ?>

<div class="card-panel teal lighten-2 white-text" id="sucesso" style="display:none;">Registro feito com sucesso!</div>

<div class="card-panel red lighten-2" id="erro" style="display:none;"></div>

<div class="row" style="padding-right: 200px;">
    <form action="/Vaga/register" method="POST" class="col s12 m6 push-m4" style="margin-top: 100px;">
        <div class="row">
            <h3 class="light col s6 push-m3" style="margin-bottom: 50px">Registrar Vaga</h3>
        </div>
        <div class="row">
            <div class="input-field col s6 push-m3">
                <input placeholder="Insira a descricao" id="descricao" type="text" class="validate" name="descricao"
                       value="<?= set_value('descricao') ?>">
                <label for="descricao">Descrição</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6 push-m3">
                <input placeholder="Insira a lista de atividades" id="listaDeAtividades" type="text" class="validate" name="listaDeAtividades"
                       value="<?= set_value('listaDeAtividades') ?>">
                <label for="listaDeAtividades">Lista de atividades</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6 push-m3">
                <input placeholder="Insira lista de habilidades requeridas" id="listaDeHabilidadesRequeridas" type="text" class="validate" name="listaDeHabilidadesRequeridas"
                       value="<?= set_value('listaDeHabilidadesRequeridas') ?>">
                <label for="listaDeHabilidadesRequeridas">Lista de habilidades requeridas</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6 push-m3">
                <input placeholder="Insira o semestre requerido" id="semestreRequerido" type="text" class="validate" name="semestreRequerido"
                       value="<?= set_value('semestreRequerido') ?>">
                <label for="semestreRequerido">Semestre requerido</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6 push-m3">
                <input placeholder="Insira a quantidade de horas semanais" id="quantidadeDeHoras" type="text" class="validate" name="quantidadeDeHoras"
                       value="<?= set_value('quantidadeDeHoras') ?>">
                <label for="quantidadeDeHoras">Quantidade de horas</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6 push-m3">
                <input placeholder="Insira a remuneração" id="remuneracao" type="text" class="validate" name="remuneracao"
                       value="<?= set_value('remuneracao') ?>">
                <label for="remuneracao">Remuneração</label>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m6 push-m7">
                <button type="submit" class="btn" id="btnRegistro" name="btnRegistro">Criar</button>
                <input type="hidden" name="action" value="cadastrarVaga"/>
                <input type="hidden" id="empregadorID" name="empregadorID" value="empregadorID"/>
            </div>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<!--JavaScript at end of body for optimized loading-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>

</html>