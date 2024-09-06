<div id="modal-list-tour-package" style="
    width: 100vw;
    height: 100%;
    position: fixed;
    top: 0;
    left: 0;
    z-index: 9999;
    background-color: #111827c5;
    /* display: flex; */
    display: none;
    justify-content: center;
    align-items: center;
    padding: 0 44px;
">
    <div id="enxcontainer-modal" style="
        width: 100%;
        max-width: 880px;
        max-height: 70vh;
        /* padding: 20px 0 20px 20px; */
        background-color: white;
        border-radius: 12px;
        display: flex;
        flex-direction: column;
        position: relative;
    ">
        <div class="flex justify-between p-4 border-b">
            <p class="text-xl font-bold flex-1">Detail Package</p>
            <button id="close-modal-list-tourpackage" type="button" class="btn-close">✕</button>
        </div>
        <div style="
            display: flex;
            flex-direction: column;
            width: 100%;
            height: 100%;
            overflow-y: auto;
            padding-left: 16px;
            padding-right: 16px;
        " id="detail-content">
            <!-- CONTENTS -->

            <div style="width: 100%;">
                <div class="mt-5">
                    <div class="flex items-center justify-between gap-4">
                        <input type="checkbox" hidden>
                        <p class="font-bold">Title Package</p>
                        <div style="width: 20px; height: 20px;" class="border-2 border-primary rounded-md relative">

                            <span class="iconify absolute top-0 left-0" data-icon="mingcute:check-fill" data-width="16"
                                data-height="16"></span>
                        </div>
                    </div>
                    <div class="flex gap-2 mt-4">
                        <span style="background-color: #BBE9FF60;"
                            class="px-2 border border-primary rounded-full text-xs md:text-sm">
                            5 Days
                        </span>
                        <span style="background-color: #BBE9FF60;"
                            class="px-2 border border-primary rounded-full text-xs md:text-sm">
                            8 Cities Visited
                        </span>
                        <p class="font-bold text-xs md:text-sm ml-auto">USD 0.00</p>
                    </div>
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ex similique at vero deserunt sint quod
                        sunt, inventore dicta assumenda quas maiores? Atque veniam nisi perferendis repellendus possimus
                        nihil, ratione corporis.</p>
                </div>
                <div class="mt-5 border-t pt-5">
                    <div class="flex items-center justify-between gap-4">
                        <input type="checkbox" hidden>
                        <p class="font-bold">Title Package</p>
                        <div style="width: 20px; height: 20px;" class="border-2 border-primary rounded-md relative">

                            <span class="iconify absolute top-0 left-0" data-icon="mingcute:check-fill" data-width="16"
                                data-height="16"></span>
                        </div>
                    </div>
                    <div class="flex gap-2 mt-4">
                        <span style="background-color: #BBE9FF60;"
                            class="px-2 border border-primary rounded-full text-xs md:text-sm">
                            5 Days
                        </span>
                        <span style="background-color: #BBE9FF60;"
                            class="px-2 border border-primary rounded-full text-xs md:text-sm">
                            8 Cities Visited
                        </span>
                        <p class="font-bold text-xs md:text-sm ml-auto">USD 0.00</p>
                    </div>
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ex similique at vero deserunt sint quod
                        sunt, inventore dicta assumenda quas maiores? Atque veniam nisi perferendis repellendus possimus
                        nihil, ratione corporis.</p>
                </div>
            </div>
            <!-- <div>Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias, veritatis magnam, sed sequi
                adipisci, illo assumenda voluptates nihil maxime consequuntur repellat? Recusandae quis laboriosam
                mollitia perferendis numquam eius aut illum!</div> -->

            <!-- END CONTENTS -->
        </div>
        <div class="flex justify-end border-t p-4 mt-4">
            <button type="btn" id="btn-submit-select-package" class="btn-primary">Select</button>
        </div>
    </div>
</div>