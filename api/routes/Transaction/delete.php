<?php
include("../../config/connection.php");
include("../../modules/header.php");
include("../../modules/post_body.php");

if (isset($_BODY)) {
    if (isset($_BODY["transaction_id"])) {
        $transaction_id = intval($_BODY["transaction_id"]);

        if ($transaction_id) {
            $sql = "SELECT * FROM wallet_transaction WHERE transaction_id = $transaction_id";
            $result = $connect->query($sql);

            if ($result->num_rows > 0) {
                $sql = "DELETE FROM wallet_transaction WHERE transaction_id = $transaction_id";

                if  ($connect -> query($sql) === TRUE) {
                    http_response_code(200);
                    $response["data"] = "Transação excluída";
                } else {
                    http_response_code(500);
                    $response["data"] = "Algo deu errado";
                }
            } else {
                http_response_code(404);
                $response["data"] = "Transação não encontrada";
            }
        } else {
            http_response_code(400);
            $response["data"] = "Informe o ID da transação a ser excluída";
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
