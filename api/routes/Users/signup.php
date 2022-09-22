<?php
include("../../config/connection.php");
include("../../modules/header.php");
include("../../modules/post_body.php");

if (isset($_BODY)) {
    if (
        isset($_BODY["name"]) &&
        isset($_BODY["nickname"]) &&
        isset($_BODY["email"]) &&
        isset($_BODY["password"]) &&
        isset($_BODY["c_password"]) &&
        isset($_BODY["avatar_id"])
    ){
        $name = $_BODY["name"];
        $nickname = $_BODY["nickname"];
        $email = $_BODY["email"];
        $password = $_BODY["password"];
        $c_password = $_BODY["c_password"];
        $avatar_id = intval($_BODY["avatar_id"]);

        if (
            $name &&
            $nickname && 
            $email &&
            $password &&
            $c_password &&
            $avatar_id
        ) {
            if ($password === $c_password) {
                $sql = "SELECT * FROM wallet_user WHERE `user_name` = '$name' OR user_nickname = '$nickname' OR user_email = '$email'";
                $result = $connect->query($sql);

                if ($result->num_rows > 0) {
                    http_response_code(400);
                    $response = "Usuário já existe";
                } else {
                    $encrypted_password = $password;
                    for ($i = 0; $i < 2; $i ++) {
                        $encrypted_password = md5($encrypted_password);
                    }
                    
                    $sql = "INSERT INTO wallet_user(`user_name`, user_nickname, user_email, user_password, user_avatar_id) VALUES ('$name', '$nickname', '$email', '$encrypted_password', $avatar_id)";
                    if ($connect->query($sql) === TRUE) {
                        http_response_code(200);
                        $response = "Usuário cadastrado com sucesso";
                    } else {
                        http_response_code(500);
                        $response = "Não foi possível cadastrar este usuário";
                    }
                }
            } else {
                http_response_code(400);
                $response = "Senhas não correspondem";
            }
        } else {
            http_response_code(400);
            $response = "Preencha todos os campos";
        }
    } else {
        http_response_code(400);
        $response = "Requisição incoerente";
    }
} else {
    http_response_code(400);
    $response = "Este end-point não suporta requisições pelo método GET";
}

echo(json_encode($response));