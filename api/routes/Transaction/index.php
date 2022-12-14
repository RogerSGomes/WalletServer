<?php
include("../../config/connection.php");
include("../../modules/header.php");

if (isset($_GET["id"])) {
    $user_id = intval($_GET["id"]);

    $sql = "SELECT * FROM wallet_user WHERE `user_id` = $user_id";
    $result = $connect -> query($sql);

    if ($result -> num_rows > 0) {
        $sql = "SELECT * FROM wallet_transaction WHERE transaction_user_id = $user_id";
        $result = $connect -> query($sql);
        
        if ($result -> num_rows > 0) {
            while($transaction = $result -> fetch_assoc()) {
                $date = explode("-", $transaction["transaction_date"]);
                $transaction["transaction_date"] = $date[2]."/".$date[1]."/".$date[0];

                $transaction_data[] = [
                    "id" => intval($transaction["transaction_id"]),
                    "type" => $transaction["transaction_type"],
                    "date" => $transaction["transaction_date"],
                    "cost" => $transaction["transaction_cost"],
                    "payment" => $transaction["transaction_payment"],
                    "origin" => $transaction["transaction_origin"],
                    "description" => $transaction["transaction_description"],
                    "adress" => $transaction["transaction_adress"],
                ];
            }
            http_response_code(200);
            $response = $transaction_data;
        } else {
            http_response_code(404);
            $response = "Nenhuma transação encontrada para este usuário";
        }
    } else {
        http_response_code(404);
        $response = "Usuário não encontrado";
    }
} else {
    http_response_code(400);
    $response = "Este end-point não suporta requisições pelo método GET";
}


echo(json_encode($response));