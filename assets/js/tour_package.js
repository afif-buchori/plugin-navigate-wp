const API_TP_URL = "/api/tour-package";
let url_name = window.location.pathname.split("/");
url_name = url_name.filter((item) => item !== "");

if (url_name[0] == "tourpackage" && !url_name[1]) {
  //List Tour
  console.log("List Tour");
} else if (url_name[0] == "tourpackage" && url_name[1] == "addons") {
  //Addons Tour
  console.log("List Tour");
} else if (url_name[0] == "tourpackage" && url_name[1] == "booking") {
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
        window.location.href = res.invoice_url;
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
} else if (url_name[0] == "tourpackage") {
  //Detail Tour
  console.log("Detail Tour");

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
                <label class="flex items-center justify-between gap-4">
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
                        ${el.contents.citites_visited} Cities Visited
                    </span>
                    <p class="font-bold text-xs md:text-sm ml-auto">${
                      el.rate.currency.client_currency.symbol
                    } ${numberFormat(
                el.rate.minimum_price.client_currency,
                el.rate.currency.client_currency.digit
              )}</p>
                </div>
                <p>${el.contents.description}</p>
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
