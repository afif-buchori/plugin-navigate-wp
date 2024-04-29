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
    console.log(dateSelected);
    dateSelected.addEventListener("change", function (e) {
      const idTicket = dateSelected.getAttribute("data-id-ticket");
      getAvailDate({
        id: idTicket,
        date: e.target.value,
      });
      console.log(e.target.value, idTicket);
    });

    const btnSubmitPackage =
      document.getElementById("submit-package" + i) || "";

    const newTicketTypeAct = document.querySelectorAll("#new-ticket-type-act");
    newTicketTypeAct.forEach(function (element) {
      var qtyType = element.getAttribute("data-qty-type-act");
      const qty = document.getElementById(qtyType);

      var btnDecrement = element.getAttribute("data-qty-act-dec");
      console.log("TESTING");
      document.getElementById(btnDecrement).onclick = function () {
        if (parseInt(qty.innerText) <= 0)
          return (btnSubmitPackage.disabled = true);
        qty.innerText = parseInt(qty.innerText) - 1;
        btnSubmitPackage.disabled = false;
      };

      var btnIncrement = element.getAttribute("data-qty-act-inc");
      document.getElementById(btnIncrement).onclick = function () {
        qty.innerText = parseInt(qty.innerText) + 1;
        btnSubmitPackage.disabled = true;
      };
    });
  }
}

const btnFindPakcage = document.getElementById("find-package-act") || "";
if (btnFindPakcage) {
  btnFindPakcage.addEventListener("click", function () {
    packageOptActivity.scrollIntoView({ behavior: "smooth" });
  });
}

function getAvailDate(data) {
  console.log(data);
  var timeCalculate;
  // var isGetData = 0;

  // addonSetLoading(true);
  // clearTimeout(timeCalculate);
  // timeCalculate = setTimeout(

  async () => {
    console.log("STEP - 1");
    try {
      console.log("STEP - 2");
      const url = API_ACT_URL + "/check-block-date";
      console.log(url);
      const result = await fetch(url, {
        method: "POST",
        headers: {
          Accept: "application/json",
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ id: "9125", date: "2024-05-13" }),
      });
      console.log("STEP - 3");
      console.log(result);
    } catch (error) {
      console.log(error);
    }
  };
}

// async () => {
//   console.log("STEP - 1");
//   try {
//     console.log("STEP - 2");
//     const url = API_ACT_URL + "/check-block-date";
//     const result = await fetch(url, {
//       method: "POST",
//       headers: {
//         Accept: "application/json",
//         "Content-Type": "application/json",
//       },
//       body: JSON.stringify({ id: "9125", date: "2024-05-13" }),
//     });
//     console.log("STEP - 3");
//     console.log(result);
//   } catch (error) {
//     console.log(error);
//   }
// };
