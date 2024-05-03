<?php

function enx_mapping_card($data, $data_res, $currency)
{
    foreach ($data as $idx => $ticket) { ?>
        <div class="w-full rounded-lg" style="background-color: white;">
            <p class="font-bold p-4"><?php echo $ticket->name ?></p>
            <div class="w-full flex flex-col md:flex-row p-4" style="background-color: #dadada;">
                <div class="flex-1 flex flex-col">
                    <?php if ($ticket->definedDuration && $ticket->definedDuration > 0) { ?>
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 14px; height: 14px;"
                                viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path
                                    d="M152 24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H64C28.7 64 0 92.7 0 128v16 48V448c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V192 144 128c0-35.3-28.7-64-64-64H344V24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H152V24zM48 192h80v56H48V192zm0 104h80v64H48V296zm128 0h96v64H176V296zm144 0h80v64H320V296zm80-48H320V192h80v56zm0 160v40c0 8.8-7.2 16-16 16H320V408h80zm-128 0v56H176V408h96zm-144 0v56H64c-8.8 0-16-7.2-16-16V408h80zM272 248H176V192h96v56z" />
                            </svg>
                            <p class="text-sm">Valid for <?php echo $ticket->definedDuration ?></p>
                        </div>
                    <?php } ?>

                    <?php if ($ticket->redeemStart && $ticket->redeemEnd) { ?>
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 14px; height: 14px;"
                                viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path
                                    d="M152 24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H64C28.7 64 0 92.7 0 128v16 48V448c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V192 144 128c0-35.3-28.7-64-64-64H344V24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H152V24zM48 192h80v56H48V192zm0 104h80v64H48V296zm128 0h96v64H176V296zm144 0h80v64H320V296zm80-48H320V192h80v56zm0 160v40c0 8.8-7.2 16-16 16H320V408h80zm-128 0v56H176V408h96zm-144 0v56H64c-8.8 0-16-7.2-16-16V408h80zM272 248H176V192h96v56z" />
                            </svg>
                            <p class="text-sm">Valid from
                                <?php echo date('D, d F Y', strtotime($ticket->redeemStart)) . " - " . date('D, d F Y', strtotime($ticket->redeemStart)) ?>
                            </p>
                        </div>
                    <?php } ?>

                    <?php if ($data_res->isInstantConfirmation) { ?>
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 14px; height: 14px;"
                                viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path fill="#4CC0CE"
                                    d="M349.4 44.6c5.9-13.7 1.5-29.7-10.6-38.5s-28.6-8-39.9 1.8l-256 224c-10 8.8-13.6 22.9-8.9 35.3S50.7 288 64 288H175.5L98.6 467.4c-5.9 13.7-1.5 29.7 10.6 38.5s28.6 8 39.9-1.8l256-224c10-8.8 13.6-22.9 8.9-35.3s-16.6-20.7-30-20.7H272.5L349.4 44.6z" />
                            </svg>
                            <p class="text-sm">Instant Confirmation</p>
                        </div>
                    <?php } ?>

                    <?php if ($ticket->isCancellable) { ?>
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 14px; height: 14px;"
                                viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path fill="green"
                                    d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-111 111-47-47c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l64 64c9.4 9.4 24.6 9.4 33.9 0L369 209z" />
                            </svg>
                            <p class="text-sm">Refundable</p>
                        </div>
                    <?php } else { ?>
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 14px; height: 14px;"
                                viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path fill="red"
                                    d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c-9.4 9.4-9.4 24.6 0 33.9l47 47-47 47c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l47-47 47 47c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-47-47 47-47c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-47 47-47-47c-9.4-9.4-24.6-9.4-33.9 0z" />
                            </svg>
                            <p class="text-sm">Non Refundable</p>
                        </div>
                    <?php } ?>

                    <div>
                        <button type="button" id="btn-details-package<?php echo $idx ?>" class="font-bold text-sm" style="border: 1px solid black !important; 
                            border-radius: 999px; 
                            padding: 1px 8px !important;">See Details
                        </button>
                    </div>
                </div>

                <div class="flex justify-between items-end">
                    <p class="ml-auto"><span class="text-lg font-bold"><?php echo "$currency->symbol" ?>
                            <?php echo number_format($ticket->minimumPrice, $currency->digit) ?></span>/pax</p>
                </div>
            </div>
            <?php include 'contents/details-package.php' ?>

            <div class="text-center pt-2">
                <p class="font-bold">Package Options</p>
            </div>
            <div class="w-full flex flex-col md:flex-row gap-4 p-4">
                <div class="flex-1">
                    <?php if ($ticket->visitDate->request) { ?>
                        <div class="flex items-center justify-between w-full rounded-full px-4 py-2 gap-4"
                            style="background-color: #dadada;">
                            <input type="date" name="" id="date-package-act<?php echo $idx ?>"
                                min="<?php echo date('Y-m-d', strtotime(date('Y-m-d') . ' + 2 days')) ?>"
                                data-id-ticket="<?php echo $ticket->ticketType[0]->id ?>" class="w-full" placeholder="select date"
                                style="background-color: transparent; height: 30px;">
                        </div>
                    <?php } ?>
                </div>
                <input type="hidden" id='<?= "total-qty-package$idx" ?>' value="0">
                <div id="ticket-type-act" class="flex-1 flex flex-col gap-1"
                    data-ticket="<?php echo count($ticket->ticketType) ?>">
                    <?php foreach ($ticket->ticketType as $key_tick => $tick_type) { ?>
                        <div class="flex items-center justify-between w-full rounded-full px-4 py-2 gap-4"
                            style="background-color: #dadada;" id="new-ticket-type-act"
                            data-qty-package-act='<?= "total-qty-package$idx" ?>'
                            data-date-package-act="date-package-act<?php echo $idx ?>"
                            data-msg-error="<?php echo "msg-error" . $idx ?>"
                            data-qty-act-dec="<?= $idx . "qty-act-dec" . $key_tick ?>"
                            data-qty-type-act="<?= $idx . "qty-type-act" . $key_tick ?>"
                            data-qty-act-inc="<?= $idx . "qty-act-inc" . $key_tick ?>" data-price="<?= $tick_type->price ?>"
                            data-total-price="<?= "total-price" . $idx ?>" data-msg-error="<?php echo "msg-error" . $idx ?>"
                            data-id-btn-submit="<?php echo "submit-package" . $idx ?>"
                            data-with-question="<?php echo (($ticket->questions && count($ticket->questions) > 0) || ($ticket->timeSlot && count($ticket->timeSlot) > 0)) ?>"
                            data-modal-quest="<?php echo "modal-question" . $idx ?>"
                            data-close-modal="<?php echo "close-modal-quest" . $idx ?>"
                            data-id-activity="<?php echo $data_res->id ?>" data-name-activity="<?php echo $data_res->name ?>"
                            data-id-ticket="<?php echo $ticket->id ?>" data-name-ticket="<?php echo $ticket->name ?>"
                            data-defined-duration="<?php echo $ticket->definedDuration ?>"
                            data-required-time-slot="<?php echo $ticket->timeSlot && count($ticket->timeSlot) > 0 ? "true" : "false" ?>"
                            data-required-date="<?php echo $ticket->visitDate->required ?>"
                            data-booking-ticket="data-book-ticket<?php echo $idx ?>"
                            data-all-ticket="data-all-ticket<?php echo $idx ?>" data-id-ticket-type="<?php echo $tick_type->id ?>"
                            data-form-quest="form-quest<?= $idx ?>" data-confirm-btn="confirm-btn<?= $idx ?>">
                            <p class=" font-bold"><?php echo $tick_type->name ?></p>
                            <p class="text-xs md:text-sm ml-auto" style="opacity: 0.7;">
                                <?php $currency->symbol ?>
                                <?php echo number_format($tick_type->price, $currency->digit) ?>
                            </p>
                            <div class="flex items-center gap-2">
                                <button id="<?php echo $idx . "qty-act-dec" . $key_tick ?>" class="btn-circle-primary">
                                    <p class="text-lg font-bold" style="margin-top: -3px !important;">-</p>
                                </button>
                                <p id="<?php echo $idx . "qty-type-act" . $key_tick ?>" class="font-bold">
                                    0
                                </p>
                                <button id="<?php echo $idx . "qty-act-inc" . $key_tick ?>" class="btn-circle-primary">
                                    <p class="text-lg" style="margin-top: -3px !important;">+</p>
                                </button>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="flex items-center justify-between w-full rounded-full px-4 py-2 gap-4"
                        style="background-color: #dadada;">
                        <p>Total Price</p>
                        <p class="ml-auto"><?php echo $currency->symbol ?> <span data-digit="<?php echo $currency->digit ?>"
                                id="total-price<?php echo $idx ?>">0</span></p>
                    </div>
                </div>
            </div>

            <div class="w-full flex">
                <p id="<?php echo "msg-error" . $idx ?>" class="text-right text-xs md:text-sm px-4 ml-auto"></p>
            </div>
            <div class="w-full flex gap-2 p-4">
                <input type="hidden" name="" id="data-book-ticket<?php echo $idx ?>" value="">
                <input type="hidden" name="" id="data-all-ticket<?php echo $idx ?>"
                    value="<?php echo htmlspecialchars(json_encode($ticket->ticketType), ENT_QUOTES, 'UTF-8'); ?>">
                <button id="<?php echo "submit-package" . $idx ?>" disabled type="button" class="ml-auto btn-primary">Select
                    Package</button>
            </div>
            <div id="modal-question<?php echo $idx ?>" style="
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
                        <p class="text-xl font-bold">Questions</p>
                        <button id="close-modal-quest<?php echo $idx ?>" type="button" class="font-bold" style="
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
                        min-width: 360px;
                        height: 100%;
                        overflow-y: auto;
                        padding-right: 16px;
                    ">
                        <form id="form-quest<?= $idx ?>" style="margin-bottom: 0px !important;">
                            <?php var_dump(isset($ticket->timeSlot) && count($ticket->timeSlot) > 0) ?>

                            <?php foreach ($ticket->ticketType as $key_type_quest => $type) { ?>
                                <?php if ($key_type_quest > 0) { ?>
                                    <hr style="margin-top: 20px !important; margin-bottom: 10px !important;">
                                <?php } ?>
                                <p class="font-bold">
                                    <?php echo $type->name ?>
                                </p>
                                <?php if ($ticket->questions && count($ticket->questions) > 0) { ?>
                                    <?php foreach ($ticket->questions as $key_quest => $quest) { ?>
                                        <?php if ($quest->type == "DATE") { ?>
                                            <div class="">
                                                <p><?php echo $quest->question ?> :</p>
                                                <input type="date"
                                                    name="<?php echo $quest->id . ':' . str_replace(' ', '_', $quest->question) . ':' . strtolower($type->name) ?>"
                                                    class="w-full mb-2" style="border: solid 1px black !important;" required>
                                            </div>
                                        <?php } elseif ($quest->type == "OPTION") { ?>
                                            <div class="">
                                                <p><?php echo $quest->question ?> :</p>
                                                <select
                                                    name="<?php echo $quest->id . ':' . str_replace(' ', '_', $quest->question) . ':' . strtolower($type->name) ?>"
                                                    id="" class="w-full mb-2" style="border: solid 1px black !important;" required>
                                                    <option value="">---</option>
                                                    <?php foreach ($quest->options as $opt) { ?>
                                                        <option value="<?php echo $opt ?>"><?php echo $opt ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        <?php } else { ?>
                                            <div class="">
                                                <p><?php echo $quest->question ?> :</p>
                                                <input type="text"
                                                    name="<?php echo $quest->id . ':' . str_replace(' ', '_', $quest->question) . ':' . strtolower($type->name) ?>"
                                                    class="w-full mb-2" style="border: solid 1px black !important;" required>
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                                <?php }
                            } ?>
                            <div class="w-full flex mt-5">
                                <button type="submit" id="confirm-btn<?= $idx ?>" class="btn-primary ml-auto">Confirm</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php }
} ?>