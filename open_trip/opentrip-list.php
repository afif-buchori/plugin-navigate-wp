<?php
function enx_get_page_content($data)
{
    // dd($data);
    ob_start();
    ?>
    <div class="enx-container site-wrapper">
        <div class="site-content">
            <div class="relative bg-cover bg-center h-tour"
                style="background-image: url(<?= $data[0]?->country?->imageBanner ?? "https://img-services.s3.ap-southeast-1.amazonaws.com/assets-plugin-wp/nusa-dua.jpg" ?>)">
                <div class="absolute w-full h-full bg-secondary bg-opacity-50">
                    <div class="container text-center h-full flex flex-col justify-center">
                        <div>
                            <span
                                class="bg-primary uppercase font-base rounded px-3 py-1 text-white text-xs md:text-sm tracking-widest">Open
                                Trip</span>

                            <h1
                                class="font-heading text-primary text-3xl md:text-5xl lg:text-6xl xl:text-6xl mb-14 mt-5 lg:leading-15 xl:px-10">
                                Search offers and find best for you
                            </h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container md:grid grid-cols-12 gap-4 mt-16 mb-14">

                <div
                    class="col-span-12 flex justify-between items-center border-b border-primary border-opacity-20 mb-10 py-5">
                    <p class="text-primary text-sm text-opacity-70 font-medium font-numbers">
                        <?= count($data) ?> Open trip found for
                        <span class="font-bold">
                            <?php
                            $query = array_values(array_filter(explode("/", $_SERVER['REQUEST_URI'])));
                            $country = $_GET['slug'];
                            if (isset($query[1]) && !str_contains($query[1], 'slug'))
                                $country = $query[1];
                            echo $country;
                            ?>
                        </span>
                    </p>
                </div>

                <?php
                foreach ($data as $item) {
                    $url_to_detail = "/" . OPENTRIP_LINK . "/" . $item->country->slug . "/" . $item->slug;
                    ?>
                    <div data-x-data data-x-ref="losAngeles"
                        data-x-intersect="anime({ targets: $refs.losAngeles, translateY: [100, 0], opacity: [0, 1], duration: 500 ,easing: 'easeOutQuad' })"
                        style="flex: 1 1 0" class="col-span-4">
                        <a href="<?= $url_to_detail ?>"
                            class="group flex-1 flex flex-col block relative bg-cover rounded-2xl xl:my-0 overflow-hidden w-full"
                            style="min-height: 340px">
                            <div class="bg-cover bg-center origin-top w-full rounded-2xl transition duration-500 transform translate-y-[-10px] group-hover:scale-110"
                                style="background-image: url(<?= $item->image ?>); aspect-ratio: 16/10">
                            </div>
                            <div class="flex-1 flex flex-col h-full w-full bg-secondary transition duration-500 group-hover:bg-primary p-4 rounded-2xl"
                                style="z-index: 1; margin-top: -32px;">
                                <h3 style="line-height: 1.25rem !important;"
                                    class="line-clamp-2 font-heading text-xl text-transform-unset font-medium text-primary transition duration-500 group-hover:text-white">
                                    <?= ucwords(strtolower($item->name)) ?>
                                </h3>
                                <div style="opacity: 0.7;" class="w-full flex items-center mb-4">
                                    <span
                                        class="iconify inline-block text-primary mr-1 transition duration-500 group-hover:text-white"
                                        data-icon="ic:outline-location-on" data-width="15" data-height="15"></span>
                                    <p class="text-sm text-primary transition duration-500 group-hover:text-white">
                                        <?= $item->country->name ?>
                                    </p>
                                </div>

                                <div class="flex flex-wrap gap-x-2 gap-y-1 mb-1">
                                    <div style="background-color: #A76545; color: #FFC1DA;"
                                        class="flex items-center px-2 rounded-full">
                                        <span class="iconify inline-block mr-1" data-icon="mdi:city-variant-outline"
                                            data-width="15" data-height="15"></span>
                                        <p class="text-sm"><?= $item->citiesVisited ?> Cities Visited</p>
                                    </div>
                                    <div style="background-color: #27548A; color: #4ED7F1;"
                                        class="flex items-center px-2 rounded-full">
                                        <span class="iconify inline-block mr-1" data-icon="mdi:airplane-takeoff" data-width="15"
                                            data-height="15"></span>
                                        <p class="text-sm"><?= $item->period ?> Keberangkatan</p>
                                    </div>
                                </div>

                                <span class="mt-auto"></span>
                                <?php if ($item->price->discount > 0) { ?>
                                    <p style="text-decoration: line-through;"
                                        class="text-right text-primary transition duration-500 group-hover:text-white text-sm font-numbers">
                                        IDR <?= number_format($item->price->before) ?>
                                    </p>
                                <?php } ?>
                                <div class="flex justify-between">
                                    <div class="flex items-end text-primary transition duration-500 group-hover:text-white">
                                        <label class="flex items-center text-sm" for="peopleBooked">
                                            <span
                                                class="iconify inline-block text-primary mr-1 transition duration-500 group-hover:text-white"
                                                data-icon="mdi:timer-outline" data-width="15" data-height="15"></span>
                                            <p><?= $item->duration ?> Days</p>
                                        </label>
                                    </div>
                                    <p
                                        class="text-right text-primary transition duration-500 group-hover:text-white text-lg font-numbers font-bold">
                                        IDR <?= number_format($item->price->after) ?>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <?php
    $contents = ob_get_clean();
    return $contents;
}
