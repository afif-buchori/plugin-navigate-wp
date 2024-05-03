<?php
function enx_get_payment_info()
{
    $url = API_ACTIVITY_URL . "/get/data-order?" . $_GET['orderId'];
    $order = fetchGet($url);
    return $order;
}
function enx_get_page_content($data)
{
    // var_dump(json_encode($data));
    $order = $data->order;

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
                                        <h5
                                            class="font-heading text-xl text-primary font-bold border-b-2 border-primary border-opacity-10 px-7 py-3">
                                            Booking Details
                                        </h5>
                                        <div class="py-5 px-7">
                                            <div class="mb-4">
                                                <span class="text-primary font-semibold flex gap-2 items-center"
                                                    for="email">
                                                    <p id="info-orderss" data-status="<?php echo $order->status ?>"
                                                        data-order="<?php echo $order->transaction_id ?>">Status:</p>
                                                    <span class="font-numbers font-bold text-primary/90 text-sm"
                                                        id="<?php echo $order->status == "Process" ? 'animate-pulse' : '' ?>"><?php echo $order->status ?></span>
                                                    <?php if ($order->status == 'Unpaid') { ?>
                                                        <a href="#" class="btn btn-link">Refresh</a>
                                                    <?php } ?>
                                                </span>
                                            </div>
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
                                                    <li><?php echo $item->item_description ?>
                                                        <span class="font-medium"
                                                            style="opacity: 0.7;">(<?= $item->item_name ?>)</span>
                                                    </li>
                                                <?php } ?>
                                            </ol>
                                        </div>

                                        <div class="py-5 px-7 border-t border-primary border-opacity-10 text-xl font-bold">
                                            Total:
                                            <?php echo $order->original_currency . number_format($order->total, $order->original_currency->digit) ?>
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
