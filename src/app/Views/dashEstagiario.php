<!DOCTYPE html>
<html>
<?php
if(!session()->get('estagiario')) return redirect()->to('Login');
?>
<head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
    <body>
    <nav>
        <div class="nav-wrapper grey darken-3">
            <a href="#!" class="brand-logo center">  MOE</a>
            <ul class="right hide-on-med-and-down">
                <li><a href="/estagiario/dash"><i class="material-icons">home</i></a></li>
                <li><a href="/estagiario/editar"><i class="material-icons">person</i></a></li>
                <li><a href="/login/logout"><i class="material-icons">exit_to_app</i></a></li>
            </ul>
        </div>
    </nav>

    <div class="card-panel teal lighten-2 white-text" id="sucesso" style="display:none;">
        Interesses salvos com sucesso!
    </div>

        <div class="row">
            <h3 class="light col s6 push-m3"> Selecione as empresas de seu interesse:</h3>
        </div>

        <div class="container">
            <table class="striped">
                <thead>
                <tr>
                    <th>Interesse</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Produtos</th>
                </tr>
                </thead>
                <tbody>
            <?php
            if(isset($empregadores) && isset($empregadoresSeguindo)) {
                foreach ($empregadores[0] as $empregador) { 
                    $checked = in_array($empregador->id, $empregadoresSeguindo) ? "checked='checked'" : '';
                    echo "<tr>
                    <th class='center-align'><label><input value='$empregador->id' name='id' type='checkbox' $checked/><span></span></label></th>
                    <th>$empregador->nomeDaEmpresa</th>
                    <th>$empregador->descricao</th>
                    <th>$empregador->produtos</th>
                    <th><a href='/vaga/vagasEmpregador?id=$empregador->id' class='icon-block green-text'><i class='material-icons'>library_books</i></a></th>
                    </tr>";
                }
            }
            ?>
                </tbody>
            </table>
        </div>

        <div class="row">
            <div class="col s6 push-m3">
                    <button type="submit" class='btn' id='salvaInteresse'>Salva interesse</button>
                </div>
        </div>
    </body>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<!--JavaScript at end of body for optimized loading-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

<script>
$("#salvaInteresse").on('click', function(event) {
    event.preventDefault();

    var empregadores = [];

    $("input:checkbox[name=id]:checked").each(function() {
        empregadores.push($(this).val());
    });

    var conteudo = {
        "valor": empregadores
    };
    
    $.ajax({
        type: 'post',
        url: 'http://projeto/Estagiario/SalvaInteresse',
        data: {empregadores:empregadores},
        success: function(data) {
            console.log(data);
            $('#sucesso').show();
            var divSucesso = $('#sucesso');
            $('html').scrollTop(divSucesso.offset().top);
            $('html').scrollLeft(divSucesso.offset().left);
        }
    });
});
</script>

</body>

</html>