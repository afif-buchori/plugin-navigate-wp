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
                        <div class="pt-16 pb-5 xl:py-20">
                            <div class="grid grid-cols-4 gap-2">
                                <div class="col-span-4 md:col-span-3">
                                    <img src="<?php echo "https://product-image.globaltix.com/live-gtImage/1ca00541-516c-4d05-b673-8e2b5bb87b1c" ?>"
                                        width="100%" class="rounded-lg" style="aspect-ratio: 16/9;">
                                </div>
                                <div class="col-span-1 w-full h-full hidden md:flex flex-col justify-between">
                                    <?php for ($i = 0; $i < 3; $i++) { ?>
                                        <img src="<?php echo "https://product-image.globaltix.com/live-gtImage/1ca00541-516c-4d05-b673-8e2b5bb87b1c" ?>"
                                            width="100%" class="rounded-lg" style="aspect-ratio: 16/9;">
                                    <?php } ?>
                                </div>
                            </div>

                            <div class="grid grid-cols-4 gap-4 pt-7">
                                <div class="col-span-4 md:col-span-3">
                                    <h1 class="col-span-3 md:text-2xl font-bold">
                                        <?php echo "Display Activity Full Name" ?>
                                    </h1>
                                    <p><?php echo "Jl. Raya Penelokan No.999, Batur Tengah, Kec. Kintamani, Kabupaten Bangli, Bali 80652, Indonesia" ?>
                                    </p>
                                    <h2 class="font-medium mt-5">Descriptions</h2>
                                    <p class="pl-4">Welcome to Amora Restaurant!
                                        The menus that the Amora Kintamani Bali offers are dictated by the local harvest.
                                        Our culinary team at the AmorabaliBali takes pleasure in creating menus that cater
                                        to every ones tastes, whatever the occasion. The fare is always focused strongly on
                                        quality produce and authentic flavours. The location of our breath taking the edge
                                        of the cliffrestaurant, Breeze, ensues all occasions will be ones to be remembered
                                        forever. Lunch here is a leisurely affair, a balance of elegant foods served in an
                                        atmosphere of simplicity. diningoverlooking mount and lake Batur has befitted this
                                        romantic hideaway you will find it irresistible.</p>
                                </div>

                                <div class="col-span-1 hidden md:flex flex-col relative">
                                    <div class="shadow shadow-lg p-4 sticky top-28 right-0" style="
                                        width: 100%;
                                        border-radius: 8px;
                                        background-color: white;
                                    ">
                                        <p class="mb-2">Start From <span class="font-bold"><?php echo "USD 123,60" ?></span>
                                        </p>
                                        <button class="w-full btn-primary">Find Package</button>
                                    </div>
                                </div>
                            </div>

                            <div class="w-full flex flex-col gap-4 p-4 rounded-lg mt-10"
                                style="background-color: #4cc0ce40;">
                                <h3 class="font-bold">Package Options</h3>

                                <?php for ($i = 0; $i < 3; $i++) { ?>
                                    <div class="w-full rounded-lg" style="background-color: white;">
                                        <p class="font-bold p-4">Package</p>
                                        <div class="w-full flex p-4" style="background-color: #dadada;">
                                            <div class="flex-1 flex flex-col">
                                                <div>
                                                    <p class="text-sm">Valid for</p>
                                                </div>
                                                <div>
                                                    <p class="text-sm">Instant Confirmation</p>
                                                </div>
                                                <div>
                                                    <p class="text-sm">Refundable</p>
                                                </div>
                                            </div>
                                            <div class="flex items-end">
                                                <p><span class="text-lg font-bold">USD 345,20</span>/pax</p>
                                            </div>
                                        </div>
                                        <div class="w-full flex p-4">
                                            <button class="ml-auto btn-primary">Select Package</button>
                                        </div>
                                    </div>
                                <?php } ?>
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
