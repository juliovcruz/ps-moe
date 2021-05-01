<?php 
include_once 'header.php';
?>

<div class="card-panel teal lighten-2 white-text" id="sucesso" style="display:none;">Registro feito com sucesso!</div>

<div class="card-panel red lighten-2" id="erro" style="display:none;"></div>

<div class="row" style="padding-right: 200px;">
    <form action="../controller/empregador.php" method="POST" class="col s12 m6 push-m4" style="margin-top: 100px;" id="empregadorForm">
        <div class="row">
            <h3 class="light col s6 push-m3" style="margin-bottom: 50px">Registrar Empregador</h3>
        </div>
        <div class="row">
            <div class="input-field col s6 push-m3">
                <input placeholder="Insira o seu email" id="email" type="text" class="validate" name="email">
                <label for="email">Email</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6 push-m3">
                <input placeholder="Insira sua senha" id="senha" type="password" class="validate" name="senha">>
                <label for="senha">Senha</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6 push-m3">
                <input placeholder="Insira o nome do responsável" id="nomeDoResponsavel" type="text" class="validate" name="nomeDoResponsavel">>
                <label for="nomeDoResponsavel">Nome do Responsável</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6 push-m3">
                <input placeholder="Insira o nome da empresa" id="nomeDaEmpresa" type="text" class="validate" name="nomeDaEmpresa">>
                <label for="nomeDaEmpresa">Nome da Empresa</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6 push-m3">
                <input placeholder="Insira a descrição" id="descricao" type="text" class="validate" name="descricao">>
                <label for="descricao">Descricao</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6 push-m3">
                <input placeholder="Insira os produtos da empresa" id="produtos" type="text" class="validate" name="produtos">>
                <label for="produtos">Produtos</label>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m6 push-m7">
            <button type="submit" class="btn" id="btnRegistro" name="btnRegistro">Criar</button>
                <input type="hidden" name="action" value="cadastrarEmpregador"/>
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
        "nomeDoResponsavel": $("#nomeDoResponsavel").val(),
        "nomeDaEmpresa": $("#nomeDaEmpresa").val(),
        "descricao": $("#descricao").val(),
        "produtos": $("#produtos").val(),
        "action": "cadastrarEmpregador",
    };

    event.preventDefault();
    $.ajax({
        type: "POST",
        url: "../controller/empregador.php",
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