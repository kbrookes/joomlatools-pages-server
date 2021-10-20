<?php

# load auth0 lib
//require(KOOWA_ROOT.'/pages/init.php');
//header("Referer: https://undertheradarreport-test.chargebee.com");
//header("Access-Control-Allow-Origin: " . $_SERVER['HTTP_ORIGIN'] . "");

try {
    if(isset($_REQUEST["key"]) && $_REQUEST["key"]="n43KmcQwDRf"){
        $payload = @file_get_contents('php://input');
        $decArr = json_decode($payload, true);
        echo 'Response: <pre>'; print_r($decArr); echo '</pre>';
        header('HTTP/1.1 200 OK');
        return;
    } else {
        echo "Error!";
        http_response_code(400);
    }
    exit();
} catch(\UnexpectedValueException $e) {
    // Invalid payload
    header('HTTP/1.1 400 Bad Request');
    return;
    exit();
}




?>