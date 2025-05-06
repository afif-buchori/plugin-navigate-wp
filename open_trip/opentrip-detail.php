<?php
function enx_get_page_content($data)
{
    function formatTravelPeriod($periodFrom, $periodTo)
    {
        $from = DateTime::createFromFormat('Y-m-d', $periodFrom);
        $to = DateTime::createFromFormat('Y-m-d', $periodTo);

        if (!$from || !$to)
            return '';

        $sameYear = $from->format('Y') === $to->format('Y');
        $sameMonth = $from->format('m') === $to->format('m');

        if ($sameYear && $sameMonth) {
            // Contoh: 01 - 31 Jan 2025
            return $from->format('d') . ' - ' . $to->format('d M Y');
        } elseif ($sameYear) {
            // Contoh: 01 Jan - 31 Des 2025
            return $from->format('d M') . ' - ' . $to->format('d M Y');
        } else {
            // Contoh: 01 Jan 2025 - 31 Des 2026
            return $from->format('d M Y') . ' - ' . $to->format('d M Y');
        }
    }
    // dd($data);
    // $data_res = $data->service;
    // $contents = $data_res->contents;
    // $currency = $data_res->minimum_price->price_detail->currency;
    // $global_information = $contents->global_information ?? null;
    // function groupDatesByMonth($dates)
    // {
    //     $grouped_dates = [];
    //     foreach ($dates as $date) {
    //         $month_year = date('Y-m', strtotime($date));
    //         if (!isset($grouped_dates[$month_year])) {
    //             $grouped_dates[$month_year] = [];
    //         }
    //         $grouped_dates[$month_year][] = $date;
    //     }
    //     foreach ($grouped_dates as $month => $dates) {
    //         sort($grouped_dates[$month]);
    //     }
    //     ksort($grouped_dates);
    //     $result = [];
    //     foreach ($grouped_dates as $month => $dates) {
    //         $formatted_month = date('F Y', strtotime($month . '-01'));
    //         $result[] = [
    //             'monthly' => $formatted_month,
    //             'dates' => $dates
    //         ];
    //     }
    //     return $result;
    // }

    // $close_dates = groupDatesByMonth($data_res->close_date_time);
    ob_start();
    ?>
    <!-- <script>
        const itin = <php echo json_encode($contents->itinerary) ?>;
    </script> -->

    <div class="enx-container site-wrapper">
        <div class="site-content">
            <div class="">

                <section data-period='<?= json_encode($data->travelPeriods[0]) ?>' data-serviceid="<?= $data->id ?>"
                    id="period-selected">
                    <div class="container">
                        <div class="pb-5 xl:pb-20">
                            <!-- SLIDER -->

                            <div style="z-index: 0; flex-shrink: 1; overflow-y: clip;" class="px-7 flex relative">
                                <div style="z-index: -1; width: 100vw; left: 50%; transform: translateX(-50%);"
                                    class="absolute bottom-0">
                                    <img data-imgs='<?php echo json_encode([$data->image, ...$data->images]) ?>'
                                        id="img-bg-blur-detail" src="<?php echo $data->image ?>" alt=""
                                        style="filter: blur(5px);" class="w-full">
                                </div>
                                <div style="z-index: 1;" class="carousel-654-container">
                                    <div class="carousel-654">
                                        <?php foreach ([$data->image, ...$data->images] as $key => $img) { ?>
                                            <div class="carousel-654-item"><img src="<?php echo $img ?>"
                                                    alt="Image <?php echo $key ?>">
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <button class="carousel-654-prev">
                                        <span style="margin-top: -4px;" class="iconify inline"
                                            data-icon="fluent:chevron-left-12-filled" data-width="20"
                                            data-height="20"></span>
                                    </button>
                                    <button class="carousel-654-next">
                                        <span style="margin-top: -4px;" class="iconify inline"
                                            data-icon="fluent:chevron-right-12-filled" data-width="20"
                                            data-height="20"></span>
                                    </button>
                                </div>
                            </div>
                            <div style="width: fit-content; max-width: 100%; margin-top: -2.5rem; z-index: 2;"
                                class="hidden md:flex overflow-hidden rounded-lg mx-auto">
                                <div id="scrollbar-mystyle" class="nav-carsl-654-container shadow-lg">
                                    <div class="nav-carsl-654">
                                        <?php foreach ([$data->image, ...$data->images] as $key => $img) { ?>
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

                            <div class="grid grid-cols-10 gap-4 pt-7">
                                <div class="col-span-12 md:col-span-7">
                                    <h1 class="col-span-3 md:text-2xl font-bold">
                                        <?= $data->name ?>
                                    </h1>
                                    <p id="detail-tp-title-package" class="col-span-3 md:text-2xl font-bold italic"></p>
                                    <p>
                                        <span class="iconify inline" data-icon="mdi:location" data-width="20"
                                            data-height="20"></span>
                                        <?= $data->country->name ?>
                                    </p>

                                    <!-- LIST ICON -->
                                    <div style="border-top: solid 2px #45474B50 !important; border-bottom: solid 2px #45474B50 !important; align-items: stretch;"
                                        class="flex flex-wrap gap-4 p-4 mt-5">
                                        <div class="flex gap-2 items-center">
                                            <span class="iconify inline" data-icon="mingcute:time-duration-fill"
                                                data-width="20" data-height="20"></span>
                                            <p id="period-day-duration"> 0 Days</p>
                                        </div>
                                        <div class="flex gap-2 items-center">
                                            <span class="iconify inline" data-icon="mdi:city-variant-outline"
                                                data-width="20" data-height="20"></span>
                                            <p id="period-cities-visited"> 0 Cities Visited</p>
                                        </div>
                                        <div class="flex gap-2 items-center">
                                            <span class="iconify inline" data-icon="mdi:flight" data-width="20"
                                                data-height="20"></span>
                                            <p id="period-airline">Airlines</p>
                                        </div>
                                        <div class="flex gap-2 items-center">
                                            <span class="iconify inline" data-icon="mdi:airplane-takeoff" data-width="20"
                                                data-height="20"></span>
                                            <p id="period-departure-from">Keberangkatan</p>
                                        </div>
                                    </div>
                                    <div class="my-4">
                                        <p><?= $data->description ?></p>
                                    </div>

                                    <!-- END LIST ICON -->
                                    <!-- <div id="detail-tp-description" style="text-align: justify;" class="my-10 reset-tw">
                                        <= $data?->contents?->description ?>
                                    </div> -->

                                    <!-- ITINERARY -->
                                    <p class="mt-10 mb-2">What To Expect</p>
                                    <div id="itinerary-ot" class="p-4 bg-white rounded-xl"></div>
                                    <!-- END ITINERARY -->

                                    <!-- INCLUDE EXCLUDE -->
                                    <div class="bg-white rounded-lg my-10">
                                        <div style="border: solid 1px #D1E9F6 !important; background-color: #D1E9F660 !important;"
                                            class="p-4 flex flex-col gap-4 md:flex-row rounded-lg bg-gray-light3 shadow-lg">
                                            <div class="flex-1 flex flex-col gap-2">
                                                <h2 style="border-bottom: solid 2px black !important; width: fit-content;"
                                                    class="font-bold">
                                                    Include:</h2>
                                                <div id="content_includes">
                                                    <?php foreach ($data->include as $key => $incl) { ?>
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
                                                    <?php foreach ($data->exclude as $key => $excl) { ?>
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
                                    <!-- INCLUDE EXCLUDE -->

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
                                    <!-- <php include_once plugin_dir_path(__FILE__) . 'contents/modal-termcondition.php'; ?> -->
                                </div>

                                <div
                                    class="col-span-12 md:col-span-3 flex flex-col relative border-t md:border-t-0 pt-10 md:pt-0">
                                    <form id="form-period-opentrip" method="post"
                                        class="shadow shadow-lg sticky top-28 right-0" style="
                                        width: 100%;
                                        border-radius: 8px;
                                        background-color: white;
                                        overflow: hidden;
                                    ">
                                        <div style="background-color: #18551915;" class="flex p-4 justify-between">
                                            <p class="">Start From </p>
                                            <p id="min-price-detail" class="font-bold"></p>
                                        </div>
                                        <div id="data-travel-periods" class="p-4"
                                            data-travelperiods='<?= json_encode($data->travelPeriods) ?>'>
                                            <p class="text-sm">Select Date & Departur City:</p>
                                            <select id="ot-date-select"
                                                class="w-full form-input bg-gray-light4/60 border-none rounded py-2 px-5 w-auto font-numbers font-medium text-center text-primary/90 focus:ring-2 focus:ring-primary placeholder-gray-400 text-sm mb-4">
                                                <?php foreach ($data->travelPeriods as $travPeriod) { ?>
                                                    <option value="<?= $travPeriod->id ?? "" ?>" style="text-align: left;"
                                                        <?= $travPeriod->status === "Expired" ? "disabled" : "" ?>>
                                                        <?= formatTravelPeriod($travPeriod->periodFrom, $travPeriod->periodTo) ?>
                                                        ~ <?= $travPeriod->departureFrom ?>
                                                        <?= $travPeriod->status === "Expired" ? " ~ (Full Book)" : "" ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                            <!-- <input type="date" name="date" min="<php echo date('Y-m-d\TH:i') ?>"
                                                id="tp_date_detail"
                                                class="w-full form-input bg-gray-light4/60 border-none rounded py-2 px-5 w-auto font-numbers font-medium text-center text-primary/90 focus:ring-2 focus:ring-primary placeholder-gray-400 text-sm mb-4" /> -->



                                            <div id="btns-inpt-pass-detail">
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

                                                <div id="min_rate_qty_detail">
                                                    <div class="flex justify-between font-bold mb-2">
                                                        <p>Total</p>
                                                        <div id="loader-total-price-detail" class="loader-dots-654 hidden">
                                                            <div></div>
                                                        </div>
                                                        <p id="total-price-detail" class="mb-2">IDR 0.00</p>
                                                    </div>

                                                    <p id="msg-error-detail-ot"
                                                        class="text-red-error font-medium italic text-center hidden"></p>

                                                    <div id="loading-qty-pass-ot" class="hidden">
                                                        <div id="skeleton-pulse" style="background-color: #405D72;"
                                                            class="w-full h-10 rounded-lg flex justify-center items-center font-bold text-white">
                                                            Calculate Price...</div>
                                                    </div>

                                                    <button id="btn-book-opentrip" type="submit"
                                                        style="margin-bottom: 0px !important;"
                                                        class="w-full btn-primary">Book
                                                        Now</button>
                                                </div>
                                            </div>

                                            <p id="error-msg-list-package" class="error-message text-center"></p>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- <php include_once plugin_dir_path(__FILE__) . 'contents/list-package.php'; ?> -->

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
