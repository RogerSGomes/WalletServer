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

    $response["status"] = 200;
    $response["response"] = $avatar_data;
} else {
    $response["status"] = 404;
    $response["response"] = "Nenhum avatar encontrado";
}

echo(json_encode($response));