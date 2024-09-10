<?php
function enx_get_data_addontp()
{
    $url = API_TOUR_PACKAGE_URL . "/post/data-addons";
    $body = $_SESSION['SESSION_TOUR_PACKAGE'] ?? [];
    $body->currency = str_replace("currency=", "", checkCurrency());
    $data = fetchPost($url, $body) ?? [];
    return $data;
}

function enx_get_page_content($data)
{
    $data_session = $_SESSION['SESSION_TOUR_PACKAGE'] ?? [];
    $service = $data->service;
    $rate = $service->rate;
    $breadCrumbStep = $data->breadCrumbStep;
    $addons = $service->addons ?? [];
    $total_pax = $service->rate->total->total_pax ?? 0;
    $curr = $service->rate->currency->client_currency;
    ob_start();
?>
    <div class="enx-container site-wrapper" id="page-addon">
        <div class="site-content">
            <div class="bg-gray-light3">

                <section>
                    <div class="container">

                        <div class="stepper-wrapper">
                            <?php foreach ($breadCrumbStep as $key => $value) {
                            ?>
                                <div
                                    class="stepper-item  <?php echo $value->name != 'Additonal Service' && $key == 0 ? 'completed' : '' ?>">
                                    <div class="step-counter">
                                        <?php if ($value->name == 'Additonal Service') { ?>
                                            <p></p>
                                        <?php } ?>
                                    </div>
                                    <div class="step-name"><?php echo $value->name ?></div>
                                </div>
                            <?php } ?>
                        </div>

                        <div class="xl:grid grid-cols-12 gap-x-16 pt-5 pb-5">
                            <div class="col-span-4">
                                <div class="mb-10 sticky top-10">
                                    <div class="widget shadow-lg rounded-xl mb-10 bg-white">
                                        <h5 class="font-heading text-xl text-primary font-bold border-b-2 border-primary border-opacity-10 px-7 py-3">
                                            Service Details
                                        </h5>
                                        <div class="py-5 px-7">
                                            <input type="hidden" name="total_price_service" value="<?php echo $rate->total->client_currency ?>">
                                            <div class="mb-4">
                                                <label class="text-primary font-semibold block" for="email">Service Name:</label>
                                                <span class="font-numbers font-medium text-primary/90  text-sm"><?php echo $service->contents->title ?></span>
                                            </div>

                                            <div class="mb-4">
                                                <label class="text-primary font-semibold block" for="email">Service Date:</label>
                                                <span class="font-numbers font-medium text-primary/90  text-sm"><?php echo date_format(new DateTime($data_session->date), "l, d F Y") ?></span>
                                            </div>

                                            <div>
                                                <label class="text-primary font-semibold block" for="email">Traveler:</label>
                                                <div class="flex justify-between font-numbers font-medium text-primary/90 text-sm">
                                                    <div class="flex justify-start">
                                                        <span class="grid">Adult:</span>
                                                        <span class="grid font-bold"><?php echo $rate->adult->price_details->qty ?> pax</span>
                                                    </div>
                                                    <div>
                                                        <span class="grid font-bold"><?php echo $curr->symbol . " " . number_format($rate->adult->price, $curr->digit) ?></span>
                                                    </div>
                                                </div>
                                                <?php if ($rate->with_child_rate) { ?>
                                                    <div class="flex justify-between font-numbers font-medium text-primary/90 text-sm">
                                                        <div class="flex justify-start">
                                                            <span class="grid">Child:</span>
                                                            <span class="grid font-bold"><?php echo $rate->child->price_details->qty ?> pax</span>
                                                        </div>
                                                        <div>
                                                            <span class="grid font-bold"><?php echo $curr->symbol . " " . number_format($rate->child->price, $curr->digit) ?></span>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                                <?php if ($rate->with_infant_rate) { ?>
                                                    <div class="flex justify-between font-numbers font-medium text-primary/90 text-sm">
                                                        <div class="flex justify-start">
                                                            <span class="grid">Infant:</span>
                                                            <span class="grid font-bold"><?php echo $rate->infant->price_details->qty ?> pax</span>
                                                        </div>
                                                        <div>
                                                            <span class="grid font-bold"><?php echo $curr->symbol . " " . number_format($rate->infant->price, $curr->digit) ?></span>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="flex justify-between py-5 px-7 border-t border-primary border-opacity-10 text-xl font-bold">
                                            <span>Sub Total: </span>
                                            <span><?php echo $curr->symbol . " " . number_format($rate->total->client_currency, $curr->digit) ?></span>
                                        </div>
                                    </div>

                                    <div class="widget shadow-lg rounded-xl mb-10 bg-white">
                                        <h5 class="font-heading text-xl text-primary font-bold border-b-2 border-primary border-opacity-10 px-7 py-3">
                                            Additional Service
                                        </h5>
                                        <div class="py-5 px-7 hidden" additional-service-loader>
                                            <div class="mb-4">
                                                <span loader class="loader mb-4"></span>
                                            </div>
                                        </div>
                                        <?php if (isset($data_session->addon_selected) && count($data_session->addon_selected) > 0) { ?>
                                            <div class="py-5 px-7" additional-service-body>
                                                <label class="text-primary font-semibold block" for="email">Selected Service:</label>
                                                <ul class="style-1">
                                                    <?php foreach ($data_session->addon_selected as $key => $value) { ?>
                                                        <li><?php echo $value->name . " x" . $value->qty ?></li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                            <div class="flex justify-between py-5 px-7 border-t border-primary border-opacity-10 text-xl font-bold">
                                                <span>Sub Total:</span>
                                                <span additional-service-total>
                                                    <?php
                                                    $total_addon = array_sum(array_values(array_column($data_session->addon_selected, 'price')));
                                                    echo $curr->symbol . " " . number_format($total_addon, $curr->digit);
                                                    ?>
                                                </span>
                                            </div>
                                        <?php } else { ?>
                                            <div class="py-5 px-7" additional-service-body>
                                                <div>
                                                    <label class="text-primary font-semibold block" for="email">No service selected</label>
                                                </div>
                                            </div>
                                            <div class="flex justify-between py-5 px-7 border-t border-primary border-opacity-10 text-xl font-bold">
                                                <span>Sub Total:</span>
                                                <span additional-service-total>-</span>
                                            </div>
                                        <?php } ?>
                                    </div>

                                    <div class="flex justify-between widget shadow-lg rounded-xl mb-10 bg-white py-5 px-7 text-xl font-bold">
                                        <span>Total</span>
                                        <span additional-grandtotal>
                                            <?php
                                            $grandtotal = $rate->total->client_currency + ($total_addon ?? 0);
                                            echo $curr->symbol . " " . number_format($grandtotal, $curr->digit);
                                            ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <form id="form_addons" method="post" class="col-span-8">
                                <h2 class="font-heading font-bold text-primary text-transform-unset mt-3 text-4xl">
                                    Additional Service
                                </h2>

                                <div id="addon-form" class="w" data-x-data="accordionInit()" data-sid="" data-date="">

                                    <div class="mt-10">
                                        <div class="widget shadow-lg rounded-xl mb-10 bg-white">
                                            <textarea name="addon_selected" hidden><?php echo json_encode($data_session ?? []) ?></textarea>
                                            <?php $n = 0;
                                            foreach ($addons as $key => $item) {
                                                $addon_selected = [];
                                                if (isset($data_session->addon_selected) && count($data_session->addon_selected) > 0) {
                                                    $addon_selected = array_values(array_filter($data_session->addon_selected, function ($ad) use ($item) {
                                                        return $item->id == $ad->id;
                                                    }));
                                                }

                                                $i = 0; ?>
                                                <!-- <h5 class="font-heading text-xl text-primary font-bold border-b-2 border-primary border-opacity-10 px-7 py-3">
                                                    Name
                                                    <input type="radio" class="hidden" name="addon" value="notset" checked="checked" />
                                                </h5> -->
                                                <div class="py-5 px-7 flex justify-between">

                                                    <!-- <php foreach ($addon->service_children as $key => $item) {
                                                        if ($i > 0) echo "<hr />";
                                                    ?> -->
                                                    <!-- <div class="md:grid grid-cols-12 md:space-x-4"> -->
                                                    <div class="col-span-9">
                                                        <strong><?php echo $item->title ?></strong>
                                                        <div>
                                                            <div class="flex items-center">
                                                                <span class="cursor-pointer uppercase font-base rounded py-1 text-primary text-xs tracking-widest" data-x-bind="trigger(<?php echo $key; ?>)">details
                                                                    <span class="iconify -mt-1 transition-all duration-500 inline" data-icon="fluent:chevron-down-12-regular" data-width="20" data-height="20" data-x-bind="iconStyle(<?php echo $key; ?>)"></span>
                                                                </span>
                                                            </div>
                                                            <div class="relative overflow-hidden transition-all max-h-0 duration-700 inner-text-sm" data-x-ref="container-<?php echo $key; ?>" data-x-bind="containerStyle(<?php echo $key; ?>)">
                                                                <?php echo $item->description ?>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- data-addon-container="<php echo $item->id ?>" data-addon-container-parent="<php echo $addon->id ?>" 
                                                            data-addon-select-mode="<php echo $addon->select_mode ?>" data-addon-qty-type="<php echo $item->qty_type ?>" 
                                                            data-rate-type="<php echo $item->rate_type == 'FIXED' || $item->service_type == "MOBILE" ? "FIXED" : "MULTIPLE" ?>" 
                                                            data-addon-type="<php echo $item->type_addon ?>" -->
                                                    <div class="col-span-3 md:border-l border-0 md:pl-5 pl-0 md:mt-0 mt-3">
                                                        <!-- <php if ($addon->select_mode == 'ONE') { ?>
                                                                <div class="md:grid md:space-x-4" data-btn-key="<php echo $item->id ?>" data-addon-key="<php echo $addon->id ?>">
                                                                    <div>
                                                                        <button type="button" class="btn btn-primary" select-one data-select-key="<php echo $item->id ?>" data-addon-key="<php echo $addon->id ?>">select</button>
                                                                    </div>
                                                                </div>
                                                                <div class="hidden" data-input-key="<php echo $item->id ?>" data-addon-key="<php echo $addon->id ?>">
                                                                    <input type="radio" class="hidden" name="addon_<php echo $addon->id ?>" value="<php echo $item->id ?>" />
                                                                    <div class="md:grid md:space-x-4">
                                                                        <div class="mb-4">
                                                                            <button type="button" class="btn btn-danger" select-one data-remove-key="<php echo $item->id ?>" data-addon-key="<php echo $addon->id ?>">remove</button>
                                                                        </div>
                                                                    </div>
                                                                    <php if ($item->qty_type == 'FIXED') { ?>
                                                                        <div class="flex justify-between md:grid grid-cols-2 md:space-x-4">
                                                                            <div>
                                                                                Qty
                                                                            </div>
                                                                            <div>
                                                                                <php renderSelect("qty_$item->id", 0, $item->qty, $item->qty, false, 'data-addon-select="' . $item->id . '" data-type="qty"') ?>
                                                                            </div>
                                                                        </div>
                                                                    <php } elseif ($item->qty_type == 'SAME_AS_PRIMARY') { ?>

                                                                        <div class="md:grid" <php echo 'data-addon-select="' . $item->id . '" data-type="same_as_primary"' ?> data-adult="<php echo  $cart->adult ?>" data-child="<php echo  $cart->child ?? 0 ?>" data-infant="<php echo  $cart->infant ?? 0 ?>">

                                                                            <div class="flex justify-between md:grid grid-cols-2 md:space-x-4">
                                                                                <div class="mb-4">
                                                                                    Adult
                                                                                </div>
                                                                                <div class="mb-4">
                                                                                    <php renderInputReadonly("adult", $cart->adult) ?>
                                                                                </div>
                                                                            </div>
                                                                            <div class="flex justify-between md:grid grid-cols-2 md:space-x-4">
                                                                                <div class="mb-4">
                                                                                    Child
                                                                                </div>
                                                                                <div class="mb-4">
                                                                                    <php renderInputReadonly("child", $cart->child ?? 0) ?>
                                                                                </div>
                                                                            </div>
                                                                            <div class="flex justify-between md:grid grid-cols-2 md:space-x-4">
                                                                                <div class="mb-4">
                                                                                    Infant
                                                                                </div>
                                                                                <div class="mb-4">
                                                                                    <php renderInputReadonly("infant", $cart->infant ?? 0) ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    <php } else { ?>
                                                                        <php if ($item->rate_type == 'FIXED' || $item->service_type == "MOBILE") { ?>
                                                                            <div class="flex justify-between md:grid grid-cols-2 md:space-x-4">
                                                                                <div>
                                                                                    Qty
                                                                                </div>
                                                                                <div>
                                                                                    <php renderSelect("qty_$item->id", 0, $item->qty, $item->qty_max, false, 'data-addon-select="' . $item->id . '" data-type="qty"') ?>
                                                                                </div>
                                                                            </div>
                                                                        <php } else { ?>
                                                                            <div class="flex justify-between md:grid grid-cols-2 md:space-x-4">
                                                                                <div class="mb-4">
                                                                                    Adult
                                                                                </div>
                                                                                <div class="mb-4">
                                                                                    <php renderSelect("adult_$item->id", 0, $item->qty, $item->qty_max, false, 'data-addon-select="' . $item->id . '" data-type="adult"') ?>
                                                                                </div>
                                                                            </div>
                                                                            <div class="flex justify-between md:grid grid-cols-2 md:space-x-4">
                                                                                <div class="mb-4">
                                                                                    Child
                                                                                </div>
                                                                                <div class="mb-4">
                                                                                    <php renderSelect("child_$item->id", 0, 0, $item->qty_max, true, 'data-addon-select="' . $item->id . '" data-type="child"') ?>
                                                                                </div>
                                                                            </div>
                                                                            <div class="flex justify-between md:grid grid-cols-2 md:space-x-4">
                                                                                <div class="mb-4">
                                                                                    Infant
                                                                                </div>
                                                                                <div class="mb-4">
                                                                                    <php renderSelect("infant_$item->id", 0, 0, $item->qty_max, true, 'data-addon-select="' . $item->id . '" data-type="infant"') ?>
                                                                                </div>
                                                                            </div>
                                                                        <php } ?>
                                                                    <php } ?>
                                                                </div>
                                                            <php } else { ?> -->
                                                        <?php if ($item->type_select_qty == 'FIXED') { ?>
                                                            <div class="flex justify-between md:grid grid-cols-2 md:space-x-4">
                                                                <div>
                                                                    Qty
                                                                </div>
                                                                <div>
                                                                    <?php renderSelect("qty_addon", $addon_selected[0]->qty ?? 0, $item->qty ?? 0, $item->qty_max ?? $total_pax, true, "data-addon-select='" . json_encode($item) . "'") ?>
                                                                </div>
                                                            </div>
                                                        <?php } elseif ($item->type_select_qty == 'SAME_AS_PRIMARY') { ?>
                                                            <input type="checkbox" name="select_<?php echo $item->id ?>" value="on" class="hidden" <?php echo 'data-addon-select="' . $item->id . '" data-type="same_as_primary"' ?> data-adult="1" data-child="0" data-infant="0" />
                                                            <div class="md:grid md:space-x-4" data-btn-key="<?php echo $item->id ?>">
                                                                <div class="mb-4">
                                                                    <button type="button" class="btn btn-primary" select-multiple data-select-key="<?php echo $item->id ?>">select</button>
                                                                </div>
                                                            </div>
                                                            <div class="md:grid hidden" data-input-key="<?php echo $item->id ?>">
                                                                <div class="md:grid md:space-x-4">
                                                                    <div class="mb-4">
                                                                        <button type="button" class="btn btn-danger" select-multiple data-remove-key="<?php echo $item->id ?>">remove</button>
                                                                    </div>
                                                                </div>
                                                                <div class="flex justify-between md:grid grid-cols-2 md:space-x-4">
                                                                    <div class="mb-4">
                                                                        Adult
                                                                    </div>
                                                                    <div class="mb-4">
                                                                        <?php renderInputReadonly("adult", 1) ?>
                                                                    </div>
                                                                </div>
                                                                <div class="flex justify-between md:grid grid-cols-2 md:space-x-4">
                                                                    <div class="mb-4">
                                                                        Child
                                                                    </div>
                                                                    <div class="mb-4">
                                                                        <?php renderInputReadonly("child", 0) ?>
                                                                    </div>
                                                                </div>
                                                                <div class="flex justify-between md:grid grid-cols-2 md:space-x-4">
                                                                    <div class="mb-4">
                                                                        Infant
                                                                    </div>
                                                                    <div class="mb-4">
                                                                        <?php renderInputReadonly("infant", 0) ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php } else { ?>
                                                            <?php if ($item->type_rate == 'FIXED') { ?>
                                                                <div class="flex justify-between md:grid grid-cols-2 md:space-x-4">
                                                                    <div>
                                                                        Qty
                                                                    </div>
                                                                    <div>
                                                                        <?php renderSelect("qty_addon", $addon_selected[0]->qty ?? 0, $item->qty ?? 0, $item->qty_max ?? $total_pax, true, "data-addon-select='" . json_encode($item) . "'") ?>
                                                                    </div>
                                                                </div>
                                                            <?php } else { ?>
                                                                <div class="flex justify-between md:grid grid-cols-2 md:space-x-4">
                                                                    <div class="mb-4">
                                                                        Adult
                                                                    </div>
                                                                    <div class="mb-4">
                                                                        <?php renderSelect("qty_addon", 0, $item->qty ?? 0, $item->qty_max ?? $total_pax, true, "data-addon-select='" . json_encode($item) . "' data-type='adult'") ?>
                                                                    </div>
                                                                </div>
                                                                <div class="flex justify-between md:grid grid-cols-2 md:space-x-4">
                                                                    <div class="mb-4">
                                                                        Child
                                                                    </div>
                                                                    <div class="mb-4">
                                                                        <?php renderSelect("qty_addon", 0, $item->qty ?? 0, $item->qty_max ?? $total_pax, true, "data-addon-select='" . json_encode($item) . "' data-type='child'") ?>
                                                                    </div>
                                                                </div>
                                                                <div class="flex justify-between md:grid grid-cols-2 md:space-x-4">
                                                                    <div class="mb-4">
                                                                        Infant
                                                                    </div>
                                                                    <div class="mb-4">
                                                                        <?php renderSelect("qty_addon", 0, $item->qty ?? 0, $item->qty_max ?? $total_pax, true, "data-addon-select='" . json_encode($item) . "' data-type='infant'") ?>
                                                                    </div>
                                                                </div>
                                                            <?php } ?>
                                                        <?php } ?>
                                                        <!-- <php } ?> -->
                                                    </div>
                                                    <!-- </div> -->
                                                    <!-- <php
                                                        $n++;
                                                        $i++;} ?> -->

                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="my-4 flex justify-end mt-7 mb-5">
                                    <!-- <a href="/<php echo AIRPORT_SERVICE_LINK . '/checkout' ?>" class="btn ">Skip</a> -->
                                    <!-- <form method="POST" action="/<php echo AIRPORT_SERVICE_LINK . '/postdata/addon' ?>"> -->
                                    <input type="hidden" name="selected_service" input-selected-services />
                                    <button type="submit" class="btn btn-primary 
                                    <?php echo isset($data_session->addon_selected) &&  count($data_session->addon_selected) > 0 ? "" : "btn-disable" ?>"
                                        <?php echo isset($data_session->addon_selected) &&  count($data_session->addon_selected) > 0 ? "" : "disabled" ?>
                                        button-next-step>Next</button>
                                    <!-- </form> -->
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
