<?php
include("../../config/connection.php");
include("../../modules/header.php");
include("../../modules/post_body.php");

if (isset($_BODY)) {
    if (isset($_BODY["user_id"]) && isset($_BODY["confirm"])) {
        $user_id = intval($_BODY["user_id"]);
        $confirm = $_BODY["confirm"];

        if ($user_id && $confirm) {
            if ($confirm === TRUE) {
                $sql = "SELECT * FROM wallet_user WHERE `user_id` = $user_id";
                $result = $connect->query($sql);

                if ($result -> num_rows > 0) {
                    $sql = "UPDATE wallet_user SET user_token = NULL WHERE `user_id` = $user_id";

                    if($connect->query($sql)) {
                        $response["status"] = 200;
                        $response["response"] = "Sessão finalizada";
                    } else {
                        $response["status"] = 400;
                        $response["response"] = "Algo deu errado";
                    }
                } else {
                    $response["status"] = 404;
                    $response["response"] = "Usuário não encontrado";
                }
            } else {
                $response["status"] = 400;
                $response["response"] = "Não foi possível sair, sem confirmação do usuário";
            }
        } else {
            $response["status"] = 403;
            $response["response"] = "Informe o ID do usuário e sua confirmação para sair";
        }
    } else {
        $response["status"] = 400;
        $response["response"] = "Requisição incoerente";
    }
} else {
    $response["status"] = 400;
    $response["response"] = "Este end-point não suporta requisições pelo método GET";
}

echo(json_encode($response));