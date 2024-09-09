<?php
function enx_get_payment_success()
{
    $url = API_TOUR_PACKAGE_URL . "/post/data-order";
    $order = fetchPost($url, ['id' => $_GET['orderId']]);
    return $order;
}
function enx_get_page_content($data)
{
    $order = $data->order;
    $details = $data->details;
    $payments = $data->payments;
    $travelers = $data->travelers;
    $curr = $data->currency_detail;
    $breadCrumbStep = $data->breadCrumbStep;
    // var_dump(json_encode($order->payments[0]->pay_before));
    $total = 0;
    $grand_total = 0;
    ob_start();
?>
    <div class="enx-container site-wrapper" id="page-addon">
        <div class="site-content">
            <div class="bg-gray-light3">

                <section>
                    <div class="container">
                        <div class="stepper-wrapper">
                            <?php foreach ($data->breadCrumbStep as $key => $value) {
                            ?>
                                <div
                                    class="stepper-item  <?php echo $value->name != 'Result' ? 'completed' : '' ?>">
                                    <div class="step-counter">
                                        <?php if ($value->name == 'Result') { ?>
                                            <p></p>
                                        <?php } ?>
                                    </div>
                                    <div class="step-name"><?php echo $value->name ?></div>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="flex flex-col-reverse xl:grid grid-cols-12 gap-x-16 pt-16 pb-5 xl:py-20">
                            <div class="col-span-6">
                                <div class="mb-10 top-10">
                                    <div class="widget shadow-lg rounded-xl mb-10 bg-white">
                                        <h5
                                            class="font-heading text-xl text-primary font-bold border-b-2 border-primary border-opacity-10 px-7 py-3">
                                            Booking Details
                                        </h5>
                                        <div class="py-5 px-7">
                                            <?php foreach ($payments as $key => $value) { ?>
                                                <div class="<?php echo $key > 0 ? "mt-4" : "" ?>">
                                                    <div class="mt-2">
                                                        <h6>
                                                            Detail Payment :
                                                        </h6>
                                                    </div>
                                                    <div class="pl-4 border-b border-primary border-opacity-10">
                                                        <h6 class="font-bold">
                                                            <?php
                                                            echo $key > 0 ? "Payment #" . $key : (count($payments) > 1 ? 'Down Payment' : 'Full Payment') ?>
                                                        </h6>
                                                    </div>
                                                    <div
                                                        class="pl-4 flex justify-between border-b border-primary border-opacity-10">
                                                        <h6>
                                                            Payment Status :
                                                            <?php echo $value->status ? $value->status : ($key == 0 ? null : ($payments[$key - 1]->status == "PAID" ? "Waiting" : ($key == 1 ? "Waiting Down Payment" : "Waiting Payment " . $key))) ?>
                                                        </h6>

                                                        <?php if (($key == 0 && $value->status != "PAID") || ($key > 0 && $payments[$key - 1]->status == "PAID") && $value->status != "PAID") { ?>
                                                            <button class="btn btn-primary generate_payment" data-payment='<?php echo json_encode($value) ?>'>Payment Now</button>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="pl-4 border-b border-primary border-opacity-10">
                                                        <?php
                                                        $amoun_pay = $value->status != null && $value->status == "PAID" ? $value->paid_amount : $value->amount;
                                                        ?>
                                                        <h6>
                                                            Amount Due :
                                                            <?php echo $curr->symbol . " " . number_format($amoun_pay, $curr->digit) ?>
                                                        </h6>
                                                    </div>
                                                    <div class="pl-4">
                                                        <h6>
                                                            Due Date : <?php echo $value->pay_before ?>
                                                        </h6>
                                                    </div>
                                                </div>
                                            <?php } ?>

                                            <div class="mb-4 mt-4 border-t border-primary border-opacity-10">
                                                <label class="text-primary font-semibold block" for="email">Name:</label>
                                                <span class="font-numbers font-medium text-primary/90 text-sm">
                                                    <?php echo $order->first_name . " " . $order->last_name ?>
                                                </span>
                                            </div>

                                            <div class="mb-4 border-t border-primary border-opacity-10">
                                                <label class="text-primary font-semibold block" for="email">Email:</label>
                                                <span class="font-numbers font-medium text-primary/90 text-sm">
                                                    <?php echo $order->email ?>
                                                </span>
                                            </div>

                                            <div class="border-t border-primary border-opacity-10">
                                                <label class="text-primary font-semibold block" for="email">Phone:</label>
                                                <span class="font-numbers font-medium text-primary/90 text-sm">
                                                    <?php echo $order->phone ?>
                                                </span>
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
                                        <div class="mb-4 border-b-2 border-primary border-opacity-10">
                                            <label class="text-primary block">Status : <span
                                                    class="font-bold"><?php echo $order->status == "DP" ? "Down Payment" : $order->status ?></span></label>
                                        </div>
                                        <div class="mb-4 border-b-2 border-primary border-opacity-10">
                                            <label class="text-primary block">Booking Id : <span
                                                    class="font-bold"><?php echo $order->booking_id ?></span></label>
                                        </div>

                                        <?php foreach ($details as $key => $value) {

                                            $qty_item = $value->qty;
                                            $price_item = $value->price;

                                            if ($value->price_advance) {
                                                $new_qty_a = $value->qty_advance;
                                                $new_qty = 0;
                                                $new_price = 0;
                                                foreach ($value->item_price_advance as $i_price_key => $i_price_val) {
                                                    $new_price += $i_price_val * $new_qty_a->$i_price_key;
                                                    $new_qty += $new_qty_a->$i_price_key;
                                                }
                                                $qty_item = $new_qty;
                                                $price_item = $new_price;
                                            }

                                            $total += $price_item;
                                            $grand_total += $total;
                                        ?>
                                            <div class="mb-4">
                                                <div class="flex justify-between ">
                                                    <p>
                                                        <?php echo $value->item_name ?> <span
                                                            class="font-bold">(x<?php echo $qty_item ?>)</span>
                                                    </p>
                                                    <p>
                                                        <?php echo $curr->symbol . " " . number_format($price_item, $curr->digit) ?>
                                                    </p>
                                                </div>
                                                <p>
                                                    <?php echo date_format(new DateTime($value->service_date), "l, d M Y") ?>
                                                </p>
                                            </div>
                                        <?php } ?>

                                        <div
                                            class="w-full py-5 border-t border-primary border-opacity-10 text-xl font-bold">
                                            <div class=" flex gap-10">
                                                <p class="ml-auto">
                                                    Sub Total:
                                                </p>
                                                <p>
                                                    <?php echo $curr->symbol . " " . number_format($total, $curr->digit) ?>
                                                </p>
                                            </div>
                                            <?php
                                            if (count($order->costs) > 0) {
                                                foreach ($order->costs as $key => $v) {
                                                    $grand_total += $v->value;
                                            ?>
                                                    <div class=" flex gap-10">
                                                        <p class="ml-auto">
                                                            <?php echo $v->name ?> :
                                                        </p>
                                                        <p>
                                                            <?php echo $curr->symbol . " " . number_format($v->value, $curr->digit) ?>
                                                        </p>
                                                    </div>
                                            <?php }
                                            } ?>

                                            <div class=" flex gap-10">
                                                <p class="ml-auto">
                                                    Total:
                                                </p>
                                                <p>
                                                    <?php echo $curr->symbol . " " . number_format($grand_total, $curr->digit) ?>
                                                </p>
                                            </div>

                                            <?php if ($order->status != "PAID") { ?>
                                                <div class=" flex gap-10">
                                                    <p class="ml-auto">
                                                        Balance:
                                                    </p>
                                                    <p>
                                                        <?php echo $curr->symbol . " " . number_format($order->balance, $curr->digit) ?>
                                                    </p>
                                                </div>
                                            <?php } ?>
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
