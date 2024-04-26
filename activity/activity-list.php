<?php
function enx_get_page_content($data)
{
    // $data = enx_get_list_data_activity();
    $items = $data->data;
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
                            <span class="font-semibold"><?php echo $data->page->totalData ?></span> Activities
                        </p>
                        <!-- <div>
                            <label class="text-primary text-sm text-opacity-70 mr-3 font-medium" for="sortBy">Sort
                                by</label>
                            <select
                                class="form-select bg-gray-light4 bg-opacity-50 border-none rounded-full py-1 pr-14 pl-5 font-body font-semibold text-primary text-opacity-70 focus:ring-2 focus:ring-primary"
                                id="sortBy">
                                <option value="title">Price</option>
                                <option value="price">Title</option>
                            </select>
                        </div> -->
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-7 gap-y-2">

                        <?php
                        if (!$items) {
                            echo 'Please refresh this page!';
                        } else {
                            enx_create_list_activity($items, $data->imageUrl, $data->currency);
                        } ?>
                    </div>
                    <div class="flex flex-wrap justify-center gap-4 my-10">
                        <?php for ($i = 1; $i <= $data->page->total; $i++) {
                            $domain = $_SERVER['HTTP_HOST'];
                            $path = '/activity';
                            $country = $_GET['country'] ?? COUNTRY_ACTIVITY;
                            $url = "$path?country=$country&page=$i"
                                ?>
                            <a href="<?= $url ?>" style="width: 2.5rem; aspect-ratio: 1/1; place-content: center;"
                                class="inline-flex grid transition justify-center text-lg font-heading font-medium leading-none <?php echo ($i == $data->page->current || $data->page->current == null) ? "text-white bg-primary" : "text-primary bg-secondary" ?> hover:bg-primary hover:text-white"><?php echo $i ?></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    $contents = ob_get_clean();
    return $contents;
}
