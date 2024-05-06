<div id="modal-session-end" style="
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
            <button id="close-modal-session-end" type="button" class="font-bold" style="
                background-color: white !important;
                width: 32px;
                height: 32px;
                /* aspect-ratio: 1/1; */
                border-radius: 999px;
                border: solid 2px black !important;
                display: grid;
                place-content: center;
                position: absolute;
                top: 8px;
                right: 8px;
                color:black;
                padding: 0px !important;
            ">X</button>
        </div>
        <div style="
            display: flex;
            flex-direction: column;
            width: 100%;
            height: 100%;
            overflow-y: auto;
            padding-right: 16px;
            min-width: 310px;
        ">
            <p>Oops! It looks like your booking has expired. Feel free to make a new booking and experience the
                excitement once again!</p>
            <div class="w-full flex">
                <a href="/activity" class="btn-primary rounded-lg mt-4 ml-auto">OK</a>
            </div>
        </div>
    </div>
</div>