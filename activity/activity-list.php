<?php
function enx_get_page_content($data)
{
    // $data = enx_get_list_data_activity();
    $items = $data->items;
    ob_start();
    ?>
    <div class="enx-container site-wrapper">
        <div class="site-content">
            <div class="relative bg-cover bg-center h-tour"
                style="background-image: url(https://img-services.s3.ap-southeast-1.amazonaws.com/assets-plugin-wp/nusa-dua.jpg)">
                <div class="absolute w-full h-full bg-secondary bg-opacity-90">
                    <div class="container text-center h-full flex flex-col justify-center">
                        <div>
                            <span
                                class="bg-primary uppercase font-base rounded px-3 py-1 text-white text-xs md:text-sm tracking-widest">Activity</span>

                            <h1
                                class="font-heading text-primary text-3xl md:text-5xl lg:text-6xl xl:text-6xl mb-14 mt-5 lg:leading-15 xl:px-10">
                                Search offers and find best for you
                            </h1>
                            <a href="#" class="font-semibold font-body text-primary">
                                Check out best offers
                                <span class="iconify text-primary inline-block ml-3" data-icon="bi:arrow-right"
                                    data-inline="false"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container xl:grid grid-cols-12 xl:gap-12 2xl:gap-16 mt-16">

                <div class="col-span-12">
                    <div class="flex justify-between items-center border-b border-primary border-opacity-20 mb-10 py-5">
                        <p class="text-primary text-sm text-opacity-70 font-medium font-numbers">
                            <span class="font-semibold">20</span> Tours
                        </p>
                        <div>
                            <label class="text-primary text-sm text-opacity-70 mr-3 font-medium" for="sortBy">Sort
                                by</label>
                            <select
                                class="form-select bg-gray-light4 bg-opacity-50 border-none rounded-full py-1 pr-14 pl-5 font-body font-semibold text-primary text-opacity-70 focus:ring-2 focus:ring-primary"
                                id="sortBy">
                                <option value="title">Price</option>
                                <option value="price">Title</option>
                            </select>
                        </div>
                    </div>
                    <!-- <div class="md:grid items-center md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-2 2xl:grid-cols-3 gap-x-10 gap-y-0 mb-10"> -->
                    <!-- <div class="md:grid items-center md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 2xl:grid-cols-4 gap-x-10 gap-y-0 mb-10"> -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-7 gap-y-0">

                        <?php
                        if (!$items) {
                            echo 'Please refresh this page!';
                        } else {
                            enx_create_list_activity($items);
                        } ?>
                    </div>
                    <!-- <div class="flex justify-center space-x-3 mb-24">
                        <a href="#" class="inline-flex transition justify-center w-6 h-6 text-lg font-heading font-medium leading-none text-primary bg-secondary rounded-full hover:bg-primary hover:text-white">1</a>
                        <a href="#" class="inline-flex transition justify-center w-6 h-6 text-lg font-heading font-medium leading-none text-primary bg-secondary rounded-full hover:bg-primary hover:text-white">2</a>
                        <a href="#" class="inline-flex transition justify-center w-6 h-6 text-lg font-heading font-medium leading-none text-primary bg-secondary rounded-full hover:bg-primary hover:text-white">3</a>
                        <a href="#" class="inline-flex transition justify-center w-6 h-6 text-lg font-heading font-medium leading-none text-primary bg-secondary rounded-full hover:bg-primary hover:text-white">4</a>
                        <a href="#" class="inline-flex transition justify-center w-6 h-6 text-lg font-heading font-medium leading-none text-primary bg-secondary rounded-full hover:bg-primary hover:text-white">5</a>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
    <?php
    $contents = ob_get_clean();
    return $contents;
}
