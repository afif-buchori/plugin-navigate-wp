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
    $url = API_TOUR_PACKAGE_URL . '/get/data-list?currency=USD&slug_country=bali&limit=2';
    $fetch = fetchCardGet($url);
    $style = style();
    $script = script();
    $cek = $style . $script . '
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-7 gap-y-2">
    ';
    foreach ($fetch->data->services as $key => $value) {
        $cek .= '<div data-x-data data-x-ref="losAngeles"
            data-x-intersect="anime({ targets: $refs.losAngeles, translateY: [100, 0], opacity: [0, 1], duration: 500 ,easing: "easeOutQuad" })"
            style="flex: 1 1 0">
<a href="/' . TOUR_PACKAGE_LINK . "/" . $value->slug . '" class="group flex-1 flex flex-col block relative bg-cover rounded-2xl xl:my-0 overflow-hidden w-full"
                style="min-height: 410px">
                <div class="bg-cover bg-center origin-top w-full rounded-2xl transition duration-500 transform translate-y-[-10px] group-hover:scale-110"
                    style="background-image: url(' . $value->image . '); aspect-ratio: 16/10">
                </div>
</a>
            </div>';
    }
    '
    </div>';
    return $cek;
}

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
