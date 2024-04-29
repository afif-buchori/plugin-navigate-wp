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
