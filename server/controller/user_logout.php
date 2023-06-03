<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    session_start();
    unset($_SESSION["user"]);
    session_destroy();

    error_log("I am here");
    http_response_code(200);
    exit(json_encode(["status" => "SUCCESS", "message" => "Successfull logout"]));
}
