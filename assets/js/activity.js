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
      console.log(e.target.value);
    });

    const btnSubmitPackage = document.getElementById("submit-package1") || "";
    btnSubmitPackage.setAttribute("disabled", "false");
    console.log(btnSubmitPackage);

    const newTicketTypeAct = document.querySelectorAll("#new-ticket-type-act");
    newTicketTypeAct.forEach(function (element) {
      var qtyType = element.getAttribute("data-qty-type-act");
      const qty = document.getElementById(qtyType);

      var btnDecrement = element.getAttribute("data-qty-act-dec");
      console.log("TESTING");
      document.getElementById(btnDecrement).onclick = function () {
        if (parseInt(qty.innerText) <= 0)
          return btnSubmitPackage.setAttribute("disabled", "true");
        qty.innerText = parseInt(qty.innerText) - 1;
        btnSubmitPackage.setAttribute("disabled", "false");
      };

      var btnIncrement = element.getAttribute("data-qty-act-inc");
      document.getElementById(btnIncrement).onclick = function () {
        qty.innerText = parseInt(qty.innerText) + 1;
        btnSubmitPackage.setAttribute("disabled", "true");
      };
    });
  }
}
