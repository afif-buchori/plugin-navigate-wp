<div id="modal-detail-act<?php echo $idx ?>" style="
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
        max-width: 880px;
        max-height: 70vh;
        padding: 20px 0 20px 20px;
        background-color: white;
        border-radius: 12px;
        display: flex;
        flex-direction: column;
        position: relative;
    ">
        <div class="flex justify-between" style="padding-bottom: 8px;">
            <p class="text-xl font-bold">Detail Package</p>
            <button id="close-modal<?php echo $idx ?>" type="button" class="font-bold" style="
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
            <p class="font-bold p-4"><?php echo $ticket->name ?></p>

            <?php if (isset($ticket->description)) { ?>
                <h2 class="font-medium mt-5">Description/important notes</h2>
                <p><?php $dom = new DOMDocument();
                $dom->loadHTML($ticket->description);
                echo $dom->saveHTML();
                ?></p>
            <?php } ?>

            <?php if (isset($ticket->inclusions)) { ?>
                <h2 class="font-medium mt-5">Inclusions</h2>
                <div class="pl-4">
                    <?php foreach ($ticket->inclusions as $inclusion) { ?>
                        <li><?php echo $inclusion ?></li>
                    <?php } ?>
                </div>
            <?php } ?>

            <?php if (isset($ticket->cancellationNotes)) { ?>
                <h2 class="font-medium mt-5">Cancellation notes</h2>
                <div class="pl-4">
                    <?php foreach ($ticket->cancellationNotes as $cancel_notes) { ?>
                        <li><?php echo $cancel_notes ?></li>
                    <?php } ?>
                </div>
            <?php } ?>

            <?php if (isset($ticket->tourInformation)) { ?>
                <h2 class="font-medium mt-5">Tour information</h2>
                <div class="pl-4">
                    <?php foreach ($ticket->tourInformation as $tour_info) {
                        if ($tour_info !== null) {
                            foreach ($tour_info as $tour) {
                                ?>
                                <li><?php echo $tour ?></li>
                            <?php }
                        } else {
                            echo "-";
                        }
                    } ?>
                </div>
            <?php } ?>

            <?php if (isset($ticket->termsAndConditions)) { ?>
                <h2 class="font-medium mt-5">Terms and conditions</h2>
                <p><?php $dom = new DOMDocument();
                $dom->loadHTML($ticket->termsAndConditions);
                echo $dom->saveHTML();
                ?></p>
            <?php } ?>

        </div>
    </div>
</div>