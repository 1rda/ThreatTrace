<?php
include_once("database.php");

$sql = "SELECT * FROM `detection`  
ORDER BY `detection`.`id` DESC
LIMIT 50";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $detection[] = $row;
}
echo json_encode($detection);
