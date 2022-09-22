<?php
include("../../config/connection.php");
include("../../modules/header.php");
include("../../modules/post_body.php");

if (isset($_BODY)) {
    if(
        isset($_BODY["transaction_id"]) &&
        isset($_BODY["date"]) &&
        isset($_BODY["cost"]) &&
        isset($_BODY["origin"]) &&
        isset($_BODY["payment"]) &&
        isset($_BODY["description"]) &&
        isset($_BODY["adress"])
    ) {
        $transaction_id = intval($_BODY["transaction_id"]);
        $date = $_BODY["date"];
        $cost = $_BODY["cost"];
        $origin = $_BODY["origin"];
        $payment = $_BODY["payment"];
        $description = $_BODY["description"];
        $adress = $_BODY["adress"];

        if (
            $transaction_id && (
                $date ||
                $cost ||
                $origin ||
                $payment ||
                $description ||
                $adress
            )
        ) {
            $sql = "SELECT * FROM wallet_transaction WHERE transaction_id = $transaction_id";
            $result = $connect->query($sql);

            if ($result->num_rows > 0) {
                $sql = "UPDATE wallet_transaction SET transaction_id = $transaction_id";

                if ($date) {
                    $sql = "$sql, transaction_date = '$date'";
                }
                if ($cost) {
                    $sql = "$sql, transaction_cost = '$cost'";
                }
                if ($origin) {
                    $sql = "$sql, transaction_origin = '$origin'";
                }
                if ($payment) {
                    $sql = "$sql, transaction_payment = '$payment'";
                }
                if ($description) {
                    $sql = "$sql, transaction_description = '$description'";
                }
                if ($adress) {
                    $sql = "$sql, transaction_adress = '$adress'";
                }
                $sql = "$sql WHERE transaction_id = $transaction_id";

                if  ($connect -> query($sql) === TRUE) {
                    http_response_code(200);
                    $response = "Transação atualizada";
                } else {
                    http_response_code(500);
                    $response = "Algo deu errado";
                }
            } else {
                http_response_code(404);
                $response = "Transação não encontrada";
            }
        } else {
            http_response_code(400);
            $response = "Informe o que deseja editar";
        }
    } else {
        http_response_code(400);
        $response = "Requisição incoerente";
    }
} else {
    http_response_code(400);
    $response = "Este end-point não suporta requisições pelo método GET";
}

echo (json_encode($response));
