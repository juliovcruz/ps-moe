<?php 
include_once 'header.php';
?>

<div class="card-panel teal lighten-2 white-text" id="sucesso" style="display:none;">Registro feito com sucesso!</div>

<div class="card-panel red lighten-2" id="erro" style="display:none;"></div>

<div class="row" style="padding-right: 200px;">
    <form action="../controller/estagiario.php" method="POST" class="col s12 m6 push-m4" style="margin-top: 50px;">
        <div class="row">
            <h3 class="light col s6 push-m3" style="margin-bottom: 50px">Registrar Estagiário</h3>
        </div>
        <div class="row">
            <div class="input-field col s6 push-m3">
                <input placeholder="Insira o seu email" id="email" type="text" class="validate" name="email">
                <label for="email">Email</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6 push-m3">
                <input placeholder="Insira sua senha" id="senha" type="password" class="validate" name="senha">
                <label for="senha">Senha</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6 push-m3">
                <input placeholder="Insira o seu nome" id="nome" type="text" class="validate" name="nome">
                <label for="nome">Nome</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6 push-m3">
                <input placeholder="Insira seu curso" id="curso" type="text" class="validate" name="curso">
                <label for="curso">Curso</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6 push-m3">
                <input placeholder="Insira o seu ano de ingresso" id="anoDeIngresso" type="text" class="validate"
                    name="anoDeIngresso">
                <label for="anoDeIngresso">Ano de ingresso</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6 push-m3">
                <textarea id="minicurriculo" class="materialize-textarea" name="minicurriculo"></textarea>
                <label for="minicurriculo" type="text" class="validate">Minicurrículo</label>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m6 push-m7">
                <button type="submit" class="btn" id="btnRegistro" name="btnRegistro">Criar</button>
                <input type="hidden" name="action" value="cadastrarEstagiario" />
            </div>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<script>
$("#btnRegistro").click(function(event) {

    var data = {
        "email": $("#email").val(),
        "senha": $("#senha").val(),
        "nome": $("#nome").val(),
        "curso": $("#curso").val(),
        "anoDeIngresso": $("#anoDeIngresso").val(),
        "minicurriculo": $("#minicurriculo").val(),
        "action": "cadastrarEstagiario",
    };

    event.preventDefault();
    $.ajax({
        type: "POST",
        url: "../controller/estagiario.php",
        data: data,
        dataType: 'json',
        success: function(data) {
            if (data.sucesso == false) {
                var msgErro = "<h6><b>Registro não foi possível:</b></h6> </br>" + "<li>" + data.mensagem;
                $("#erro").html(msgErro);
                $('#erro').show();

                var divErro = $('#erro');
                $('html').scrollTop(divErro.offset().top);
                $('html').scrollLeft(divErro.offset().left);
            }

            if (data.sucesso == true) {
                $('#erro').hide();
                $('#sucesso').show();
                var divSucesso = $('#sucesso');
                $('html').scrollTop(divSucesso.offset().top);
                $('html').scrollLeft(divSucesso.offset().left);

                $("body").fadeOut(3000, function() {
                    window.location.href = "../view/login.php"
                })
            }

        },
        error: function() {
            alert('Error occured');
        }
    });
});
</script>

<?php 
include_once 'footer.php';
?>