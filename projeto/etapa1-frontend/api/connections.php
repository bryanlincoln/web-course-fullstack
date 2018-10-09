<?php

// define os dados do servidor mysql
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "senha");
define("DB_NAME", "curso");

// constante que define se o cookie de sessão armazenado é seguro ou não
define("SECURE", isset($_SERVER["HTTPS"]));

// cria o objeto de conexão que será usado pela api para se comunicar com o servidor
$connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// verifica se ocorreu algum problema na conexão
if (mysqli_connect_errno()) {
    printf("Conexão falhou: %s\n", mysqli_connect_error());
    exit();
}

// faz com que a conexão trabalhe com conjuto de caracteres utf-8
if (!$connection->set_charset("utf8")) {
    printf("Error loading character set utf8: %s\n", $connection->error);
    exit();
}
?>
