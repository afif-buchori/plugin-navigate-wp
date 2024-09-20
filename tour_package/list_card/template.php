<?php

function style()
{
    return '<link rel="stylesheet" type="text/css" href="' . plugins_url('/contents/style.css', __FILE__) . '">';
}

function script()
{
    return '<script src="' . plugins_url('/contents/script.js', __FILE__) . '" defer></script>';
}
function get_contents($datas)
{
    // $url = API_TOUR_PACKAGE_URL . '/get/data-list?currency=USD&slug_country=bali&limit=8';
    $url = '/api/tour-package/list-data';
    $route = TOUR_PACKAGE_LINK;
    $style = style();
    $script = script();

    $slug = $datas['slug'] ?? "";
    $limit = $datas['limit'] ?? "";

    $output = $style . $script . '
            <div class="sct-container-card" data-url="' . $url . '" data-route="' . $route . '" data-slug-country="' . $slug . '" data-limit="' . $limit . '">
            </div>';
    return $output;

}

// With PHP
// function get_contents($datas)
// {
//     $url = API_TOUR_PACKAGE_URL . '/get/data-list?currency=USD&slug_country=bali&limit=8';
//     $style = style();
//     $script = script();

//     try {
//         $fetch = fetchCardGet($url);

//         if ($fetch->result == "ok") {
//             $cek = $style . $script . '
//             <div class="sct-container-card">
//             ';
//             foreach ($fetch->data->services as $key => $value) {

//                 $global_information = $value->contents->global_information ?? null;
//                 $duration = "";
//                 if ($global_information) {
//                     $duration = $global_information->duration;
//                     $day = $duration->day;
//                     $hour = $duration->hour;
//                     $minute = $duration->minute;
//                     if ($day > 0)
//                         $duration = ($hour > 0 ? $day + 1 : $day) . ($day > 1 || $hour > 0 ? " Days" : " Day");
//                     if ($day <= 0 && $hour > 0)
//                         $duration = $hour . ($hour > 1 ? " Hours" : " Hour");
//                     if ($day <= 0 && $minute > 0)
//                         $duration .= $minute . ($minute > 1 ? " Minutes" : " Minute");
//                     if ($duration->approx)
//                         $duration .= " (approx.)";
//                 }
//                 $cek .= '
//                 <div class="sct-card">
//                     <a href="/' . TOUR_PACKAGE_LINK . "/" . $value->slug . '">
//                         <div class="sct-card-top">    
//                             <img src=' . $value->image . ' alt="img-tour" class="sct-img-card">
//                         </div>
//                         <div class="sct-card-bottom">
//                             <p class="sct-title">' . $value->contents->title . '</p>
//                             <div class="sct-conloc">
//                                 <span class="iconify" data-icon="ic:outline-location-on" data-width="15" data-height="15"></span>
//                                 <p>' . $value->country->name . '</p>
//                             </div>
//                             <div class="sct-container-info-card">
//                                 <div class="sct-duration">
//                                     <span class="iconify" data-icon="ic:outline-location-on" data-width="15" data-height="15"></span>
//                                     <p>' . $duration . '</p>
//                                 </div>
//                                 <div class="sct-info-price">
//                                     <p>Start From</p>
//                                     <p>' .
//                     'USD'
//                     // $value->minimum_price_detail->currency->symbol
//                     // . number_format($value->minimum_price, $value->minimum_price_detail->currency->digit) 
//                     . '
//                                     </p>
//                                 </div>
//                             </div>
//                         </div>
//                     </a>
//                 </div>';
//             }
//             '
//             </div>';
//             return $cek;
//         } else {
//             return "else";
//         }
//     } catch (\Throwable $th) {
//         //throw $th;
//         return "gagal";
//     }
// }
// End With PHP

function fetchCardGet($url)
{
    $context = stream_context_create(array('http' => array('ignore_errors' => true)));
    $response = json_decode(file_get_contents($url, false, $context), true);
    $response_code = substr($http_response_header[0], 9, 3);

    if ($response_code != 200) {
        return json_decode(json_encode(['error' => true, 'code' => $response_code, ...$response]));
    }
    return json_decode(json_encode($response));
}
