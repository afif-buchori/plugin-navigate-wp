<?php
function enx_get_data_api()
{
    if ($_SERVER['REQUEST_METHOD'] == "GET") {
        $data = enx_get_data_api_get();
    }
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $data = enx_get_data_api_post();
    }
    return $data;
}

function enx_get_data_api_get()
{
    return;
}

function enx_get_data_api_post()
{
    $url = explode("/", substr(explode("?", $_SERVER['REQUEST_URI'])[0], 1));
    $data = [];
    if ($url[2] == "check-block-date") {
        $data = enx_post_check_block_date();
    } elseif ($url[2] == "generate-act-session") {
        session_start();
        $data = enx_generate_act_session();
    } elseif ($url[2] == "booking-act") {
        $data = enx_post_booking_act();
    }

    return $data;
}

//POST data =========
function enx_post_check_block_date()
{
    $url = API_ACTIVITY_URL . "/post/check-block-date";
    // $req = $_GET;
    $req = json_decode(file_get_contents("php://input"));
    // var_dump($req, $_GET);
    // die;
    $data = fetchPost($url, $req);
    return $data;
}

function enx_generate_act_session()
{
    $_SESSION['CART_ACTIVITY'] = json_decode(file_get_contents("php://input"));

    return $_SESSION['CART_ACTIVITY'];
}

function enx_post_booking_act()
{
    $url = API_ACTIVITY_URL . "/post/booking";
    $req = json_decode(file_get_contents("php://input"));
    $data = fetchPost($url, $req);
    return $data;
}
