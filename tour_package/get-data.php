<?php

function enx_get_list_data_tour_package()
{

    $country = $_GET['country'] ?? COUNTRY_TOUR_PACKAGE;
    $country = str_replace(' ', '%20', $country);
    // $search = $_GET['q'] ?? '';
    // $paramsSearch = $search != '' ? "&q=$search" : "";
    // $page = $_GET['page'] ?? '';
    // $paramsPage = $page != '' ? "&page=$page" : '';
    // $url = API_ACTIVITY_URL . "/get/data-activitys" . CreateParams() . "&country=$country$paramsPage$paramsSearch";
    $url = API_TOUR_PACKAGE_URL . "/get/data-list" . CreateParams() . "&slug_country=$country";
    // var_dump($url);
    // $url = API_ACTIVITY_URL . "/get/data-activitys" . CreateParams();
    return fetchGet($url);
}

function enx_get_detail_data_tour_package()
{
    $country = $_GET['country'] ?? COUNTRY_TOUR_PACKAGE;
    $country = str_replace(' ', '%20', $country);
    $query = explode("/", $_SERVER['REQUEST_URI']);
    $url = API_TOUR_PACKAGE_URL . "/get/data-detail" . CreateParams() . "&slug_country=" . $country . "&slug=" . $query[2];
    return fetchGet($url);
}

// function enx_service_have_addon($id)
// {
//     $url = API_FASTTRACK_URL . "/$id/have-addon" . CreateParams();
//     return fetchGet($url)->addon_count > 0;
// }

// function enx_service_get_addon($id)
// {
//     $url = API_FASTTRACK_URL . "/$id/get-addon" . CreateParams();
//     return fetchGet($url);
// }

function enx_create_list_tour_package($items)
{
    foreach ($items as $item) {
?>
        <div data-x-data data-x-ref="losAngeles"
            data-x-intersect="anime({ targets: $refs.losAngeles, translateY: [100, 0], opacity: [0, 1], duration: 500 ,easing: 'easeOutQuad' })"
            style="flex: 1 1 0">
            <a href="<?php echo "/" . TOUR_PACKAGE_LINK . "/" . $item->slug ?>"
                class="group flex-1 flex flex-col block relative bg-cover rounded-2xl xl:my-0 overflow-hidden w-full"
                style="min-height: 410px">
                <div class="bg-cover bg-center origin-top w-full rounded-2xl transition duration-500 transform translate-y-[-10px] group-hover:scale-110"
                    style="background-image: url(<?php echo  $item->image ?>); aspect-ratio: 16/10">
                </div>
                <div class="flex-1 flex flex-col h-full w-full bg-secondary transition duration-500 group-hover:bg-primary py-5 px-4 rounded-2xl"
                    style="z-index: 1; margin-top: -32px;">
                    <h3
                        class="font-heading text-xl text-transform-unset font-medium text-primary transition duration-500 group-hover:text-white">
                        <?php echo ucwords(strtolower($item->contents->title)) ?>
                    </h3>
                    <div class="w-full flex justify-between">
                        <p class="text-sm text-primary transition duration-500 group-hover:text-white" style="opacity: 0.7;">
                            <?php echo $item->country->name ?>
                        </p>
                        <!-- <p class="text-xs text-primary transition duration-500 group-hover:text-white"
                            style="padding: 2px 8px 4px 8px; border-radius: 9999px; border: solid 1px turquoise !important; background-color: #7fffd440">
                            <php echo $item->category ?>
                        </p> -->
                    </div>
                    <div
                        class="w-full border-t border-primary border-opacity-40 my-3 transition duration-500 group-hover:border-white/30">
                    </div>
                    <div class="flex justify-between mt-auto">
                        <div class="flex items-end text-primary transition duration-500 group-hover:text-white">
                            <!-- <php if ($item->is_instant_confirmation) { ?>
                                <div class="flex items-center gap-1 mt-auto">
                                    <svg style="width: 15px; height: 15px;" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 448 512">
                                        <path fill="#74c0fc"
                                            d="M349.4 44.6c5.9-13.7 1.5-29.7-10.6-38.5s-28.6-8-39.9 1.8l-256 224c-10 8.8-13.6 22.9-8.9 35.3S50.7 288 64 288H175.5L98.6 467.4c-5.9 13.7-1.5 29.7 10.6 38.5s28.6 8 39.9-1.8l256-224c10-8.8 13.6-22.9 8.9-35.3s-16.6-20.7-30-20.7H272.5L349.4 44.6z" />
                                    </svg>
                                    <p class="text-xs" style="line-height: 11px !important; color: #74c0fc;">instant <br />
                                        confirmation</p>
                                </div>
                            <php } ?> -->
                            <label class="flex items-center" for="peopleBooked">
                                <span class="iconify inline-block text-primary mr-1 transition duration-500 group-hover:text-white"
                                    data-icon="mdi:timer-outline" data-width="15" data-height="15"></span>
                                <?= $item->durations->first == $item->durations->last ? $item->durations->first : $item->durations->first . " ~ " . $item->durations->last ?>
                                <?= $item->durations->first > 1 || $item->durations->last > 1 ? " Days" : " Day" ?>
                            </label>
                        </div>
                        <div class="text-right text-primary transition duration-500 group-hover:text-white">
                            <span class="block text-sm font-numbers">From</span>
                            <span class="block text-lg font-numbers font-bold">
                                <?php echo $item->minimum_price_detail->currency->symbol ?>
                                <?php echo number_format($item->minimum_price, $item->minimum_price_detail->currency->digit) ?>
                            </span>
                        </div>
                    </div>
                </div>
            </a>
        </div>

<?php
    }
}
