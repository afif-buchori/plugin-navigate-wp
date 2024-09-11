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
    function groupDatesByMonth($dates)
    {
        $grouped_dates = [];
        foreach ($dates as $date) {
            $month_year = date('Y-m', strtotime($date));
            if (!isset($grouped_dates[$month_year])) {
                $grouped_dates[$month_year] = [];
            }
            $grouped_dates[$month_year][] = $date;
        }
        foreach ($grouped_dates as $month => $dates) {
            sort($grouped_dates[$month]);
        }
        ksort($grouped_dates);
        $result = [];
        foreach ($grouped_dates as $month => $dates) {
            $formatted_month = date('F Y', strtotime($month . '-01'));
            $result[] = [
                'monthly' => $formatted_month,
                'dates' => $dates
            ];
        }
        return $result;
    }

    $close_dates = groupDatesByMonth($data_res->close_date_time);
    // var_dump(json_encode($close_dates));
    ob_start();
    ?>
    <div class="enx-container site-wrapper">
        <div class="site-content">
            <div class="bg-gray-light3">

                <section>
                    <div class="container">
                        <div class="pt-16 pb-5 xl:py-20">
                            <!-- SLIDER -->

                            <div style="z-index: 0;" class="carousel-654-container">
                                <div class="carousel-654">
                                    <?php foreach ([$data_res->image, ...$data_res->images] as $key => $img) { ?>
                                        <div class="carousel-654-item"><img src="<?php echo $img ?>"
                                                alt="Image <?php echo $key ?>">
                                        </div>
                                    <?php } ?>
                                </div>
                                <button class="carousel-654-prev">
                                    <span style="margin-top: -4px;" class="iconify inline"
                                        data-icon="fluent:chevron-left-12-filled" data-width="20" data-height="20"></span>
                                </button>
                                <button class="carousel-654-next">
                                    <span style="margin-top: -4px;" class="iconify inline"
                                        data-icon="fluent:chevron-right-12-filled" data-width="20" data-height="20"></span>
                                </button>
                            </div>
                            <div style="width: fit-content; max-width: 100%; margin-top: -2.5rem; z-index: 1;"
                                class="hidden md:flex overflow-hidden rounded-lg mx-auto">
                                <div id="scrollbar-mystyle" class="nav-carsl-654-container shadow-lg">
                                    <div class="nav-carsl-654">
                                        <?php foreach ([$data_res->image, ...$data_res->images] as $key => $img) { ?>
                                            <div style="background-color: black;">
                                                <div class="nav-carsl-654-item"><img src="<?php echo $img ?>"
                                                        alt="Image <?php echo $key ?>">
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <!-- END SLIDER -->

                            <!-- <div class="md:hidden w-full flex" style="overflow-x: auto;">
                                <div class="flex gap-2" style="padding-bottom: 8px;">
                                    <img src="<php echo $data_res->image ?>" width="320px" class="rounded-lg"
                                        style="aspect-ratio: 16/9; border: solid 1px black;"> -->
                            <!-- <php foreach ($data_res->media as $idx => $media) {
                                                if ($idx < 3) { ?>
                                            <img src="<php echo $data->imageUrl . $media->path ?>" width="320px" class="rounded-lg"
                                                style="aspect-ratio: 16/9; object-fit: cover;">
                                        <php }
                                            } ?> -->
                            <!-- </div>
                            </div> -->
                            <!-- <div class="hidden md:grid grid-cols-4 gap-2">
                                <div
                                    class="<php echo count($data_res->images) > 0 ? " md:col-span-3" : "md:col-span-4" ?> ">
                                    <img src="<php echo $data_res->image ?>" width="100%" class="rounded-lg"
                                        style="aspect-ratio: 16/9;">
                                </div>
                                <div class="col-span-1 w-full h-full hidden md:flex flex-col justify-between">
                                    <php foreach ($data_res->images as $idx => $media) {
                                        if ($idx < 3) { ?>
                                            <img src="<php echo $media ?>" width="100%" class="rounded-lg"
                                                style="aspect-ratio: 16/9; object-fit: cover;">
                                        <php }
                                    } ?>
                                </div>
                            </div> -->

                            <div class="grid grid-cols-10 gap-4 pt-7">
                                <div class="col-span-12 md:col-span-7">
                                    <h1 class="col-span-3 md:text-2xl font-bold">
                                        <?php echo $data_res->contents->title ?>
                                    </h1>
                                    <p id="detail-tp-title-package" class="col-span-3 md:text-2xl font-bold italic"></p>
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
                                            <p id="detail-tp-duration">
                                                <?php
                                                $duration_first = $contents->duration->first;
                                                $duration_last = $contents->duration->last;
                                                echo $duration_first == $duration_last ? $duration_first : $duration_first . " ~ " . $duration_last
                                                    ?>
                                                Days
                                            </p>
                                        </div>
                                        <span style="width: 2px; background-color: #45474B50;"></span>
                                        <div class="flex gap-2 items-center">
                                            <span class="iconify inline" data-icon="mdi:home-city-outline" data-width="20"
                                                data-height="20"></span>
                                            <p id="detail-tp-cities-visited">
                                                <?php
                                                $cities_visited_first = $contents->cities_visited->first;
                                                $cities_visited_last = $contents->cities_visited->last;
                                                echo $cities_visited_first == $cities_visited_last ? $cities_visited_first : $cities_visited_first . " ~ " . $cities_visited_last
                                                    ?>
                                                Cities Visited
                                            </p>
                                        </div>
                                        <span style="width: 2px; background-color: #45474B50;"></span>
                                        <div class="flex gap-2 items-center">
                                            <span class="iconify inline" data-icon="ion:ticket-outline" data-width="20"
                                                data-height="20"></span>
                                            <p>E-ticket</p>
                                        </div>
                                    </div>
                                    <!-- END LIST ICON -->
                                    <p id="detail-tp-description" style="text-align: justify;" class="mt-10 mb-10">
                                        <?php echo $data_res->contents->description ?>
                                    </p>

                                    <!-- BLOCK DATE -->
                                    <?php if (count($close_dates) > 0) { ?>
                                        <div style="background-color: #EB367810;" class="widget shadow-lg rounded-xl mb-10">
                                            <p class="font-bold text-lg p-4 border-b-2 border-primary border-opacity-10">Close
                                                Date
                                            </p>
                                            <div class="p-4 pt-0">
                                                <?php foreach ($close_dates as $key => $data_dates) { ?>
                                                    <p style="opacity: 0.4; <?php echo $key > 0 ? "border-top: solid 1px #45474B60 !important;" : "" ?>"
                                                        class="font-bold <?php echo $key > 0 ? "mt-4" : "" ?> pt-4">
                                                        <?php echo $data_dates['monthly'] ?>
                                                    </p>
                                                    <div class="flex flex-wrap gap-x-4 px-2">
                                                        <?php foreach ($data_dates['dates'] as $kd => $c_date) { ?>
                                                            <p style="width: 140px;">
                                                                <?php echo date_format(new DateTime($c_date), "d M Y") ?>
                                                            </p>
                                                        <?php } ?>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <!-- END BLOCK DATE -->

                                    <!-- ITINERARY -->
                                    <p class="mt-6 mb-2">What To Expect</p>
                                    <div style="border: solid 1px #D1E9F6 !important; background-color: #fff !important;"
                                        class="p-4 flex flex-col gap-4 md:flex-row rounded-lg bg-gray-light3 shadow-lg">
                                        <div id="scrollbar-mystyle" style="overflow-x: auto; overflow-y: hidden;"
                                            class="flex">
                                            <div class="flex">
                                                <?php foreach ($contents->itinerary as $key_day => $itin_day) { ?>
                                                    <button class="whitespace-nowrap p-4 border-b-2 rounded-none">Day
                                                        <?php echo $key_day + 1 ?></button>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END ITINERARY -->

                                    <div class="bg-white rounded-lg">
                                        <div style="border: solid 1px #D1E9F6 !important; background-color: #D1E9F660 !important;"
                                            class="p-4 flex flex-col gap-4 md:flex-row rounded-lg bg-gray-light3 shadow-lg">
                                            <div class="flex-1 flex flex-col gap-2">
                                                <h2 style="border-bottom: solid 2px black !important; width: fit-content;"
                                                    class="font-bold">
                                                    Include:</h2>
                                                <div id="content_includes">
                                                    <?php foreach ($data_res->contents->include as $key => $incl) { ?>
                                                        <div class="text-sm md:text-base flex gap-2">
                                                            <span class="iconify inline-block text-green-success"
                                                                data-icon="akar-icons:circle-check" data-width="20"
                                                                data-height="20" style="margin-top: 0.125rem"></span>
                                                            <p class="flex-1"><?php echo $incl ?></p>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="flex-1 flex flex-col gap-2">
                                                <h2 style="border-bottom: solid 2px black !important; width: fit-content;"
                                                    class="font-bold">
                                                    Exclude:</h2>
                                                <div id="content_excludes">
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
                                                    style="margin-bottom: 0px !important;" class="w-full btn-primary">Book
                                                    Now</button>
                                            </div>

                                            <p id="error-msg-list-package" class="error-message text-center"></p>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <?php include_once plugin_dir_path(__FILE__) . 'contents/list-package.php'; ?>
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
