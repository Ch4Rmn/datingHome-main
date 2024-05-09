<?php

require_once("../config/database.php");
require_once("../config/config.php");
// echo "hello";
// exit();

$sql = "SELECT `id`, `name`, `created_at`, `created_by`, `updated_at`, `updated_by` FROM `hobbies`";
$cityQuery = $mysqli->query($sql);
$num_row = $cityQuery->num_rows;
// echo $num_row;
// die;
$data = [];
$response_data = [];
if ($num_row > 0) {
    while ($data = $cityQuery->fetch_assoc()) {
        $id = $data['id'];
        $name = htmlspecialchars($data['name']);
        array_push($response_data, $data);
    }
}
echo json_encode($response_data);
