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
                                                <div class="flex items-center gap-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" style="width: 14px; height: 14px;"
                                                        viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                        <path
                                                            d="M152 24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H64C28.7 64 0 92.7 0 128v16 48V448c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V192 144 128c0-35.3-28.7-64-64-64H344V24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H152V24zM48 192h80v56H48V192zm0 104h80v64H48V296zm128 0h96v64H176V296zm144 0h80v64H320V296zm80-48H320V192h80v56zm0 160v40c0 8.8-7.2 16-16 16H320V408h80zm-128 0v56H176V408h96zm-144 0v56H64c-8.8 0-16-7.2-16-16V408h80zM272 248H176V192h96v56z" />
                                                    </svg>
                                                    <p class="text-sm">Valid for</p>
                                                </div>
                                                <div class="flex items-center gap-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" style="width: 14px; height: 14px;"
                                                        viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                        <path fill="#4CC0CE"
                                                            d="M349.4 44.6c5.9-13.7 1.5-29.7-10.6-38.5s-28.6-8-39.9 1.8l-256 224c-10 8.8-13.6 22.9-8.9 35.3S50.7 288 64 288H175.5L98.6 467.4c-5.9 13.7-1.5 29.7 10.6 38.5s28.6 8 39.9-1.8l256-224c10-8.8 13.6-22.9 8.9-35.3s-16.6-20.7-30-20.7H272.5L349.4 44.6z" />
                                                    </svg>
                                                    <p class="text-sm">Instant Confirmation</p>
                                                </div>
                                                <div class="flex items-center gap-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" style="width: 14px; height: 14px;"
                                                        viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                        <path fill="green"
                                                            d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-111 111-47-47c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l64 64c9.4 9.4 24.6 9.4 33.9 0L369 209z" />
                                                    </svg>
                                                    <p class="text-sm">Refundable</p>
                                                </div>
                                                <div class="flex items-center gap-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" style="width: 14px; height: 14px;"
                                                        viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                        <path fill="red"
                                                            d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c-9.4 9.4-9.4 24.6 0 33.9l47 47-47 47c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l47-47 47 47c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-47-47 47-47c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-47 47-47-47c-9.4-9.4-24.6-9.4-33.9 0z" />
                                                    </svg>
                                                    <p class="text-sm">Non Refundable</p>
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
