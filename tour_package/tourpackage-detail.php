<?php
function enx_get_page_content($data)
{
    // var_dump($data);
    // die();
    // $data = enx_get_detail_data();
    // $res_tour = $data->service;
    $data_res = $data->service;
    $contents = $data_res->contents;
    $currency = $data_res->minimum_price->price_detail->currency;
    // var_dump(json_encode($contents));
    ob_start();
    ?>
    <div class="enx-container site-wrapper">
        <div class="site-content">
            <div class="bg-gray-light3">

                <section>
                    <div class="container">
                        <div class="pt-16 pb-5 xl:py-20">
                            <div class="md:hidden w-full flex" style="overflow-x: auto;">
                                <div class="flex gap-2" style="padding-bottom: 8px;">
                                    <img src="<?php echo $data_res->image ?>" width="320px" class="rounded-lg"
                                        style="aspect-ratio: 16/9; border: solid 1px black;">
                                    <!-- <php foreach ($data_res->media as $idx => $media) {
                                                if ($idx < 3) { ?>
                                            <img src="<php echo $data->imageUrl . $media->path ?>" width="320px" class="rounded-lg"
                                                style="aspect-ratio: 16/9; object-fit: cover;">
                                        <php }
                                            } ?> -->
                                </div>
                            </div>
                            <div class="hidden md:grid grid-cols-4 gap-2">
                                <div
                                    class="<?php echo count($data_res->images) > 0 ? " md:col-span-3" : "md:col-span-4" ?> ">
                                    <img src="<?php echo $data_res->image ?>" width="100%" class="rounded-lg"
                                        style="aspect-ratio: 16/9;">
                                </div>
                                <div class="col-span-1 w-full h-full hidden md:flex flex-col justify-between">
                                    <?php foreach ($data_res->images as $idx => $media) {
                                        if ($idx < 3) { ?>
                                            <img src="<?php echo $media ?>" width="100%" class="rounded-lg"
                                                style="aspect-ratio: 16/9; object-fit: cover;">
                                        <?php }
                                    } ?>
                                </div>
                            </div>

                            <div class="grid grid-cols-10 gap-4 pt-7">
                                <div class="col-span-12 md:col-span-7">
                                    <h1 class="col-span-3 md:text-2xl font-bold">
                                        <?php echo $data_res->contents->title ?>
                                    </h1>
                                    <p>
                                        <span class="iconify inline" data-icon="mdi:location" data-width="20"
                                            data-height="20"></span>
                                        <?php echo $data_res->country->name ?>
                                    </p>

                                    <!-- LIST ICON -->
                                    <div style="border-top: solid 2px #45474B50 !important; border-bottom: solid 2px #45474B50 !important; align-items: stretch;"
                                        class="flex gap-4 p-4 mt-5">
                                        <div class="flex gap-2 items-center">
                                            <span class="iconify inline" data-icon="mingcute:time-duration-fill"
                                                data-width="20" data-height="20"></span>
                                            <p><?php echo $contents->duration->first . " ~ " . $contents->duration->last ?>
                                                Days</p>
                                        </div>
                                        <span style="width: 2px; background-color: #45474B50;"></span>
                                        <div class="flex gap-2 items-center">
                                            <span class="iconify inline" data-icon="mdi:home-city-outline" data-width="20"
                                                data-height="20"></span>
                                            <p><?php echo $contents->cities_visited->first . " ~ " . $contents->cities_visited->last ?>
                                                Cities Visited</p>
                                        </div>
                                        <span style="width: 2px; background-color: #45474B50;"></span>
                                        <div class="flex gap-2 items-center">
                                            <span class="iconify inline" data-icon="ion:ticket-outline" data-width="20"
                                                data-height="20"></span>
                                            <p>E-ticket</p>
                                        </div>
                                    </div>
                                    <!-- LIST ICON -->
                                    <p style="text-align: justify;" class="mt-10 mb-10">
                                        <?php echo $data_res->contents->description ?>
                                    </p>


                                    <div id="" class="w" data-x-data="accordionInit()">

                                        <div class="widget shadow-lg rounded-xl mb-10 bg-white">
                                            <h5
                                                class="font-heading text-xl text-primary font-bold border-b-2 border-primary border-opacity-10 px-7 py-3">
                                                Itinerary
                                                <input type="radio" class="hidden"
                                                    name="addon_<php echo $contents->itinerary ?>" value="notset"
                                                    checked="checked" />
                                            </h5>
                                            <div class="px-2 md:px-8">

                                                <?php
                                                $n = 0;
                                                $i = 0;
                                                foreach ($contents->itinerary as $key => $item) {
                                                    if ($i > 0)
                                                        echo "<hr />";
                                                    ?>
                                                    <div
                                                        class="md:grid grid-cols-12 md:space-x-4 relative <?php echo ($i == (count($contents->itinerary) - 1) ? 'smt-4' : ($i > 0 ? 'smy-4' : 'smb-4')) ?>">
                                                        <div class="col-span-12 py-5">
                                                            <?php if (count($contents->itinerary) > 1) { ?>
                                                                <span class="absolute left-45px md:left-55px"
                                                                    style="border-left: solid 2px #BBE9FF !important; position: absolute; top: 0px; left: 58px; 
                                                                    height: <?php echo count($contents->itinerary) === $key + 1 ? "30px" : ($key === 0 ? 'calc(100% - 30px)' : '100%'); ?>; 
                                                                    top: <?php echo $key === 0 ? "30px" : "0px" ?> ;"></span>
                                                            <?php } ?>
                                                            <div class="flex items-center justify-between cursor-pointer"
                                                                data-x-bind="trigger(<?php echo $n; ?>)">
                                                                <div class="flex gap-2 text-xs md:text-base">
                                                                    <strong style="opacity: 0.6;" class="whitespace-nowrap">Day
                                                                        <?php echo $key ?>
                                                                    </strong>
                                                                    <span class="mt-0.5 md:mt-1.5"
                                                                        style="width: 12px; height: 12px; border-radius: 99px; background-color: #BBE9FF;"></span>
                                                                    <strong class="flex-1"><?php echo $item->title ?></strong>
                                                                </div>
                                                                <span class="iconify -mt-1 transition-all duration-500 inline"
                                                                    data-icon="fluent:chevron-down-12-regular" data-width="20"
                                                                    data-height="20"
                                                                    data-x-bind="iconStyle(<?php echo $n; ?>)"></span>
                                                            </div>
                                                            <div class="relative overflow-hidden transition-all max-h-0 duration-700 inner-text-sm ml-14 md:ml-72px mt-2"
                                                                data-x-ref="container-<?php echo $n; ?>"
                                                                data-x-bind="containerStyle(<?php echo $n; ?>)">
                                                                <span>
                                                                    <?php echo $item->description ?>
                                                                </span>
                                                                <?php if ($item->with_add_info) {
                                                                    $icon = [
                                                                        'utensils' => '<span class="iconify mt-1 inline"
                                                                                    data-icon="fa6-solid:utensils" data-width="16"
                                                                                    data-height="16"></span>',
                                                                        'plane' => '<span class="iconify mt-1 inline" data-icon="ri:plane-fill"
                                                                                    data-width="16" data-height="16"></span>'
                                                                    ];
                                                                    foreach ($item->add_info as $key => $info) {
                                                                        ?>
                                                                        <div class="flex gap-2 <?php echo $key == 0 ? "mt-4" : "" ?>">
                                                                            <?php echo $icon[$info->icon] ?? "" ?>
                                                                            <p><?php echo $info->description ?></p>
                                                                        </div>
                                                                    <?php }
                                                                } ?>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <?php
                                                    $n++;
                                                    $i++;
                                                } ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="bg-white rounded-lg">
                                        <div style="border: solid 1px #D1E9F6 !important; background-color: #D1E9F660 !important;"
                                            class="p-4 flex flex-col gap-4 md:flex-row rounded-lg bg-gray-light3 shadow-lg">
                                            <div class="flex-1 flex flex-col gap-2">
                                                <h2 style="border-bottom: solid 2px black !important; width: fit-content;"
                                                    class="font-bold">
                                                    Include:</h2>
                                                <?php foreach ($data_res->contents->include as $key => $incl) { ?>
                                                    <div class="text-sm md:text-base flex gap-2">
                                                        <span class="iconify inline-block text-green-success"
                                                            data-icon="akar-icons:circle-check" data-width="20" data-height="20"
                                                            style="margin-top: 0.125rem"></span>
                                                        <p class="flex-1"><?php echo $incl ?></p>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <div class="flex-1 flex flex-col gap-2">
                                                <h2 style="border-bottom: solid 2px black !important; width: fit-content;"
                                                    class="font-bold">
                                                    Exclude:</h2>
                                                <?php foreach ($data_res->contents->exclude as $key => $excl) { ?>
                                                    <div class="text-sm md:text-base flex gap-2">
                                                        <span class="iconify inline-block text-red-error"
                                                            data-icon="radix-icons:cross-circled" data-width="20"
                                                            data-height="20" style="margin-top: 0.12rem"></span>
                                                        <p class="flex-1"><?php echo $excl ?></p>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="btn-open-modal-tc-detail"
                                        style="border: solid 2px #FFDE4D !important; background-color: #45474B; padding: 1rem 40px 1rem 1rem;"
                                        class="relative rounded-lg mt-10 shadow-lg cursor-pointer">
                                        <div style="color: #FFDE4D;" class="flex gap-2">
                                            <span id="animate-pulse" class="iconify mt-1 inline"
                                                data-icon="akar-icons:info-fill" data-width="20" data-height="20"></span>
                                            <p class="font-bold">Term and Conditions</p>
                                        </div>
                                        <p class="text-white text-xs md:text-sm">By placing an order, you must accept the
                                            terms and conditions.
                                            Please read first
                                            to be sure.</p>
                                        <span style="top: calc(50% - 20px); right: 14px;"
                                            class="iconify mt-1 inline animate-pulse absolute text-white"
                                            data-icon="typcn:chevron-right" data-width="32" data-height="32"></span>
                                    </div>
                                    <?php include_once plugin_dir_path(__FILE__) . 'contents/modal-termcondition.php'; ?>
                                </div>

                                <div class="col-span-3 hidden md:flex flex-col relative">
                                    <form id="form-package-detail-tourpackage" method="post"
                                        class="shadow shadow-lg sticky top-28 right-0" style="
                                        width: 100%;
                                        border-radius: 8px;
                                        background-color: white;
                                        overflow: hidden;
                                    ">
                                        <div style="background-color: #18551915;" class="flex p-4 justify-between">
                                            <p class="">Start From </p>
                                            <p id="min-price-detail" class="font-bold">
                                                <?php echo $currency->symbol ?>
                                                <?php echo number_format($data_res->minimum_price->price, $currency->digit) ?>
                                            </p>
                                        </div>
                                        <!-- <p class="mb-2">Start From <span class="font-bold">
                                                <php echo $currency->symbol ?>
                                                <php echo number_format($res_tour->original_price, $currency->digit) ?></span>
                                        </p> -->

                                        <div class="p-4">
                                            <p class="text-sm">Date:</p>
                                            <input type="date" name="date" min="<?php echo date('Y-m-d\TH:i') ?>"
                                                id="tp_date_detail" data-service='<?= json_encode([
                                                    'slug' => $data_res->slug,
                                                    'slug_country' => $data_res->country->slug
                                                ]) ?>'
                                                class="w-full form-input bg-gray-light4/60 border-none rounded py-2 px-5 w-auto font-numbers font-medium text-center text-primary/90 focus:ring-2 focus:ring-primary placeholder-gray-400 text-sm mb-4" />

                                            <div id="btn-slc-package-detail" class="hidden">
                                                <p class="text-sm">Package:</p>
                                                <button id="btn-open-list-modal-package" type="button"
                                                    class="w-full btn-primary mb-4">Select
                                                    Package</button>
                                            </div>
                                            <div id="loading-select-package-detail" class="hidden">
                                                <div id="skeleton-pulse" style="background-color: #405D72;"
                                                    class="w-full h-10 rounded-lg"></div>
                                            </div>
                                            <!-- DATA -->
                                            <textarea name="package-data" hidden
                                                value="<?php echo json_encode([]) ?>"></textarea>
                                            <input type="hidden" name="package-selected" value="">
                                            <!-- END DATA -->

                                            <div id="btn-inpt-passanger-detail" class="hidden">
                                                <div class="flex flex-col gap-1 mb-4">
                                                    <div id="div-qtydetail-adult" class="flex items-center justify-between">
                                                        <p>Adult:</p>
                                                        <div class="w-40"><?php renderInputNumber("adult", 1, 1) ?></div>
                                                    </div>
                                                    <div id="div-qtydetail-child"
                                                        class="flex items-center justify-between hidden">
                                                        <p>Child:</p>
                                                        <div class="w-40"><?php renderInputNumber("child", 0, 0) ?></div>
                                                    </div>
                                                    <div id="div-qtydetail-infant"
                                                        class="flex items-center justify-between hidden">
                                                        <p>Infant:</p>
                                                        <div class="w-40"><?php renderInputNumber("infant", 0, 0) ?></div>
                                                    </div>
                                                </div>

                                                <div class="flex justify-between font-bold mb-2">
                                                    <p>Total</p>
                                                    <div id="loader-total-price-detail" class="loader-dots-654 hidden">
                                                        <div></div>
                                                    </div>
                                                    <p id="total-price-detail">USD 0.00</p>
                                                </div>

                                                <button id="find-package-tourpack" type="submit"
                                                    class="w-full btn-primary">Book Now</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- <div id="package-opt-activity" class="w-full flex flex-col gap-4 p-4 rounded-lg mt-10"
                                style="background-color: #4cc0ce40;" data-package="<php echo count($data->ticket) ?>">
                                <h3 class="font-bold">Package Options</h3>
                                <php enx_mapping_card($data->ticket, $data_res, $currency) ?>
                            </div> -->

                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
    <?php
    $contents = ob_get_clean();
    return $contents;
}
