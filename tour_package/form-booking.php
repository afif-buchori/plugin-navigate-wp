<?php
function enx_get_page_content($data)
{
    $old = json_decode(OLD);
    $error = json_decode(ERROR_DATA);

    $url = API_TOUR_PACKAGE_URL . '/post/data-booking';
    $data->currency = str_replace("currency=", "", checkCurrency());
    $data_res = fetchPost($url, $data);
    var_dump($data_res->countrys);
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
                                <div class="mb-10 sticky top-10">
                                    <div class="wiget shadow-lg rounded-xl mb-10 bg-white">
                                        <h5 class="font-heading text-xl text-primary font-bold border-b-2 border-primary border-opacity-10 px-7 py-3">
                                            Tour Details
                                        </h5>
                                        <!-- <php foreach ($data as $k_data => $data_booking) { >
                                            <div class="py-5 px-7">
                                                <p class="font-bold text-lg"><php echo $data_booking->activityName ></p>
                                                <p class="font-bold" style="opacity: 0.7;">
                                                    <php echo $data_booking->packageName >
                                                </p>
                                                <php foreach ($data_booking->ticketType as $type) { >
                                                    <div class="flex justify-between pl-4 text-sm">
                                                        <p><php echo $type->ticketName ></p>
                                                        <p>x <php echo $type->ticketQty ></p>
                                                    </div>
                                                <php } >
                                                <div class="w-full flex justify-between">
                                                    <p>Total</p>
                                                    <p><php echo $data_res->data->currency->symbol > <span
                                                            class="font-bold"><php echo number_format($data_booking->total, $data_res->data->currency->digit) ></span>
                                                    </p>
                                                </div>
                                            </div>
                                        <php } > -->
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

                                            <!-- <label for="phone_code_select2" id="phone_code_label"
                                                class="absolute inset-y-0 left-0 cursor-pointer"
                                                style="padding: 8px; font-size: 14px"><php echo $old->phone_code  ('+' . $old->phone_code) : '-Code-' >-</label> -->
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
