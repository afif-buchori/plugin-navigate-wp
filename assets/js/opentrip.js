if (url_name[0] == "opentrip") {
    // console.log("url", url_name);
    const API_OT_URL = "/api/opentrip";
    function formatPeriodRange(fromStr, toStr) {
        const from = new Date(fromStr);
        const to = new Date(toStr);

        const fromDay = from.getDate();
        const fromMonth = from.toLocaleString("en-US", { month: "long" });
        const fromYear = from.getFullYear();

        const toDay = to.getDate();
        const toMonth = to.toLocaleString("en-US", { month: "long" });
        const toYear = to.getFullYear();

        const sameYear = fromYear === toYear;
        const sameMonth = fromMonth === toMonth && sameYear;

        if (sameMonth) {
            // 12 - 15 January 2023
            return `${fromDay} - ${toDay} ${fromMonth} ${fromYear}`;
        } else if (sameYear) {
            // 12 January - 15 February 2023
            return `${fromDay} ${fromMonth} - ${toDay} ${toMonth} ${fromYear}`;
        } else {
            // 12 January 2023 - 15 February 2024
            return `${fromDay} ${fromMonth} ${fromYear} - ${toDay} ${toMonth} ${toYear}`;
        }
    }

    // DETAIL PAGE
    if (url_name[2]) {
        const elPeriod = document.getElementById("period-selected");
        const serviceId = elPeriod.dataset.serviceid;
        const dataPeriod = JSON.parse(elPeriod.dataset.period);
        console.log(serviceId, dataPeriod);

        // DESC
        const modalTCdetail = document.getElementById("modal-term-condition-opentrip");
        const btnTerms = document.getElementById("btn-open-modal-tc-detail-ot");
        btnTerms.addEventListener("click", () => {
            const btnClose = document.getElementById("close-modal-term-condition-opentrip");
            modalTCdetail.style.display = "grid";
            btnClose.addEventListener("click", () => (modalTCdetail.style.display = "none"));
        });

        const elDayDuration = document.getElementById("period-day-duration");
        const elCitiesVisit = document.getElementById("period-cities-visited");
        const elAirline = document.getElementById("period-airline");
        const elDepartureFrom = document.getElementById("period-departure-from");
        const elTitleItin = document.getElementById("title-itin-ot");

        const container = document.getElementById("itinerary-ot");

        const dataIcon = {
            plane: `<span class="iconify inline" data-icon="mdi:airplane" data-width="20" data-height="20"></span>`,
            utensils: `<span class="iconify inline" data-icon="mdi:utensils-fork-knife" data-width="20" data-height="20"></span>`,
        };

        changeViewPeriod = (dataSelected) => {
            elDayDuration.innerHTML = dataSelected.duration + " Days";
            elCitiesVisit.innerHTML = dataSelected.citiesVisited + " Cities Visited";
            elAirline.innerHTML = dataSelected.airline;
            elDepartureFrom.innerHTML = "Keberangkatan dari " + dataSelected.departureFrom;
            elTitleItin.innerHTML = "Itinerary " + formatPeriodRange(dataSelected.periodFrom, dataSelected.periodTo);
            // ITINERARY
            container.innerHTML = dataSelected.itinerary
                .map((item, idx) => {
                    const infoHTML =
                        item.with_add_info === "true"
                            ? `<div class="flex flex-wrap gap-2 mt-2">
                            ${item.add_info
                                .map(
                                    (info) => `
                            <div class="flex items-center gap-1 bg-primary/10 text-primary px-2 py-1 rounded-full text-sm">
                            ${dataIcon[info.icon]}
                                <span>${info.description}</span>
                            </div>
                            `
                                )
                                .join("")}
                        </div>`
                            : "";

                    return `
                    <div class="pt-2 ${idx + 1 === dataPeriod.itinerary.length ? "" : "border-b pb-4"} flex flex-col relative">
                        <div class="flex items-center gap-1">
                            <p style="width: 52px;" class="text-base font-medium">Day ${idx + 1}</p>
                            <span style="width: 14px; height: 14px; border-radius: 14px; background-color: #309898; display: flex;"></span>
                            <h3 class="flex-1 text-base font-bold pl-2 mb-1">${item.title}</h3>
                        </div>
                        <div style="padding-left: 76px">
                            <div class="text-sm text-gray-600">${item.description}</div>
                            ${infoHTML}
                        </div>
                        <span style="width: 2px; background-color: #30989860; left: 62px; top: ${idx === 0 ? "16px" : "0px"}; height: ${
                        dataPeriod.itinerary.length === idx + 1 ? "18px" : idx === 0 ? "calc(100% - 16px)" : "100%"
                    };" class="absolute flex"></span>
                    </div>
                    `;
                })
                .join("");
        };
        changeViewPeriod(dataPeriod);

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
            if (controller) {
                controller.abort();
            }
            controller = new AbortController();
            const signal = controller.signal;
            const { adult, child, infant } = pass;
            elMsgError.classList.add("hidden");
            elLoader.classList.remove("hidden");
            btnBook.classList.add("hidden");
            elLoadTotalPrice.classList.remove("hidden");
            elTotalPrice.classList.add("hidden");
            try {
                const result = await fetch(API_OT_URL + "/updateprice", {
                    method: "POST",
                    headers: {
                        Accept: "application/json",
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({ serviceId, periodId: id, adult, child, infant }),
                    signal: signal,
                });
                const res = await result.json();
                afterFetching(res);
                return res;
            } catch (error) {
                if (error.name === "AbortError") {
                    console.log("Fetch dibatalkan");
                } else {
                    console.log("Err fetch", error);
                    afterFetching(error);
                }
                return error;
            }
        };
        function afterFetching(res) {
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
        }

        elSelectPeriod.addEventListener("change", async (e) => {
            const val = e.target.value;
            const periodSelected = listTravelPeriod.find((p) => p.id === val) ?? null;
            elMinPrice.innerText = "IDR " + numberFormat(periodSelected.price.after);
            changeViewPeriod(periodSelected);
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

        // PERIOD BOOKING
        formPeriod.addEventListener("submit", (e) => {
            e.preventDefault();
            const body = {
                serviceId,
                periodId: elSelectPeriod.value,
                adult: bodyPassenger.adult,
                child: bodyPassenger.child,
                infant: bodyPassenger.infant,
            };
            console.log(body);
            modalTCdetail.style.display = "grid";
            const btnConfirm = document.getElementById("confirm-button-modal-tc");
            btnConfirm.classList.remove("hidden");
            btnConfirm.addEventListener("click", async () => {
                const res = await fetchingPost(API_OT_URL + "/createsession", body);
                if (res) window.location.href = "/opentrip/addons";
            });
        });
    }
}
