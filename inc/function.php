<?php
function ConvertToObject($val)
{
    return json_decode(json_encode($val));
}
function ConvertStringToObject($val)
{
    return json_decode($val);
}
function ConvertToArray($val)
{
    return json_decode(json_encode($val), true);
}
function ConvertToString($obj)
{
    return json_encode($obj);
}
function CreateParams()
{
    $param = '';
    $currency = checkCurrency();
    $param .= $currency;
    if ($param != '')
        $param = '?' . $param;
    return $param;
}

function createParamsFromGet()
{
    $param = '';
    foreach ($_GET as $key => $get) {
        $param .= $key . '=' . $get;
    }
    if ($param != '')
        $param = '?' . $param;
    return $param;
}

function checkCurrency()
{
    $default = 'USD';
    $currency = "";
    if (!isset($_COOKIE[CURRENCY_COOKIE])) {
        setcookie(CURRENCY_COOKIE, $default, time() + (86400 * 365), "/"); // 86400 = 1 day
        return 'currency=' . $default;
    }
    $currency = 'currency=' . $_COOKIE[CURRENCY_COOKIE];
    return $currency;
}
function hideEmailAddress($email)
{
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        list($first, $last) = explode('@', $email);
        $first = str_replace(substr($first, '3'), str_repeat('*', strlen($first) - 3), $first);
        $last = explode('.', $last);
        $last_domain = str_replace(substr($last['0'], '1'), str_repeat('*', strlen($last['0']) - 1), $last['0']);
        $hideEmailAddress = $first . '@' . $last_domain . '.' . $last['1'];
        return $hideEmailAddress;
    }
    return $email;
}
function getClientIp()
{
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if (isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if (isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if (isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

function parseHeaders($headers)
{
    $head = array();
    foreach ($headers as $k => $v) {
        $t = explode(':', $v, 2);
        if (isset($t[1]))
            $head[trim($t[0])] = trim($t[1]);
        else {
            $head[] = $v;
            if (preg_match("#HTTP/[0-9\.]+\s+([0-9]+)#", $v, $out))
                $head['response_code'] = intval($out[1]);
        }
    }
    return ConvertToObject($head);
}
function fetchGet($url)
{
    $context = stream_context_create(array('http' => array('ignore_errors' => true)));
    $response = json_decode(file_get_contents($url, false, $context), true);
    $response_code = substr($http_response_header[0], 9, 3);

    if ($response_code != 200) {
        return json_decode(json_encode(['error' => true, 'code' => $response_code, ...$response]));
    }
    return json_decode(json_encode($response));
}
function fetchPost($url, $body)
{
    $data = $body;

    $options = [
        'http' => [
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data),
            'ignore_errors' => true
        ],
    ];

    $context = stream_context_create($options);
    $response = json_decode(file_get_contents($url, false, $context), true);
    $response_code = substr($http_response_header[0], 9, 3);

    if ($response_code != 200) {
        return json_decode(json_encode(['error' => true, 'code' => $response_code, ...$response]));
    }
    return json_decode(json_encode($response));
}
// KITA
// function fetchGet($url)
// {
//     $response = file_get_contents($url);

//     $header = parseHeaders($http_response_header);
//     if ($header->response_code != 200) {
//         return ['error' => true];
//     }
//     $res = json_decode($response);
//     return $res;
// }

// function fetchPost($url, $body)
// {
//     $data = $body;

//     // use key 'http' even if you send the request to https://...
//     $options = [
//         'http' => [
//             'header' => "Content-type: application/x-www-form-urlencoded\r\n",
//             'method' => 'POST',
//             'content' => http_build_query($data),
//         ],
//     ];

//     $context = stream_context_create($options);
//     $response = file_get_contents($url, false, $context);
//     $header = parseHeaders($http_response_header);
//     if ($header->response_code != 200) {
//         print_r($header);
//         return ['error' => true];
//     }
//     $res = json_decode($response);

//     return $res;
// }
// END KITA

// function fetchGet($url)
// {
//     $response = wp_remote_get($url);
//     if (is_wp_error($response)) {
//         return false;
//     }
//     $data = $response['response'];
//     $body = wp_remote_retrieve_body($response);
//     $data['response'] = json_decode($body);
//     $data = json_decode(json_encode($data));
//     $res = $data->response;

//     if ($data->code == 200 && $res != null)
//         return $res;
//     else
//         return false;
// }

// function fetchPost($url, $body)
// {
//     $args = array('body' => json_decode(json_encode($body), true));
//     $response = wp_remote_post($url, $args);
//     if (is_wp_error($response)) {
//         return false;
//     }
//     $data = $response['response'];
//     $body = wp_remote_retrieve_body($response);
//     $data['response'] = json_decode($body);
//     $data = json_decode(json_encode($data));
//     $res = $data->response;

//     if ($data->code == 200 && $res != null)
//         return $res;
//     else
//         return false;
// }
