if (url_name[0] == "opentrip") {
    // console.log("url", url_name);
    const API_OT_URL = "/api/opentrip";

    // DETAIL PAGE
    if (url_name[2]) {
        const elPeriod = document.getElementById("period-selected");
        const serviceId = elPeriod.dataset.serviceid;
        const dataPeriod = JSON.parse(elPeriod.dataset.period);
        console.log(serviceId, dataPeriod);

        // DESC
        const elDayDuration = document.getElementById("period-day-duration");
        elDayDuration.innerHTML = dataPeriod.duration + " Days";
        const elCitiesVisit = document.getElementById("period-cities-visited");
        elCitiesVisit.innerHTML = dataPeriod.citiesVisited + " Cities Visited";
        const elAirline = document.getElementById("period-airline");
        elAirline.innerHTML = dataPeriod.airline;
        const elDepartureFrom = document.getElementById("period-departure-from");
        elDepartureFrom.innerHTML = "Keberangkatan dari " + dataPeriod.departureFrom;

        const container = document.getElementById("itinerary-ot");

        container.innerHTML = dataPeriod.itinerary
            .map((item, idx) => {
                const infoHTML =
                    item.with_add_info === "true"
                        ? `<div class="flex flex-wrap gap-2 mt-2">
                        ${item.add_info
                            .map(
                                (info) => `
                        <div class="flex items-center gap-1 bg-primary/10 text-primary px-2 py-1 rounded-full text-sm">
                            <i class="fa-solid fa-${info.icon}"></i>
                            <span>${info.description}</span>
                        </div>
                        `
                            )
                            .join("")}
                    </div>`
                        : "";

                return `
                <div class="py-4 flex flex-col relative">
                    <div class="flex items-center gap-1">
                        <p class="text-base font-medium">Day ${idx + 1}</p>
                        <span style="width: 14px; height: 14px; border-radius: 14px; background-color: #309898; display: flex;"></span>
                        <h3 class="flex-1 text-base font-bold pl-2 mb-1">${item.title}</h3>
                    </div>
                    <div style="padding-left: 70px">
                        <div class="text-sm text-gray-600">${item.description}</div>
                        ${infoHTML}
                    </div>
                    <span style="width: 2px; background-color: #30989860; left: 12px" class="absolute top-0 h-full flex"></span>
                </div>
                `;
            })
            .join("");

        // FORM SELECT PERIOD
        const elDataPeriods = document.getElementById("data-travel-periods");
        const listTravelPeriod = JSON.parse(elDataPeriods.dataset.travelperiods);

        const elLoader = document.getElementById("loading-qty-pass-ot");
        const btnBook = document.getElementById("btn-book-opentrip");

        const elSelectPeriod = document.getElementById("ot-date-select");
        elSelectPeriod.value = listTravelPeriod[0]?.id ?? "";

        const formPeriod = document.getElementById("form-period-opentrip");
        const inputPassengers = formPeriod.querySelectorAll("input[type='number']") ?? [];

        const elMsgError = document.getElementById("msg-error-detail-ot");

        const elMinPrice = document.getElementById("min-price-detail");
        const elLoadTotalPrice = document.getElementById("loader-total-price-detail");
        const elTotalPrice = document.getElementById("total-price-detail");

        const btnQtyAdult = document.getElementById("div-qtydetail-adult");
        const btnQtyChild = document.getElementById("div-qtydetail-child");
        const btnQtyInfant = document.getElementById("div-qtydetail-infant");
        const handleDisplayQtyButtons = (data, price) => {
            if (!data) return;
            if (data.childData) {
                if (btnQtyChild.classList.contains("hidden")) btnQtyChild.classList.remove("hidden");
            } else {
                if (btnQtyChild.classList.contains("hidden")) console.log("");

                btnQtyChild.classList.add("hidden");
            }
            if (data.infantData) {
                if (btnQtyInfant.classList.contains("hidden")) btnQtyInfant.classList.remove("hidden");
            } else {
                if (btnQtyInfant.classList.contains("hidden")) console.log("");
                btnQtyInfant.classList.add("hidden");
            }
            if (price) elMinPrice.innerText = "IDR " + numberFormat(price.after);
            elTotalPrice.innerText = numberFormat(data.total);
        };
        handleDisplayQtyButtons(dataPeriod.updatePrice, dataPeriod.price);

        let bodyPassenger = { adult: 1, child: 0, infant: 0 };
        const updatePrice = async (id, pass) => {
            const { adult, child, infant } = pass;
            elMsgError.classList.add("hidden");
            elLoader.classList.remove("hidden");
            btnBook.classList.add("hidden");
            elLoadTotalPrice.classList.remove("hidden");
            elTotalPrice.classList.add("hidden");
            const res = await fetchingPost(API_OT_URL + "/updateprice", { serviceId, periodId: id, adult, child, infant });

            if (res.error) return null;
            elLoader.classList.add("hidden");
            btnBook.classList.remove("hidden");
            elLoadTotalPrice.classList.add("hidden");
            elTotalPrice.classList.remove("hidden");
            handleDisplayQtyButtons(res.data);
            if ((res.data?.adultData?.min ?? 0) > bodyPassenger.adult) {
                elMsgError.classList.remove("hidden");
                elMsgError.innerText = "*minimum Adult " + res.data.adultData.min;
                btnBook.disabled = true;
            } else {
                btnBook.disabled = false;
            }

            return res;
        };

        elSelectPeriod.addEventListener("change", async (e) => {
            const val = e.target.value;
            const periodSelected = listTravelPeriod.find((p) => p.id === val) ?? null;
            elMinPrice.innerText = "IDR " + numberFormat(periodSelected.price.after);
            const res = await updatePrice(periodSelected.id, bodyPassenger);
            console.log(res);
        });

        inputPassengers.forEach((input) => {
            bodyPassenger[input.name] = parseInt(input.value);

            const incBtn = input.nextElementSibling;
            const decBtn = input.previousElementSibling;

            const onUpdatePrice = async () => {
                let currentValue = parseInt(input.value);
                bodyPassenger = { ...bodyPassenger, [input.name]: currentValue };
                const res = await updatePrice(elSelectPeriod.value, bodyPassenger);
                console.log(res);
            };
            incBtn.addEventListener("click", onUpdatePrice);
            decBtn.addEventListener("click", onUpdatePrice);
        });
    }
}
