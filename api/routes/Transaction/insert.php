<?php
include("../../config/connection.php");
include("../../modules/header.php");
include("../../modules/post_body.php");

if (isset($_BODY)) {
    if(
        isset($_BODY["user_id"]) &&
        isset($_BODY["type"]) &&
        isset($_BODY["date"]) &&
        isset($_BODY["cost"]) &&
        isset($_BODY["origin"]) &&
        isset($_BODY["payment"]) &&
        isset($_BODY["description"]) &&
        isset($_BODY["adress"])
    ) {
        $user_id = intval($_BODY["user_id"]);
        $type = $_BODY["type"];
        $date = $_BODY["date"];
        $cost = $_BODY["cost"];
        $origin = $_BODY["origin"];
        $payment = $_BODY["payment"];
        $description = $_BODY["description"];
        $adress = $_BODY["adress"];

        if (
            isset($user_id) &&
            $type &&
            $date &&
            $cost &&
            $origin &&
            $payment
        ) {
            $sql = "SELECT * FROM wallet_user WHERE `user_id` = $user_id";
            $result = $connect->query($sql);

            if ($result->num_rows > 0) {
                $sql = "INSERT INTO wallet_transaction
                    (
                        transaction_user_id,
                        transaction_type,
                        transaction_date,
                        transaction_cost,
                        transaction_payment,
                        transaction_origin,
                        transaction_description,
                        transaction_adress
                    )
                    VALUES ($user_id, '$type', '$date', '$cost', '$payment', '$origin', '$description', '$adress')";
                if  ($connect -> query($sql) === TRUE) {
                    http_response_code(200);
                    $response["data"] = "Transação concluída";
                } else {
                    http_response_code(500);
                    $response["data"] = "Algo deu errado";
                }
            } else {
                http_response_code(404);
                $response["data"] = "Usuário não encontrado";
            }
        } else {
            http_response_code(400);
            $response["data"] = "Preencha todos os campos";
        }
    } else {
        http_response_code(400);
        $response["data"] = "Requisição incoerente";
    }
} else {
    http_response_code(400);
    $response["data"] = "Este end-point não suporta requisições pelo método GET";
}

echo (json_encode($response));
