<?php

include_once 'validador.php';
include_once 'utils.php';
// include_once '../models/vaga.php';

function insertOneVaga($conn, $vaga) {
    $sql = "INSERT INTO vagas (id, empregadorID, descricao, listaDeAtividades, listaDeHabilidadesRequeridas, semestreRequerido, quantidadeDeHoras, remuneracao) VALUES('$vaga->id','$vaga->empregadorID','$vaga->descricao','$vaga->listaDeAtividades', '$vaga->listaDeHabilidadesRequeridas', $vaga->semestreRequerido,$vaga->quantidadeDeHoras, $vaga->remuneracao)";

    if(!$conn->query($sql)) {
        return $conn->error;
    }

    return null;
}

function cadastrarVaga($vaga) {
    $validador = validarVagaParaRegistro($vaga);
    if ($validador != null) {
        $arr = array('sucesso' => false, 'mensagem' => $validador);
        echo json_encode($arr);
        return;
    }

    $conn = connectDb();

    if (insertOneVaga($conn, $vaga) != null) {
        $arr = array('sucesso' => false, 'mensagem' => "vaga nao inserida");
        echo json_encode($arr);
        return;
    }

    $arr = array('sucesso' => true);
    echo json_encode($arr);
}

function getAllVagas($conn, $skip, $limit) {
    $sql = "SELECT * FROM vagas LIMIT $skip, $limit";

    if ($result = $conn->query($sql)) {
        while ($data = $result->fetch_object()) {
            $vagas[] = $data;
        }
    }

    $result->fetch_object();

     foreach ($vagas as $vaga) {
        printVaga($vaga);
    }

    return $vagas;
}

function printVaga($vaga) {
    echo $vaga->id . "<br>";
    echo $vaga->empregadorID . "<br>";
    echo $vaga->titulo . "<br>";
    echo $vaga->descricao . "<br>";
    echo $vaga->listaDeAtividades . "<br>";
    echo $vaga->listaDeHabilidadesRequeridas . "<br>";
    echo $vaga->semestreRequerido . "<br>";
    echo $vaga->quantidadeDeHoras . "<br>";
    echo $vaga->remuneracao . "<br>";
}

function getAllVagasByEmpregadorID($conn, $skip, $limit, $empregadorID) {
    $sql = "SELECT * FROM vagas LIMIT WHERE empregadorID = '$empregadorID' $skip, $limit";

    if ($result = $conn->query($sql)) {
        while ($data = $result->fetch_object()) {
            $vagas[] = $data;
        }
    }

    if($result->num_rows === 0) return "Sem resultado";

    $result->fetch_object();

    /* foreach ($vagas as $vaga) {
        echo "<br>";
        echo $vaga->titulo . " " . $vaga->id;
        echo "<br>";
    }
    */

    return $vagas;
}

?>