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
                <input placeholder="Insira novamente sua senha" id="confirmacaoSenha" type="password" class="validate" name="senha">
                <label for="confirmacaoSenha">Confirmação Senha</label>
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
        "confirmacaoSenha": $("#confirmacaoSenha").val(),
        "nome": $("#nome").val(),
        "curso": $("#curso").val(),
        "anoDeIngresso": $("#anoDeIngresso").val(),
        "miniCurriculo": $("#minicurriculo").val(),
    };

    event.preventDefault();
    $.ajax({
        type: "POST",
        url: "http://projeto/Estagiario/register",
        data: data,
        dataType: 'json',
        success: function(data) {
            console.log(data);
            /*
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
            }*/

        },
        error: function() {
            alert('Error occured');
        }
    });
});
</script>

<!--JavaScript at end of body for optimized loading-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>

</html>