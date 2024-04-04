"use strict";

const API_URL = "/api/fasttrack";
var i = 0;

var timeCalculate;
var isGetData = 0;
const timeout = 1000;

const ft_change = () => {
  const form = document.querySelector("form[data-id]#formbooks1");
  if (!form) return;
  const sid = document
    .querySelector("form[data-id]#formbooks1")
    .getAttribute("data-id");
  const action_container = document.querySelector("[action-container]");
  const display_error = document.querySelector("[display-error]");
  const data_total = document.querySelector("[data-total]");
  const date = document.querySelector('#formbooks1 input[name="date"]').value;
  const adult = document.querySelector('#formbooks1 input[name="adult"]').value;
  const child = document.querySelector('#formbooks1 input[name="child"]').value;
  const infant = document.querySelector(
    '#formbooks1 input[name="infant"]'
  ).value;
  const location = document.querySelector(
    '#formbooks1 select[name="location"]'
  )?.value;
  action_container.classList.remove("is-invalid");
  display_error.innerHTML = "";
  setLoading(true);
  if (
    !date ||
    (document.querySelector('#formbooks1 select[name="location"]') !=
      undefined &&
      location == "")
  ) {
    data_total.innerHTML = "-";
    setLoading(false);
    return;
  }

  clearTimeout(timeCalculate);
  timeCalculate = setTimeout(async () => {
    isGetData++;
    await fetch(API_URL + "/get-rate" + createParams(), {
      method: "POST",
      headers: {
        Accept: "application/json",
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        sid: sid,
        date: date,
        adult: adult,
        child: child,
        infant: infant,
        location: location,
      }),
    })
      .then(async (res) => {
        return await res.json();
      })
      .then((data) => {
        isGetData--;

        var res = data;
        if (res.error) {
          if (res.type == "VALIDATION") {
            action_container.classList.add("is-invalid");
            display_error.innerHTML = res.message;
          }
          data_total.innerHTML = "-";

          setLoading(false);

          let btn_submit = document.querySelector(
            `form#formbooks1 button[btn-submit]`
          );
          btn_submit.disabled = true;
          btn_submit.classList.add("btn-disable");
          return;
        }

        data_total.innerHTML =
          res.currency.symbol + numberFormat(res.total, res.currency.digit);
        const input_total = document.querySelector("[name='total']");
        input_total.value = res.total;
        setLoading(false);
      });
  }, timeout);
};

function setLoading(state) {
  if (state == false && isGetData > 0) return;
  const btn_submit = document.querySelector(
    `form#formbooks1 button[btn-submit]`
  );
  const loader = document.querySelector(`[loader]`);
  const total_container = document.querySelector(`[data-total-container]`);
  btn_submit.disabled = state;
  if (state) {
    btn_submit.classList.add("btn-disable");
    loader.classList.remove("hidden");
    total_container.classList.add("hidden");
  } else {
    btn_submit.classList.remove("btn-disable");
    loader.classList.add("hidden");
    total_container.classList.remove("hidden");
  }
  // const all_button = document.querySelectorAll(`form#formbooks1 button`);
  // all_button.forEach((btn) => {
  //   btn.disabled = state;
  //   if (state) btn.classList.add("btn-disable");
  //   else btn.classList.remove("btn-disable");
  // });

  // const all_input = document.querySelectorAll(`form#formbooks1 input`);
  // all_input.forEach((input) => {
  //   input.disabled = state;
  // });
}

const bookStep1 = () => {};

const decrement = (e) => {
  e.preventDefault();
  const btn = e.target.parentNode.parentElement.querySelector(
    'button[data-action="decrement"]'
  );
  const target = btn.nextElementSibling;
  const min = target.getAttribute("min");
  let value = Number(target.value);
  value--;
  if (value < min) value = min;
  target.value = value;
  ft_change();
};

const increment = (e) => {
  e.preventDefault();
  const btn = e.target.parentNode.parentElement.querySelector(
    'button[data-action="decrement"]'
  );
  const target = btn.nextElementSibling;
  const max = target.getAttribute("max");
  let value = Number(target.value);
  value++;
  if (value > max) value = max;
  target.value = value;
  ft_change();
};

const iAgree = document.querySelectorAll(`[iAgree]`);

iAgree.forEach((btn) => {
  btn.addEventListener("change", function (e) {
    e.preventDefault();
    var elBtn = document.querySelector(`[iAgree-button]`);
    if (e.target.checked) {
      elBtn.disabled = false;
      elBtn.classList.remove("btn-disable");
    } else {
      elBtn.disabled = true;
      elBtn.classList.add("btn-disable");
    }
  });
});

const decrementButtons = document.querySelectorAll(
  `button[data-action="decrement"]`
);

const incrementButtons = document.querySelectorAll(
  `button[data-action="increment"]`
);

const fasttrack_button = document.querySelectorAll(
  `button[data-action-ft="next-s1-ft"]`
);

const fasttrack_calculate = document.querySelectorAll(
  `[data-action-ft="onchange-calculate"]`
);

fasttrack_button.forEach((btn) => {
  btn.addEventListener("click", bookStep1);
});

fasttrack_calculate.forEach((element) => {
  element.addEventListener("change", ft_change);
});

decrementButtons.forEach((btn) => {
  btn.addEventListener("click", decrement);
});

incrementButtons.forEach((btn) => {
  btn.addEventListener("click", increment);
});

const buttonSelectAddon = document.querySelectorAll(
  `#page-addon button[data-select-key][select-multiple]`
);

buttonSelectAddon.forEach((btn) => {
  btn.addEventListener("click", buttonSelectHandle);
});

const buttonRemoveAddon = document.querySelectorAll(
  `#page-addon button[data-remove-key][select-multiple]`
);

buttonRemoveAddon.forEach((btn) => {
  btn.addEventListener("click", buttonRemoveHandle);
});

function buttonSelectHandle(e) {
  e.preventDefault();
  var key = e.target.getAttribute("data-select-key");
  var elBtn = document.querySelector(
    `#page-addon div[data-btn-key="` + key + `"]`
  );
  elBtn.classList.add("hidden");
  var elInput = document.querySelector(
    `#page-addon div[data-input-key="` + key + `"]`
  );
  elInput.classList.remove("hidden");

  var elSelect = document.querySelector(
    `#page-addon input[type="checkbox"][name="select_` + key + `"]`
  );
  elSelect.checked = true;
  selectAddonChangeHandler();
}

function buttonRemoveHandle(e) {
  e.preventDefault();
  var key = e.target.getAttribute("data-remove-key");
  var elBtn = document.querySelector(
    `#page-addon div[data-btn-key="` + key + `"]`
  );
  elBtn.classList.remove("hidden");
  var elInput = document.querySelector(
    `#page-addon div[data-input-key="` + key + `"]`
  );
  elInput.classList.add("hidden");

  var elSelect = document.querySelector(
    `#page-addon input[type="checkbox"][name="select_` + key + `"]`
  );
  elSelect.checked = false;

  selectAddonChangeHandler();
}

const buttonSelectOneAddon = document.querySelectorAll(
  `#page-addon button[data-select-key][select-one]`
);

buttonSelectOneAddon.forEach((btn) => {
  btn.addEventListener("click", buttonSelectOneHandle);
});

const buttonRemoveOneAddon = document.querySelectorAll(
  `#page-addon button[data-remove-key][select-one]`
);

buttonRemoveOneAddon.forEach((btn) => {
  btn.addEventListener("click", buttonRemoveOneHandle);
});

function selectOneDefault(addonKey) {
  var elButton = document.querySelectorAll(
    `#page-addon div[data-btn-key][data-addon-key="` + addonKey + `"]`
  );
  elButton.forEach((el) => {
    el.classList.remove("hidden");
  });
  var elInput = document.querySelectorAll(
    `#page-addon div[data-input-key][data-addon-key="` + addonKey + `"]`
  );
  elInput.forEach((el) => {
    el.classList.add("hidden");
  });
}

function buttonSelectOneHandle(e) {
  e.preventDefault();
  var key = e.target.getAttribute("data-select-key");
  var addonKey = e.target.getAttribute("data-addon-key");
  var radio = document.querySelector(
    `#page-addon input[type="radio"][value="` + key + `"]`
  );
  radio.checked = true;
  selectOneDefault(addonKey);
  var elBtn = document.querySelector(
    `#page-addon div[data-btn-key="` + key + `"]`
  );
  elBtn.classList.add("hidden");
  var elInput = document.querySelector(
    `#page-addon div[data-input-key="` + key + `"]`
  );
  elInput.classList.remove("hidden");
  selectAddonChangeHandler();
}

function buttonRemoveOneHandle(e) {
  e.preventDefault();
  var key = e.target.getAttribute("data-remove-key");
  var addonKey = e.target.getAttribute("data-addon-key");
  var radio = document.querySelector(
    `#page-addon input[type="radio"][name="addon_` +
      addonKey +
      `"][value="notset"]`
  );
  radio.checked = true;
  var elBtn = document.querySelector(
    `#page-addon div[data-btn-key="` + key + `"]`
  );
  elBtn.classList.remove("hidden");
  var elInput = document.querySelector(
    `#page-addon div[data-input-key="` + key + `"]`
  );
  elInput.classList.add("hidden");
  selectAddonChangeHandler();
}

document
  .querySelectorAll(`#page-addon #addon-form select[data-addon-select]`)
  .forEach((input) => {
    input.addEventListener("change", selectAddonChangeHandler);
  });

function selectAddonChangeHandler() {
  let sid = getData(document.querySelector("#addon-form"), "sid");
  let date = getData(document.querySelector("#addon-form"), "date");

  let addonContainer = document.querySelectorAll(
    `#page-addon [data-addon-container]`
  );

  var gTotal = 0;
  var selectAddons = [];

  addonContainer.forEach((el) => {
    let dataId = getAttribute(el, "data-addon-container");
    let dataParentId = getAttribute(el, "data-addon-container-parent");
    let rateType = getAttribute(el, "data-rate-type");
    let selectMode = getAttribute(el, "data-addon-select-mode");
    let qtyType = getAttribute(el, "data-addon-qty-type");
    let addonType = getAttribute(el, "data-addon-type");

    if (selectMode == "MULTIPLE" && qtyType == "SAME_AS_PRIMARY") {
      let elcheck = document.querySelector(
        '#page-addon [name="select_' + dataId + '"]'
      );
      if (elcheck && elcheck.checked) {
        let adult = getData(elcheck, "adult");
        let child = getData(elcheck, "child");
        let infant = getData(elcheck, "infant");

        let addData = {
          addonType: addonType,
          rateType: rateType,
          selectMode: selectMode,
          dataId: dataId,
          qtyType: qtyType,
          adult: adult,
          child: child,
          infant: infant,
        };

        selectAddons = [...selectAddons, addData];
      }
    } else if (
      (selectMode == "MULTIPLE" && qtyType == "FIXED") ||
      (selectMode == "MULTIPLE" && qtyType == "CUSTOM" && rateType == "FIXED")
    ) {
      let qty = getElementWithName("qty_" + dataId);
      if (qty.value > 0) {
        let addData = {
          addonType: addonType,
          rateType: rateType,
          selectMode: selectMode,
          dataId: dataId,
          qtyType: qtyType,
          qty: qty.value,
        };

        selectAddons = [...selectAddons, addData];
      }
    } else if (
      selectMode == "MULTIPLE" &&
      qtyType == "CUSTOM" &&
      rateType == "MULTIPLE"
    ) {
      let adult = getElementWithName("adult_" + dataId);
      let child = getElementWithName("child_" + dataId);
      let infant = getElementWithName("infant_" + dataId);
      if (!(adult.value <= 0 && child.value <= 0 && infant.value <= 0)) {
        let addData = {
          addonType: addonType,
          rateType: rateType,
          selectMode: selectMode,
          dataId: dataId,
          qtyType: qtyType,
          adult: adult.value,
          child: child.value,
          infant: infant.value,
        };

        selectAddons = [...selectAddons, addData];
      }
    }

    if (selectMode == "ONE") {
      let elradio = document.querySelector(
        '#page-addon [name="addon_' + dataParentId + '"]:checked'
      );
      if (elradio && elradio.value == dataId) {
        //Start from
        if (qtyType == "SAME_AS_PRIMARY") {
          let divData = document.querySelector(
            '#page-addon div[data-addon-select="' + dataId + '"]'
          );
          let adult = getData(divData, "adult");
          let child = getData(divData, "child");
          let infant = getData(divData, "infant");

          let addData = {
            addonType: addonType,
            rateType: rateType,
            selectMode: selectMode,
            dataId: dataId,
            qtyType: qtyType,
            adult: adult,
            child: child,
            infant: infant,
          };

          selectAddons = [...selectAddons, addData];
        } else if (
          qtyType == "FIXED" ||
          (qtyType == "CUSTOM" && rateType == "FIXED")
        ) {
          let qty = getElementWithName("qty_" + dataId);
          if (qty.value > 0) {
            let addData = {
              addonType: addonType,
              rateType: rateType,
              selectMode: selectMode,
              dataId: dataId,
              qtyType: qtyType,
              qty: qty.value,
            };

            selectAddons = [...selectAddons, addData];
          }
        } else if (qtyType == "CUSTOM" && rateType == "MULTIPLE") {
          let adult = getElementWithName("adult_" + dataId);
          let child = getElementWithName("child_" + dataId);
          let infant = getElementWithName("infant_" + dataId);
          if (!(adult.value <= 0 && child.value <= 0 && infant.value <= 0)) {
            let addData = {
              addonType: addonType,
              rateType: rateType,
              selectMode: selectMode,
              dataId: dataId,
              qtyType: qtyType,
              adult: adult.value,
              child: child.value,
              infant: infant.value,
            };

            selectAddons = [...selectAddons, addData];
          }
        }
      }
    }
  });
  if (selectAddons.length > 0) {
    let formData = {
      serviceId: sid,
      date: date,
      addons: selectAddons,
    };
    const inputSelectedServices = document.querySelector(
      "[input-selected-services]"
    );
    inputSelectedServices.value = JSON.stringify(selectAddons);
    getAddonsRate(formData);
  } else {
    const data_sel_service = document.querySelector(
      "[additional-service-body]"
    );
    const inputSelectedServices = document.querySelector(
      "[input-selected-services]"
    );
    const data_total = document.querySelector("[additional-service-total]");
    inputSelectedServices.value = "";
    data_sel_service.innerHTML =
      '<label class="text-primary font-semibold block" for="email">No service selected</label>';
    data_total.innerHTML = "Total: -";
  }
  // console.log(formData);
  // alert(target.value + " " + dataId);
}

function getAddonsRate(data) {
  var timeCalculate;
  var isGetData = 0;

  addonSetLoading(true);
  clearTimeout(timeCalculate);
  timeCalculate = setTimeout(async () => {
    isGetData++;
    await fetch(API_URL + "/get-rate-addon" + createParams(), {
      method: "POST",
      headers: {
        Accept: "application/json",
        "Content-Type": "application/json",
      },
      body: JSON.stringify(data),
    })
      .then(async (res) => {
        isGetData--;
        return await res.json();
      })
      .then((data) => {
        var res = data;
        if (res.error) {
          data_total.innerHTML = "-";
          addonSetLoading(false);
          return;
        }

        const data_sel_service = document.querySelector(
          "[additional-service-body]"
        );
        const data_total = document.querySelector("[additional-service-total]");
        let selService =
          '<label class="text-primary font-semibold block" for="email">Selected Service:</label><ul class="style-1">';
        res.services.map((item) => {
          selService += "<li>" + item.title + "</li>";
        });
        selService += "</ul>";
        data_sel_service.innerHTML = selService;
        data_total.innerHTML =
          "Total: " +
          res.currency.symbol +
          numberFormat(res.total, res.currency.digit);
        // const input_total = document.querySelector("[name='total']");
        // input_total.value = res.total;
        addonSetLoading(false);
      });
  }, timeout);
}

function addonSetLoading(state) {
  if (state == false && isGetData > 0) return;
  const data_sel_service = document.querySelector("[additional-service-body]");
  const data_total = document.querySelector("[additional-service-total]");
  const loader = document.querySelector("[additional-service-loader]");
  const buttonNext = document.querySelector("[button-next-step]");

  buttonNext.disabled = state;

  if (state) {
    data_sel_service.classList.add("hidden");
    data_total.classList.add("hidden");
    loader.classList.remove("hidden");
    buttonNext.classList.add("btn-disable");
  } else {
    data_sel_service.classList.remove("hidden");
    data_total.classList.remove("hidden");
    loader.classList.add("hidden");
    buttonNext.classList.remove("btn-disable");
  }
}
document
  .querySelectorAll(`#page-fasttrack #checkout-form select[airline-select]`)
  .forEach((input) => {
    input.addEventListener("change", selectAirlineCheckoutChangeHandler);
  });

function selectAirlineCheckoutChangeHandler(e) {
  const flightType = e.target.getAttribute("airline-select");
  const airline_code = e.target
    .querySelector("option:checked")
    .getAttribute("data-code");
  const updateTarget = document.querySelector("span[code-" + flightType + "]");
  const updateTargetInput = document.querySelector(
    "input[code-" + flightType + "]"
  );
  updateTarget.innerHTML = airline_code;
  updateTargetInput.value = airline_code;
}

document
  .querySelectorAll(`#page-fasttrack #checkout-form select[select-phone-code]`)
  .forEach((input) => {
    input.addEventListener("change", selectPhoneCodeCheckoutChangeHandler);
  });

function selectPhoneCodeCheckoutChangeHandler(e) {
  const showElement = e.target.getAttribute("select-phone-code");
  const phone_code = e.target.querySelector("option:checked");
  const updateTarget = document.getElementById(showElement);
  updateTarget.innerHTML = "+" + phone_code.value;
}

document.querySelectorAll(`input[image-browser]`).forEach((input) => {
  input.addEventListener("change", previewImage);
});
document.querySelectorAll(`[image-preview]`).forEach((input) => {
  input.addEventListener("click", openDialogImage);
});

document.querySelectorAll(`button[image-upload]`).forEach((input) => {
  input.addEventListener("click", documentUpload);
});
function documentUpload(e) {
  var data = new FormData();
  const elementBrowser = e.target.previousElementSibling;
  const elementPreview = elementBrowser.previousElementSibling;
  const uid = elementBrowser.getAttribute("data-uid");
  const type = elementBrowser.getAttribute("data-type");
  const sid = document.getElementById("sid").value;
  data.append("file", elementBrowser.files[0]);
  data.append("type", type);
  data.append("uid", uid);
  data.append("sid", sid);

  uploadIsLoading(e.target, elementBrowser);
  fetch(API_URL + "/upload-documents?service=" + sid, {
    method: "POST",
    body: data,
  })
    .then(async (res) => {
      if (res.ok) return await res.json();
      throw new Error("Something went wrong");
    })
    .then((res) => {
      if (res.status == "success") {
        //success
        let successSpan =
          '<span class="bg-primary uppercase font-base rounded px-3 py-5 my-5 text-white text-xs md:text-sm tracking-widest inline-block">Document has been uploaded.</span>';
        e.target.parentElement.innerHTML = successSpan;
      } else {
        //failed
        uploadNotLoading(e.target, elementBrowser, true);
      }
    })
    .catch((err) => {
      //failed
      uploadNotLoading(e.target, elementBrowser, true);
    });
}
function openDialogImage(e) {
  const elementInput = e.target.nextElementSibling;
  elementInput.click();
}
function previewImage(e) {
  const [file] = e.target.files;
  const elementPreview = e.target.previousElementSibling;
  const elementButton = e.target.nextElementSibling;
  if (file) {
    elementPreview.style.backgroundImage =
      "url(" + URL.createObjectURL(file) + ")";
    elementButton.classList.remove("hidden");
  }
}
function uploadIsLoading(button, browser) {
  button.disabled = true;
  button.classList.add("btn-disable");
  button.nextElementSibling.classList.add("hidden");
  button.parentElement.querySelector("i").classList.remove("hidden");
  browser.disabled = true;
}
function uploadNotLoading(button, browser, error = false) {
  button.disabled = false;
  button.classList.remove("btn-disable");
  button.parentElement.querySelector("i").classList.add("hidden");
  browser.disabled = false;
  if (error) button.nextElementSibling.classList.remove("hidden");
}

jQuery(document).ready(function ($) {
  $("#phone_code_select2").select2();

  $("#airline_arrival").select2();
  var codeAirlineArrival = $("#airline_arrival")
    .find("option:selected")
    .data("code");
  $("#label-arrival-for-code").html(codeAirlineArrival || "---");
  $("#airline_arrival").on("change", function () {
    const selectedOption = $(this).find("option:selected");
    const code = selectedOption.data("code");
    const val = code || "---";
    $("#label-arrival-for-code").html(val);
  });

  $("#airline_departure_select2").select2();
  var codeAirlineDeparture = $("#airline_departure_select2")
    .find("option:selected")
    .data("code");
  $("#label-departure-for-code").html(codeAirlineDeparture || "---");
  $("#airline_departure_select2").on("change", function () {
    const selectedOption = $(this).find("option:selected");
    const code = selectedOption.data("code");
    const val = code || "---";
    $("#label-departure-for-code").html(val);
  });

  $("#country_select2").select2();
  $("#country_select2").on("change", function () {
    const selectedOption = $(this).find("option:selected");
    const code = selectedOption.data("code");
    const codephone = "+" + code;
    if ($("#phone_code_label").html() !== "-Code-") return;
    $("#phone_code_label").html(codephone);
    $("#phone_code_select2").val(code);
  });

  $('label[for="phone_code_select2"]').on("click", function () {
    $("#phone_code_select2").select2("open");
  });

  $("#phone_code_select2").on("change", function (e) {
    const val = e.target.value === "" ? "--Code--" : "+" + e.target.value;
    $("#phone_code_label").html(val);
  });

  var lastName = $("#firstname").val();
  var firstName = $("#lastname").val();
  $("#firstname").on("keyup", function () {
    firstName = $("#firstname").val();
    var fullName = firstName + " " + lastName;
    $("#adult_name_0").val(fullName);
  });
  $("#lastname").on("keyup", function () {
    lastName = $("#lastname").val();
    var fullName = firstName + " " + lastName;
    $("#adult_name_0").val(fullName);
  });

  $("#the-guest-book").change(function () {
    if ($("#the-guest-book").is(":checked")) {
      $("#adult_name_0").prop("readonly", true);
      var fullName = firstName + " " + lastName;
      $("#adult_name_0").val(fullName);
    } else {
      $("#adult_name_0").prop("readonly", false);
      $("#adult_name_0").val("");
    }
  });

  $("#submit-booking").on("click", function () {
    $("#loading-654").css("display", "flex");
  });
});

// GET ORDER
const getStatusOrder = async (id, count = 0) => {
  try {
    const result = await fetch(API_URL + "/get-status", {
      method: "POST",
      headers: {
        Accept: "application/json",
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ order: id }),
    });
    const res = await result.json();
    console.log(res);
    if (res.status === "UNPAID" && count < 3) {
      setTimeout(() => getStatusOrder(id, count + 1), 2000);
    } else if (res.status === "PROCESS") {
      setTimeout(() => getStatusOrder(id), 3000);
    } else {
      const animatePulse = document.getElementById("animate-pulse");
      animatePulse.innerHTML = res.status;
      animatePulse.id = null;
    }
  } catch (error) {
    location.reload(true);
  }
};

const infoOrder = document.getElementById("info-orders");
if (infoOrder && infoOrder.dataset.status === "Process") {
  getStatusOrder(infoOrder.dataset.order);
} else if (infoOrder && infoOrder.dataset.status === "Unpaid") {
  getStatusOrder(infoOrder.dataset.order);
}

const btnTC = document.getElementById("btn-TC") || "";
const modalComp = document.getElementById("modal-tc") || "";
if (btnTC) {
  btnTC.addEventListener("click", function () {
    modalComp.style.display = "grid";
  });
  modalComp.addEventListener("click", function () {
    modalComp.style.display = "none";
  });
}
const btnCloseModal = document.getElementById("close-modal") || "";
if (btnCloseModal) {
  btnCloseModal.addEventListener("click", function () {
    modalComp.style.display = "none";
  });
}
const containerModal = document.getElementById("enxcontainer-modal") || "";
if (containerModal !== "") {
  containerModal.addEventListener("click", function (e) {
    e.stopPropagation();
  });
}
