<?php
include("../../config/connection.php");
include("../../modules/header.php");
include("../../modules/post_body.php");

if (isset($_BODY)) {
    if(isset($_BODY["login"]) && isset($_BODY["password"])) {
        $login = $_BODY["login"];
        $password = $_BODY["password"];

        if($login && $password) {
            $sql = "SELECT * FROM wallet_user WHERE `user_name` = '$login' OR user_nickname = '$login' OR user_email = '$login'";
            $result = $connect->query($sql);

            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                for ($i = 0; $i < 2; $i++) {
                    $password = md5($password);
                }

                if ($password === $user["user_password"]) {
                    $random = rand(1, 267849);
                    $token =  md5($random) . "wallet2022" . $random;
                    $sql = "UPDATE wallet_user SET user_token = '$token' WHERE `user_id` = ".$user["user_id"];

                    if ($connect->query($sql) === TRUE) {
                        $response["status"] = 200;
                        $response["response"] = [
                            "id" => intval($user["user_id"]),
                            "name" => $user["user_name"],
                            "nickname" => $user["user_nickname"],
                            "email" => $user["user_email"],
                            "token" => $token
                        ];
                    } else {
                        $response["status"] = 400;
                        $response["response"] = "Não foi possível iniciar sessão";
                    }
                } else {
                    $response["status"] = 400;
                    $response["response"] = "Usuário e/ou senha incorretos";
                }
            } else {
                $response["status"] = 404;
                $response["response"] = "Usuário não encontrado";
            }
        } else {
            $response["status"] = 403;
            $response["response"] = "Preencha todos os campos";
        }
    } else {
        $response["status"] = 400;
        $response["response"] = "Requisição incoerente";
    }
} else {
    $response["status"] = 400;
    $response["response"] = "Este end-point não suporta requisições pelo método GET";
}

echo (json_encode($response));
