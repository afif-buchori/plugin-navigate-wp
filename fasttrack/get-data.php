<?php

function enx_get_list_data()
{
    $url = API_FASTTRACK_URL . CreateParams();
    if (isset($_GET['code'])) $url .= "&code=" . strtoupper($_GET['code']);
    return fetchGet($url);
}

function enx_get_detail_data()
{
    $query = explode("/", $_SERVER['REQUEST_URI']);
    $url = API_FASTTRACK_URL . "/" . $query[2] . CreateParams();
    return fetchGet($url);
}

function enx_service_have_addon($id)
{
    $url = API_FASTTRACK_URL . "/$id/have-addon" . CreateParams();
    return fetchGet($url)->addon_count > 0;
}

function enx_service_get_addon($id)
{
    $url = API_FASTTRACK_URL . "/$id/get-addon" . CreateParams();
    return fetchGet($url);
}

function enx_create_list($items)
{
    foreach ($items as $item) {
?>
        <div data-x-data data-x-ref="losAngeles"
            data-x-intersect="anime({ targets: $refs.losAngeles, translateY: [100, 0], opacity: [0, 1], duration: 500 ,easing: 'easeOutQuad' })"
            style="flex: 1 1 0">
            <a href="<?php echo "/" . AIRPORT_SERVICE_LINK . "/" . $item->slug ?>"
                class="group flex-1 block relative bg-cover rounded-2xl xl:my-0 overflow-hidden w-full"
                style="min-height: 480px">
                <div class="absolute bg-cover bg-center origin-top w-full rounded-2xl transition duration-500 transform translate-y-[-10px] group-hover:scale-110"
                    style="background-image: url(<?php echo
                                                    isset($item->image_url) && @getimagesize($item->image_url) ?
                                                        $item->image_url :
                                                        'https://d3837chlpocfug.cloudfront.net/28338fc3-5be8-4666-9b73-babecc70a467/build/assets/ph-notfound-d1e5c849.png';
                                                    ?>); height: 80%">
                </div>

                <!-- <div class="bg-primary absolute origin-top-right right-5 top-5 rounded text-secondary uppercase px-5 py-1 font-numbers text-xs tracking-wider">
                    4 tours
                </div> -->
                <div
                    class="absolute bottom-10 w-full bg-secondary transition duration-500 group-hover:bg-primary py-5 px-4 rounded-2xl">
                    <h3
                        class="font-heading text-xl text-transform-unset font-light text-primary transition duration-500 group-hover:text-white">
                        <?php echo $item->title ?>
                    </h3>
                    <div
                        class="w-full border-t border-primary border-opacity-40 my-6 transition duration-500 group-hover:border-white/30">
                    </div>
                    <div class="flex justify-between items-center">
                        <span
                            class="btn btn-primary hover:bg-green-light hover:text-primary py-3 transition duration-500 text-sm group-hover:bg-secondary group-hover:text-primary">
                            Explore
                        </span>
                        <div class="text-right text-primary transition duration-500 group-hover:text-white">
                            <span class="block text-sm font-numbers">From</span>
                            <span class="block text-lg font-numbers font-bold">
                                <?php echo $item->currency->symbol ?>
                                <?php echo number_format($item->rate, $item->currency->digit) ?>
                            </span>
                        </div>
                    </div>
                </div>
            </a>
        </div>


        <!-- <div data-x-data data-x-ref="losAngeles" data-x-intersect="anime({ targets: $refs.losAngeles, translateY: [100, 0], opacity: [0, 1], duration: 500 ,easing: 'easeOutQuad' })">
            <a href="<?php // echo "/" . AIRPORT_SERVICE_LINK . "/" . $item->slug 
                        ?>" class="group flex-1 block relative bg-cover rounded-2xl xl:my-0 overflow-hidden w-full h-tour xl:w-[400px] 2xl:w-[300px] h-[490px]">
                <div class="absolute bg-cover bg-center origin-top w-full h-5/6 rounded-2xl transition duration-500 transform translate-y-[-10px] group-hover:scale-110" style="background-image: url(<?php // echo $item->image_url 
                                                                                                                                                                                                        ?>);">
                </div>
                <!- <div class="bg-primary absolute origin-top-right right-5 top-5 rounded text-secondary uppercase px-5 py-1 font-numbers text-xs tracking-wider">
                    4 tours
                </div> -->
        <!-- <div class="absolute bottom-10 w-full bg-secondary transition duration-500 group-hover:bg-primary py-8 px-5 rounded-2xl">
                    <h3 class="font-heading text-xl text-transform-unset font-light text-primary transition duration-500 group-hover:text-white">
                        <?php // echo $item->title 
                        ?>
                    </h3>
                    <div class="w-full border-t border-primary border-opacity-40 my-6 transition duration-500 group-hover:border-white/30"></div>
                    <div class="flex justify-between items-center">
                        <span class="btn btn-primary hover:bg-green-light hover:text-primary py-3 transition duration-500 text-sm group-hover:bg-secondary group-hover:text-primary">
                            Explore
                        </span>
                        <div class="text-right text-primary transition duration-500 group-hover:text-white">
                            <span class="block text-sm font-numbers">From</span>
                            <span class="block text-lg font-numbers font-bold">
                                <?php // echo $item->currency->symbol 
                                ?><?php // echo number_format($item->rate, $item->currency->digit) 
                                    ?>
                            </span>
                        </div>
                    </div>
                </div>
            </a>
        </div> -->
<?php
    }
}
