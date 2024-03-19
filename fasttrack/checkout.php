<?php
function enx_get_page_content($data)
{
    $cartdata = json_decode(json_encode($_SESSION[NAVIGATE_CART]));
    $cart = $cartdata->main_service;

    $postData = array(
        'sid' => $cart->sid,
        'date' => $cart->date,
        'adult' => $cart->adult,
        'child' => $cart->child,
        'infant' => $cart->infant,
        'location' => $cart->location,
        'addons' => $cartdata->addons ?? null,
        'withdatachecout' => 1,
    );

    $url = API_FASTTRACK_URL . "/get/rate" . CreateParams();
    $data = fetchPost($url, $postData);
    // $args = array('body' => $postData);
    // $response = wp_remote_post($url, $args);
    // if (is_wp_error($response)) {
    //     return false;
    // }
    // $data = $response['response'];
    // $body = wp_remote_retrieve_body($response);
    // $data['response'] = json_decode($body);
    // $data = json_decode(json_encode($data));
    $service = $data->service;
    $addons = $data->addons ?? null;

    $checkoutdata = $data->checkoutdata;
    $serviceSum = $data;

    $old = json_decode(OLD);
    // $old = (object) [
    //     'airline_arrival' => '',
    //     'prefix_code_arrival' => '',
    //     'code_arrival' => '',
    //     'location_arrival' => '',
    //     'airline_departure' => '',
    //     'prefix_code_departure' => '',
    //     'code_departure' => '',
    //     'location_departure' => '',
    //     'firstname' => '',
    //     'lastname' => '',
    //     'phone_code' => '',
    //     'phone' => '',
    //     'email' => '',
    //     'payment_method' => '',
    //     'country' => '',



    // ];
    $error = json_decode(ERROR_DATA);
    // $error = (object) [
    //     'airline_arrival' => ['select first'],
    //     'prefix_code_arrival' => 'pca',
    //     'code_arrival' => ['code empty'],
    //     'location_arrival' => 'la',
    //     'airline_departure' => 'ad',
    //     'prefix_code_departure' => 'pca',
    //     'code_departure' => 'cd',
    //     'location_departure' => 'ld',
    //     'firstname' => ['input is empty'],
    //     'lastname' => ['input is empty'],
    //     'phone_code' => 'pc',
    //     'phone' => ['invalid phone number'],
    //     'email' => ['invalid format email'],
    //     'payment_method' => '',
    //     'country' => '',

    // ];

    ob_start();
?>
    <div class="enx-container site-wrapper" id="page-fasttrack">
        <div class="site-content">
            <div class="bg-gray-light3">

                <section>
                    <div class="container">

                        <div class="stepper-wrapper">
                            <div class="stepper-item completed">
                                <div class="step-counter">
                                    <p></p>
                                </div>
                                <div class="step-name">Addon Service</div>
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
                        </div>

                        <div class="xl:grid grid-cols-12 gap-x-16 pt-16 pb-5 xl:py-20">
                            <div class="col-span-4">
                                <div class="mb-10 sticky top-10">
                                    <div class="widget shadow-lg rounded-xl mb-10 bg-white">
                                        <h5 class="font-heading text-xl text-primary font-bold border-b-2 border-primary border-opacity-10 px-7 py-3">
                                            Service Details
                                        </h5>
                                        <div class="py-5 px-7">
                                            <div class="mb-4">
                                                <label class="text-primary font-semibold block" for="email">Service Name:</label>
                                                <span class="font-numbers font-medium text-primary/90  text-sm"><?php echo $service->title ?></span>
                                            </div>

                                            <div class="mb-4">
                                                <label class="text-primary font-semibold block" for="email">Flight Date:</label>
                                                <span class="font-numbers font-medium text-primary/90  text-sm"><?php echo $cart->date ?></span>
                                            </div>

                                            <div>
                                                <label class="text-primary font-semibold block" for="email">Traveler:</label>
                                                <div class="font-numbers font-medium text-primary/90 text-sm flex justify-start">
                                                    <span>
                                                        <span class="grid">Adult: </span>
                                                        <span class="grid">Child: </span>
                                                        <span class="grid">Infant: </span>
                                                    </span>
                                                    <span>
                                                        <span class="grid font-bold"><?php echo $cart->adult ?> pax</span>
                                                        <span class="grid font-bold"><?php echo $cart->child ?> pax</span>
                                                        <span class="grid font-bold"><?php echo $cart->infant ?> pax</span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="py-5 px-7 border-t border-primary border-opacity-10 text-md font-bold">
                                            Total: <?php echo $serviceSum->currency->symbol . number_format($serviceSum->total, $serviceSum->currency->digit) ?>
                                        </div>
                                    </div>

                                    <?php if ($addons) { ?>
                                        <div class="widget shadow-lg rounded-xl mb-10 bg-white">
                                            <h5 class="font-heading text-xl text-primary font-bold border-b-2 border-primary border-opacity-10 px-7 py-3">
                                                Additional Service
                                            </h5>
                                            <div class="py-5 px-7">
                                                <div>
                                                    <label class="text-primary font-semibold block" for="email">Selected Service:</label>
                                                    <ul class="style-1">
                                                        <?php foreach ($addons->services as $addon) { ?>
                                                            <li><?php echo $addon->title ?></li>
                                                        <?php } ?>
                                                    </ul>
                                                </div>

                                            </div>
                                            <div class="py-5 px-7 border-t border-primary border-opacity-10 text-md font-bold">
                                                Total: <?php echo $addons->currency->symbol . number_format($addons->total, $addons->currency->digit) ?>
                                            </div>
                                        </div>

                                        <div class="widget shadow-lg rounded-xl mb-10 bg-white">
                                            <div class="py-5 px-7 border-t border-primary border-opacity-10 text-xl font-bold">
                                                Total: <?php echo $serviceSum->currency->symbol . number_format($serviceSum->total + $addons->total, $serviceSum->currency->digit) ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <form id="checkout-form" method="post" action="/<?php echo AIRPORT_SERVICE_LINK . '/postdata/checkout' ?>" class="col-span-8">
                                <h2 class="font-heading font-bold text-primary text-transform-unset mt-3 text-2xl">
                                    Service Information
                                </h2>
                                <?php if ($service->flight_type == 'ARRIVAL') { ?>
                                    <h3 class="font-bold">
                                        Arrival
                                    </h3>
                                    <div class="mt-2">
                                        <div class="md:grid grid-cols-2 gap-4">
                                            <div>
                                                <label class="text-primary font-semibold block mb-3" for="airline_arrival">Airline:</label>

                                                <select name="airline_arrival" airline-select="arrival" id="airline_arrival" class="<?php echo $error->airline_arrival ? 'is-invalid' : '' ?>" type="text">
                                                    <option selected value="" class="hidden">--select airlines--</option>
                                                    <?php foreach ($checkoutdata->airlines as $airline) { ?>
                                                        <option value="<?php echo $airline->id ?>" data-code="<?php echo $airline->code ?>" <?php echo $old->airline_arrival == $airline->id ? 'selected' : '' ?>><?php echo ($airline->name . ' (' . $airline->code . ')') ?></option>
                                                    <?php } ?>
                                                </select>

                                                <div class="invalid-feedback text-sm"><?php echo $error->airline_arrival[0] ?></div>
                                            </div>
                                            <div>
                                                <label class="text-primary font-semibold block mb-3" for="code_arrival">Code:</label>
                                                <input type="hidden" name="prefix_code_arrival" value="<?php echo $old->prefix_code_arrival ?>" code-arrival>
                                                <div class="<?php echo $error->code_arrival ? 'is-invalid' : '' ?> relative">
                                                    <div class="absolute inset-y-0 left-0 flex">
                                                        <span id="label-arrival-for-code" class="py-2 text-sm font-medium text-primary/90 pl-3" code-arrival><?php echo $old->prefix_code_arrival ?? '---' ?></span>
                                                    </div>
                                                    <input name="code_arrival" id="code_arrival" value="<?php echo $old->code_arrival ?>" class="<?php echo $error->code_arrival ? 'is-invalid' : '' ?> transition w-full form-input bg-gray-light4/60 py-2 pr-3 pl-14 w-auto font-numbers font-medium text-primary/90 focus:ring-2 focus:ring-primary placeholder-gray-400 text-sm" type="text" placeholder="Code">
                                                </div>
                                                <div class="invalid-feedback text-sm"><?php echo $error->code_arrival[0] ?></div>
                                            </div>
                                            <?php if ($service->sub_type == 'FAST TRACK TRANSFER' || $service->sub_type == 'MEET AND GREET TRANSFER') { ?>
                                                <div class="col-span-2">
                                                    <label class="text-primary font-semibold block mb-3" for="location_arrival">Location:</label>
                                                    <textarea name="location_arrival" id="location_arrival" class="<?php echo $error->location_arrival ? 'is-invalid' : '' ?> transition w-full form-input bg-gray-light4/60 py-2 px-3 w-auto font-numbers font-medium text-primary/90 focus:ring-2 focus:ring-primary placeholder-gray-400 text-sm" type="text" placeholder="Location"><?php echo $old->location_arrival ?></textarea>
                                                    <div class="invalid-feedback text-sm"><?php echo $error->location_arrival[0] ?></div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php } ?>
                                <!-- <hr class="my-5" /> -->
                                <?php if ($service->flight_type == 'DEPARTURE' || $service->sub_type == 'LOUNGE') { ?>
                                    <h3 class="font-bold mt-4">
                                        Departure
                                    </h3>
                                    <div class="mt-2">
                                        <div class="md:grid grid-cols-2 gap-4">
                                            <div>
                                                <label class="text-primary font-semibold block mb-3" for="airline_departure">Airline:</label>
                                                <select name="airline_departure" id="airline_departure_select2" class="<?php echo $error->airline_departure ? 'is-invalid' : '' ?> w-auto" type="text">
                                                    <option selected value="" class="hidden">--select airlines--</option>
                                                    <?php foreach ($checkoutdata->airlines as $airline) { ?>
                                                        <option value="<?php echo $airline->id ?>" data-code="<?php echo $airline->code ?>" <?php echo $old->airline_departure == $airline->id ? 'selected' : '' ?>><?php echo ($airline->name . ' (' . $airline->code . ')') ?></option>
                                                    <?php } ?>
                                                </select>

                                                <div class="invalid-feedback text-sm"><?php echo $error->airline_departure[0] ?></div>
                                            </div>
                                            <div>
                                                <label class="text-primary font-semibold block mb-3" for="code_departure">Code:</label>
                                                <input type="hidden" name="prefix_code_departure" value="<?php echo $old->prefix_code_departure ?>" code-departure>
                                                <div class="<?php echo $error->code_departure ? 'is-invalid' : '' ?> relative">
                                                    <div class="absolute inset-y-0 left-0 flex">
                                                        <span id="label-departure-for-code" class="py-2 text-sm font-medium text-primary/90 pl-3" code-departure><?php echo $old->prefix_code_departure ?? '---' ?></span>
                                                    </div>
                                                    <input name="code_departure" id="code_departure" value="<?php echo $old->code_departure ?>" class="<?php echo $error->code_departure ? 'is-invalid' : '' ?> transition w-full form-input bg-gray-light4/60 py-2 pr-3 pl-14 w-auto font-numbers font-medium text-primary/90 focus:ring-2 focus:ring-primary placeholder-gray-400 text-sm" type="text" placeholder="Code">
                                                </div>
                                                <div class="invalid-feedback text-sm"><?php echo $error->code_departure[0] ?></div>
                                            </div>
                                            <?php if ($service->sub_type == 'FAST TRACK TRANSFER' || $service->sub_type == 'MEET AND GREET TRANSFER') { ?>
                                                <div class="col-span-2">
                                                    <label class="text-primary font-semibold block mb-3" for="location_departure">Location:</label>
                                                    <textarea name="location_departure" id="location_departure" class="<?php echo $error->location_departure ? 'is-invalid' : '' ?> transition w-full form-input bg-gray-light4/60 py-2 px-3 w-auto font-numbers font-medium text-primary/90 focus:ring-2 focus:ring-primary placeholder-gray-400 text-sm" type="text" placeholder="Location"><?php echo $old->location_departure ?></textarea>
                                                    <div class="invalid-feedback text-sm"><?php echo $error->location_departure[0] ?></div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php } ?>

                                <h2 class="font-heading font-bold text-primary text-transform-unset mt-14 text-2xl">
                                    Booking Details
                                </h2>
                                <div class="mt-5">
                                    <div class="md:grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="text-primary font-semibold block mb-3" for="firstname">First name:</label>
                                            <input name="firstname" id="firstname" value="<?php echo $old->firstname ?>" class="<?php echo $error->firstname ? 'is-invalid' : '' ?> transition w-full form-input bg-gray-light4/60 py-2 px-3 w-auto font-numbers font-medium text-primary/90 focus:ring-2 focus:ring-primary placeholder-gray-400 text-sm" type="text" placeholder="First name">
                                            <div class="invalid-feedback text-sm"><?php echo $error->firstname[0] ?></div>
                                        </div>
                                        <div>
                                            <label class="text-primary font-semibold block mb-3" for="lastname">Last name:</label>
                                            <input name="lastname" id="lastname" value="<?php echo $old->lastname ?>" class="<?php echo $error->lastname ? 'is-invalid' : '' ?> transition w-full form-input bg-gray-light4/60 py-2 px-3 w-auto font-numbers font-medium text-primary/90 focus:ring-2 focus:ring-primary placeholder-gray-400 text-sm" type="text" placeholder="Last name">
                                            <div class="invalid-feedback text-sm"><?php echo $error->lastname[0] ?></div>
                                        </div>

                                        <div>
                                            <label class="text-primary font-semibold block mb-3" for="country">Country:</label>

                                            <select name="country" id="country_select2" class="<?php echo $error->country ? 'is-invalid' : '' ?>" type="text">
                                                <option selected value="" class="hidden">--select country--</option>
                                                <?php foreach ($checkoutdata->countries as $country) { ?>
                                                    <option value="<?php echo $country->id ?>" data-code="<?php echo $country->phonecode ?>" <?php echo $old->country == $country->id ? 'selected' : '' ?>><?php echo ($country->name) ?></option>
                                                <?php } ?>
                                            </select>


                                            <div class="invalid-feedback text-sm"><?php echo $error->country[0] ?></div>
                                        </div>
                                        <div>
                                            <label class="text-primary font-semibold block mb-3" for="email">Email:</label>
                                            <input name="email" id="email" value="<?php echo $old->email ?>" class="<?php echo $error->lastname ? 'is-invalid' : '' ?> transition w-full form-input bg-gray-light4/60 py-2 px-3 w-auto font-numbers font-medium text-primary/90 focus:ring-2 focus:ring-primary placeholder-gray-400 text-sm" type="text" placeholder="Email">
                                            <div class="invalid-feedback text-sm"><?php echo $error->email[0] ?></div>
                                        </div>
                                        <div>
                                            <label class="text-primary font-semibold block mb-3" for="phone">Phone:</label>
                                            <div class="<?php echo ($error->phone_code || $error->phone) ? 'is-invalid' : '' ?> relative">

                                                <label for="phone_code_select2" id="phone_code_label" class="absolute inset-y-0 left-0 cursor-pointer" style="padding: 8px; font-size: 14px"><?php echo $old->phone_code ? ('+' . $old->phone_code) : '-Code-' ?></label>
                                                <div class="absolute top-7 left-0 flex w-full" style="z-index: -10">
                                                    <select name="phone_code" id="phone_code_select2" class="<?php echo ($error->phone_code || $error->phone) ? 'is-invalid' : '' ?>">
                                                        <option selected value="">--Code Phone--</option>
                                                        <?php foreach ($checkoutdata->countries as $country) { ?>
                                                            <option value="<?php echo $country->phonecode ?>" <?php echo $old->phone_code == $country->phonecode ? 'selected' : '' ?>><?php echo ('(+' . $country->phonecode . ') - ' . $country->name) ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>


                                                <input name="phone" id="phone" value="<?php echo $old->phone ?>" class="<?php echo ($error->phone_code || $error->phone) ? 'is-invalid' : '' ?> transition w-full form-input bg-gray-light4/60 py-2 pr-3 pl-24 w-auto font-numbers font-medium text-primary/90 focus:ring-2 focus:ring-primary placeholder-gray-400 text-sm" type="text" placeholder="Phone">
                                            </div>
                                            <div class="invalid-feedback text-sm"><?php echo $error->phone[0] ?? $error->phone_code[0] ?></div>

                                            <!-- <input name="phone" id="phone" class="transition w-full form-input bg-gray-light4/60 py-2 px-3 w-auto font-numbers font-medium text-primary/90 focus:ring-2 focus:ring-primary placeholder-gray-400 text-sm" type="text" placeholder="Phone"> -->
                                        </div>

                                    </div>
                                    <div class="my-4" id="contact-form-status"></div>

                                </div>

                                <h2 class="font-heading font-bold text-primary text-transform-unset mt-14 text-2xl">
                                    Passengers Details
                                </h2>
                                <div class="mt-5">
                                    <h3 class="font-bold mb-4">Adult</h3>
                                    <div class="md:grid grid-cols-2 gap-4">
                                        <?php for ($a = 0; $a < $cart->adult; $a++) { ?>
                                            <div>
                                                <label class="self-center text-primary font-semibold block mb-3">Full name #<?php echo ($a + 1) ?>:</label>
                                                <input name="adult_name_<?php echo $a ?>" value="<?php echo $old->{'adult_name_' . $a} ?>" class="<?php echo $error->{'adult_name_' . $a} ? 'is-invalid' : '' ?> transition w-full form-input bg-gray-light4/60 py-2 px-3 w-auto font-numbers font-medium text-primary/90 focus:ring-2 focus:ring-primary placeholder-gray-400 text-sm" type="text" placeholder="Full name">
                                                <div class="invalid-feedback text-sm"><?php echo $error->{'adult_name_' . $a}[0] ?></div>
                                            </div>
                                        <?php } ?>
                                    </div>

                                    <?php if ($cart->child > 0) { ?>
                                        <hr class="my-5" />
                                        <h3 class="font-bold mb-4">Child</h3>
                                        <div class="md:grid grid-cols-2 gap-4">
                                            <?php for ($c = 0; $c < $cart->child; $c++) { ?>
                                                <div>
                                                    <label class="self-center text-primary font-semibold block mb-3">Full name #<?php echo ($c + 1) ?>:</label>
                                                    <input name="child_name_<?php echo $c ?>" value="<?php echo $old->{'child_name_' . $c} ?>" class="<?php echo $error->{'child_name_' . $c} ? 'is-invalid' : '' ?> transition w-full form-input bg-gray-light4/60 py-2 px-3 w-auto font-numbers font-medium text-primary/90 focus:ring-2 focus:ring-primary placeholder-gray-400 text-sm" type="text" placeholder="Full name">
                                                    <div class="invalid-feedback text-sm"><?php echo $error->{'child_name_' . $c}[0] ?></div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    <?php } ?>

                                    <?php if ($cart->infant > 0) { ?>
                                        <hr class="my-5" />
                                        <h3 class="font-bold mb-4">Infant</h3>
                                        <div class="md:grid grid-cols-2 gap-4">
                                            <?php for ($i = 0; $i < $cart->infant; $i++) { ?>
                                                <div>
                                                    <label class="self-center text-primary font-semibold block mb-3">Full name #<?php echo ($i + 1) ?>:</label>
                                                    <input name="infant_name_<?php echo $i ?>" value="<?php echo $old->{'infant_name_' . $i} ?>" class="<?php echo $error->{'infant_name_' . $i} ? 'is-invalid' : '' ?> transition w-full form-input bg-gray-light4/60 py-2 px-3 w-auto font-numbers font-medium text-primary/90 focus:ring-2 focus:ring-primary placeholder-gray-400 text-sm" type="text" placeholder="Full name">
                                                    <div class="invalid-feedback text-sm"><?php echo $error->{'infant_name_' . $i}[0] ?></div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    <?php } ?>
                                </div>

                                <h2 class="font-heading font-bold text-primary text-transform-unset mt-14 text-2xl">
                                    Payment Method
                                </h2>
                                <div class="mt-5">
                                    <div class="payment-type">
                                        <div class="<?php echo $error->payment_method ? 'is-invalid' : '' ?> grid grid-cols-4 types gap-12 types">
                                            <input type="radio" name="payment_method" id="payment-method-cc" value="CC" class="input-payment-method hidden" <?php echo $old->payment_method == 'CC' ? 'checked' : '' ?>>
                                            <label for="payment-method-cc" class="type">
                                                <div class="logo">
                                                    <i class="far fa-credit-card"></i>
                                                </div>
                                                <div class="text">
                                                    <p>Pay with Credit Card</p>
                                                </div>
                                            </label>
                                            <?php
                                            // <input type="radio" name="payment_method" id="payment-method-paypal" value="PayPal" class="input-payment-method hidden" <?php echo $old->payment_method == 'PayPal' ? 'checked' : '' tandatanya>>
                                            // <label for="payment-method-paypal" class="type">
                                            //     <div class="logo">
                                            //         <i class="fab fa-paypal"></i>
                                            //     </div>
                                            //     <div class="text">
                                            //         <p>Pay with PayPal</p>
                                            //     </div>
                                            // </label>
                                            ?>
                                        </div>
                                        <div class="invalid-feedback text-sm"><?php echo $error->payment_method[0] ?></div>
                                    </div>
                                </div>

                                <div class="mt-5">
                                    <div>
                                        <label class="text-primary font-semibold block mb-3" for="firstname">Special request:</label>
                                        <textarea name="note" id="note" class="<?php echo $error->note ? 'is-invalid' : '' ?> transition w-full form-input bg-gray-light4/60 py-2 px-3 w-auto font-numbers font-medium text-primary/90 focus:ring-2 focus:ring-primary placeholder-gray-400 text-sm" placeholder="Special request"></textarea>
                                        <div class="invalid-feedback text-sm"><?php echo $error->note[0] ?></div>
                                    </div>

                                    <div class="mt-8">
                                        <label class="text-primary font-semibold block" for="iagree">
                                            <input type="checkbox" class="mr-1" id="iagree" name="iagree" iAgree>
                                            I agree to the terms and conditions
                                        </label>
                                    </div>

                                </div>

                                <div class="my-4 flex justify-end mt-7 mb-5">
                                    <input type="hidden" name="surl" value="<?php echo get_bloginfo('url') . '/' . AIRPORT_SERVICE_LINK . '/payment/success' ?>">
                                    <input type="hidden" name="furl" value="<?php echo get_bloginfo('url') . '/' . AIRPORT_SERVICE_LINK . '/payment/fail' ?>">
                                    <input type="hidden" name="select_currency" value="<?php echo !isset($_COOKIE[CURRENCY_COOKIE]) ? '' : $_COOKIE[CURRENCY_COOKIE] ?>">
                                    <button class="btn btn-primary btn-disable" button-next-step iAgree-button disabled>Continue To Payment</button>
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
