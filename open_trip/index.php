<?php
function enx_get_page_content($data)
{
    // dd($data);
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
                                class="bg-primary uppercase font-base rounded px-3 py-1 text-white text-xs md:text-sm tracking-widest">Open
                                Trip</span>

                            <h1
                                class="font-heading text-primary text-3xl md:text-5xl lg:text-6xl xl:text-6xl mb-14 mt-5 lg:leading-15 xl:px-10">
                                Search offers and find best for you
                            </h1>
                            <a href="#" class="font-semibold font-body text-primary">
                                Realtime and instant confirmation
                                <span class="iconify text-primary inline-block ml-3" data-icon="bi:arrow-right"
                                    data-inline="false"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container xl:grid grid-cols-12 xl:gap-12 2xl:gap-16 mt-16">
                <div class="col-span-12">
                    <p class="font-bold text-xl mb-4">Select Country</p>
                    <div class="grid grid-cols-3 gap-4 px-2 overflow-y-auto">
                        <?php
                        foreach ($data as $item) {
                            $url_to_detail = "/" . OPENTRIP_LINK . "/" . $item->slug;
                            ?>
                            <a href="<?= $url_to_detail ?>" style="aspect-ratio: 16/9;"
                                class="col-span-1 bg-primary rounded-lg overflow-hidden relative">
                                <img src="<?= $item->imageIcon ?>" alt="img-country" class="w-full h-full"
                                    style="object-fit: cover;">
                                <div style="background-color: #ffffff90;"
                                    class="w-full py-1 px-4 absolute bottom-0 left-0 font-bold">
                                    <p><?= $item->fullName ?></p>
                                </div>
                            </a>
                            <?php
                        }
                        ?>
                        <!-- <div style="aspect-ratio: 16/9;" class="col-span-1 bg-primary rounded-lg overflow-hidden relative">
                            <img src="https://storage-junk.s3.ap-southeast-1.amazonaws.com/service/opentrip/1725845218-1344450.jpeg"
                                alt="img-country" class="w-full h-full" style="object-fit: cover;">
                            <div style="line-height: 0.9rem !important; background-color: #ffffff90;"
                                class="w-full p-1 absolute bottom-0 left-0 font-bold text-sm">
                                <p>Title Country / Province / City / Other Name</p>
                            </div>
                        </div>
                        <div style="aspect-ratio: 16/9;" class="col-span-1 bg-primary rounded-lg p-4"></div>
                        <div style="aspect-ratio: 16/9;" class="col-span-1 bg-primary rounded-lg p-4"></div>
                        <div style="aspect-ratio: 16/9;" class="col-span-1 bg-primary rounded-lg p-4"></div>
                        <div style="aspect-ratio: 16/9;" class="col-span-1 bg-primary rounded-lg p-4"></div>
                        <div style="aspect-ratio: 16/9;" class="col-span-1 bg-primary rounded-lg p-4"></div>
                        <div style="aspect-ratio: 16/9;" class="col-span-1 bg-primary rounded-lg p-4"></div>
                        <div style="aspect-ratio: 16/9;" class="col-span-1 bg-primary rounded-lg p-4"></div>
                        <div style="aspect-ratio: 16/9;" class="col-span-1 bg-primary rounded-lg p-4"></div>
                        <div style="aspect-ratio: 16/9;" class="col-span-1 bg-primary rounded-lg p-4"></div>
                        <div style="aspect-ratio: 16/9;" class="col-span-1 bg-primary rounded-lg p-4"></div>
                        <div style="aspect-ratio: 16/9;" class="col-span-1 bg-primary rounded-lg p-4"></div>
                        <div style="aspect-ratio: 16/9;" class="col-span-1 bg-primary rounded-lg p-4"></div>
                        <div style="aspect-ratio: 16/9;" class="col-span-1 bg-primary rounded-lg p-4"></div>
                        <div style="aspect-ratio: 16/9;" class="col-span-1 bg-primary rounded-lg p-4"></div>
                        <div style="aspect-ratio: 16/9;" class="col-span-1 bg-primary rounded-lg p-4"></div>
                        <div style="aspect-ratio: 16/9;" class="col-span-1 bg-primary rounded-lg p-4"></div>
                        <div style="aspect-ratio: 16/9;" class="col-span-1 bg-primary rounded-lg p-4"></div>
                        <div style="aspect-ratio: 16/9;" class="col-span-1 bg-primary rounded-lg p-4"></div>
                        <div style="aspect-ratio: 16/9;" class="col-span-1 bg-primary rounded-lg p-4"></div> -->
                    </div>
                </div>

                <!-- <div class="col-span-12">
                    <div class="flex justify-between items-center border-b border-primary border-opacity-20 mb-10 py-5">
                        <p class="text-primary text-sm text-opacity-70 font-medium font-numbers">
                            
                            </span>
                        </p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-4 gap-y-2">
                    </div>
                </div> -->
            </div>
        </div>
    </div>
    <?php
    $contents = ob_get_clean();
    return $contents;
}
