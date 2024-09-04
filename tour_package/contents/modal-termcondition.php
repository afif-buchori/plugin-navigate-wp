<div id="modal-term-condition-tourpackage" style="
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
            <p class="text-xl font-bold flex-1">Term and Conditions</p>
            <button id="close-modal-term-condition-tourpackage" type="button" class="btn-close">✕</button>
        </div>
        <div style="
            display: flex;
            flex-direction: column;
            width: 100%;
            height: 100%;
            overflow-y: auto;
            padding-right: 16px;
        ">
            <!-- CONTENTS -->
            <div><?php echo $contents->term_condition ?></div>
            <!-- END CONTENTS -->
        </div>
        <div class="p-4 pb-0 flex justify-end">
            <button id="confirm-button" class="btn-primary">Confirm</button>
        </div>
    </div>
</div>