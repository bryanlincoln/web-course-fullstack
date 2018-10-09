<?php

///////// FUNÇÕES AUXILIARES

function respond($message) {
    if(isset($_SERVER['HTTP_REFERER'])) {
        header("Location: " . LAST_PAGE . "?&msg=" . $message);
    } else {
        header("Location: ../?msg=" . $message);
    }

    exit();
}

///////// FUNÇÕES DE AUTENTICAÇÃO

function login($connection, $username, $password) {
    $query = "SELECT username, password FROM users WHERE username='$username'";
    if($stmt = $connection->query($query)) {
        if($stmt->num_rows == 0) {
            return "Usuário não encontrado.";
        } else {
            $row = $stmt->fetch_assoc();
            
            if(password_verify($password, $row['password'])) {
                $_SESSION['username'] = $username;
            } else {
                return "Senha incorreta.";
            }

            return true;
        }
    } else {
        return "Erro na solicitação.";
    }
}
function register($connection, $username, $password) {
    $password_hashed = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO users (username, password) VALUES ('$username', '$password_hashed')";
    if($stmt = $connection->query($query)) {
        $login = login($connection, $username, $password);
        if($login !== true) {
            return $login;
        }

        return true;
    } else {
        return "Erro na solicitação.";
    }
}

///////// FUNÇÕES GERADORAS DE INTERFACE

function get_all_posts($connection) {
    $query = "SELECT id, username, message, likes, date FROM posts ORDER BY date DESC"; 
    if($stmt = $connection->query($query)) {
        if($stmt->num_rows == 0) {
            return "Nenhum post ainda.";
        }

        $result = "";
        while($row = $stmt->fetch_assoc()) {
            $temp_model = POST_MODEL;

            $temp_model = str_replace("#id#", $row['id'], $temp_model);
            $temp_model = str_replace("#username#", $row['username'], $temp_model);
            $temp_model = str_replace("#message#", $row['message'], $temp_model);
            $temp_model = str_replace("#likes#", $row['likes'], $temp_model);
            $temp_model = str_replace("#date#", date_format(date_create($row['date']), "d-m-Y à\s h:i"), $temp_model);

            $result .= $temp_model;
        }

        return $result;
    } else {
        return "Erro na requisição.";
    }
}


///////// FUNÇÕES DE POSTAGEM

function create_post($connection, $username, $message) {
    $query = "INSERT INTO posts (username, message) VALUES ('$username', '$message');";
    if($stmt = $connection->query($query)) {
        return true;
    } else {
        return "Erro na postagem.";
    }
}
function like_post($connection, $id, $liker) {
    $query = "UPDATE posts SET likes=likes+1 WHERE id=$id";
    if($connection->query($query)) {
        $poster = $connection->query("SELECT username FROM posts WHERE id=$id")->fetch_assoc()['username'];
        $connection->query("INSERT INTO notifications (username, text) VALUES('$poster', '$liker gostou do seu post!')");
        return true;
    }
    else {
        return $query;
    }
}

///////// FUNÇÕES DE NOTIFICAÇÃO

function get_notifications($connection, $username) {
    $query = "SELECT count(id) as notifications FROM notifications WHERE username='$username'";
    if($stmt = $connection->query($query)) {
        return $stmt->fetch_assoc()['notifications'];
    } else {
        return -1;
    }
}
function get_notification_texts($connection, $username) {
    $query = "SELECT text FROM notifications WHERE username='$username'";
    if($stmt = $connection->query($query)) {
        if($stmt->num_rows == 0) {
            return "Nenhuma notificação.";
        }
        $result = "<ul>";
        while($row = $stmt->fetch_assoc()) {
            $result .= "<li>".$row["text"]."</li>";
        }
        $result .= "</ul>";

        $connection->query("DELETE FROM notifications WHERE username='$username'");

        return $result;
    } else {
        return $query;
    }
}
?>