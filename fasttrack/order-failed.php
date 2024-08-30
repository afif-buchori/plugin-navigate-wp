<?php
function enx_get_page_content($data)
{
    $url = API_FASTTRACK_URL . "/get/order?order=" . $_GET['order'];
    $order = fetchGet($url);
    // var_dump(json_encode($order->payment_url));
    // var_dump(json_encode($order->expired_at));
    // var_dump(Date('Y-m-d H:i:s'));
    if (strtolower($order->status) == 'paid') {
        header("Location: /airport-service/payment/success/?order=" . $order->transaction_id);
    }
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
                                        <h5 id="data-expired-order" data-expired="<?= $order->expired_at ?>"
                                            class="font-heading text-xl text-primary font-bold border-b-2 border-primary border-opacity-10 px-7 py-3">
                                            Booking Details
                                        </h5>
                                        <div class="py-5 px-7">
                                            <div class="mb-4">
                                                <span class="text-primary font-semibold flex gap-2 items-center"
                                                    for="email">
                                                    <p id="info-orders" data-status="<?php echo $order->status ?>"
                                                        data-order="<?php echo $order->transaction_id ?>">Status:</p>
                                                    <span class="font-numbers font-bold text-primary/90 text-sm"
                                                        id="<?php echo $order->status == "Process" ? 'animate-pulse' : '' ?>"><?php echo $order->status ?></span>
                                                    <?php if ($order->status == 'Unpaid') { ?>
                                                        <a href="#" class="btn btn-link">Refresh</a>
                                                    <?php } ?>
                                                </span>
                                                <?php if ($order->status === 'Failed' && $order->payments_failed_message) { ?>
                                                    <span class="text-red-error font-semibold flex gap-2 items-center"
                                                        for="email">
                                                        <p id="info-orders" data-status="<?php echo $order->status ?>"
                                                            data-order="<?php echo $order->transaction_id ?>">Message:</p>
                                                        <span
                                                            class="font-numbers font-bold text-red-error text-sm"><?php echo $order->payments_failed_message ?></span>
                                                    </span>
                                                <?php } ?>
                                            </div>

                                            <div class="mb-4">
                                                <label class="text-primary font-semibold block" for="email">Name:</label>
                                                <span
                                                    class="font-numbers font-medium text-primary/90 text-sm"><?php echo $order->full_name ?></span>
                                            </div>

                                            <div class="mb-4">
                                                <label class="text-primary font-semibold block" for="email">Email:</label>
                                                <span
                                                    class="font-numbers font-medium text-primary/90 text-sm"><?php echo hideEmailAddress($order->email) ?></span>
                                            </div>
                                        </div>
                                    </div>
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
                                                        <li><?php echo $item->title ?>
                                                            <?php if ($item->addons) { ?>
                                                                <ul class="style-1">
                                                                    <?php foreach ($item->addons as $addon) { ?>
                                                                        <li><?php echo $addon->title ?></li>
                                                                    <?php } ?>
                                                                </ul>
                                                            <?php } ?>
                                                        </li>
                                                    <?php } ?>
                                                </ol>
                                            </div>

                                            <div
                                                class="py-5 px-7 border-t border-primary border-opacity-10 text-xl font-bold">
                                                Total:
                                                <?php echo $order->original_currency . number_format($order->total, $order->original_currency->digit) ?>
                                            </div>
                                            <div class="py-5 border-t border-primary border-opacity-10">
                                                <label class="text-primary font-semibold block"
                                                    for="email">Traveler:</label>
                                                <ul class="style-1">
                                                    <li>Adult (<?php echo count($order->travelers->adult) ?>)
                                                        <ol class="style-1">
                                                            <?php foreach ($order->travelers->adult as $item) { ?>
                                                                <li><?php echo $item->full_name ?></li>
                                                            <?php } ?>
                                                        </ol>
                                                    </li>
                                                    <?php if ($order->travelers->child) { ?>
                                                        <li>Child (<?php echo count($order->travelers->child) ?>)
                                                            <ol class="style-1">
                                                                <?php foreach ($order->travelers->child as $item) { ?>
                                                                    <li><?php echo $item->full_name ?></li>
                                                                <?php } ?>
                                                            </ol>
                                                        </li>
                                                    <?php } ?>
                                                    <?php if ($order->travelers->infant) { ?>
                                                        <li>Infant (<?php echo count($order->travelers->infant) ?>)
                                                            <ol class="style-1">
                                                                <?php foreach ($order->travelers->infant as $item) { ?>
                                                                    <li><?php echo $item->full_name ?></li>
                                                                <?php } ?>
                                                            </ol>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-span-6">
                                <div id="is-change-to-expired" class="mb-10 top-10">
                                    <div class="widget shadow-lg rounded-xl mb-10 bg-white">
                                        <h5
                                            class="font-heading text-xl font-bold border-b-2 border-primary border-opacity-10 px-7 py-3">
                                            Important Information
                                        </h5>
                                        <div class="py-5 px-7">
                                            <div class="mb-4">
                                                <p>Kindly proceed by clicking on the provided link to initiate the payment
                                                    process once again.
                                                    <br />
                                                    <a href="<?php echo $order->payment_url ?>" class="btn-primary my-5">Pay
                                                        With
                                                        Another Card</a>
                                                    <br />
                                                </p>
                                                <p>The remaining payment time is <span id="count-down-expired"
                                                        class="font-bold" style="margin-left: 4px;"></span></p>

                                            </div>

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
