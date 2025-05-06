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
    if ($url[2] == "updateprice") {
        $data = enx_updateprice();
    }

    return $data;
}

function enx_updateprice()
{
    $url = API_OPENTRIP_URL . "/updateprice";
    $req = json_decode(file_get_contents("php://input"));
    $req->currency = str_replace("currency=", "", checkCurrency());
    $req->companyId = COMPANY_ID;
    $data = fetchPost($url, $req);
    return $data;
}

