<?php
include("../../config/connection.php");
include("../../modules/header.php");

$sql = "SELECT * FROM wallet_user";
$result = $connect -> query($sql);

if ($result -> num_rows > 0) {
    while($user = $result -> fetch_assoc()) {
        $user_data[] = [
            "id" => intval($user["user_id"]),
            "avatar_id" => intval($user["user_avatar_id"]),
            "name" => $user["user_name"],
            "email" => $user["user_email"],
        ];
    }

    http_response_code(200);
    $response = $user_data;
} else {
    http_response_code(404);
    $response = "Nenhum usuário encontrado";
}

echo(json_encode($response));