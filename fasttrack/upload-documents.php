<?php
function enx_get_page_content($data)
{
    $cartdata = json_decode(json_encode($_SESSION[NAVIGATE_CART]));
    $cart = $cartdata->main_service;
    $addons = json_decode($data->response->addons);
    
    $url = API_FASTTRACK_URL . "/get/order?order=" . $_GET['order'];
    $order = fetchGet($url);

    // var_dump(json_encode(strpos($order->order_type, "VISA")));
    
    $isVoa = strpos($order->order_type, "VISA");
    // $isVoa = false;
    // foreach ($order->details as $detail) {
    //     if (strpos($detail->title, "VOA") !== false) $isVoa = true;
    // }

    ob_start();
?>
    <div class="enx-container site-wrapper">
        <div class="site-content">
            <div class="bg-gray-light3">

                <section>
                    <div class="container">
                        <div class="xl:grid grid-cols-12 gap-x-16 pt-16 pb-5 xl:py-20">
                            <div class="col-span-12">
                                <div class="mb-10 top-10">
                                    <div class="widget shadow-lg rounded-xl mb-10 bg-white relative">
                                        <div class="flex justify-between border-b-2 border-primary border-opacity-10 pl-7 pr-4 py-4">
                                            <h5 class="font-heading text-xl text-primary font-bold">
                                                Service Details
                                                <input type="hidden" name="sid" id="sid" value="<?php echo $_GET['order'] ?>">
                                            </h5>
                                            <div id="btn-TC" class="btn btn-primary flex gap-2">
                                                <p class="ring-654 text-white">!</p>
                                                Term and Conditions Upload
                                                <p class="ring-654 text-white">!</p>
                                            </div>
                                        </div>
                                        <?php include 'contents/rulesUpload.php' ?>
                                        <div class="grid grid-cols-12">
                                            <div class="py-5 px-7 col-span-6">
                                                <div class="mb-4">
                                                    <label class="text-primary font-semibold block" for="email">Service Name:</label>
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
                                            </div>

                                            <div class="py-5 px-7 col-span-6">
                                                <div class="mb-4">
                                                    <label class="text-primary font-semibold block" for="email">Service Date:</label>
                                                    <ol class="style-1">
                                                        <?php foreach ($order->details as $item) { ?>
                                                            <li><?php echo $item->service_date ?></li>
                                                        <?php } ?>
                                                    </ol>
                                                </div>
                                            </div>
                                        </div>

                                        <?php foreach ($order->travelers->adult as $item) { ?>
                                            <hr />
                                            <div class=" py-5 px-7 col-span-6">
                                                <label class="text-primary font-semibold block" for="email"><?php echo $item->full_name ?></label>
                                                <div class="grid grid-cols-4 sm:grid-cols-8 md:grid-cols-12 gap-2">
                                                    <div class="py-5 px-7 col-span-4">
                                                        <label class="text-primary font-semibold block" for="email">Passport</label>
                                                        <div>
                                                            <?php if (!$item->passport) { ?>
                                                                <div image-preview style="width: 100%; height:200px; background-image: url(<?php echo plugins_url('../assets/images/select-image.jpg', __FILE__) ?>); background-repeat: no-repeat;background-position: left center;background-size: contain; background-position: center" class="border-2"></div>
                                                                <input class="hidden" accept=".jpg,.jpeg,.png,.bmp" type='file' data-type="passport" data-uid="<?php echo $item->id ?>" image-browser />
                                                                <button type="button" class="btn-primary my-5 hidden" image-upload><i class="fa-solid fa-circle-notch fa-spin hidden"></i> Upload</button>
                                                                <div class="text-red-error hidden">Failed to upload data. Please try again!</div>
                                                            <?php } else { ?>
                                                                <span class="bg-primary uppercase font-base rounded px-3 py-5 my-5 text-white text-xs md:text-sm tracking-widest inline-block">Document has been uploaded.</span>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                    <div class="py-5 px-7 col-span-4">
                                                        <label class="text-primary font-semibold block" for="email">
                                                            <?php echo $isVoa ? "Return Ticket" : "Flight Ticket" ?>
                                                        </label>
                                                        <div>
                                                            <?php if (!$item->flight_ticket) { ?>
                                                                <div image-preview style="width: 100%; height:200px; background-image: url(<?php echo plugins_url('../assets/images/select-image.jpg', __FILE__) ?>); background-repeat: no-repeat;background-position: left center;background-size: contain; background-position: center" class="border-2"></div>
                                                                <input class="hidden" accept=".jpg,.jpeg,.png,.bmp,.pdf" type='file' 
                                                                data-type="<?php 
                                                                    if($order->flight_type === "ARRIVAL") echo "flight-ticket-arrival";
                                                                    if($order->flight_type === "DEPARTURE") echo "flight-ticket-departure";
                                                                    else echo "flight-ticket";
                                                                ?>"
                                                                data-uid="<?php echo $item->id ?>" image-browser />
                                                                <button type="button" class="btn-primary my-5 hidden" image-upload><i class="fa-solid fa-circle-notch fa-spin hidden"></i> Upload</button>
                                                                <div class="text-red-error hidden">Failed to upload data. Please try again!</div>
                                                            <?php } else { ?>
                                                                <span class="bg-primary uppercase font-base rounded px-3 py-5 my-5 text-white text-xs md:text-sm tracking-widest inline-block">Document has been uploaded.</span>
                                                            <?php } ?>
                                                        </div>
                                                    </div>

                                                    <?php if ($isVoa) { ?>
                                                        <!-- <div class="py-5 px-7 col-span-6">
                                                            <label class="text-primary font-semibold block" for="email">Return Ticket</label>
                                                            <div>
                                                                <?php //if (!$item->flight_ticket_departure) { ?>
                                                                    <div image-preview style="width: 100%; height:200px; background-image: url(<?php //echo plugins_url('../assets/images/select-image.jpg', __FILE__) ?>); background-repeat: no-repeat;background-position: left center;background-size: contain; background-position: center"></div>
                                                                    <input class="hidden" accept=".jpg,.jpeg,.png,.bmp,.pdf" type='file' 
                                                                    data-type="flight-ticket-departure"
                                                                    data-uid="<?php //echo $item->id ?>" image-browser />
                                                                    <button type="button" class="btn-primary my-5 hidden" image-upload><i class="fa-solid fa-circle-notch fa-spin hidden"></i> Upload</button>
                                                                    <div class="text-red-error hidden">Failed to upload data. Please try again!</div>
                                                                <?php //} else { ?>
                                                                    <span class="bg-primary uppercase font-base rounded px-3 py-5 my-5 text-white text-xs md:text-sm tracking-widest inline-block">Document has been uploaded.</span>
                                                                <?php //} ?>
                                                            </div>
                                                        </div> -->
                                                        <div class="py-5 px-7 col-span-4">
                                                            <label class="text-primary font-semibold block" for="email">Selfie</label>
                                                            <div>
                                                                <?php if (!$item->selfie) { ?>
                                                                    <div image-preview style="width: 100%; height:200px; background-image: url(<?php echo plugins_url('../assets/images/select-image.jpg', __FILE__) ?>); background-repeat: no-repeat;background-position: left center;background-size: contain; background-position: center" class="border-2"></div>
                                                                    <input class="hidden" accept=".jpg,.jpeg,.png,.bmp" type='file' 
                                                                    data-type="selfie"
                                                                    data-uid="<?php echo $item->id ?>" image-browser />
                                                                    <button type="button" class="btn-primary my-5 hidden" image-upload><i class="fa-solid fa-circle-notch fa-spin hidden"></i> Upload</button>
                                                                    <div class="text-red-error hidden">Failed to upload data. Please try again!</div>
                                                                <?php } else { ?>
                                                                    <span class="bg-primary uppercase font-base rounded px-3 py-5 my-5 text-white text-xs md:text-sm tracking-widest inline-block">Document has been uploaded.</span>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    <?php } ?>

                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php foreach ($order->travelers->child as $item) { ?>
                                            <hr />
                                            <div class=" py-5 px-7 col-span-6">
                                                <label class="text-primary font-semibold block" for="email"><?php echo $item->full_name ?></label>
                                                <div class="grid grid-cols-12 gap-2">
                                                    <div class="py-5 px-7 col-span-4">
                                                        <label class="text-primary font-semibold block" for="email">Passport</label>
                                                        <div>
                                                            <?php if (!$item->passport) { ?>
                                                                <div image-preview style="width: 100%; height:200px; background-image: url(<?php echo plugins_url('../assets/images/select-image.jpg', __FILE__) ?>); background-repeat: no-repeat;background-position: left center;background-size: contain; background-position: center" class="border-2"></div>
                                                                <input class="hidden" accept=".jpg,.jpeg,.png,.bmp" type='file' data-type="passport" data-uid="<?php echo $item->id ?>" image-browser />
                                                                <button type="button" class="btn-primary my-5 hidden" image-upload><i class="fa-solid fa-circle-notch fa-spin hidden"></i> Upload</button>
                                                                <div class="text-red-error hidden">Failed to upload data. Please try again!</div>
                                                            <?php } else { ?>
                                                                <span class="bg-primary uppercase font-base rounded px-3 py-5 my-5 text-white text-xs md:text-sm tracking-widest inline-block">Document has been uploaded.</span>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                    <div class="py-5 px-7 col-span-4">
                                                        <label class="text-primary font-semibold block" for="email">
                                                            <?php echo $isVoa ? "Return Ticket" : "Flight Ticket" ?>
                                                        </label>
                                                        <div>
                                                            <?php if (!$item->flight_ticket) { ?>
                                                                <div image-preview style="width: 100%; height:200px; background-image: url(<?php echo plugins_url('../assets/images/select-image.jpg', __FILE__) ?>); background-repeat: no-repeat;background-position: left center;background-size: contain; background-position: center" class="border-2"></div>
                                                                <input class="hidden" accept=".jpg,.jpeg,.png,.bmp,.pdf" type='file' data-type="<?php 
                                                                    if($order->flight_type === "ARRIVAL") echo "flight-ticket-arrival";
                                                                    if($order->flight_type === "DEPARTURE") echo "flight-ticket-departure";
                                                                    else echo "flight-ticket";
                                                                ?>" 
                                                                data-uid="<?php echo $item->id ?>" image-browser />
                                                                <button type="button" class="btn-primary my-5 hidden" image-upload><i class="fa-solid fa-circle-notch fa-spin hidden"></i> Upload</button>
                                                                <div class="text-red-error hidden">Failed to upload data. Please try again!</div>
                                                            <?php } else { ?>
                                                                <span class="bg-primary uppercase font-base rounded px-3 py-5 my-5 text-white text-xs md:text-sm tracking-widest inline-block">Document has been uploaded.</span>
                                                            <?php } ?>
                                                        </div>
                                                    </div>

                                                    <?php if ($isVoa) { ?>
                                                        <div class="py-5 px-7 col-span-4">
                                                            <label class="text-primary font-semibold block" for="email">Selfie</label>
                                                            <div>
                                                                <?php if (!$item->selfie) { ?>
                                                                    <div image-preview style="width: 100%; height:200px; background-image: url(<?php echo plugins_url('../assets/images/select-image.jpg', __FILE__) ?>); background-repeat: no-repeat;background-position: left center;background-size: contain; background-position: center" class="border-2"></div>
                                                                    <input class="hidden" accept=".jpg,.jpeg,.png,.bmp" type='file' 
                                                                    data-type="selfie"
                                                                    data-uid="<?php echo $item->id ?>" image-browser />
                                                                    <button type="button" class="btn-primary my-5 hidden" image-upload><i class="fa-solid fa-circle-notch fa-spin hidden"></i> Upload</button>
                                                                    <div class="text-red-error hidden">Failed to upload data. Please try again!</div>
                                                                <?php } else { ?>
                                                                    <span class="bg-primary uppercase font-base rounded px-3 py-5 my-5 text-white text-xs md:text-sm tracking-widest inline-block">Document has been uploaded.</span>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    <?php } ?>

                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php foreach ($order->travelers->infant as $item) { ?>
                                            <hr />
                                            <div class=" py-5 px-7 col-span-6">
                                                <label class="text-primary font-semibold block" for="email"><?php echo $item->full_name ?></label>
                                                <div class="grid grid-cols-12 gap-2">
                                                    <div class="py-5 px-7 col-span-4">
                                                        <label class="text-primary font-semibold block" for="email">Passport</label>
                                                        <div>
                                                            <?php if (!$item->passport) { ?>
                                                                <div image-preview style="width: 100%; height:200px; background-image: url(<?php echo plugins_url('../assets/images/select-image.jpg', __FILE__) ?>); background-repeat: no-repeat;background-position: left center;background-size: contain; background-position: center" class="border-2"></div>
                                                                <input class="hidden" accept=".jpg,.jpeg,.png,.bmp" type='file' data-type="passport" data-uid="<?php echo $item->id ?>" image-browser />
                                                                <button type="button" class="btn-primary my-5 hidden" image-upload><i class="fa-solid fa-circle-notch fa-spin hidden"></i> Upload</button>
                                                                <div class="text-red-error hidden">Failed to upload data. Please try again!</div>
                                                            <?php } else { ?>
                                                                <span class="bg-primary uppercase font-base rounded px-3 py-5 my-5 text-white text-xs md:text-sm tracking-widest inline-block">Document has been uploaded.</span>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                    <div class="py-5 px-7 col-span-4">
                                                        <label class="text-primary font-semibold block" for="email">
                                                            <?php echo $isVoa ? "Return Ticket" : "Flight Ticket" ?>
                                                        </label>
                                                        <div>
                                                            <?php if (!$item->flight_ticket) { ?>
                                                                <div image-preview style="width: 100%; height:200px; background-image: url(<?php echo plugins_url('../assets/images/select-image.jpg', __FILE__) ?>); background-repeat: no-repeat;background-position: left center;background-size: contain; background-position: center" class="border-2"></div>
                                                                <input class="hidden" accept=".jpg,.jpeg,.png,.bmp,.pdf" type='file' data-type="<?php 
                                                                    if($order->flight_type === "ARRIVAL") echo "flight-ticket-arrival";
                                                                    if($order->flight_type === "DEPARTURE") echo "flight-ticket-departure";
                                                                    else echo "flight-ticket";
                                                                ?>" 
                                                                data-uid="<?php echo $item->id ?>" image-browser />
                                                                <button type="button" class="btn-primary my-5 hidden" image-upload><i class="fa-solid fa-circle-notch fa-spin hidden"></i> Upload</button>
                                                                <div class="text-red-error hidden">Failed to upload data. Please try again!</div>
                                                            <?php } else { ?>
                                                                <span class="bg-primary uppercase font-base rounded px-3 py-5 my-5 text-white text-xs md:text-sm tracking-widest inline-block">Document has been uploaded.</span>
                                                            <?php } ?>
                                                        </div>
                                                    </div>

                                                    <?php if ($isVoa) { ?>
                                                        <div class="py-5 px-7 col-span-4">
                                                            <label class="text-primary font-semibold block" for="email">Selfie</label>
                                                            <div>
                                                                <?php if (!$item->selfie) { ?>
                                                                    <div image-preview style="width: 100%; height:200px; background-image: url(<?php echo plugins_url('../assets/images/select-image.jpg', __FILE__) ?>); background-repeat: no-repeat;background-position: left center;background-size: contain; background-position: center" class="border-2"></div>
                                                                    <input class="hidden" accept=".jpg,.jpeg,.png,.bmp" type='file' 
                                                                    data-type="selfie"
                                                                    data-uid="<?php echo $item->id ?>" image-browser />
                                                                    <button type="button" class="btn-primary my-5 hidden" image-upload><i class="fa-solid fa-circle-notch fa-spin hidden"></i> Upload</button>
                                                                    <div class="text-red-error hidden">Failed to upload data. Please try again!</div>
                                                                <?php } else { ?>
                                                                    <span class="bg-primary uppercase font-base rounded px-3 py-5 my-5 text-white text-xs md:text-sm tracking-widest inline-block">Document has been uploaded.</span>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    
                                                </div>
                                            </div>
                                        <?php } ?>
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
