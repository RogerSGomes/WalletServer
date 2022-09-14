<?php
include("../../config/connection.php");
include("../../modules/header.php");
include("../../modules/post_body.php");

if (isset($_BODY)) {
    if(isset($_BODY["user_id"])) {
        $user_id = intval($_BODY["user_id"]);

        if($user_id) {
            $sql = "SELECT * FROM wallet_user WHERE `user_id` = $user_id";
            $result = $connect->query($sql);

            if ($result->num_rows > 0) {
                while($user = $result -> fetch_assoc()) {
                    $user_data[] = [
                        "id" => intval($user["user_id"]),
                        "avatar_id" => intval($user["user_avatar_id"]),
                        "name" => $user["user_name"],
                        "email" => $user["user_email"],
                    ];
                }
            
                $response["status"] = 200;
                $response["response"] = $user_data;
            } else {
                $response["status"] = 404;
                $response["response"] = "Usuário não encontrado";
            }
        } else {
            $response["status"] = 403;
            $response["response"] = "Informe o ID do usuário";
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
