<?php
include_once("definitions.php");

///////// FUNÇÕES DE AUTENTICAÇÃO

if(isset($_GET['login'])) {
    // verifica se todos os dados foram enviados
    if(!isset($_POST['username']) || !isset($_POST['password'])) {
        respond("Faltam dados.");
    }

    // atribui o usuário
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    // atribui a senha
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    // loga
    $result = login($connection, $username, $password);
    // se ocorreu um errro no cadastro, responde com a mensagem
    if($result !== true) {
        respond($result);
    }
    // se deu certo, 
    respond("Olá, " . ucfirst($username) . "!");
}
else if(isset($_GET['register'])) {
    // verifica se todos os dados foram enviados
    if(!isset($_POST['username']) || !isset($_POST['password']) || !isset($_POST['password_again'])) {
        respond("Faltam dados.");
    }

    // atribui o usuário
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);

    // verifica se as senhas batem
    if($_POST['password'] != $_POST['password_again']) {
        respond("As senhas não batem.");
    }

    // atribui a senha
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    // faz o cadastro
    $result = register($connection, $username, $password);
    // se ocorreu um errro no cadastro, responde com a mensagem
    if($result !== true) {
        respond($result);
    }
    // se deu certo, 
    respond("Tudo ok.");
}
else if(isset($_GET['logout'])) {
    session_destroy();
    session_unset();

    respond("Tchau!");
}

///////// INTERFACE DE POSTS

else if(isset($_GET['post'])) {
    if(isset($_SESSION['username']) && isset($_POST['message'])) {
        $message = filter_input(INPUT_POST, "message", FILTER_SANITIZE_STRING);

        $result = create_post($connection, $_SESSION['username'], $message);
        if($result !== true) {
            respond($result);
        }
        respond("Post criado!");
    }
}
else if(isset($_GET['like'])) {
    if(isset($_GET['id'])) {
        $result = like_post($connection, $_GET['id'], $_SESSION['username']);
        if($result !== true) {
            respond($result);
        }
        respond("Post likeado!");
    }
}

else if(isset($_GET['show_notifications'])) {
    if(isset($_SESSION['username']))
        respond(get_notification_texts($connection, $_SESSION['username']));
}