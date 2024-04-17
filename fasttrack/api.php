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
    if ($url[2] == "get-rate") {
        $data = enx_get_rate_data_api();
    } else if ($url[2] == "get-rate-addon") {
        $data = enx_get_rate_addon_data_api();
    } else if ($url[2] == "upload-documents") {
        $data = enx_upload_data_api();
    } else if ($url[2] == "get-status") {
        $data = enx_get_booking_status_api();
    }
    
    return $data;
}

//POST data =========
function enx_get_booking_status_api()
{
    $url = API_FASTTRACK_URL . "/get/bookingstatus" . createParamsFromGet();
    $req = json_decode(file_get_contents("php://input"));
    $data = fetchPost($url, $req);
    return $data;
}

function enx_get_rate_data_api()
{
    $url = API_FASTTRACK_URL . "/get/rate" . createParamsFromGet();
    $req = json_decode(file_get_contents("php://input"));
    $data = fetchPost($url, $req);
    return $data;
}

function enx_get_rate_addon_data_api()
{
    $url = API_FASTTRACK_URL . "/get/rate-addon" . createParamsFromGet();
    $req = json_decode(file_get_contents("php://input"));
    $data = fetchPost($url, $req);
    if ($data->error) return false;
    return $data;
}

function enx_upload_data_api()
{
    $url = API_FASTTRACK_URL . "/post/upload?service=" . $_GET['service'];

    $multipart_boundary = '--------------------------' . microtime(true);
    $header = 'Content-Type: multipart/form-data; boundary=' . $multipart_boundary;
    $filename = $_FILES['file']['name'];
    $tempname = $_FILES['file']['tmp_name'];
    $file_contents = file_get_contents($tempname);
    $mimetype = $_FILES['file']['type'];

    $content =  "--" . $multipart_boundary . "\r\n" .
        "Content-Disposition: form-data; name=\"file\"; filename=\"" . $filename . "\"\r\n" .
        "Content-Type: " . $mimetype . "\r\n\r\n" .
        $file_contents . "\r\n";

    $content .= "--" . $multipart_boundary . "\r\n" .
        "Content-Disposition: form-data; name=\"type\"\r\n\r\n" . $_POST['type'] . "\r\n";

    $content .= "--" . $multipart_boundary . "\r\n" .
        "Content-Disposition: form-data; name=\"uid\"\r\n\r\n" . $_POST['uid'] . "\r\n";

    $content .= "--" . $multipart_boundary . "\r\n" .
        "Content-Disposition: form-data; name=\"sid\"\r\n\r\n" . $_POST['sid'] . "\r\n";
    
        if ($_POST['type'] == 'imei') {
            $content .= "--" . $multipart_boundary . "\r\n" .
                "Content-Disposition: form-data; name=\"imei_name\"\r\n\r\n" . $_POST['name'] . "\r\n";
        }

    // signal end of request (note the trailing "--")
    $content .= "--" . $multipart_boundary . "--\r\n";

    $context = stream_context_create(array(
        'http' => array(
            'method' => 'POST',
            'header' => $header,
            'content' => $content,
        )
    ));

    $response = file_get_contents($url, false, $context);

    $header = parseHeaders($http_response_header);

    if ($header->response_code != 200) {
        return ['status' => 'error'];
    }
    $data = json_decode($response);

    if ($data->error || !$data) return ['status' => 'error'];
    return ['status' => 'success'];
    // return ['status' => $data];
}
