<?php
function enx_get_page_content($data)
{
    ob_start();
    ?>
    <div class="enx-container site-wrapper">
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

                        <div class="grid grid-cols-12 gap-x-16 pt-16 pb-5 xl:py-20">
                            <!-- SIDE BOOKING -->
                            <div class="col-span-4">
                                <div class="mb-10 sticky top-10">
                                    <div class="wiget shadow-lg rounded-xl mb-10 bg-white">
                                        <h5
                                            class="font-heading text-xl text-primary font-bold border-b-2 border-primary border-opacity-10 px-7 py-3">
                                            Activity Details
                                        </h5>
                                        <div class="py-5 px-7">
                                            <p class="font-bold text-lg"><?php echo "ACTIVITY NAME" ?></p>
                                            <p class="font-bold" style="opacity: 0.7;"><?php echo "Package Name" ?></p>
                                            <?php foreach (["", ""] as $type) { ?>
                                                <div class="flex justify-between">
                                                    <p><?php echo "adult" ?></p>
                                                    <p><?php echo "1x" ?></p>
                                                </div>
                                            <?php } ?>
                                            <div class="w-full flex justify-between">
                                                <p>Total</p>
                                                <p><?php echo "USD  " ?><span
                                                        class="font-bold"><?php echo "123,02" ?></span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- SIDE FORM BOOKING -->

                            <form id="checkout-form" method="post"
                                action="/<?php echo AIRPORT_SERVICE_LINK . '/postdata/checkout' ?>" class="col-span-8">
                                <h2 class="font-heading font-bold text-primary text-transform-unset mt-3 text-2xl">
                                    Your Booking
                                </h2>
                                <p class="mb-10" style="opacity: 0.7;">Fill in your details and review your booking.</p>

                                <div class="grid grid-cols-2 gap-4">
                                    <div class="flex-1">
                                        <label class="text-primary font-semibold block mb-3" for="firstname">First
                                            name:</label>
                                        <input name="firstname" id="firstname" value="< ?php echo $old->firstname ?>"
                                            class="< ?php echo $error->firstname ? 'is-invalid' : '' ?> transition w-full form-input bg-gray-light4/60 py-2 px-3 w-auto font-numbers font-medium text-primary/90 focus:ring-2 focus:ring-primary placeholder-gray-400 text-sm"
                                            type="text" placeholder="First name">
                                        <div class="invalid-feedback text-sm">
                                            < ?php echo $error->firstname[0] ?>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <label class="text-primary font-semibold block mb-3" for="firstname">Last
                                            name:</label>
                                        <input name="firstname" id="firstname" value="< ?php echo $old->firstname ?>"
                                            class="< ?php echo $error->firstname ? 'is-invalid' : '' ?> transition w-full form-input bg-gray-light4/60 py-2 px-3 w-auto font-numbers font-medium text-primary/90 focus:ring-2 focus:ring-primary placeholder-gray-400 text-sm"
                                            type="text" placeholder="First name">
                                        <div class="invalid-feedback text-sm">
                                            < ?php echo $error->firstname[0] ?>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <label class="text-primary font-semibold block mb-3" for="firstname">Email:</label>
                                        <input name="firstname" id="firstname" value="< ?php echo $old->firstname ?>"
                                            class="< ?php echo $error->firstname ? 'is-invalid' : '' ?> transition w-full form-input bg-gray-light4/60 py-2 px-3 w-auto font-numbers font-medium text-primary/90 focus:ring-2 focus:ring-primary placeholder-gray-400 text-sm"
                                            type="text" placeholder="First name">
                                        <div class="invalid-feedback text-sm">
                                            < ?php echo $error->firstname[0] ?>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="text-primary font-semibold block mb-3" for="phone">Phone:</label>
                                        <div
                                            class="< ?php echo ($error->phone_code || $error->phone) ? 'is-invalid' : '' ?> relative">

                                            <label for="phone_code_select2" id="phone_code_label"
                                                class="absolute inset-y-0 left-0 cursor-pointer"
                                                style="padding: 8px; font-size: 14px"><?php //echo $old->phone_code ? ('+' . $old->phone_code) : '-Code-' ?>-</label>
                                            <div class="absolute top-7 left-0 flex w-full" style="z-index: -10">
                                                <select name="phone_code" id="phone_code_select2"
                                                    class="< ?php echo ($error->phone_code || $error->phone) ? 'is-invalid' : '' ?>">
                                                    <option selected value="">--Code Phone--</option>
                                                </select>
                                            </div>


                                            <input name="phone" id="phone" value="< ?php echo $old->phone ?>"
                                                class="< ?php echo ($error->phone_code || $error->phone) ? 'is-invalid' : '' ?> transition w-full form-input bg-gray-light4/60 py-2 pr-3 pl-24 w-auto font-numbers font-medium text-primary/90 focus:ring-2 focus:ring-primary placeholder-gray-400 text-sm"
                                                type="text" placeholder="Phone">
                                        </div>
                                        <div class="invalid-feedback text-sm">
                                            < ?php echo $error->phone[0] ?? $error->phone_code[0] ?>
                                        </div>

                                        <!-- <input name="phone" id="phone" class="transition w-full form-input bg-gray-light4/60 py-2 px-3 w-auto font-numbers font-medium text-primary/90 focus:ring-2 focus:ring-primary placeholder-gray-400 text-sm" type="text" placeholder="Phone"> -->
                                    </div>
                                </div>

                                <div class="mt-5">
                                    <div>
                                        <label class="text-primary font-semibold block mb-3" for="firstname">Special
                                            request:</label>
                                        <textarea name="note" id="note"
                                            class="< ?php echo $error->note ? 'is-invalid' : '' ?> transition w-full form-input bg-gray-light4/60 py-2 px-3 w-auto font-numbers font-medium text-primary/90 focus:ring-2 focus:ring-primary placeholder-gray-400 text-sm"
                                            placeholder="Special request"></textarea>
                                        <div class="invalid-feedback text-sm">
                                            < ?php echo $error->note[0] ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex flex-col items-end ml-auto mt-14 mb-5" style="max-width: 292px">
                                    <button class="btn btn-primary btn-disable w-full" id="submit-booking" button-next-step
                                        iAgree-button disabled>Continue To Payment</button>
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