const API_TP_URL = "/api/tour-package";
const main_url = "tour";
let url_name = window.location.pathname.split("/");
url_name = url_name.filter((item) => item !== "");

if (url_name[0] == main_url && !url_name[1]) {
  //List Tour
  console.log("List Tour");
} else if (url_name[0] == main_url && url_name[1] == "addons") {
  //Addons Tour
  console.log("Addons");

  const formAddons = document.getElementById("form_addons");
  const selectAddons =
    formAddons.querySelectorAll("select[name='qty_addon']") ?? [];
  const addonSelected = document.querySelector(
    "textarea[name='addon_selected']"
  );
  const data_sel_service = document.querySelector("[additional-service-body]");
  const data_total = document.querySelector("[additional-service-total]");
  const dataGrandtotal = document.querySelector("[additional-grandtotal]");
  const totalPriceService = document.querySelector(
    "input[name='total_price_service']"
  );
  const buttonNext = document.querySelector("[button-next-step]");

  selectAddons.forEach((input) => {
    input.addEventListener("change", async () => {
      const dataSession = JSON.parse(addonSelected.value);
      let oldData = dataSession.addon_selected || [];
      const attrDataType = input.dataset.type ?? null;
      const { id, title, price, price_detail } = JSON.parse(
        input.dataset.addonSelect
      );

      oldData = oldData.filter((e) => e.id !== id);
      const qty = parseInt(input.value);
      if (qty > 0)
        oldData.push({
          id,
          name: title,
          qty,
          price: price * qty,
          subQty: null,
        });

      const body = { ...dataSession, addon_selected: oldData };

      const res = await fetchingPost(API_TP_URL + "/generate-tp-session", body);
      if (res) {
        addonSelected.value = JSON.stringify(body);
        const totalPrice = oldData.reduce((sum, item) => sum + item.price, 0);

        if (oldData.length > 0) {
          let selService =
            '<label class="text-primary font-semibold block" for="email">Selected Service:</label><ul class="style-1">';
          oldData.map((item) => {
            selService += "<li>" + item.name + " x" + item.qty + "</li>";
          });
          selService += "</ul>";
          data_sel_service.innerHTML = selService;
          data_total.innerHTML =
            price_detail.currency.symbol +
            " " +
            numberFormat(totalPrice, price_detail.currency.digit);
          dataGrandtotal.innerHTML =
            price_detail.currency.symbol +
            " " +
            numberFormat(
              totalPrice + parseFloat(totalPriceService.value),
              price_detail.currency.digit
            );
          buttonNext.classList.remove("btn-disable");
          buttonNext.removeAttribute("disabled");
        } else {
          data_sel_service.innerHTML =
            '<label class="text-primary font-semibold block">No service selected</label>';
          data_total.innerHTML = "-";
          dataGrandtotal.innerHTML =
            price_detail.currency.symbol +
            " " +
            numberFormat(totalPriceService.value, price_detail.currency.digit);
          buttonNext.classList.add("btn-disable");
          buttonNext.setAttribute("disabled", "");
        }
      }
    });
  });

  formAddons.addEventListener("submit", async function (event) {
    event.preventDefault();
    return (window.location.href = "/tourpackage/booking");
  });

  // function addonSetLoading(state) {
  //   if (state == false && isGetData > 0) return;
  //   const data_sel_service = document.querySelector("[additional-service-body]");
  //   const data_total = document.querySelector("[additional-service-total]");
  //   const loader = document.querySelector("[additional-service-loader]");
  //   const buttonNext = document.querySelector("[button-next-step]");

  //   buttonNext.disabled = state;

  //   if (state) {
  //     data_sel_service.classList.add("hidden");
  //     data_total.classList.add("hidden");
  //     loader.classList.remove("hidden");
  //     buttonNext.classList.add("btn-disable");
  //   } else {
  //     data_sel_service.classList.remove("hidden");
  //     data_total.classList.remove("hidden");
  //     loader.classList.add("hidden");
  //     buttonNext.classList.remove("btn-disable");
  //   }
  // }
} else if (url_name[0] == main_url && url_name[1] == "booking") {
  //Booking Tour
  console.log("Booking Tour");

  const payment_settings =
    document.querySelectorAll("input[name='payment_settings']") ?? [];

  payment_settings.forEach((element) => {
    element.addEventListener("click", function (e) {
      const card_total = document.getElementById("card_total_booking");
      if (e.target.checked) {
        const data_payment = JSON.parse(e.target.value);
        const attr_service_fee = parseFloat(element.dataset.serviceFee);
        const attr_currency = JSON.parse(element.dataset.currency);
        const total = document.getElementById("total_booking");
        const service_fee = document.getElementById("service_fee_booking");
        const total_pay = document.getElementById("total_pay_booking");

        let check_total = data_payment.total_payment;
        let check_service_fee = check_total * attr_service_fee;
        let check_pay = check_total + check_service_fee;
        total.innerHTML =
          attr_currency.symbol +
          " " +
          numberFormat(data_payment.total_payment, attr_currency.digit);
        service_fee.innerHTML =
          attr_currency.symbol +
          " " +
          numberFormat(check_service_fee, attr_currency.digit);
        total_pay.innerHTML =
          attr_currency.symbol +
          " " +
          numberFormat(check_pay, attr_currency.digit);

        card_total.classList.remove("hidden");
      } else {
        card_total.classList.add("hidden");
      }
    });
  });

  const form_booking =
    document.querySelector("#form-booking-tourpackage") ?? null;
  if (form_booking) {
    form_booking.addEventListener("submit", async function (event) {
      event.preventDefault();
      const input_error = document.querySelectorAll(".error-div");
      const payment_error = document.querySelector("#select_payment_error");
      input_error.forEach((element) => (element.innerHTML = ""));

      const form_data = new FormData(form_booking);
      let data = {};
      for (const [key, value] of form_data.entries()) {
        data[key] = value;
      }

      if (!data.payment_settings)
        return payment_error.classList.remove("hidden");
      payment_error.classList.add("hidden");

      const payment_settings = JSON.parse(data.payment_settings);
      const body_booking = {
        code: "",
        firstName: data.first_name,
        lastName: data.last_name,
        email: data.email,
        phone: data.phone,
        codePhone: data.phone_code,
        formPassenger: [
          {
            code: "",
            name: `${data.first_name} ${data.last_name}`,
            remark: data.note,
          },
        ],
        payment: {
          name: payment_settings.title,
          price: payment_settings.total_payment,
        },
      };
      const url_booking = API_TP_URL + "/booking-tp";

      // Fetch
      const res = await fetchingPost(url_booking, body_booking);
      if (res && res.result == "ok") {
        window.location.href = res.data.invoice_url;
      } else if (res && res.result == "no") {
        res.message.forEach((element) => {
          const input =
            document.getElementById(`${element.name}_error`) ?? null;
          if (input) input.innerHTML = element.value;
        });
      } else {
        console.log("Response data is empty or not returned correctly");
      }
      // End Fetch
    });
  }
} else if (url_name[0] == main_url && url_name[1] == "paymentsuccess") {
  console.log("Payment Success");

  const btnPayments = document.querySelectorAll(".generate_payment") ?? [];

  btnPayments.forEach((element) => {
    element.addEventListener("click", async function (e) {
      const payment = JSON.parse(element.dataset.payment);
      const urlGeneratePay = API_TP_URL + "/generate-urlpayment";
      const bodyGeneratePay = { id: payment.id ?? null };
      const res = await fetchingPost(urlGeneratePay, bodyGeneratePay);

      if (res && res.result == "ok") {
        return (window.location.href = res.data.invoice_url);
      } else if (res && res.result == "no") {
        console.log(res);
      } else {
        console.log("Not Found!");
      }
    });
  });
} else if (url_name[0] == main_url) {
  //Detail Tour
  console.log("Detail Tour");
  lucide.createIcons();
  // Function Detail
  const form_detail =
    document.querySelector("#form-package-detail-tourpackage") ?? null;

  if (form_detail) {
    const package_data = form_detail.querySelector(
      "textarea[name='package-data']"
    );
    const input_passengers =
      form_detail.querySelectorAll("input[type='number']") ?? [];
    const date_detail = document.getElementById("tp_date_detail") ?? null;
    const attr_service =
      JSON.parse(date_detail.getAttribute("data-service")) ?? {};
    const url_get_package_detail = API_TP_URL + "/get-package";
    const package_selected = document.querySelector(
      "input[name='package-selected']"
    );
    const loading_select_pac =
      document.getElementById("loading-select-package-detail") ?? null;
    const btn_submit_package =
      document.getElementById("find-package-tourpack") ?? null;

    const errMSgListPackage =
      document.getElementById("error-msg-list-package") ?? null;
    const div_passengers =
      document.querySelector(`#btn-inpt-passanger-detail`) ?? null;
    const btnSlectPackage =
      document.getElementById("btn-open-list-modal-package") ?? null;

    let passengers = {};
    let body_detail = {
      date: date_detail.value,
      ...attr_service,
      adult: 1,
      child: 0,
      infant: 0,
    };

    //FetchPassenger
    let controllerPass;
    async function fetchingPassenger(url, data) {
      if (controllerPass) {
        controllerPass.abort();
      }
      controllerPass = new AbortController();
      const signal = controllerPass.signal;
      const loader_price =
        document.getElementById("loader-total-price-detail") ?? null;
      const total_price = document.getElementById("total-price-detail") ?? null;
      loader_price.classList.remove("hidden");
      total_price.classList.add("hidden");
      btn_submit_package.innerText = "Calculate...";
      btn_submit_package.setAttribute("disabled", "");
      try {
        const result = await fetch(url, {
          method: "POST",
          headers: {
            Accept: "application/json",
            "Content-Type": "application/json",
          },
          body: JSON.stringify(data),
          signal: signal, // Sertakan sinyal untuk aborting
        });
        const res = await result.json();
        btn_submit_package.innerText = "Book Now";
        btn_submit_package.removeAttribute("disabled");
        loader_price.classList.add("hidden");
        total_price.classList.remove("hidden");
        return res;
      } catch (error) {
        if (error.name === "AbortError") {
          console.log("Fetch dibatalkan");
        } else {
          console.log(error);
          btn_submit_package.innerText = "Book Now";
          btn_submit_package.removeAttribute("disabled");
          loader_price.classList.add("hidden");
          total_price.classList.remove("hidden");
        }
        return error;
      }
    }
    // End FetchPassenger

    // Passenger
    input_passengers.forEach((input) => {
      // DATA
      passengers[input.name] = parseInt(input.value);
      body_detail = {
        ...body_detail,
        ...passengers,
      };
      // END DATA

      // Onclick Add
      const incrementButton = input.nextElementSibling;
      incrementButton.addEventListener("click", async function () {
        let currentValue = parseInt(input.value);
        body_detail = {
          ...body_detail,
          [input.name]: currentValue,
        };

        // Fetch
        const res = await fetchingPassenger(
          url_get_package_detail,
          body_detail
        );
        if (res && res.result === "ok") {
          const select_data = res.data.filter(
            (d) => d.travel_period_id == package_selected.value
          );
          if (select_data.length > 0) changeMinTol(select_data);
          package_data.value = JSON.stringify(res.data);
        } else {
          console.log("Response data is empty or not returned correctly");
        }
        // End Fetch
      });
      // End Onclick Add

      // Onclick Min
      const decrementButton = input.previousElementSibling;
      decrementButton.addEventListener("click", async function () {
        let currentValue = parseInt(input.value);
        body_detail = {
          ...body_detail,
          [input.name]: currentValue,
        };

        // Fetch
        const res = await fetchingPassenger(
          url_get_package_detail,
          body_detail
        );
        if (res && res.result === "ok") {
          const select_data = res.data.filter(
            (d) => d.travel_period_id == package_selected.value
          );
          if (select_data.length > 0) changeMinTol(select_data);
          package_data.value = JSON.stringify(res.data);
        } else {
          console.log("Response data is empty or not returned correctly");
        }
        // Fetch
      });
      // End Onclick Min
    });
    // End Passenger

    // Date
    date_detail.addEventListener("change", async function (e) {
      const btn_slct_package = document.querySelector(
        "#btn-slc-package-detail"
      );

      body_detail = {
        ...body_detail,
        date: e.target.value,
        ...passengers,
      };

      // Fetch Date
      loading_select_pac.classList.remove("hidden");
      btn_slct_package.classList.add("hidden");
      errMSgListPackage.innerText = "";
      div_passengers.classList.add("hidden");
      const res = await fetchingPost(url_get_package_detail, body_detail);
      if (res && res.result === "ok") {
        package_data.value = JSON.stringify(res.data);
        btn_slct_package.classList.remove("hidden");
        loading_select_pac.classList.add("hidden");
        if (package_selected.value != "")
          div_passengers.classList.remove("hidden");
      } else {
        btn_slct_package.classList.add("hidden");
        console.log("Response data is empty or not returned correctly");
        loading_select_pac.classList.add("hidden");
        div_passengers.classList.add("hidden");
        package_selected.value = "";
        btnSlectPackage.innerText = "Select Package";
        errMSgListPackage.innerText =
          "Date Not Available. You can try another date.";

        input_passengers.forEach((input) => {
          if (input.name == "adult") {
            input.value = 1;
          } else {
            input.value = 0;
          }
        });
      }
      // End Fetch Date
    });
    // End Date

    // Modal List Package
    const modalListPackage =
      document.getElementById("modal-list-tour-package") ?? null;
    if (btnSlectPackage) {
      btnSlectPackage.addEventListener("click", function () {
        const package_data =
          form_detail.querySelector("textarea[name='package-data']") ?? null;
        const btnClose = document.getElementById(
          "close-modal-list-tourpackage"
        );
        const content = document.getElementById("detail-content") ?? null;

        let data = [];
        if (package_data) data = JSON.parse(package_data.value);

        if (content && data.length > 0) {
          const content_data = data
            .map(
              (el) => `
            <div class="mt-5">
                <label class="flex items-center justify-between gap-4 cursor-pointer">
                    <input type="radio" hidden id="${
                      el.travel_period_id
                    }" value="${
                el.travel_period_id
              }" name="list-package-detail" ${
                package_selected.value == el.travel_period_id ? "checked" : ""
              }>
                    <p class="font-bold">${el.contents.title}</p>
                    <div style="width: 20px; height: 20px;" class="border-2 border-primary rounded-md relative">
                      <span class="iconify checked-icon absolute top-0 left-0" data-icon="mingcute:check-fill" data-width="16" data-height="16"></span>
                    </div>
                </label>
                <div class="flex gap-2 mt-4">
                    <span style="background-color: #BBE9FF60;"
                        class="px-2 border border-primary rounded-full text-xs md:text-sm">
                        ${el.contents.duration} Days
                    </span>
                    <span style="background-color: #BBE9FF60;"
                        class="px-2 border border-primary rounded-full text-xs md:text-sm">
                        ${el.contents.cities_visited} Cities Visited
                    </span>
                    <p class="font-bold text-xs md:text-sm ml-auto">${
                      el.rate.currency.client_currency.symbol
                    } ${numberFormat(
                el.rate.minimum_price.client_currency,
                el.rate.currency.client_currency.digit
              )}</p>
                </div>
                <p class="line-clamp-4">${el.contents.description}</p>
            </div>
          `
            )
            .join(" ");
          //   const content_data = `
          //   <div>
          //     <ul>
          //       ${data
          //         .map(
          //           (element) => `
          //         <li>
          //           <input type="radio" id="${element.travel_period_id}" value="${element.travel_period_id}" name="list-package-detail" ${package_selected.value == element.travel_period_id ? "checked" : ""}>
          //           <label for="${element.travel_period_id}">${element.contents.title}</label>
          //         </li>
          //       `
          //         )
          //         .join("")}
          //     </ul>
          //   </div>
          // `;

          content.innerHTML = content_data;
        }

        // Funct List
        const list_datas =
          document.querySelectorAll("input[name='list-package-detail']") ?? [];
        list_datas.forEach((element) => {
          element.addEventListener("click", function (e) {
            if (e.target.checked) {
              package_selected.value = e.target.value;
              const select_data = data.filter(
                (d) => d.travel_period_id == package_selected.value
              );

              if (select_data.length > 0) {
                Object.entries(passengers).forEach(([key, value]) => {
                  if (key != "adult") {
                    if (
                      select_data[0].rate.with_child_rate ||
                      select_data[0].rate.with_infant_rate
                    ) {
                      const div_passenger = document.querySelector(
                        `#div-qtydetail-${key}`
                      );
                      if (div_passenger.classList.contains("hidden"))
                        div_passenger.classList.remove("hidden");
                    } else {
                      input_passengers.forEach((input) => {
                        if (input.name == key) {
                          input.value = 0;
                        }
                      });
                      document
                        .querySelector(`#div-qtydetail-${key}`)
                        .classList.add("hidden");
                    }
                  } else {
                    if (div_passengers.classList.contains("hidden"))
                      div_passengers.classList.remove("hidden");
                  }
                });
                changeMinTol(select_data);
                // const curr = select_data[0].rate.currency.client_currency;
                // minimum_price.innerHTML = `${curr.symbol} ${numberFormat(select_data[0].rate.minimum_price.client_currency, curr.digit)}`;
                // total_price.innerHTML = `${curr.symbol} ${numberFormat(select_data[0].rate.total.client_currency, curr.digit)}`;
                btnSlectPackage.innerText = select_data[0].contents.title;
                // modalListPackage.style.display = "none";
                const detailDescription = document.getElementById(
                  "detail-tp-description"
                );
                const detailDuration =
                  document.getElementById("detail-tp-duration");
                const detailCitiesVisited = document.getElementById(
                  "detail-tp-cities-visited"
                );
                const detailTitlePackage = document.getElementById(
                  "detail-tp-title-package"
                );
                const detailItinerary = document.getElementById(
                  "detail-tp-itinerary"
                );
                detailCitiesVisited.innerText =
                  select_data[0].contents.cities_visited + " Cities Visited";
                detailDescription.innerText =
                  select_data[0].contents.description;
                detailDuration.innerText =
                  select_data[0].contents.duration + " Days";
                detailTitlePackage.innerText = `(${select_data[0].contents.title})`;
                // detailItinerary.innerHTML = generateItin(
                //   select_data[0].contents.itinerary
                // );
                generateItin(select_data[0].contents.itinerary);

                // Includes
                const includes = select_data[0].contents.include ?? [];
                const elementIncludes =
                  document.getElementById("content_includes");
                elementIncludes.innerHTML = "";
                includes.forEach((value) => {
                  elementIncludes.innerHTML += generateIncludeExcludes(
                    "text-green-success",
                    "akar-icons:circle-check",
                    value,
                    "margin-top: 0.125rem"
                  );
                });
                // End Includes

                // Includes
                const exludes = select_data[0].contents.include ?? [];
                const elementExcludes =
                  document.getElementById("content_includes");
                elementExcludes.innerHTML = "";
                exludes.forEach((value) => {
                  elementExcludes.innerHTML += generateIncludeExcludes(
                    "text-red-error",
                    "radix-icons:cross-circled",
                    value,
                    "margin-top: 0.12rem"
                  );
                });
                // End Includes
              }
            }
          });
        });
        // End Func List

        modalListPackage.style.display = "flex";
        btnClose.addEventListener(
          "click",
          () => (modalListPackage.style.display = "none")
        );
        const btnSubmitPackage =
          document.getElementById("btn-submit-select-package") ?? null;
        btnSubmitPackage.addEventListener("click", function () {
          modalListPackage.style.display = "none";
        });
      });
    }
    // End Modal List Package

    // Submit
    form_detail.addEventListener("submit", async function (event) {
      event.preventDefault();
      const package_data =
        form_detail.querySelector("textarea[name='package-data']") ?? null;

      let data = [];
      if (package_data) data = JSON.parse(package_data.value);
      const select_data = data.filter(
        (d) => d.travel_period_id == package_selected.value
      );

      const { date, adult, child, infant } = body_detail;
      const body_form_detail = {
        id: package_selected.value,
        date,
        adult,
        child,
        infant,
      };
      const url_post_session = API_TP_URL + "/generate-tp-session";
      const res = await fetchingPost(url_post_session, body_form_detail);
      if (res && select_data.length > 0) {
        if (select_data[0].addons > 0) {
          window.location.href = "/tourpackage/addons";
        } else {
          window.location.href = "/tourpackage/booking";
        }
      }
    });
    // End Submit
  }

  // Modal Term & Conditions
  const modalTCdetail =
    document.getElementById("modal-term-condition-tourpackage") ?? null;
  const btnOpenModalTCdetail =
    document.getElementById("btn-open-modal-tc-detail") ?? null;
  if (btnOpenModalTCdetail) {
    btnOpenModalTCdetail.addEventListener("click", function () {
      const btnClose = document.getElementById(
        "close-modal-term-condition-tourpackage"
      );
      modalTCdetail.style.display = "grid";
      btnClose.addEventListener(
        "click",
        () => (modalTCdetail.style.display = "none")
      );
    });
  }
  // END Modal Term & Conditions

  // Func Change Minimum & Total
  function changeMinTol(select_data) {
    const minimum_price = document.getElementById("min-price-detail");
    const total_price = document.getElementById("total-price-detail");
    const curr = select_data[0].rate.currency.client_currency;
    minimum_price.innerHTML = `${curr.symbol} ${numberFormat(
      select_data[0].rate.minimum_price.client_currency,
      curr.digit
    )}`;
    total_price.innerHTML = `${curr.symbol} ${numberFormat(
      select_data[0].rate.total.client_currency,
      curr.digit
    )}`;
  }
  // End Func Change Minimum & Total
  // End Function Detail

  // GENERATE ITINERARY
  function generateItin(itinerary = []) {
    let container = document.getElementById("detail-tp-itinerary");
    let n = 0;
    container.innerHTML = "";

    itinerary.forEach((item, key) => {
      const hr = key > 0 ? "<hr />" : "";
      const isLast = key === itinerary.length - 1;

      const itineraryHtml = `
        ${hr}
        <div class="md:grid grid-cols-12 md:space-x-4 relative ${
          isLast ? "smt-4" : key > 0 ? "smy-4" : "smb-4"
        }">
          <div class="col-span-12 py-5">
            ${
              itinerary.length > 1
                ? `
            <span class="absolute left-45px md:left-55px"
              style="border-left: solid 2px #BBE9FF !important; position: absolute; top: 0px; left: 58px; 
              height: ${
                isLast ? "30px" : key === 0 ? "calc(100% - 30px)" : "100%"
              }; 
              top: ${key === 0 ? "30px" : "0px"};">
            </span>`
                : ""
            }
            
            <div class="flex items-center justify-between cursor-pointer" data-x-bind="trigger(${n})">
              <div class="flex gap-2 text-xs md:text-base">
                <strong style="opacity: 0.6;" class="whitespace-nowrap">Day ${
                  key + 1
                }</strong>
                <span class="mt-0.5 md:mt-1.5"
                  style="width: 12px; height: 12px; border-radius: 99px; background-color: #BBE9FF;"></span>
                <strong class="flex-1">${item.title}</strong>
              </div>
              <span class="iconify -mt-1 transition-all duration-500 inline"
                data-icon="fluent:chevron-down-12-regular" data-width="20" data-height="20"
                data-x-bind="iconStyle(${n})">
              </span>
            </div>
            
            <div class="relative overflow-hidden transition-all max-h-0 duration-700 inner-text-sm ml-14 md:ml-72px mt-2" 
              data-x-ref="container-${n}" data-x-bind="containerStyle(${n})">
              <span>${item.description}</span>
              ${
                item.with_add_info
                  ? item.add_info
                      .map(
                        (info, index) => `
                <div class="flex gap-2 ${index === 0 ? "mt-4" : ""}">
                  ${getIconHtml(info.icon)}
                  <p>${info.description}</p>
                </div>`
                      )
                      .join("")
                  : ""
              }
            </div>
          </div>
        </div>
      `;
      container.innerHTML += itineraryHtml;
      n++;
    });
  }

  function getIconHtml(icon) {
    const icons = {
      utensils:
        '<span class="iconify mt-1 inline" data-icon="fa6-solid:utensils" data-width="16" data-height="16"></span>',
      plane:
        '<span class="iconify mt-1 inline" data-icon="ri:plane-fill" data-width="16" data-height="16"></span>',
    };
    return icons[icon] || "";
  }
  // END GENERATE ITINERARY

  function generateIncludeExcludes(classdiv, icon, content, style) {
    const template = `
        <div class="text-sm md:text-base flex gap-2">
            <span class="iconify inline-block ${classdiv}"
                data-icon="${icon}" data-width="20" data-height="20"
                style="${style}">
            </span>
            <p class="flex-1">${content}</p>
        </div>`;
    return template;
  }
}

// total-price-detail
// min-price-detail
// Fetch Post
// async function fetchingPost(url, data) {
//   try {
//     const result = await fetch(url, {
//       method: "POST",
//       headers: {
//         Accept: "application/json",
//         "Content-Type": "application/json",
//       },
//       body: JSON.stringify(data),
//     });
//     const res = await result.json();
//     return res;
//   } catch (error) {
//     console.log(error);
//     return error;
//   }
// }
let controller;
async function fetchingPost(url, data) {
  if (controller) {
    controller.abort();
  }
  controller = new AbortController();
  const signal = controller.signal;
  try {
    const result = await fetch(url, {
      method: "POST",
      headers: {
        Accept: "application/json",
        "Content-Type": "application/json",
      },
      body: JSON.stringify(data),
      signal: signal,
    });
    const res = await result.json();
    return res;
  } catch (error) {
    if (error.name === "AbortError") {
      console.log("Fetch dibatalkan");
    } else {
      console.log("Err fetch", error);
    }
    return error;
  }
}
// End Fetch Post
