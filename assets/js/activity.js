const API_ACT_URL = "/api/activity";

const packageOptActivity =
  document.getElementById("package-opt-activity") || "";
if (packageOptActivity !== "") {
  const countPackage = packageOptActivity.getAttribute("data-package");
  for (let i = 0; i < parseInt(countPackage); i++) {
    const btnDetailPkt =
      document.getElementById("btn-details-package" + i) || "";
    const modalComp = document.getElementById("modal-detail-act" + i) || "";
    const btnCloseModal = document.getElementById("close-modal" + i) || "";

    if (btnCloseModal) {
      btnCloseModal.addEventListener("click", function () {
        modalComp.style.display = "none";
      });
    }
    if (btnDetailPkt) {
      btnDetailPkt.addEventListener("click", function () {
        modalComp.style.display = "grid";
      });
      modalComp.addEventListener("click", function () {
        modalComp.style.display = "none";
      });
    }

    const dateSelected = document.getElementById("date-package-act" + i) || "";
    if (dateSelected) {
      dateSelected.addEventListener("change", function (e) {
        const idTicket = dateSelected.getAttribute("data-id-ticket");
        const msgCheckDate = document.getElementById("msg-error" + i);
        const elementQtyPackages = document.getElementById(
          "total-qty-package" + i
        );
        const btnSubmitPackage =
          document.getElementById("submit-package" + i) || "";

        getAvailDate(
          {
            id: idTicket,
            date: e.target.value,
          },
          msgCheckDate,
          elementQtyPackages,
          btnSubmitPackage
        );
        // console.log(parseInt(elementQtyPackages.value));
        if (
          parseInt(elementQtyPackages.value) > 0 &&
          msgCheckDate.innerText &&
          msgCheckDate.innerText != "checking date..."
        )
          return (btnSubmitPackage.disabled = false);
        return (btnSubmitPackage.disabled = true);
      });
    }

    const newTicketTypeAct = document.querySelectorAll("#new-ticket-type-act");
    newTicketTypeAct.forEach(function (element) {
      const idBtnSubmit = element.getAttribute("data-id-btn-submit");
      const btnSubmitPackage = document.getElementById(idBtnSubmit) || "";
      const qtyType = element.getAttribute("data-qty-type-act");
      const priceType = element.getAttribute("data-price");
      const totalPrice = element.getAttribute("data-total-price");
      const qty = document.getElementById(qtyType);

      const datePackageAct = element.getAttribute("data-date-package-act");
      let elementDatePackageAct = document.getElementById(datePackageAct);

      const msgError = element.getAttribute("data-msg-error");
      let elementMsgError = document.getElementById(msgError);

      const qtyPackage = element.getAttribute("data-qty-package-act");
      const elementQtyPackage = document.getElementById(qtyPackage);

      const btnDecrement = element.getAttribute("data-qty-act-dec");

      const attDataBookingTicket = element.getAttribute("data-booking-ticket");
      const attAllticket = element.getAttribute("data-all-ticket");
      const attIdTicketType = element.getAttribute("data-id-ticket-type");
      const elDataBookingTicket = document.getElementById(attDataBookingTicket);
      const elAllTicket = JSON.parse(
        document.getElementById(attAllticket).value
      );

      document.getElementById(btnDecrement).onclick = function () {
        if (parseInt(qty.innerText) <= 0) return;
        const qtyNewDec = parseInt(qty.innerText) - 1;
        elementQtyPackage.value = parseInt(elementQtyPackage.value) - 1;
        // console.log(elementQtyPackage.value);
        changeQty(elAllTicket, qtyNewDec, elDataBookingTicket, attIdTicketType);

        qty.innerText = qtyNewDec;
        updatePrice(
          document.getElementById(totalPrice),
          priceType,
          "dec",
          btnSubmitPackage,
          elementDatePackageAct ? elementDatePackageAct.value : "-",
          elementMsgError.innerText
        );
      };

      const btnIncrement = element.getAttribute("data-qty-act-inc");
      document.getElementById(btnIncrement).onclick = function () {
        const qtyNewInc = parseInt(qty.innerText) + 1;
        elementQtyPackage.value = parseInt(elementQtyPackage.value) + 1;
        qty.innerText = qtyNewInc;
        changeQty(elAllTicket, qtyNewInc, elDataBookingTicket, attIdTicketType);
        // console.log(elementQtyPackage.value);

        updatePrice(
          document.getElementById(totalPrice),
          priceType,
          "increment",
          btnSubmitPackage,
          elementDatePackageAct ? elementDatePackageAct.value : "-",
          elementMsgError.innerText
        );
      };

      const attrModal = element.getAttribute("data-modal-quest");
      const modalQuestion = document.getElementById(attrModal);
      const attDataTicketType = element.getAttribute("data-ticketType");
      const attIdActivity = element.getAttribute("data-id-activity");
      const attNameActivity = element.getAttribute("data-name-activity");
      const attidTicket = element.getAttribute("data-id-ticket");
      const attNameTicket = element.getAttribute("data-name-ticket");
      const attDefinedDuration = element.getAttribute("data-defined-duration");
      const attRequiredTimeSlot = element.getAttribute(
        "data-required-time-slot"
      );
      const attRequiredDate = element.getAttribute("data-required-date");

      btnSubmitPackage.onclick = function () {
        const data = {
          date: elementDatePackageAct?.value ?? "", //yyyy-mm-dd
          requiredDate: attRequiredDate == "true" ? true : false, //bol
          definedDuration: attDefinedDuration, //int
          requiredTimeSlot: attRequiredTimeSlot == "true" ? true : false, //bol
          timeSlot: "", //null
          packageId: attidTicket,
          packageName: attNameTicket,
          activityId: attIdActivity,
          activityName: attNameActivity,
          total: 0, //float,
          ticketType: JSON.parse(elDataBookingTicket.value),
          questionList: null,
        };

        const attrData = element.getAttribute("data-with-question");
        if (!attrData) return createSession(data);
        modalQuestion.style.display = "grid";
        const attrTimeSlot = element.getAttribute("data-time-slot");
        const dataresTimeSlot = JSON.parse(
          document.getElementById(attrTimeSlot).value
        );
        const dataQuestions = JSON.parse(
          element.getAttribute("data-questions")
        );
        // console.log(dataQuestions);
        const attrFormQuest = element.getAttribute("data-form-quest");
        const elementFormQuest = document.getElementById(attrFormQuest);
        const attrFormContent = elementFormQuest.getAttribute("data-content");
        const elementFormContent = document.getElementById(attrFormContent);

        // const ticketTyesss = JSON.parse(elDataBookingTicket.value);
        // console.log("testing", data.ticketType);

        let templateForm = data.requiredTimeSlot
          ? `
          <div class="flex gap-2 mb-5">
              <p>Select Time:</p>
              <select name="time-slot" id="" class="px-2"
                  style="border: solid 1px black !important; min-width: 30%">
                  <option value="">---</option>
                  ${dataresTimeSlot.map(
                    (item) => `<option value=${item}>${item}</option>`
                  )}
              </select>
          </div>
        `
          : "";

        // elementFormContent.innerHTML = templateFormTimeSlot;

        templateForm += data.ticketType
          .map((type) => {
            console.log(data);

            return `
            ${Array.from({ length: type.ticketQty })
              .map((_, idx) => {
                return `
                  ${
                    idx > 0
                      ? `<hr style="margin-top: 20px !important; margin-bottom: 10px !important;">`
                      : ""
                  }
                  <p class="font-bold">${type.ticketName} - ${idx + 1}</p>
                  ${dataQuestions
                    .map((quest) => {
                      if (quest.type == "DATE") {
                        return `
                        <div>
                            <p>${quest.question} :</p>
                            <input type="date"
                              name="${type.ticketId}:${
                          quest.id
                        }:${quest.question.replaceAll(
                          " ",
                          "_"
                        )}:${type.ticketName.toLowerCase()}-${idx + 1}"
                              class="w-full mb-2 px-2" style="border: solid 1px black !important;" required>
                        </div>
                        `;
                      } else if (quest.type == "OPTION") {
                        return `
                        <div>
                            <p>${quest.question} :</p>
                            <select
                                name="${type.ticketId}:${
                          quest.id
                        }:${quest.question.replaceAll(
                          " ",
                          "_"
                        )}:${type.ticketName.toLowerCase()}-${idx + 1}"
                                id="" class="w-full mb-2 px-2" style="border: solid 1px black !important;" required>
                                <option value="">---</option>
                                ${quest.options.map(
                                  (item) =>
                                    `<option value=${item}>${item}</option>`
                                )}
                            </select>
                        </div>
                        `;
                      } else {
                        return `
                          <div class="">
                          <p>${quest.question} :</p>
                              <input type="text"
                                  name="${type.ticketId}:${
                          quest.id
                        }:${quest.question.replaceAll(
                          " ",
                          "_"
                        )}:${type.ticketName.toLowerCase()}-${idx + 1}"
                                  class="w-full mb-2 px-2" style="border: solid 1px black !important;" required>
                          </div>
                        `;
                      }
                    })
                    .join("")}
                  `;
              })
              .join("")}
          `;
          })
          .join("");

        elementFormContent.innerHTML = templateForm;

        elementFormQuest.addEventListener("submit", (e) => {
          e.preventDefault();
          let formData = new FormData(elementFormQuest);

          let formDataObject = [];
          let timeSlotValue = "";

          formData.forEach((value, key) => {
            // formDataObject[key] = value;
            if (key == "time-slot") {
              timeSlotValue = value;
            }

            if (key != "time-slot") {
              const keyData = key.split(":");
              const name = keyData[3].toUpperCase();
              const ticketId = keyData[0];
              const ticketName = keyData[3].split("-")[0].toUpperCase();
              const id = keyData[1];
              const question = keyData[2].replaceAll("_", " ");
              const answer = value;

              // Bisa
              formDataObject.push({
                name: name,
                ticketId: ticketId,
                ticketName: ticketName,
                id: id,
                question: question,
                answer: answer,
              }); // End Bisa
            }
          });
          // console.log({
          //   ...data,
          //   timeSlot: timeSlotValue,
          //   questionList: formDataObject.length > 0 ? formDataObject : null,
          // });
          return createSession({
            ...data,
            timeSlot: timeSlotValue,
            questionList: formDataObject.length > 0 ? formDataObject : null,
          });
        });
      };

      const attrCloseModal = element.getAttribute("data-close-modal");
      const btnCloseModalQuest = document.getElementById(attrCloseModal);
      // console.log(attrCloseModal, btnCloseModalQuest);
      btnCloseModalQuest.onclick = function () {
        modalQuestion.style.display = "none";
      };
    });
  }
}

function changeQty(elAllTicket, qty, elDataBookingTicket, attIdTicketType) {
  let ticketTypeSelected =
    elDataBookingTicket.value == ""
      ? []
      : JSON.parse(elDataBookingTicket.value);
  elAllTicket.filter((data, idx) => {
    if (data.id == attIdTicketType) {
      let indexOld = null;
      ticketTypeSelected.filter((oldData, idxOld) => {
        if (oldData.ticketId == data.id) {
          indexOld = idxOld;
        }
      });

      if (indexOld !== null) {
        ticketTypeSelected[indexOld] = {
          index: idx,
          ticketId: data.id,
          ticketName: data.name,
          ticketQty: qty,
          price: data.price,
          price_idr: data.price_idr,
          applyToAllQna: data.applyToAllQna,
          sku: data.sku,
        };
      } else {
        ticketTypeSelected.push({
          index: idx,
          ticketId: data.id,
          ticketName: data.name,
          ticketQty: qty,
          price: data.price,
          price_idr: data.price_idr,
          applyToAllQna: data.applyToAllQna,
          sku: data.sku,
        });
      }
    }
  });
  elDataBookingTicket.value = JSON.stringify(ticketTypeSelected);
}

function updatePrice(initialPrice, price, method, btn, dateVal, msg) {
  // console.log(dateVal);
  // console.log(initialPrice, price, method, btn);
  const digitCurr = parseInt(initialPrice.getAttribute("data-digit"));
  var prevPrice = parseFloat(initialPrice.innerText);
  var priceType = parseFloat(price);
  if (method == "increment") {
    prevPrice = prevPrice + priceType;
  } else {
    prevPrice = prevPrice - priceType;
  }
  initialPrice.innerText = prevPrice.toFixed(digitCurr);
  if (prevPrice <= 0 || !dateVal || msg) return (btn.disabled = true);
  return (btn.disabled = false);
}

const btnFindPakcage = document.getElementById("find-package-act") || "";
if (btnFindPakcage) {
  btnFindPakcage.addEventListener("click", function () {
    packageOptActivity.scrollIntoView({ behavior: "smooth" });
  });
}

async function getAvailDate(data, elMsg, elementQtyPackages, btnSubmitPackage) {
  // console.log(data, elMsg);
  elMsg.innerText = "checking date...";
  const loader = document.getElementById(
    btnSubmitPackage.getAttribute("data-spinner")
  );
  loader.classList.add("spinner-654");
  loader.innerText = "";

  try {
    const url = API_ACT_URL + "/check-block-date";
    const result = await fetch(url, {
      method: "POST",
      headers: {
        Accept: "application/json",
        "Content-Type": "application/json",
      },
      body: JSON.stringify(data),
    });
    const res = await result.json();
    // console.log(res);
    if (res.result === "ok") {
      loader.classList.remove("spinner-654");
      loader.innerText = "Select Package";
      elMsg.innerText = "";
      if (parseInt(elementQtyPackages.value) > 0)
        return (btnSubmitPackage.disabled = false);
    }
    if (res.result === "no") {
      const arrMsg = res.message.date ? res.message.date[0] : res.message;
      elMsg.innerText = arrMsg;
      loader.classList.remove("spinner-654");
      loader.innerText = "Select Package";
      return (btnSubmitPackage.disabled = true);
    }
    //  else {
    //   elMsg.innerText = "";
    //   return (btnSubmitPackage.disabled = false);
    // }
  } catch (error) {
    console.log(error);
    elMsg.innerText = "Internal Server Error";
  }
}

async function createSession(params) {
  // const body = [
  //   {
  //     date: "", //yyyy-mm-dd
  //     requiredDate: "", //bol
  //     definedDuration: 1, //int
  //     requiredTimeSlot: "", //bol
  //     timeSlot: "", //null
  //     packageId: "",
  //     packageName: "",
  //     activityId: "",
  //     activityName: "",
  //     total: 1, //float
  //     ticketType: [
  //       {
  //         index: 1,
  //         ticketId: "",
  //         ticketName: "",
  //         ticketQty: "",
  //         price: 1,
  //         price_idr: 1,
  //         applyToAllQna: true,
  //         sku: "",
  //       },
  //     ],
  //     questionList: null,
  //   },
  // ];

  const body = params;
  try {
    const url = API_ACT_URL + "/generate-act-session";
    const result = await fetch(url, {
      method: "POST",
      headers: {
        Accept: "application/json",
        "Content-Type": "application/json",
      },
      body: JSON.stringify([body]),
    });
    const res = await result.json();
    // console.log(res);
    location.href = res;
  } catch (error) {
    console.log(error);
  }
}

const formBookActivity =
  document.getElementById("checkout-form-activity") || "";
if (formBookActivity) {
  formBookActivity.addEventListener("submit", async (e) => {
    e.preventDefault();
    let formData = new FormData(formBookActivity);
    let datas = {};
    formData.forEach((value, key) => {
      let element = document.getElementById(key) ?? "";
      let elementError = document.getElementById(key + "_error") ?? "";

      if (element) {
        element.classList.remove("is-invalid");
      }

      if (elementError) {
        elementError.innerText = "";
      }
      datas[key] = value;
    });
    const res = await bookingActivity(datas);
    // console.log(res);
    if (res.result == "no") {
      const elementIds = res.keys;
      const messages = res.message;
      elementIds.forEach((elementId) => {
        let element = document.getElementById(elementId) ?? "";
        let elementError = document.getElementById(elementId + "_error") ?? "";

        if (element) {
          element.classList.add("is-invalid");
        }

        if (elementError) {
          elementError.innerText = messages[elementId][0];
        }
      });
    } else if (res.result == "session-end") {
      checkSession(true);
    } else {
      // console.log(res);
      window.location.href = res.invoiceUrl;
    }
  });
}

async function bookingActivity(params) {
  const body = params;
  // console.log(body);
  try {
    const url = API_ACT_URL + "/booking-act";
    const result = await fetch(url, {
      method: "POST",
      headers: {
        Accept: "application/json",
        "Content-Type": "application/json",
      },
      body: JSON.stringify(body),
    });
    const res = await result.json();
    // console.log(res);
    return res;
    // window.location.href = res;
  } catch (error) {
    console.log(error);
  }
}

function checkSession(isFromFetching = false) {
  // if (isFromFetching) {
  //   console.log("testing no session");
  //   return;
  // }
  const dataSession = document.getElementById("data-booking-activity");
  const data = dataSession.dataset.bookingActivity;

  const modal = document.getElementById("modal-session-end");
  modal.style.setProperty("display", "grid");

  const close = document.getElementById("close-modal-session-end");
  close.onclick = function () {
    modal.style.display = "none";
  };
}

const elDataExpiredAct = document.getElementById("data-expired-activity");
function checkActivityExpiration() {
  if (elDataExpiredAct) {
    const dateExpiredString = elDataExpiredAct.getAttribute(
      "data-expired-activity"
    );
    const dateExpired = new Date(dateExpiredString);
    checkExpirationAct(dateExpired);
  }
}
function checkExpirationAct(expirationDate) {
  const now = new Date();
  const nowGMT = new Date(now.getTime() + now.getTimezoneOffset() * 60000);
  // console.log(expirationDate + " --- " + nowGMT.toUTCString());
  const timeDiff = expirationDate.getTime() - nowGMT.getTime();
  const secondsLeft = Math.floor(timeDiff / 1000);
  if (secondsLeft <= 0) {
    // console.log("Tanggal kedaluwarsa atau sudah lewat.");
    const elExpiredShow = document.getElementById("is-show-exp-act");
    elExpiredShow.innerHTML = `
    <div style="background-color: #C7365950; padding: 12px; border-radius: 8px">
    <p class="font-bold">Your order payment has expired.</p>
    <p>Sorry, the payment link has expired. Therefore, your order is considered failed. Please try reordering if you are still interested.</p>
    </div>`;
    const btnPayAnother = document.getElementById("btn-pay-another-act");
    btnPayAnother.style.visibility = "hidden";
  } else {
    const elCountDown = document.getElementById("count-down-expired-act");
    elCountDown.innerText = formatTimeAct(secondsLeft);
    setTimeout(checkActivityExpiration, 1000);
  }
}
function formatTimeAct(seconds) {
  const hours = Math.floor(seconds / 3600);
  const minutes = Math.floor((seconds % 3600) / 60);
  const remainingSeconds = seconds % 60;
  const paddedHours = String(hours).padStart(2, "0");
  const paddedMinutes = String(minutes).padStart(2, "0");
  const paddedSeconds = String(remainingSeconds).padStart(2, "0");
  return `${paddedHours} : ${paddedMinutes} : ${paddedSeconds}`;
}

checkActivityExpiration();
