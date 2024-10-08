<?php
function enx_get_payment_info()
{
    $url = API_ACTIVITY_URL . "/get/data-order?orderId=" . $_GET['orderId'];
    $order = fetchGet($url);
    return $order;
}
function enx_get_page_content($data)
{
    $order = $data->order;
    // var_dump(json_encode($order->payments[0]->pay_before));

    ob_start();
    ?>
    <div class="enx-container site-wrapper" id="page-addon">
        <div class="site-content">
            <div class="bg-gray-light3">

                <section>
                    <div class="container">
                        <div class="flex flex-col-reverse xl:grid grid-cols-12 gap-x-16 pt-16 pb-5 xl:py-20">
                            <div class="col-span-6">
                                <div class="mb-10 top-10">
                                    <div class="widget shadow-lg rounded-xl mb-10 bg-white">
                                        <h5 id="data-expired-activity"
                                            data-expired-activity="<?= $order->payments[0]->pay_before ?>"
                                            class="font-heading text-xl text-primary font-bold border-b-2 border-primary border-opacity-10 px-7 py-3">
                                            Booking Details
                                        </h5>
                                        <div class="py-5 px-7">
                                            <div class="mb-4">
                                                <span class="text-primary font-semibold flex gap-2 items-center"
                                                    for="email">
                                                    <p id="info-orderss" data-status="<?php echo $order->status ?>"
                                                        data-order="<?php echo $order->id ?>">Status:</p>
                                                    <span class="font-numbers font-bold text-primary/90 text-sm"
                                                        id="<?php echo $order->status == "Process" ? 'animate-pulse' : '' ?>"
                                                        style="<?= strtolower($order->status) == "failed" ? "color: red !important;" : "" ?>"><?php echo ucwords(strtolower($order->status)) ?></span>
                                                    <?php if ($order->status == 'Unpaid') { ?>
                                                        <a href="<?= $order->url_payment ?>" class="btn btn-link">Pay Now</a>
                                                    <?php } elseif (strtolower($order->status) == "failed") { ?>
                                                        <a href="<?= $order->url_payment ?>" id="btn-pay-another-act"
                                                            class="btn btn-primary ml-auto">Pay
                                                            With Another Card</a>
                                                    <?php } ?>
                                                </span>
                                            </div>
                                            <?php if (strtolower($order->status) == "failed") { ?>
                                                <div id="is-show-exp-act" class="mb-4">
                                                    <p>The remaining payment time is <span id="count-down-expired-act"
                                                            class="font-bold" style="margin-left: 4px;"></span></p>
                                                </div>
                                            <?php } ?>

                                            <div class="mb-4">
                                                <label class="text-primary font-semibold block" for="email">Name:</label>
                                                <span
                                                    class="font-numbers font-medium text-primary/90 text-sm"><?php echo $order->first_name . " " . $order->last_name ?></span>
                                            </div>

                                            <div class="mb-4">
                                                <label class="text-primary font-semibold block" for="email">Email:</label>
                                                <span
                                                    class="font-numbers font-medium text-primary/90 text-sm"><?php echo hideEmailAddress($order->email) ?></span>
                                            </div>

                                            <div class="mb-4">
                                                <label class="text-primary font-semibold block" for="email">Phone:</label>
                                                <span
                                                    class="font-numbers font-medium text-primary/90 text-sm"><?php echo $order->phone ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-span-6">
                                <div class="widget shadow-lg rounded-xl mb-10 bg-white">
                                    <h5
                                        class="font-heading text-xl text-primary font-bold border-b-2 border-primary border-opacity-10 px-7 py-3">
                                        Service Details
                                    </h5>
                                    <div class="py-5 px-7">
                                        <div class="mb-4">
                                            <label class="text-primary font-semibold block" for="email">Service
                                                Name:</label>
                                            <ol class="style-1">
                                                <?php foreach ($order->details as $item) { ?>
                                                    <li>
                                                        <div>
                                                            <p>
                                                                <span class="font-medium"
                                                                    style="opacity: 0.7;"><?= $item->item_name ?></span>
                                                                - <?php echo $item->item_description ?>
                                                            </p>
                                                            <div class="w-full flex gap-2">
                                                                <p><?= $item->service_date ?></p>
                                                                <p><?= $item->qty ?>x</p>
                                                                <p class="ml-auto font-bold text-primary" style="opacity: 0.7;">
                                                                    <?php echo $order->dataCurrency->symbol . number_format($item->total, $order->dataCurrency->digit) ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                <?php } ?>
                                            </ol>
                                        </div>

                                        <div
                                            class="w-full flex gap-10 py-5 border-t border-primary border-opacity-10 text-xl font-bold">
                                            <p class="ml-auto">
                                                Total:
                                            </p>
                                            <p>
                                                <?php echo $order->dataCurrency->symbol . number_format($order->total, $order->dataCurrency->digit) ?>
                                            </p>
                                        </div>

                                    </div>
                                </div>
                            </div>

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
