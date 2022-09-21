<?php
include("../../config/connection.php");
include("../../modules/header.php");

$sql = "SELECT * FROM wallet_avatar";
$result = $connect -> query($sql);

if ($result -> num_rows > 0) {
    while($avatar = $result -> fetch_assoc()) {
        $avatar_data[] = [
            "id" => intval($avatar["avatar_id"]),
            "url" => $avatar["avatar_url"],
        ];
    }

    http_response_code(200);
    $response["data"] = $avatar_data;
} else {
    http_response_code(404);
    $response["data"] = "Nenhum avatar encontrado";
}

echo(json_encode($response));