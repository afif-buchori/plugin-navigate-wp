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
        console.log(parseInt(elementQtyPackages.value));
        if (parseInt(elementQtyPackages.value) > 0 && msgCheckDate.innerText)
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
      console.log("APA AJAH DEH");

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
        console.log(elementQtyPackage.value);
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
        console.log(elementQtyPackage.value);

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
        console.log(elementDatePackageAct);
        const data = {
          date: elementDatePackageAct?.value, //yyyy-mm-dd
          requiredDate: attRequiredDate, //bol
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
        // console.log(elAllTicket, attIdTicketType);
        // console.log(tes);
        // console.log(JSON.parse(attDataTicketType));
        const attrData = element.getAttribute("data-with-question");
        if (!attrData) return createSession(data);
        modalQuestion.style.display = "grid";

        const attrFormQuest = element.getAttribute("data-form-quest");
        const elementFormQuest = document.getElementById(attrFormQuest);
        elementFormQuest.addEventListener("submit", (e) => {
          e.preventDefault();
          let formData = new FormData(elementFormQuest);
          // console.log(formData);

          let formDataObject = [];

          formData.forEach((value, key) => {
            const keyData = key.split(":");

            // // Bisa
            // formDataObject.push({
            //   type: keyData[2],
            //   id: keyData[0],
            //   question: keyData[1].replaceAll("_", " "),
            //   answer: value,
            // }); // End Bisa

            let newData = formDataObject[keyData[2]] ?? [];
            
            if (newData.length > 0) {

              newData.push({
                id: keyData[0],
                question: keyData[1].replaceAll("_", " "),
                answer: value,
              });
            } else {
              newData = [
                {
                  id: keyData[0],
                  question: keyData[1].replaceAll("_", " "),
                  answer: value,
                },
              ];
            }

              formDataObject[keyData[2]] = newData;
          });
          console.log(formDataObject);
          // const huhu = { ...data, questionList: formDataObject };
          // console.log(formDataObject);
          // console.log(JSON.stringify(huhu));
          // return createSession({ ...data, questionList: formDataObject });
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
  console.log(dateVal);
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
  console.log(data, elMsg);
  elMsg.innerText = "checking date...";
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
    console.log(res);
    if (res.result === "ok") {
      elMsg.innerText = "";
      if (parseInt(elementQtyPackages.value) > 0)
        return (btnSubmitPackage.disabled = false);
    }
    if (res.result === "no") {
      const arrMsg = res.message.date ? res.message.date[0] : res.message;
      elMsg.innerText = arrMsg;
      return (btnSubmitPackage.disabled = true);
    }
    //  else {
    //   elMsg.innerText = "";
    //   return (btnSubmitPackage.disabled = false);
    // }
  } catch (error) {
    console.log(error);
    elMsg.innerText = "-";
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
    console.log(res);
    location.href = res;
  } catch (error) {
    console.log(error);
  }
}
