
<div id="modal-tc" style="
    width: 100vw;
    height: 100%;
    position: fixed;
    top: 0;
    left: 0;
    z-index: 9999;
    background-color: #111827c5;
    display: none;
    place-content: center;
    padding: 0 44px;
">
    <div id="enxcontainer-modal" style="
        max-width: 900px;
        max-height: 70vh;
        padding: 20px 0 20px 20px;
        background-color: white;
        border-radius: 12px;
        display: flex;
        flex-direction: column;
        position: relative;
    ">
        <div class="flex justify-between" style="padding-bottom: 8px;">
            <!-- <p class="text-xl font-bold">Term and Conditions</p> -->
            <button id="close-modal" type="button" class="font-bold" style="
                background-color: white !important;
                width: 32px;
                height: 32px;
                border-radius: 999px;
                border: solid 2px black !important;
                display: grid;
                place-content: center;
                position: absolute;
                top: 8px;
                right: 8px;
            ">X</button>
        </div>
        <div style="
            display: flex;
            flex-direction: column;
            width: 100%;
            height: 100%;
            overflow-y: auto;
            padding-right: 16px;
        ">
            <div class="w-full flex flex-col">
                <p class="font-bold mb-4">Term And Condition Passport</p>
                <div class="flex flex-col gap-2">
                    <div class="w-full flex flex-wrap gap-2">
                        <div class="w-28 sm:w-40 flex">
                            <img src="<?php echo plugins_url( '../assets/images/quality_good.jpeg', dirname(__FILE__) ); ?>" alt="image good" class="w-full object-contain">
                        </div>
                        <div class="w-28 sm:w-40 flex">
                            <img src="<?php echo plugins_url( '../assets/images/quality_bad.jpeg', dirname(__FILE__) ); ?>" alt="image bad" class="w-ful object-containl">
                        </div>
                        <p class="flex-1" style="min-width: 170px">Make sure the photo are sharp, in focus, and not ghosted.</p>
                    </div>
                    
                    <div class="w-full flex flex-wrap gap-2 pt-2 border-t border-green-medium">
                        <div class="w-28 sm:w-40 flex">
                            <img src="<?php echo plugins_url( '../assets/images/visibility_good.jpeg', dirname(__FILE__) ); ?>" alt="image good" class="w-full object-contain">
                        </div>
                        <div class="w-28 sm:w-40 flex">
                            <img src="<?php echo plugins_url( '../assets/images/visibility_bad.jpeg', dirname(__FILE__) ); ?>" alt="image bad" class="w-full object-contain">
                        </div>
                        <p class="flex-1" style="min-width: 170px">Make sure the photo is not covered, cropped or folded and not blurry.</p>
                    </div>
                    
                    <div class="w-full flex flex-wrap gap-2 pt-2 border-t border-green-medium">
                        <div class="w-28 sm:w-40 flex">
                            <img src="<?php echo plugins_url( '../assets/images/landscape.jpeg', dirname(__FILE__) ); ?>" alt="image good" class="w-full object-contain">
                        </div>
                        <div class="w-28 sm:w-40 flex">
                            <img src="<?php echo plugins_url( '../assets/images/potrait.jpeg', dirname(__FILE__) ); ?>" alt="image bad" class="w-full object-contain mb-auto">
                        </div>
                        <p class="flex-1" style="min-width: 170px">Make sure the passport photo is in landscape form.</p>
                    </div>
                </div>
                
                <?php if ($isVoa) { ?>
                <p class="font-bold mt-10 mb-4">Term And Condition Selfie</p>
                <div class="flex flex-col gap-2">
                    <div class="w-full flex flex-wrap gap-x-8">
                        <div class="w-28 sm:w-40 flex">
                            <img src="<?php echo plugins_url( '../assets/images/photo-correct-new.jpeg', dirname(__FILE__) ); ?>" alt="image good" class="w-full object-contain">
                        </div>
                        <div>
                            <p>Photo format:</p>
                            <li>File format using *.JPEG/ .JPG/ .PNG in color.</li>
                            <li>Min. 400x600px.</li>
                            <li>max. size 2Mb.</li>
                            <li>Proper composition.</li>
                        </div>
                    </div>
                    
                    <div class="w-full flex flex-wrap gap-x-8 pt-2 border-t border-green-medium">
                        <div class="w-28 sm:w-40 flex">
                            <img src="<?php echo plugins_url( '../assets/images/size.png', dirname(__FILE__) ); ?>" alt="image good" class="w-full object-contain">
                        </div>
                        <p class="flex-1" style="min-width: 170px">
                        The top of the head, including the hair, to the bottom of the chin must be between 50% and 60% of the image's total height. The eye height (measured from the bottom of the image to the level of the eyes) should be between 50% and 60% of the image's height.</p>
                    </div>
                    
                    <div class="w-full flex flex-wrap gap-x-8 pt-2 border-t border-green-medium">
                        <div class="w-28 sm:w-40 flex">
                            <img src="<?php echo plugins_url( '../assets/images/incorrect.png', dirname(__FILE__) ); ?>" alt="image good" class="w-full object-contain">
                        </div>
                        <p class="flex-1" style="min-width: 170px">
                        The layout and position of the photo must be proper (Too close and too far are not recommended).</p>
                    </div>
                    
                    <div class="w-full flex flex-wrap gap-x-8 pt-2 border-t border-green-medium">
                        <div class="w-28 sm:w-40 flex">
                            <img src="<?php echo plugins_url( '../assets/images/incorrect-all.png', dirname(__FILE__) ); ?>" alt="image good" class="w-full object-contain">
                        </div>
                        <div>
                            <p>Unrecommended photo:</p>
                            <li>blurry photo.</li>
                            <li>Others than face photo.</li>
                            <li>Expression face photo.</li>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>