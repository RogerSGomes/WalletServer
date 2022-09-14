<?php
include("../../config/connection.php");
include("../../modules/header.php");
include("../../modules/post_body.php");

if (isset($_BODY)) {
    $name = $_BODY["name"];
    $nickname = $_BODY["nickname"];
    $email = $_BODY["email"];
    $password = $_BODY["password"];
    $c_password = $_BODY["c_password"];
    $avatar_id = intval($_BODY["avatar_id"]);

    if ($name && $nickname && $email && $c_password && $avatar_id) {
        if ($password === $c_password) {
            $sql = "SELECT * FROM wallet_user WHERE `user_name` = '$name' OR user_nickname = '$nickname'";
            $result = $connect->query($sql);

            if ($result->num_rows > 0) {
                $response["status"] = 403;
                $response["response"] = "Usuário já existe";
            } else {
                $encrypted_password = $password;
                for ($i = 0; $i < 2; $i ++) {
                    $encrypted_password = md5($encrypted_password);
                }
                
                $sql = "INSERT INTO wallet_user(`user_name`, user_nickname, user_email, user_password, user_avatar_id) VALUES ('$name', '$nickname', '$email', '$encrypted_password', $avatar_id)";
                if ($connect->query($sql) === TRUE) {
                    $response["status"] = 200;
                    $response["response"] = "Usuário cadastrado com sucesso";
                } else {
                    $response["status"] = 400;
                    $response["response"] = "Não foi possível cadastrar este usuário";
                }
            }
        } else {
            $response["status"] = 403;
            $response["response"] = "Senhas não correspondem";
        }
    } else {
        $response["status"] = 403;
        $response["response"] = "Preencha todos os campos";
    }
} else {
    $response["status"] = 400;
    $response["response"] = "Este end-point não suporta requisições pelo método GET";
}

echo(json_encode($response));