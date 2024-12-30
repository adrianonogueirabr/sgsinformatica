<?php
error_reporting(E_ALL);
@ini_set('display_errors', '1');
if (version_compare(phpversion(), "4", ">")) {
if (!extension_loaded('mysql')) {
echo( "não esta habilitada a dll Mysql" );
exit;
}
}

if(file_exists("funcoes.php")) {
include "funcoes.php";
} else {
echo "Arquivo funcoes.php não encontrado";
exit;
}

if(file_exists("config.php")) {
include "config.php";

if (!defined("localhost") or !defined("root") or !defined("") or !defined("db_sgtechfy")){
echo "Variaveis de conexao não definidas, configure corretamente o arquivo config.php";
exit;
}
}

$erros[2005] = "Esse servidor não existe";
$erros[2003] = "Servidor Mysql desligado";
$erros[1045] = "Usuario ou senha invalido";
$erros[1049] = "Banco de dados não encontrado";
$erros[1146] = "Erro de sql a tabela não existe";
$erros[1062] = "Erro campo unico na tabela, não pode cadastrar pois ele já existe";

function Abre_Conexao() {
global $erros;
@mysql_connect(SERVIDOR, USUARIO, SENHA);
if(mysql_errno() != 0) {
echo $erros[mysql_errno()];
exit;
}
@mysql_select_db(BANCO);
if(mysql_errno() != 0) {
echo $erros[mysql_errno()];
exit;
}
}

?>