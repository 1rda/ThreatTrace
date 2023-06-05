<?php
include_once "database.php";

$words = file_get_contents("dir.txt");
$array = explode(PHP_EOL, $words);
$requests = $_REQUEST;

foreach ($requests as $request => $value) {
    if (in_array($value, $array)) {
        $detection = [
            "ip_address" => $_SERVER["REMOTE_ADDR"],
            "user_agent" => $_SERVER["HTTP_USER_AGENT"],
            "script_detection" => json_encode([
                "location" => $_SERVER["REQUEST_URI"],
                "request" => $requests,
            ]),
        ];

        $ip_address = $detection["ip_address"];
        $user_agent = $detection["user_agent"];
        $script_detection = $detection["script_detection"];
        $sql = "INSERT INTO `detection` (`ip_address`, `user_agent`, `script_detection`) VALUES ('$ip_address', '$user_agent', '$script_detection')";
        $conn->query($sql);
        die("SQL INJECTION DETECTED!");
    }
}
