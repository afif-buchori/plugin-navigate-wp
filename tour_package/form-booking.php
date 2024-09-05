<?php
function enx_get_page_content($data)
{
    $old = json_decode(OLD);
    $error = json_decode(ERROR_DATA);

    $url = API_TOUR_PACKAGE_URL . '/post/data-booking';
    $data->currency = str_replace("currency=", "", checkCurrency());
    $data_res = fetchPost($url, $data);
    $rate = $data_res->service->rate;
    $currency = $rate->currency->client_currency;
    ob_start();
?>
    <div class="enx-container site-wrapper">
        <!-- <php require_once(dirname(__FILE__) . '/../activity/modal-message.php'); ?> -->
        <div class="site-content">
            <div class="bg-gray-light3">
                <section>
                    <div class="container">

                        <div class="stepper-wrapper">
                            <div class="stepper-item completed">
                                <div class="step-counter">
                                    <p></p>
                                </div>
                                <div class="step-name">Select Package</div>
                            </div>
                            <div class="stepper-item active">
                                <div class="step-counter">
                                    <h5></h5>
                                </div>
                                <div class="step-name">Form Booking</div>
                            </div>
                            <div class="stepper-item">
                                <div class="step-counter"></div>
                                <div class="step-name">Payments</div>
                            </div>
                            <div class="stepper-item">
                                <div class="step-counter"></div>
                                <div class="step-name">Payment Info</div>
                            </div>
                        </div>

                        <div class="md:grid grid-cols-12 gap-x-16 pt-16 pb-5 xl:py-20">
                            <!-- SIDE BOOKING -->
                            <div class="col-span-4">
                                <div class="mb-5">
                                    <div class="wiget shadow-lg rounded-xl mb-5 bg-white">
                                        <h5 class="font-heading text-xl text-primary font-bold border-b-2 border-primary border-opacity-10 px-7 py-3">
                                            Tour Details
                                        </h5>
                                        <div class="py-5 px-7">
                                            <h6 class="font-bold"><?php echo $data_res->service->contents->title ?></h6>
                                            <h6 class="mt-3"><?php
                                                                $date = new DateTime($data_res->data_session->date);
                                                                echo date_format($date, "l, d F Y") ?>
                                            </h6>
                                            <div class="flex justify-between mt-4">
                                                <p class="pl-4">Adult x<?php echo $rate->adult->price_details->qty ?></p>
                                                <p><?php echo $currency->symbol . " " . number_format($rate->adult->price, $currency->digit) ?></p>
                                            </div>
                                            <div class="flex justify-between">
                                                <p class="pl-4">Child x<?php echo $rate->child->price_details->qty ?></p>
                                                <p><?php echo $currency->symbol . " " . number_format($rate->child->price, $currency->digit) ?></p>
                                            </div>
                                            <div class="flex justify-between">
                                                <p class="pl-4">Infant x<?php echo $rate->infant->price_details->qty ?></p>
                                                <p><?php echo $currency->symbol . " " . number_format($rate->infant->price, $currency->digit) ?></p>
                                            </div>
                                        </div>
                                        <div class="font-bold border-t border-primary border-opacity-10 px-7 py-3 flex justify-between">
                                            <h6 class="font-bold">Total</h6>
                                            <p><?php echo $currency->symbol . " " . number_format($rate->total->client_currency, $currency->digit) ?></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-5">
                                    <div class="wiget shadow-lg rounded-xl mb-5 bg-white">
                                        <h5 class="font-heading text-xl text-primary font-bold border-b-2 border-primary border-opacity-10 px-7 py-3">
                                            Payment Settings
                                        </h5>
                                        <div class="py-5 px-7">
                                            <?php foreach ($data_res->service->payment as $key => $payment) {
                                                $payment_in_id = strtolower(str_replace(" ", "_", $payment->title)) . "_$key";
                                            ?>
                                                <div class="<?php echo $key > 0 ? "mt-4" : "" ?>">
                                                    <input type="radio" name="payment-settings" id="<?php echo $payment_in_id ?>" value='<?php echo json_encode($payment) ?>'
                                                        data-service-fee="<?php echo (float)$rate->service_fee ?>" data-currency='<?php echo json_encode($currency) ?>'>
                                                    <label for="<?php echo $payment_in_id ?>" class="pl-4"><?php echo $payment->title ?></label>
                                                    <?php foreach ($payment->detail as $detail) {
                                                        $due_date = date_format(new DateTime($detail->dueDate), "D, d F Y H:i");
                                                    ?>
                                                        <div class="flex justify-between font-bold">
                                                            <p><?php echo $detail->name ?></p>
                                                            <p><?php echo $currency->symbol . " " . number_format($detail->amount, $currency->digit) ?></p>
                                                        </div>
                                                        <div class="flex justify-between">
                                                            <p>Due Date</p>
                                                            <p><?php echo $due_date ?></p>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <div class="wiget shadow-lg rounded-xl mb-5 bg-white">
                                        <div class="flex justify-between px-7 py-3">
                                            <h6 class="font-heading text-primary font-bold ">
                                                Total
                                            </h6>
                                            <p id="total_booking"><?php echo $currency->symbol . " " . number_format(0, $currency->digit) ?></p>
                                        </div>
                                        <div class="flex justify-between px-7 py-3">
                                            <h6 class="font-heading text-primary font-bold">
                                                Service Fee
                                            </h6>
                                            <p id="service_fee_booking"><?php echo $currency->symbol . " " . number_format(0, $currency->digit) ?></p>
                                        </div>
                                        <div class="flex justify-between px-7 py-3">
                                            <h6 class="font-heading text-primary font-bold">
                                                Total Pay
                                            </h6>
                                            <p id="total_pay_booking"><?php echo $currency->symbol . " " . number_format(0, $currency->digit) ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- SIDE FORM BOOKING -->

                            <form id="form-booking-tourpackage" class="col-span-8">
                                <h2 class="font-heading font-bold text-primary text-transform-unset mt-3 text-2xl">
                                    Your Booking
                                </h2>
                                <p class="mb-10" style="opacity: 0.7;">Fill in your details and review your booking.</p>

                                <div class="md:grid grid-cols-2 gap-4">
                                    <div class="flex-1">
                                        <label class="text-primary font-semibold block mb-3" for="first_name">First
                                            name:</label>
                                        <input name="first_name" id="first_name" value=""
                                            class="transition w-full form-input bg-gray-light4/60 py-2 px-3 w-auto font-numbers font-medium text-primary/90 focus:ring-2 focus:ring-primary placeholder-gray-400 text-sm"
                                            type="text" placeholder="First name">
                                        <div class="text-sm" style="color: rgba(242, 84, 84, 1) !important;"
                                            id="first_name_error">

                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <label class="text-primary font-semibold block mb-3" for="last_name">Last
                                            name:</label>
                                        <input name="last_name" id="last_name" value=""
                                            class="transition w-full form-input bg-gray-light4/60 py-2 px-3 w-auto font-numbers font-medium text-primary/90 focus:ring-2 focus:ring-primary placeholder-gray-400 text-sm"
                                            type="text" placeholder="First name">
                                        <div class="text-sm" style="color: rgba(242, 84, 84, 1) !important;"
                                            id="last_name_error">
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <label class="text-primary font-semibold block mb-3" for="email">Email:</label>
                                        <input name="email" id="email" value=""
                                            class="transition w-full form-input bg-gray-light4/60 py-2 px-3 w-auto font-numbers font-medium text-primary/90 focus:ring-2 focus:ring-primary placeholder-gray-400 text-sm"
                                            type="text" placeholder="First name">
                                        <div class="text-sm" style="color: rgba(242, 84, 84, 1) !important;"
                                            id="email_error">
                                        </div>
                                    </div>
                                    <div>
                                        <label class="text-primary font-semibold block mb-3" for="phone">Phone:</label>
                                        <div class="relative">

                                            <label for="phone_code_select2" id="phone_code_label"
                                                class="absolute inset-y-0 left-0 cursor-pointer"
                                                style="padding: 8px; font-size: 14px">
                                                <?php echo $old->phone_code ? ('+' . $old->phone_code) : '-Code-' ?>
                                            </label>
                                            <div class="absolute top-7 left-0 flex w-full" style="z-index: -10">
                                                <select name="phone_code" id="phone_code_select2" class="">
                                                    <option selected value="">--Code Phone--</option>
                                                    <?php foreach ($data_res->countrys as $country) { ?>
                                                        <option value="<?php echo $country->phonecode ?>" <?php echo $old->phone_code == $country->phonecode ? 'selected' : '' ?>>
                                                            <?php echo ('(+' . $country->phonecode . ') - ' . $country->nicename) ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>


                                            <input name="phone" id="phone" value=""
                                                class="transition w-full form-input bg-gray-light4/60 py-2 pr-3 pl-24 w-auto font-numbers font-medium text-primary/90 focus:ring-2 focus:ring-primary placeholder-gray-400 text-sm"
                                                type="number" placeholder="Phone">
                                        </div>
                                        <div class="text-sm" style="color: rgba(242, 84, 84, 1) !important;"
                                            id="phone_code_error">
                                        </div>
                                        <div class="text-sm" style="color: rgba(242, 84, 84, 1) !important;"
                                            id="phone_error">
                                        </div>

                                        <!-- <input name="phone" id="phone" class="transition w-full form-input bg-gray-light4/60 py-2 px-3 w-auto font-numbers font-medium text-primary/90 focus:ring-2 focus:ring-primary placeholder-gray-400 text-sm" type="text" placeholder="Phone"> -->
                                    </div>
                                </div>

                                <div class="mt-5">
                                    <div>
                                        <label class="text-primary font-semibold block mb-3" for="firstname">Special
                                            request:</label>
                                        <textarea name="note" id="note"
                                            class="<?php echo $error->note ? 'is-invalid' : '' ?> transition w-full form-input bg-gray-light4/60 py-2 px-3 w-auto font-numbers font-medium text-primary/90 focus:ring-2 focus:ring-primary placeholder-gray-400 text-sm"
                                            placeholder="Special request"></textarea>
                                    </div>
                                </div>

                                <div class="flex flex-col items-end ml-auto mt-14 mb-5" style="max-width: 292px">
                                    <button type="submit" class="btn btn-primary w-full">Continue To Payment</button>
                                    <p class="text-xs mt-4">Click 'Continue to Payment' to securely proceed to Tondest.com,
                                        our trusted payment partner, for a seamless checkout experience.</p>
                                </div>
                            </form>

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
