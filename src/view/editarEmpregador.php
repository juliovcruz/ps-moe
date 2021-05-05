<?php
session_start();
if( !isset($_SESSION['logado']) ){
    header('Location: login.php');
}

include_once 'header.php';
require_once ('../models/empregador.php');
$empregador = unserialize($_SESSION['empregador']);

include_once 'header.php';
?>

    <div class="card-panel teal lighten-2 white-text" id="sucesso" style="display:none;">Dados alterados com sucesso!</div>

    <div class="card-panel red lighten-2" id="erro" style="display:none;"></div>

    <div class="row" style="padding-right: 200px;">
        <form action="../controller/empregador.php" method="POST" class="col s12 m6 push-m4" style="margin-top: 100px;" id="empregadorForm">
            <div class="row">
                <h3 class="light col s6 push-m3" style="margin-bottom: 50px">Alterar Dados</h3>
            </div>
            <div class="row">
                <div class="input-field col s6 push-m3">
                    <input placeholder="Insira o seu email" id="email" type="text" class="validate" name="email" value="<?php echo $empregador->email ?>">
                    <label for="email">Email</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6 push-m3">
                    <input placeholder="Insira o nome do responsável" id="nomeDoResponsavel" type="text" class="validate" name="nomeDoResponsavel" value="<?php echo $empregador->nomeDoResponsavel ?>">
                    <label for="nomeDoResponsavel">Nome do Responsável</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6 push-m3">
                    <input placeholder="Insira o nome da empresa" id="nomeDaEmpresa" type="text" class="validate" name="nomeDaEmpresa" value="<?php echo $empregador->nomeDaEmpresa ?>">
                    <label for="nomeDaEmpresa">Nome da Empresa</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6 push-m3">
                    <textarea id="descricao" class="materialize-textarea" name="descricao"><?php echo $empregador->descricao ?></textarea>
                    <label for="descricao" type="text" class="validate">Descrição</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6 push-m3">
                    <textarea id="produtos" class="materialize-textarea" name="produtos"><?php echo $empregador->produtos ?></textarea>
                    <label for="produtos" type="text" class="validate">Produtos</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6 push-m3">
                    <input placeholder="Insira sua senha atual" id="senhaAtual" type="password" class="validate" name="senhaAtual">
                    <label for="senhaAtual">Senha Atual</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6 push-m3">
                    <input placeholder="Insira sua nova senha" id="senhaNova" type="password" class="validate" name="senhaNova">
                    <label for="senhaNova">Nova Senha</label>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m6 push-m7">
                    <button type="submit" class="btn" id="btnRegistro" name="btnRegistro">Editar</button>
                    <input type="hidden" name="action" value="editarEmpregador"/>
                    <input type="hidden" id="id" name="id" value="<?php echo $empregador->id ?>"/>
                    <input type="hidden" id="emailAtual" name="emailAtual" value="<?php echo $empregador->email ?>"/>
                </div>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <script>
        $("#btnRegistro").click(function(event) {

            var data = {
                "id": $("#id").val(),
                "email": $("#email").val(),
                "emailAtual": $("#emailAtual").val(),
                "senhaAtual": $("#senhaAtual").val(),
                "senhaNova": $("#senhaNova").val(),
                "nomeDoResponsavel": $("#nomeDoResponsavel").val(),
                "nomeDaEmpresa": $("#nomeDaEmpresa").val(),
                "descricao": $("#descricao").val(),
                "produtos": $("#produtos").val(),
                "action": "editarEmpregador",
            };

            event.preventDefault();
            $.ajax({
                type: "POST",
                url: "../controller/empregador.php",
                data: data,
                dataType: 'json',
                success: function(data) {
                    if (data.sucesso == false) {
                        var msgErro = "<h6><b>Atualização não foi possível:</b></h6> </br>" + "<li>" + data.mensagem;
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
                            window.location.href = "../view/dashboardEmpregador.php"
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