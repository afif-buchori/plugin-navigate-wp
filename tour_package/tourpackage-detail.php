<?php
function enx_get_page_content($data)
{
    // var_dump($data);
    // die();
    // $data = enx_get_detail_data();
    // $res_tour = $data->service;
    $data_res = $data->service;
    // $currency = $data->dataCurrency;
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
                                    <img src="<?php echo $data_res->image ?>" width="320px"
                                        class="rounded-lg" style="aspect-ratio: 16/9;">
                                    <!-- <php foreach ($data_res->media as $idx => $media) {
                                                if ($idx < 3) { ?>
                                            <img src="<php echo $data->imageUrl . $media->path ?>" width="320px" class="rounded-lg"
                                                style="aspect-ratio: 16/9; object-fit: cover;">
                                        <php }
                                            } ?> -->
                                </div>
                            </div>
                            <div class="hidden md:grid grid-cols-4 gap-2">
                                <!-- <div class="col-span-4 <php echo count($data_res->media) > 0 ? "md:col-span-3" : "" ?> ">
                                    <img src="<php echo $data->imageUrl . $ ->image ?>" width="100%"
                                        class="rounded-lg" style="aspect-ratio: 16/9;">
                                </div>
                                <div class="col-span-1 w-full h-full hidden md:flex flex-col justify-between">
                                    <php foreach ($data_res->media as $idx => $media) {
                                        if ($idx < 3) { ?>
                                            <img src="<php echo $data->imageUrl . $media->path ?>" width="100%" class="rounded-lg"
                                                style="aspect-ratio: 16/9; object-fit: cover;">
                                        <php }
                                    } ?>
                                </div> -->
                            </div>

                            <div class="grid grid-cols-4 gap-4 pt-7">
                                <div class="col-span-4 md:col-span-3">
                                    <h1 class="col-span-3 md:text-2xl font-bold">
                                        <?php echo $data_res->contents->title ?>
                                    </h1>
                                    <!-- <p><php echo $data_res->addressLine ?? $data_res->city . ", " . $data_res->country ?>
                                    </p> -->
                                    <h2 class="font-medium mt-5">Descriptions</h2>
                                    <p class="pl-4"><?php echo $data_res->contents->description ?></p>

                                    <!-- <php if (isset($data_res->whatToExpect)) { ?>
                                        <h2 class="font-medium mt-5">What to Expect</h2>
                                        <p><?php $dom = new DOMDocument();
                                            $dom->loadHTML($data_res->whatToExpect);
                                            echo $dom->saveHTML();
                                            ?></p>
                                    <php } ?>

                                    <php if ($data_res->operatingHours) { ?>
                                        <php if ($data_res->operatingHours->fixedDays && count($data_res->operatingHours->fixedDays) > 0) { ?>
                                            <h2 class="font-medium mt-5">Opening Hours</h2>
                                            <php foreach ($data_res->operatingHours->fixedDays as $operation_hour) { ?>
                                                <li class="pl-4">
                                                    <php echo $operation_hour->day . ", " . $operation_hour->startHour . " - " . $operation_hour->endHour ?>
                                                </li>
                                            <php } ?>
                                        <php } ?>
                                    <php } ?> -->

                                    <!-- <php if (isset($data_res->blockedDate) && count($data_res->blockedDate) > 0) { ?>
                                        <h2 class="font-medium mt-5">Blocked Out Dates</h2>
                                        <div class="pl-4">
                                            <table style="width: fit-content;">
                                                <thead>
                                                    <tr>
                                                        <th style="min-width: 210px; text-align: start;">Date</th>
                                                        <th style="text-align: start;">Remark</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <php foreach ($data_res->blockedDate as $block) { ?>
                                                        <tr>
                                                            <td><php echo date('l, d F Y', strtotime($block->date)) ?></td>
                                                            <td><php echo $block->title ?></td>
                                                        </tr>
                                                    <php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    <php } ?> -->
                                </div>

                                <div class="col-span-1 hidden md:flex flex-col relative">
                                    <!-- <div class="shadow shadow-lg p-4 sticky top-28 right-0" style="
                                        width: 100%;
                                        border-radius: 8px;
                                        background-color: white;
                                    ">
                                        <p class="mb-2">Start From <span class="font-bold">
                                                <php echo $currency->symbol ?>
                                                <php echo number_format($res_tour->original_price, $currency->digit) ?></span>
                                        </p>
                                        <button id="find-package-act" type="button" class="w-full btn-primary">Find
                                            Package</button>
                                    </div> -->
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
