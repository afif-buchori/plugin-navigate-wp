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
        const elementQtyPackages = document.getElementById("total-qty-package" + i);
        const btnSubmitPackage = document.getElementById("submit-package" + i) || "";

        const result = getAvailDate(
          {
            id: idTicket,
            date: e.target.value,
          },
          msgCheckDate
        );
        if (parseInt(elementQtyPackages) > 0 || result != 'no') return btnSubmitPackage.disabled = false;
        return btnSubmitPackage.disabled = true;
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
      
      const qtyPackage = element.getAttribute("data-qty-package-act");
      const elementQtyPackage = document.getElementById(qtyPackage);

      const btnDecrement = element.getAttribute("data-qty-act-dec");
      console.log("APA AJAH DEH");
      document.getElementById(btnDecrement).onclick = function () {
        if (parseInt(qty.innerText) <= 0) return;
        const qtyNewDec = parseInt(qty.innerText) - 1;
        elementQtyPackage.value = parseInt(elementQtyPackage.value) - qtyNewDec;
        qty.innerText = qtyNewDec;
        updatePrice(
          document.getElementById(totalPrice),
          priceType,
          "dec",
          btnSubmitPackage,
          elementDatePackageAct ? elementDatePackageAct.value : '-'
        );
      };

      const btnIncrement = element.getAttribute("data-qty-act-inc");
      document.getElementById(btnIncrement).onclick = function () {
        const qtyNewInc = parseInt(qty.innerText) + 1;
        elementQtyPackage.value = parseInt(elementQtyPackage.value) + qtyNewInc;
        qty.innerText = qtyNewInc;

        updatePrice(
          document.getElementById(totalPrice),
          priceType,
          "increment",
          btnSubmitPackage,
          elementDatePackageAct ? elementDatePackageAct.value : '-'
        );
      };

      const attrModal = element.getAttribute("data-modal-quest");
      const modalQuestion = document.getElementById(attrModal);
      btnSubmitPackage.onclick = function () {
        modalQuestion.style.display = "grid";
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

function updatePrice(initialPrice, price, method, btn, dateVal) {
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
  if (prevPrice <= 0 || !dateVal) return (btn.disabled = true);
  return (btn.disabled = false);
}

const btnFindPakcage = document.getElementById("find-package-act") || "";
if (btnFindPakcage) {
  btnFindPakcage.addEventListener("click", function () {
    packageOptActivity.scrollIntoView({ behavior: "smooth" });
  });
}

async function getAvailDate(data, elMsg) {
  console.log(data, elMsg);

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
    if (res.result === "no") elMsg.innerText = res.message;
    return res.result;
  } catch (error) {
    console.log(error);
    return 'no';
  }
}
