<?php
function enx_get_page_content($data)
{
    // $data = enx_get_detail_data();
    $item = $data->item;
    $suggestions = $data->suggestions;
    $locations = $data->locations;
    ob_start();

    ?>
    <div class="enx-container site-wrapper">
        <div class="site-content">
            <div class="bg-gray-light3">

                <section>
                    <div class="container">
                        <div class="xl:grid grid-cols-12 gap-x-16 pt-16 pb-5 xl:py-20">
                            <div class="col-span-8">
                                <img src="<?php echo $item->image_url ?>" width="100%" class="mb-10 rounded-lg"
                                    style="aspect-ratio: 16/9;">

                                <h5 class="uppercase tracking-wide text-sm text-primary/70 font-medium">
                                    <span
                                        class="bg-primary uppercase font-base rounded px-3 py-1 text-white text-xs md:text-sm tracking-widest">
                                        <?php echo $item->airport ?>
                                    </span>
                                </h5>
                                <h2 class="font-heading font-bold text-primary text-transform-unset mt-3 text-4xl">
                                    <?php echo $item->title ?>
                                </h2>
                                <div class="text-primary/70 leading-7 mt-5 enx-description">
                                    <?php echo $item->description ?>
                                </div>
                                <h2
                                    class="my-5 mt-14 font-heading font-bold text-primary text-transform-unset text-3xl xl:text-4xl">
                                    Additional Info
                                </h2>
                                <div class="pb-10">
                                    <?php if ($item->include) {
                                        $includes = explode("\n", $item->include); ?>
                                        <div class="md:grid grid-cols-12 border-b border-primary/10 py-5">
                                            <div class="text-primary/70 col-span-4 font-medium mb-2 md:mb-0">
                                                Price Includes
                                            </div>
                                            <div class="text-primary col-span-8">
                                                <?php for ($i = 0; $i < count($includes); $i++) { ?>
                                                    <p class="flex space-x-2 mb-4">
                                                        <span class="iconify inline-block text-green-success"
                                                            data-icon="akar-icons:circle-check" data-width="20" data-height="20"
                                                            style="margin-top: 0.125rem"></span>
                                                        <span
                                                            class="font-medium text-primary text-sm md:text-base flex-1 w-full"><?php echo $includes[$i] ?></span>
                                                    </p>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    <?php }
                                    if ($item->exclude) {
                                        $excludes = explode("\n", $item->exclude); ?>
                                        <div class="md:grid grid-cols-12 border-b border-primary/10 py-5">
                                            <div class="text-primary/70 col-span-4 font-medium mb-2 md:mb-0">
                                                Price Excludes
                                            </div>
                                            <div class="text-primary col-span-8">
                                                <?php for ($i = 0; $i < count($excludes); $i++) { ?>
                                                    <p class="flex space-x-2 mb-4">
                                                        <span class="iconify inline-block text-red-error"
                                                            data-icon="radix-icons:cross-circled" data-width="20" data-height="20"
                                                            style="margin-top: 0.12rem"></span>
                                                        <span
                                                            class="font-medium text-primary text-sm md:text-base"><?php echo $excludes[$i] ?></span>
                                                    </p>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div class="md:grid grid-cols-12 py-5">
                                        <div class="text-primary/70 col-span-4 font-medium mb-2 md:mb-0">
                                            Cancelation Policy
                                        </div>
                                        <div class="text-primary col-span-8">
                                            <p class="flex space-x-2 items-center mb-4">
                                                <span class="font-medium text-primary text-sm md:text-base">No
                                                    Refundable</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-4">
                                <div class="widget shadow-lg rounded-xl mb-10 bg-white sticky top-20">
                                    <h5
                                        class="font-heading text-xl text-primary font-bold border-b-2 border-primary border-opacity-10 px-7 py-5">
                                        Book This Service
                                    </h5>
                                    <form id="formbooks1" class="py-5 px-7" method="POST"
                                        action="/<?php echo AIRPORT_SERVICE_LINK . '/postdata/fd' ?>"
                                        data-id="<?php echo $item->id ?>">
                                        <input type="hidden" name="sid" value="<?php echo $item->id ?>">
                                        <input type="hidden" name="total" value="0">
                                        <div class="flex flex-col sm:flex-row justify-between my-5">
                                            <label class="flex items-center space-x-3" for="from">
                                                <span class="iconify inline-block text-primary" data-icon="carbon:calendar"
                                                    data-width="20" data-height="20"></span>
                                                <span class="text-gray-700 font-medium">Flight Date:</span>
                                            </label>
                                            <input type="datetime-local" name="date" min="<?php echo date('Y-m-d\TH:i') ?>"
                                                data-action-ft="onchange-calculate"
                                                class="form-input bg-gray-light4/60 border-none rounded-lg py-2 px-5 w-auto font-numbers font-medium text-center text-primary/90 focus:ring-2 focus:ring-primary placeholder-gray-400 text-sm" />
                                        </div>
                                        <?php if ($item->sub_type == 'FAST TRACK TRANSFER' || $item->sub_type == 'MEET AND GREET TRANSFER') { ?>
                                            <div class="flex justify-between my-5">
                                                <label class="flex items-center space-x-3" for="from">
                                                    <span class="iconify inline-block text-primary" data-icon="carbon:calendar"
                                                        data-width="20" data-height="20"></span>
                                                    <span class="text-gray-700 font-medium">Location:</span>
                                                </label>
                                                <select name="location" data-action-ft="onchange-calculate"
                                                    class="form-select bg-gray-light4/60 border-none rounded-lg py-2 px-5 w-auto font-numbers font-medium text-center text-primary/90 focus:ring-2 focus:ring-primary placeholder-gray-400 text-sm w-full"
                                                    style="max-width: 266px">
                                                    <option value="">--select location--</option>
                                                    <?php foreach ($locations as $location) { ?>
                                                        <option value="<?php echo $location->value ?>">
                                                            <?php echo $location->label ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        <?php } ?>

                                        <div class="flex justify-between my-5">
                                            <label class="flex items-center space-x-3" for="peopleBooked">
                                                <span class="iconify inline-block text-primary"
                                                    data-icon="carbon:user-avatar" data-width="20" data-height="20"></span>
                                                <span class="text-gray-700 font-medium">Adult:</span>
                                            </label>
                                            <div class="w-40">
                                                <?php renderInputNumber("adult", 1, 1) ?>
                                            </div>
                                        </div>

                                        <div class="flex justify-between my-5">
                                            <label class="flex items-center space-x-3" for="peopleBooked">
                                                <span class="iconify inline-block text-primary"
                                                    data-icon="carbon:user-avatar" data-width="20" data-height="20"></span>
                                                <span class="text-gray-700 font-medium">Child:</span>
                                            </label>
                                            <div class="w-40">
                                                <?php renderInputNumber("child", 0, 0) ?>
                                            </div>
                                        </div>

                                        <div class="flex justify-between my-5">
                                            <label class="flex items-center space-x-3" for="peopleBooked">
                                                <span class="iconify inline-block text-primary"
                                                    data-icon="carbon:user-avatar" data-width="20" data-height="20"></span>
                                                <span class="text-gray-700 font-medium">Infant:</span>
                                            </label>
                                            <div class="w-40">
                                                <?php renderInputNumber("infant", 0, 0) ?>
                                            </div>
                                        </div>

                                        <!-- <div class="bg-gray-light4/60 rounded-xl px-7 py-7 mt-8">
                                            <h6 class="font-heading text-[#858585]">Add Extra</h6>
                                            <div class="flex justify-between my-3">
                                                <div class="flex items-center space-x-3">
                                                    <input class="form-checkbox -mt-[2px] bg-[#858585] text-primary focus:ring-primary" id="checkbox1" type="checkbox" />
                                                    <label class="text-[#858585] text-sm" for="checkbox1">Service per booking</label>
                                                </div>
                                                <p class="text-[#858585] text-sm font-numbers">$30</p>
                                            </div>
                                            <div class="flex justify-between my-3">
                                                <div class="flex items-center space-x-3">
                                                    <input class="form-checkbox -mt-[2px] bg-[#858585] text-primary focus:ring-primary" id="checkbox2" checked type="checkbox" />
                                                    <label class="text-[#858585] text-sm" for="checkbox2">Service per booking</label>
                                                </div>
                                                <p class="text-[#858585] text-sm font-numbers">$30</p>
                                            </div>
                                            <div class="text-[#858585] text-sm flex space-x-3">
                                                <span>Adult: <span class="font-numbers">$17</span></span>
                                                <span>Youth: <span class="font-numbers">$14</span></span>
                                            </div>
                                        </div> -->

                                        <div action-container
                                            class="<?php echo isset($_GET['errormessage']) ? 'is-invalid' : '' ?> flex justify-between items-center mt-7 mb-5">
                                            <span loader class="loader hidden"></span>
                                            <p data-total-container class="text-[#858585] text-xl">
                                                Total:
                                                <span data-total class="font-numbers text-primary ml-1">-</span>
                                            </p>
                                            <button btn-submit class="btn btn-primary text-white btn-disable" disabled>
                                                Book Now
                                            </button>
                                        </div>
                                        <div display-error
                                            class="invalid-feedback flex justify-between items-center mt-7 mb-5 text-red-error">
                                            <?php echo $_GET['errormessage'] ?>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <?php
                // <section class="container py-16">
                //     <h2 class="mb-10 font-heading font-bold text-transform-unset text-primary text-3xl text-4xl">
                //         You may enjoy this
                //     </h2>
                //     <div class="grid grid-cols-1 md:grid-cols-2 md:gap-x-10 lg:grid-cols-4 lg:gap-x-[370px] xl:gap-x-10 lg:overflow-x-auto xl:overflow-visible">
                //         <?php enx_create_list($suggestions) tandatanya>
                //     </div>
                // </section> 
                ?>
            </div>
        </div>
    </div>
    <?php
    $contents = ob_get_clean();
    return $contents;
}
