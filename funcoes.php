<?php

function lerArquivo($nomeArquivo){
    $arquivo = file_get_contents($nomeArquivo);
    $jsonArray = json_decode($arquivo);

    return $jsonArray;
}

function buscarFuncionarios($funcionarios, $filtro){
    $funcionariosFiltro = [];
    foreach($funcionarios as $funcionario){
        if(
            strpos($funcionario->first_name, $filtro) !== false
            ||
            strpos($funcionario->last_name, $filtro) !== false
            ||
            strpos($funcionario->department, $filtro) !== false
            ){
            $funcionariosFiltro[] = $funcionario;
        }
    }
    return $funcionariosFiltro;
}

function adicionarFuncionario($nomeArquivo, $novoFuncionario){

    $funcionarios = lerArquivo($nomeArquivo);

    $funcionarios[] = $novoFuncionario;

    $json = json_encode($funcionarios);

    file_put_contents($nomeArquivo, $json);
}

function deletarFuncionario($nomeArquivo, $idFuncionario){
    $funcionarios = lerArquivo($nomeArquivo);

    foreach($funcionarios as $chave => $funcionario){
        if($funcionario->id == $idFuncionario){
            unset($funcionarios[$chave]);
        }
    }

    $json = json_encode(array_values($funcionarios));
    file_put_contents($nomeArquivo, $json);
}

function realizarLogin($usuario, $senha, $dados){

    foreach ($dados as $dado){

        if ($dado->usuario == $usuario && $dado->senha == $senha) {
            
            //Variaveis de sessão:
            $_SESSION["usuario"] = $dado->usuario;
            $_SESSION["id"] = session_id();
            $_SESSION["data_hora"] = date('d/m/Y - h:i:s');

            header('location: area_restrita.php');
            exit;

        }
        
    }

    header('location: index.php');

}

//FUNÇÃO DE VVERIFICAÇÃO DE LOGIN
//VERIFICA SE O USUÁRIO PASSOU PELO PROCESSO DE LOGIN

function verificarLogin(){

    if($_SESSION["id"] != session_id() || (empty($_SESSION["id"])) ){

        header('location: index.php');

    }
}

//FUNÇÃO DE FINZALIZAÇÃO DE LOGIN
//EFETUA A AÇÃO DE SAIR DO USUÁRIO DESTRUINDO A SESSÃO

function finalizarLogin(){
    session_unset(); //LIMPA TODAS A AVARIAVEIS DE SESSÃO
    session_destroy(); //DESTRÓI A SESSÃO ATIVA

    header('location: index.php');
}

?>