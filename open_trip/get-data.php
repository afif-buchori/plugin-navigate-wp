<?php

function enx_get_list_country_opentrip()
{
    $url = API_OPENTRIP_URL . "/country" . CreateParams();
    try {
        $fetch = fetchPost($url, ['companyId' => COMPANY_ID]);
        return $fetch->data;
    } catch (\Throwable $th) {
        return null;
    }
}

function enx_get_list_data_opentrip()
{
    $query = array_values(array_filter(explode("/", $_SERVER['REQUEST_URI'])));
    $country = strtolower($_GET['slug'] ?? COUNTRY_TOUR_PACKAGE);
    $country = str_replace(' ', '%20', $country);
    if (isset($query[1]) && !str_contains($query[1], 'slug'))
        $country = $query[1];
    $url = API_OPENTRIP_URL . "/listdata" . CreateParams();
    try {
        $fetch = fetchPost($url, ['companyId' => COMPANY_ID, 'countrySlug' => $country]);
        return $fetch->data;
    } catch (\Throwable $th) {
        return null;
    }
}
function enx_get_detail_opentrip()
{
    $query = array_values(array_filter(explode("/", $_SERVER['REQUEST_URI'])));
    $country = strtolower($_GET['slug'] ?? COUNTRY_TOUR_PACKAGE);
    $country = str_replace(' ', '%20', $country);
    if (isset($query[1]) && !str_contains($query[1], 'slug'))
        $country = $query[1];
    $url = API_OPENTRIP_URL . "/detail" . CreateParams();
    try {
        $fetch = fetchPost($url, ['companyId' => COMPANY_ID, 'countrySlug' => $query[1], "slug" => $query[2]]);
        return $fetch->data;
    } catch (\Throwable $th) {
        return null;
    }
}