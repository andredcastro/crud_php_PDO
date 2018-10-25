<?php
date_default_timezone_set('America/Fortaleza');
//Dados da conexao com o banco
define('HOST', 'localhost');
define('DBNAME', 'basededados');
define('USER', 'root');
define('PASSWORD', 'senha');
//dados para script de backup
$HOST = HOST;
$DBNAME = DBNAME;
$USER = USER;
$PASSWORD = PASSWORD;
try {
    $opcoes = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');  
    $pdo = new PDO("mysql:host=" . HOST . "; dbname=" . DBNAME . ";charset=utf8", USER, PASSWORD, $opcoes);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e){
  echo "Erro: " . $e->getMessage();
}
