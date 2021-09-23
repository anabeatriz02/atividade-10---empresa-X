<?php

//INICIALIZA A SESSÃO PARA O LOGIN
session_start();

//VALIDANDO INFOS
require_once("./funcoes.php");


//RECEBENDO OS DADOS DO FORMULÁRIO:

if(isset($_POST["txt_usuario"]) || isset($_POST["txt_usuario"])){

    $usuario = $_POST["txt_usuario"];
    $senha = $_POST["txt_senha"];

    realizarLogin($usuario, $senha, lerArquivo("dados/usuarios.json"));

}else if($_GET["logout"]){

    finalizarLogin();
    
}
