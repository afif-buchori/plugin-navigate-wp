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
    if ($url[2] == "get-package") {
        $data = enx_post_getpackage();
    } elseif ($url[2] == "generate-tp-session") {
        session_start();
        $data = enx_generate_tp_session();
    }
    // elseif ($url[2] == "booking-act") {
    //     $data = enx_post_booking_act();
    // }

    return $data;
}

//POST data =========
function enx_post_getpackage()
{
    $url = API_TOUR_PACKAGE_URL . "/post/get-package";
    // $req = $_GET;
    $req = json_decode(file_get_contents("php://input"));
    $req->currency = str_replace("currency=", "", checkCurrency());
    // var_dump($req, $_GET);
    // die;
    $data = fetchPost($url, $req);
    return $data;
}

function enx_generate_tp_session()
{
    session_start();
    $_SESSION['SESSION_TOUR_PACKAGE'] = json_decode(file_get_contents("php://input"));
    return true;
    // return '/' . ACTIVITY_LINK . '/booking';
    // return $_SESSION['CART_ACTIVITY'];
}
