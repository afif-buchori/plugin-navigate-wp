<?php
function enx_get_list_data()
{
    $url = 'https://cae1-101-128-65-10.ngrok-free.app/api/fasttrack/list';
    // $args = array('body' => array(
    //     'from' => $_GET['from'],
    //     'to' => $_GET['to'],
    //     'date' => $_GET['date'],
    // ));
    $response = wp_remote_get($url);
    if (is_wp_error($response)) {
        // print_r($response);
        return false;
    }
    $data = $response['response'];
    $body = wp_remote_retrieve_body($response);
    $data['response'] = json_decode($body);
    // $data = json_decode($data);
    $data = json_decode(json_encode($data));
    return $data;
}

function enx_get_detail_data()
{
    $query = explode("/", $_SERVER['REQUEST_URI']);
    $url = 'https://cae1-101-128-65-10.ngrok-free.app/web/fasttrack/' . $query[2];
    // $args = array('body' => array(
    //     'from' => $_GET['from'],
    //     'to' => $_GET['to'],
    //     'date' => $_GET['date'],
    // ));
    $response = wp_remote_get($url);
    if (is_wp_error($response)) {
        return false;
    }
    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body);
    return $data;
}
