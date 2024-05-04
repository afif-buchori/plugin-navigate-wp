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
    session_start();
    $_SESSION['CART_ACTIVITY'] = json_decode(file_get_contents("php://input"));

    return '/' . ACTIVITY_LINK . '/booking';
    // return $_SESSION['CART_ACTIVITY'];
}

function enx_post_booking_act()
{
    session_start();
    $dataSession = json_decode(json_encode($_SESSION['CART_ACTIVITY']), true) ?? [];
    if ($dataSession && isset($dataSession[0]['questionList'])) {
        $questionLists = [];

        foreach ($dataSession[0]['questionList'] as $question) {
            $name = $question['name'];
            unset($question['name']);
            $ticketId = $question['ticketId'];
            $ticketName = $question['ticketName'];
            unset($question['ticketId'], $question['ticketName']);

            $key = $name . '-' . $ticketId . '-' . $ticketName;

            if (!isset($questionLists[$key])) {
                $questionLists[$key] = [
                    'name' => $name,
                    'ticketId' => $ticketId,
                    'ticketName' => $ticketName,
                    'questions' => []
                ];
            }

            $questionLists[$key]['questions'][] = $question;
        }

        $dataSession[0]['questionList'] = array_values($questionLists);
        $dataSession[0]['ticketTypes'] = $dataSession[0]['ticketType'];
        unset($dataSession[0]['ticketType']);
    }

    $url = API_ACTIVITY_URL . "/post/booking";
    $req = json_decode(file_get_contents("php://input"), true);
    $req['currency'] = DEFAULT_CURRENCY;
    $req['url_payment_info'] = 'https://' . $_SERVER['HTTP_HOST'] . '/' . ACTIVITY_LINK . '/payment-info';
    $dataSession = ['cart_activity' => $dataSession];
    // $req = json_encode([...$req, ...$dataSession]);
    $req = json_decode(json_encode([...$req, ...$dataSession]));
    // return $req;
    $data = fetchPost($url, $req);
    unset($_SESSION['CART_ACTIVITY']);
    return $data;
}
